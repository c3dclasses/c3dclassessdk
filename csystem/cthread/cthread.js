//----------------------------------------------------------------
// file: cthread.js
// desc: implements a thread object in javascript 
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: cthread
// desc: implements a thread object in javascriot 
//----------------------------------------------------------------
var CThread = new Class({	
	initialize : function(){ 
		this.m_iid=-1;
		this.m_iintervalid = -1; 
		this.m_iintervalms = 0; 
		this.m_fncallback = null; 
		this.m_iexitcode = 0; 
		this.m_fnlock = null;
		this.m_objcontext = null;
		this.m_iteration = 0;
	}, // end initialize()
	create : function( iintervalms, fncallback ){
		if( iintervalms < 1 || !fncallback || typeof( fncallback ) != "function" ) 
			return false;
		this.m_fncallback = fncallback.bind( this );
		this.m_iintervalms = iintervalms;
		CThread.createContext( this );
		return true;
	}, // end create()
	context : function(){ return this.m_objcontext; },
	destroy : function( iexitcode ){ CThread.destroyContext(this); this.exit( iexitcode ); this.initialize(); },
	start : function(){ return (this.m_iintervalid=setInterval(this.run.bind(this),this.m_iintervalms))>-1; }, 
	stop : function(){ if( this.m_iintervalid > -1 ) clearInterval( this.m_iintervalid ); this.m_iintervalid=-1; },
	run : function(){ CThread.runContext( this ); if( this.m_fncallback != null ){ this.m_fncallback(); this.m_iteration++; } },
	exit : function( iexitcode ){ 
		if( this.m_iintervalid > -1 ) 
		clearInterval( this.m_iintervalid ); 
		if( iexitcode ) 
			this.m_iexitcode = iexitcode; 
		this.unlock() 
	}, // end exit()
	jump : function( fncallback ){ this.m_fncallback = fncallback.bind( this ); },
	priority : function( ipriority ){},
	sleep : function( iintervalms ){ this.m_iintervalms = iintervalms; this.stop(); this.start(); },
	lock : function( fnlock ){ 
		if( fnlock == null ) 
			return true; 
		if( fnlock.cthread == null ){ // no thread has no lock on this function
			fnlock.cthread = this;
			this.m_fnlock = fnlock;
		} // end if
		if( fnlock.cthread == this )
			return true;
		return false;
	}, // end lock()
	unlock : function(){
		var fnunlock = this.m_fnlock;
		if( fnunlock == null || fnunlock.cthread == null )
			return true;
		if( fnunlock.cthread != this )
			return false;
		fnunlock.cthread = null;
		return true;
	}, // end unlock()
	getExitCode : function(){ return this.m_iexitcode; },
	getID : function(){ return this.m_iid; },
	getIteration : function(){ return this.m_iteration; },
	
	//-----------------------------------------------------
	// name: ClassMethods
	// desc: stores all the static members and methods
	//-----------------------------------------------------
	ClassMethods : {		
		
	m_cthread_cur 		: null,			// current thread that's running
	m_objcontext_cur 	: null,			// current context the thread is running
	m_fncontext_cur 	: null,			// current function the thread is running
	m_icthread_count 	: 0,			// the number of threads that are currently running
		
	loadContext : function( objcontext, fncontext ){
		if( !objcontext || !fncontext )
			return false;
		objcontext.m_icthread_count = 0; // set the cthread count to 0 - haven't found no thread yet
		CThread.m_objcontext_cur = objcontext;	// make this object context be the current object context	
		fncontext(); // run the function to find thread that have started with code	
		CThread.m_objcontext_cur=null;	// set this to null for next time 
		return true;
	}, // end loadContext()
		
	createContext : function( cthread ){
		if( !cthread )
			return false;
			alert("create context");
		cthread.m_iid = CThread.m_icthread_count;
		CThread.m_icthread_count++;
		var objcontext=null; // get the current object context - what object does this thread belong to?
		if( CThread.m_objcontext_cur ) 
			objcontext = CThread.m_objcontext_cur;	
		else if( CThread.m_cthread_cur && CThread.m_cthread_cur.m_objcontext )
			objcontext = CThread.m_cthread_cur.m_objcontext;
		else if( !objcontext )
			return false;
		this.m_objcontext.m_icthread_count++; // update the context
		cthread.m_objcontext = objcontext;		
		return true;
	}, // end createContext()
	
	getCurrentCThread : function(){ return CThread.m_cthread_cur; },
	
	destroyContext : function( cthread ){
		if( !cthread )
			return false;
		CThread.m_icthread_count--;
		if( CThread.m_cthread_cur == cthread )
			CThread.m_cthread_cur = null;
		if( !cthread.m_objcontext )
			return false;
		var objcontext = cthread.m_objcontext;	// update the object that runs the thread 
		cthread.m_objcontext = null;
		if( objcontext.m_icthread_count && --objcontext.m_icthread_count > 0 )
			return true;
		//objcontext.m_iendtime = (new Date()).getTime();	// set the time when all the threads are dead
		return true;
	}, // end destroyContext()
		
	runContext : function( cthread ){
		CThread.m_cthread_cur = cthread;
		if( CThread.m_fncontext_cur ) 
			CThread.m_fncontext_cur( cthread );
	}, // end runContext()
		
	setContextCallback : function( fncontext ){
		CThread.m_fncontext_cur = fncontext;
	}, // end setContextCallback()
		
	_wait : function(){
		if( this.m_childthreadcount == 0 )
			this.exit( 0 );
	} // end _wait()		
	} // end ClassMethods
}); // end CThread