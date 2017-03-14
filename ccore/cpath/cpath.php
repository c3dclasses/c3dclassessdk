<?php
//-----------------------------------------------------------------------------------------
// file: cpath.php
// desc: defines a class that store path information used globally throughout the sdk
//-----------------------------------------------------------------------------------------

// header
include_js( relname(__FILE__) . "/cpath.js" );

//-----------------------------------------------------------------------------------------
// name: CPath
// desc: defines a class that store path information used globally throughout the sdk
//-----------------------------------------------------------------------------------------
class CPath {
	// ClassMethods
	public static $m_chashpath = NULL;
	public static function add($strpathname, $strpathvalue, $params=NULL) {	
		if($strpathname == "" || $strpathname == NULL || $strpathvalue == NULL || $strpathvalue ==  "")
			return false;
		if(CPath :: $m_chashpath == NULL)
			CPath :: $m_chashpath = new CHash();				
		if(!$params) 
			$params = array();
		$params["path"] = $strpathvalue;
		CPath :: $m_chashpath->set($strpathname, $params);
		return true;
	} // end add()
	public static function remove($strpathname) {
		if($strpathname == "" || $strpathname == NULL || CPath::$m_chashpath == NULL)
			return false;	
		CPath :: $m_chashpath->remove($strpathname);
		return true;
	} // end remove()
	public static function get($strpathname) { 
		return (CPath :: $m_chashpath != NULL) ? CPath :: $m_chashpath->get($strpathname) : null;
	} // end get()
	public static function _($strpathname) {
		$path = CPath :: get($strpathname);
		return ($path) ? $path["path"] : "";
	} // end _()
	// end ClassMethods
} // end CPath

// includes 
function include_path($strpathname, $strpathvalue, $params=NULL) {
	return CPath :: add($strpathname, $strpathvalue, $params);
} // end include_path
?>