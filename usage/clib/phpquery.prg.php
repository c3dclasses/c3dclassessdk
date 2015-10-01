<?php
//---------------------------------------------------------------------------
// name: phpquery_prog.prg.php
// desc: demonstates how to use phpquery_prog
//---------------------------------------------------------------------------

// includes
include_program("phpquery_prog");

//---------------------------------------------------
// name: phpquery_prog
// desc: demonstatrates how to use phpquery_prog
//---------------------------------------------------
class phpquery_prog extends CProgram{
	public function phpquery_prog(){ 
		parent :: CProgram();	
	} // end phpquery_prog()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>phpquery_prog</b>");
	
	$doc = phpQuery::newDocument('<div/>');
	// array syntax works like ->find() here
	$doc['div']->append('<ul></ul>');
	// array set changes inner html
	$doc['div ul'] = '<li>1</li><li>2</li><li>3</li>';
	// almost everything can be a chain
	$li = NULL;
	$doc['ul > li']
        ->addClass('my-new-class')
        ->filter(':last')
        ->addClass('last-li')
	// save it anywhere in the chain
                ->toReference($li);
	
	$doc['div']->append("<script>alert('hello, world');</script>");
	
	
	// pq(); is using selected document as default
	phpQuery::selectDocument($doc);
	// documents are selected when created or by above method
	// query all unordered lists in last selected document
	pq('ul')->insertAfter('div');
	// all LIs from last selected DOM
	foreach(pq('li') as $li) {
        // iteration returns PLAIN dom nodes, NOT phpQuery objects
        $tagName = $li->tagName;
        $childNodes = $li->childNodes;
        // so you NEED to wrap it within phpQuery, using pq();
        pq($li)->addClass('my-second-new-class');
	}
	
	foreach(pq('script') as $script) {
        // iteration returns PLAIN dom nodes, NOT phpQuery objects
        $tagName = $script->tagName;
        $childNodes = $script->childNodes;
        // so you NEED to wrap it within phpQuery, using pq();
        pq($script)->addClass('my-class');
		pq($script)->html( pq($script)->html() . " alert('appending to the html');" );
	}
	
	// 1st way
//	print phpQuery::getDocument($doc->getDocumentID());
	// 2nd way
//	print phpQuery::getDocument(pq('div')->getDocumentID());
	// 3rd way
//	print pq('div')->getDocument();
	// 4th way
//	print $doc->htmlOuter();
	// 5th way
	print $doc;
	// another...
//	print $doc['ul'];
	
	return ob_end();
	} // end innerhtml()
} // end phpquery_prog
?>