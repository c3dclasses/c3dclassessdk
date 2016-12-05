//----------------------------------------------------------------
// file: cstdio.drv.js
// desc: input and output helper classes
//----------------------------------------------------------------

//-------------------------------------------------------------------
// file: CStdio
// desc: contains standard input and output function
//----------------------------------------------------------------
var CStdio = new Class({
	ClassMethods : {
		//-----------------------------------------------
		// name: _print()
		// desc: prints to a destination
		//-----------------------------------------------
		_print : function(str, dst) {
			if(!str && isNaN(str))
				str="";			
			if(CObqueue.ob_started) {
				CObqueue.ob_output += str;
				alert(str);
				return;
			} // end if
			if(!dst) { 
				dst = "#ckernal-output";
				if(CThread.m_objcontext_cur) 
					dst = CThread.m_objcontext_cur.jq();
				else if(CThread.m_cthread_cur && CThread.m_cthread_cur.m_objcontext)
					dst = CThread.m_cthread_cur.m_objcontext.jq();
			} // end if	
			var node = jQuery(dst);
			if(node)
				node.html(node.html()+str); 
			return; 
		}, // end _print()
		
		//-----------------------------------------------
		// name: _print_r()
		// desc: prints to a destination or string
		//-----------------------------------------------
		_print_r : function(mixed, btostring, dst) {
			var str = dump(mixed); 
			if(btostring) 
				return str;
			return CStdio._print(str, dst);
		}, // end _print_r()
	} // end ClassMethods
}); // end CStdio

//------------------------------------------------------------
// name: CObqueue
// desc: stores output in a buffer to be printed/used later
//------------------------------------------------------------
var CObqueue = new Class ({
	ClassMethods : {	
		//--------------------------------------------
		// name: ob_start()
		// desc: start sending output to a buffer
		//--------------------------------------------
		ob_start_stack : [],
		ob_output : "",
		ob_started : false,
		ob_start : function() {
			if(CObqueue.ob_output) {
				CObqueue.ob_start_stack.push(CObqueue.ob_output);
				CObqueue.ob_output = "";
			} // end if 
			CObqueue.ob_started = true;
			return;
		}, // end ob_start()
		
		//---------------------------------------
		// name: ob_end()
		// desc: returns the accumulated output
		//---------------------------------------
		ob_end : function() {
			var ret = CObqueue.ob_output;
			if(CObqueue.ob_start_stack.length > 0)
				CObqueue.ob_output = CObqueue.ob_start_stack.pop();
			if(CObqueue.ob_start_stack.length <= 0)
				CObqueue.ob_started = false;
			return ret;
		}, // end ob_end()
		
		//--------------------------------------------
		// name: ob_end_queue()
		// desc: dumps the output contents to a queue
		//--------------------------------------------
		ob_queues : {},
		ob_end_queue : function(queueid) {
			if(!CObqueue.ob_queues[queueid])
				CObqueue.ob_queues[queueid] = "";
			CObqueue.ob_queues[queueid] += CObqueue.ob_end();
		}, // end ob_end_queue()
		
		//--------------------------------------------------------------
		// name: ob_queue_dump()
		// desc: dumps the contents of the queue
		//--------------------------------------------------------------
		ob_queue_dump : function(strid) {
			return (!strid || !CObqueue.ob_queues[strid])  ? "" : CObqueue.ob_queues[strid];	
		} // end ob_queue_dump()		
	} // end ClassMethods
}); // end CObqueue