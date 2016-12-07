 <?php
//-----------------------------------------------------------------------------------------
// file: carray.php
// desc: defines the array object
//-----------------------------------------------------------------------------------------

// include the javascript file
include_js(relname(__FILE__) . "/carray.js");

//-------------------------------------------
// class CArray
// desc: creates a array object
//-------------------------------------------
class CArray{
	// members
	protected $m_array;
	public function CArray($mvalue=NULL) {
		$this->m_array = Array();
		if($mvalue == NULL)
			return;
		if(is_array($mvalue)) {
			$this->m_array = array_merge($mvalue, $this->m_array);
			return;
		} // end if
		else if(is_array($mvalue)) {
			$this->m_array = array_fill(0, $mvalue, 0);
		} // end if
	} // end CArray()
	public function length(){ return($this->m_array == NULL) ? 0 : count($this->m_array); }

    	public function indexOf($element) { return(($index = array_search($element, $this->m_array)) == FALSE) ? -1 : $index; }
	public function lastIndexOf($element) { 
		$len = $this->length(); 
		if($len <= 0) 
		return -1; 
		for($i=0; $i<$len; $i++) 
			if($element == $this->m_array[$i]) 
				return $i; 
		return -1; 
	} // end lastIndexOf() 
	public function get($iindex) { return $this->m_array[$iindex]; }
	public function pop() { return array_pop($this->m_array);  }
	public function push() { 
		if(func_num_args() < 1)
			return;
		$args = func_get_args();
		foreach($args as $index => $value)
			array_push($this->m_array, $value);
		return $this->length();
    	} // end push()
    	public function concat($array) { return new CArray(array_merge($array, $this->m_array)); }
	public function join($seperator) { return implode($seperator,  $this->m_array); }
    	public function reverse() { $this->m_array = array_reverse($this->m_array); return $this;}
	public function shift() { return array_shift($this->m_array); }
	public function unshift() {
		if(func_num_args() < 1)
			return;
		$args = array_reverse(func_get_args());
		foreach($args as $index => $value)
			array_unshift($this->m_array, $value);
        	return $this->length();
    	} // end unshift()
    	public function slice($offset, $length = NULL, $preserve_keys = false) { 
		return new CArray(array_slice($this->m_array, $offset, $length, $preserve_keys)); 
	} // end slice()
	public function splice($offset, $length = 0, $replacement = NULL) { 
		return new CArray(array_splice($this->m_array, $offset, $length, $replacement)); 
	} // end splice()
	public function insertAt($index, $value) {
		if($this->m_array == NULL)
			$this->m_array = array();
		array_splice($this->m_array,$index,0,$value);
		return $this->length();
	} // end insertAt()
	public function toString() { return print_r($this->m_array, TRUE); }
    	public function valueOf() { return $this->m_array; }
    	public function sort($fnsort=NULL) { usort($this->m_array, $fnsort); }
	public function & _() { return $this->m_array; }
	public function visit($fnvisit) { 
		if(is_callable($fnvisit) && $this->m_array)
			foreach($this->m_array as $index => $value) 
				call_user_func($fnvisit, $index, $value);
	} // end visit()
	public function toStringVisit($fnvisit, $cdata=NULL) { 
		$str = ""; 
		if(is_callable($fnvisit) && $this->m_array) 
			foreach($this->m_array as $index => $value) 
				$str .= call_user_func($fnvisit, $index, $value, $cdata); 
		return $str; 
	} // end toStringVisit()
	public function remove($value) { 
		if(($i = $this->indexOf($value))<=-1)
			return false; 
		array_splice($this->m_array,$i, 1);  
		return true; 
	} // end remove()
	public function removeAt($index) { array_splice($this->m_array,$index,1); }
	public function removeAll($value) { while($this->remove($value)) {} }
	public function shuffle() { return shuffle($this->m_array); }
} // end CArray

// functions 
function carray() {
	return new CArray(func_get_args()); 
} // end carray()
?>