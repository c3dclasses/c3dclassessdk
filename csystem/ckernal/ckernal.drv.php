<?php
//----------------------------------------------------------------------------
// name: ckernal.drv.php
// desc: driver functionality for ckernal object to communicate with libs  
//----------------------------------------------------------------------------

//////////////////////////////
// renders the HTML 

//---------------------------------------------------
// name: CKernal_doHead()
// desc: renders the head html of the document
//---------------------------------------------------
function CKernal_doHead($ckernal) {
	$str = "\n<!-- BEGIN CKernal_doHead() -->\n";
	$str .= CHook :: fire("head");
	$str .= "<style>"; 
	$str .= CMinify :: cssToString(CKernal_doStyle($ckernal));
	$str .= "</style>";
	$str .= "<script>"; 
	$str .= CMinify :: jsToString(CKernal_doScript($ckernal));
	$str .= "</script>";
	$str .= "\n<!-- END CKernal_doHead() -->\n";
	return $str; 
} // end doHead()

//---------------------------------------------------
// name: CKernal_doFoot()
// desc: renders the foot html of the document
//---------------------------------------------------
function CKernal_doFoot($ckernal) { 
	$str = "\n<!-- BEGIN CKernal_doFoot() -->\n";
	$str .= CHook :: fire("foot");
	$str .= "<script>";
	//$str .= CMinify :: jsToString(CKernal_doFScript($ckernal));
	$str .= CKernal_doFScript($ckernal);
	$str .= "</script>";
	$str .= "<span id=\"ckernal-output\"></span>";
	$str .= "\n<!-- END CKernal_doFoot() -->\n";
	return $str;
} // end CKernal_doFoot()

//----------------------------------------------------
// name: CKernal_doBody()
// desc:
//----------------------------------------------------
function CKernal_doBody($ckernal) {
	return ($ckernal->m_strbody) ? $ckernal->m_strbody : (CHook :: fire("body") . ob_queue_dump("body"));
} // end CKernal_doBody()

//////////////////////////////
// helper methods

//---------------------------------------------------
// name: CKernal_doStyle()
// desc:
//---------------------------------------------------
function CKernal_doStyle($ckernal) {
	return CHook :: fire("style") . $ckernal->m_strstyle . ob_queue_dump("style");
} // end CKernal_doStyle()

//---------------------------------------------------
// name: CKernal_doScript()
// desc:
//---------------------------------------------------
function CKernal_doScript($ckernal) {
	return CHook :: fire("script") . $ckernal->m_strscript . ob_queue_dump("script");
} // end CKernal_doScript()

//---------------------------------------------------
// name: CKernal_doFScript()
// desc:
//---------------------------------------------------
function CKernal_doFScript($ckernal) {
	return  CHook :: fire("fscript") . $ckernal->m_strfscript . ob_queue_dump("fscript");
} // end CKernal_doFScript()

//---------------------------------------------------
// name: CKernal_doPreBody()
// desc: renders the body html of the document
//---------------------------------------------------
function CKernal_doPreBody($ckernal) {
	$ckernal->m_strfscript = NULL;
	$ckernal->m_strscript = NULL;
	$ckernal->m_strbody = NULL;
	$strbody = $ckernal->body();
	$doc = phpQuery::newDocumentHTML($strbody); 
	phpQuery::selectDocument($doc);
	foreach (pq('script[parse], style') as $element) {
        if (strtolower($element->tagName) == "script") {
			if (strtolower(pq($element)->attr("location")) == "footer") {
				$ckernal->m_strfscript .= pq($element)->html();
			} // end if
			else $ckernal->m_strscript .= pq($element)->html();
		} // end if
		else $ckernal->m_strstyle .= pq($element)->html();
	} // end foreach ()
	// remove style and script[parse] tags and store the rest of body 
	pq('script[parse], style')->remove();
	$ckernal->m_strbody = CMinify :: htmlToString($doc->html()); 
	return;
} // end CKernal_doPreBody()
?>