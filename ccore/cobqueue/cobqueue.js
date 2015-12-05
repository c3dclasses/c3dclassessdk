//-----------------------------------------------------------------------------------------
// file: cobqueue.js
// desc: defines a queue object
//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------
// name: CObqueue
// desc: defines a queue object
//-----------------------------------------------------------
var CObqueue = new Class ({	
	// constructor
	initialize : function(){
		this.m_content="";
	}, // end initialize()
	
	create : function(params){
		return true;
	}, // end create()
	
	getContents : function(){ 
		return this.m_content;
	}, // end getContents();
	
	setContent : function( strcontent ){ 
		this.m_content = strcontent;
	}, // end setContent();

	ClassMethods : {		
		m_cobqueues:null,
		m_buffer:"",
		m_bstart:false,
		createCObqueue : function( strid, params ){
			var cobqueue = null;
			if( strid == null || strid == "" )
				return null;
			if( CObqueue.m_cobqueues == null )
				CObqueue.m_cobqueues = {};	
			if( CObqueue.m_cobqueues[strid] == null &&
				( cobqueue = new CObqueue() ) &&
				cobqueue.create(params) ){
				CObqueue.m_cobqueues[strid] = cobqueue;
			} // end if
			else cobqueue = CObqueue.m_cobqueues[strid];
			return cobqueue;
		}, // createCObqueue()
		
		dumpCObqueue : function( strid ){
			return ( CObqueue.m_cobqueues && CObqueue.m_cobqueues[strid] ) 
				? CObqueue.m_cobqueues[strid].getContents() : null;
		} // end dumpCObqueue()
	} // end ClassMethods
}); // end CObqueue

function ob_start(){
	CObqueue.m_buffer="";
	CObqueue.m_bstart=true;
} // end ob_start()

function ob_end(){
	CObqueue.m_bstart=false;	
} // end ob_end()

function ob_get_contents(){
	return CObqueue.m_buffer;	
} // end ob_get_contents()

function ob_end_clean(){
	CObqueue.m_buffer="";
	CObqueue.m_bstart=false;	
} // end ob_end_clean()

function ob_end_queue( strid, params ){
	var cobqueue=null;
	if( strid == null || strid == "" ||  (cobqueue=CObqueue.createCObqueue( strid, params )) == null )
		return false;	
	var contents = ob_get_contents();
	ob_end_clean();
	cobqueue.setContent( cobqueue.getContents() + contents );
	return true;
} // end ob_end_queue()

function ob_queue_dump( strid ){
	return CObqueue.dumpCObqueue( strid );
} // end ob_queue_dump()

function ob_queue_dump2(strid) {
	return CObqueue.dumpCObqueue( strid );
}

function ob_queue_dump3( strid ){
	return CObqueue.dumpCObqueue( strid );
} // end ob_queue_dump()