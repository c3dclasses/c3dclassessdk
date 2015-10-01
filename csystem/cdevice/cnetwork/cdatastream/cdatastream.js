//---------------------------------------------------------------------------------
// file: cdatastream.php
// desc: creates data (bus) stream using php to communicate with client browser or
//       a remote web server. Also, it's a server-side object that can be used in 
//       cases when javascript is not around use <noscript></noscript> tag to do 
//       that.    
//---------------------------------------------------------------------------------

// includes
//----------------------------------------------------------------
// class: CDataStream
// desc: defines a datastream object
//----------------------------------------------------------------
var CDataStream = new Class({	
	// constructing a datastream
	initialize: function(){
		this.m_xhr = null		// stores the xhr object
		this.m_request = null; 	// stores the request data
		this.m_response = null; // stores the response data
		this.m_options = null; 	// stores the option data
		this.m_headers = null; 	// stores headers data
		
		
		this.m_creturn = null; 	// stores the status of the datastream 
		this.m_strresponsestatus = "";	// the response status
		this.m_strerrorthrown = "";	
		this.m_iresponsecode = CDataStream.IDLE; // stores the current state
		this.options("m_bsend", true); // set some options

	}, // end CDataStream()
	
	// opening and closing a datastream
	open : function(strurl, strmethod, strid){
		this.m_creturn = null;
		strmethod = strmethod.toLowerCase();
		if(!strurl || !strmethod || ( strmethod != 'post' && strmethod != 'get' ) )
			return false;
		this.options("m_strurl", strurl);
		this.options("m_strmethod", strmethod);
		if(strid)
			this.request("m_strid", strid);
		return true;
	}, // end open()
	
	close : function(){
		this.m_request = null;
		this.m_response = null;
		this.m_options = null;
		this.m_headers = null;
		this.m_xhr = null;
		
		this.m_creturn = null;
		this.m_iresponsecode = CDataStream.IDLE;
		this.m_strresponsestatus = "";
		this.m_strerrorthrown = "";
	}, // end close()
	
	// get/set options / request / response / data / dataparam / headers
	options: function (strname, value){
		if(!this.m_options)
			this.m_options={};
		if(value){
			this.m_options[strname] = value;
			return value;
		} // end if
		return this.m_options[strname];
	}, // end options()
	
	headers : function (strname, strvalue){
		if(!strname)
			return (this.m_xhr) ? this.m_xhr.getAllResponseHeaders() : "";
		else if(!strvalue)
			return (this.m_xhr) ? this.m_xhr.getResponseHeader(strname) : "";
		if(!this.m_headers)
			this.m_headers = {};
		this.m_headers[strname] = strvalue;
		return true;
    }, // end headers()
	
    request : function (strname, value){
        if(!this.m_request)
            this.m_request = {};
        if(value){
            this.m_request[strname] = value;
            return value;
        } // end if
        return this.m_request[strname];
    }, // end request()

    response : function(strname, value){
        if(!this.m_response)
            this.m_response={};
        if(value){
            this.m_response[strname] = value;
            return value;
        } // end if
        else if(strname){
            return this.m_response[strname];
        } // end esle if
        return this.m_response;
    }, // end response()
	
	response_info : function( strname ){
	}, // end response_info()
	
    cookie: function (strname, value, options){
        return jQuery.cookie.apply(null, arguments);
    }, // end cookies()
	
	setData: function (value){
        return this.m_request = value;
    }, // end getData()
	 
	getData: function(){
        return this.response();
    }, // end getData()
	
 	setDataParam: function (strname, value){
        return this.request(strname, value);
    }, // end setDataParam()
   
    getDataParam: function (strname){
        return this.response(strname);
    }, // end getDataParam()

    // sending / receiving
    send : function(){
		 if (!jQuery)
            return null;
        this.request("m_bajax", true); 			// this is an ajax call	
        this.request("m_bcdatastream", true); 	// this is a cdatastream object
		var xhr = jQuery.ajax({					// set up to make the ajax call
            async: this.options("m_baync"),
            url: this.options("m_strurl"),
            type: this.options("m_strmethod"),
            dataType: this.options("m_strdatatype"), 	// xml, html, script, json, jsonp, text
            timeout: this.options("m_itimeout"),
            crossDomain: this.options("m_bcrossdomain"),
            cache: this.options("m_bcache"),
            accepts: this.options("m_accepts"),
            content: this.options("m_regexcontents"), 	// determines how Jquery parses the response
            contentType: this.options("m_regexcontents"), // ex. "application/x-www-form-urlencoded"
            context: this.options("m_context"), 	// the object will be made the scope of all Ajax related callbacks
            converters: this.options("m_converters"), // {"* text":window.String, "text html": true, "text json": jQuery.parseJSON, "text xml":jQuery.parseXML}
            ifModified: this.options("m_bmodified"), 		// allow request to be succesful only if response has changed since last request - check last modified header
            mimeType: this.options("m_strmimitype"), 	// allow request to be succesful only if response has changed since last request - check last modified header
            jsonp: this.options("m_strjsonp"), 	// name of the callback function
            username: this.options("m_strusername"), // name of the callback function
            password: this.options("m_strpassword"), // name of the callback function
            processData: this.options("m_bprocessdata"), // true processes the data that is sent / false does not
            scriptCharset: this.options("m_scriptCharset"), 	// name of the callback function
            traditional: this.options("m_btraditional"), 	// name of the callback function
            xhrFields: this.options("m_xhrFields"),
            jsonpCallback: this.options("m_strjsonp"), 		// call back function
			beforeSend: CDataStream.beforesend.bind(this), 
            complete: CDataStream.complete.bind(this),
            success: CDataStream.success.bind(this),
          	data: this.m_request,						// request
        	headers: this.m_headers,					// header
		    //dataFilter: 	CDataStream.datafilter.bind(this),	
            statusCode:{
            //	404:CDataStream._404.bind(this)
        	} // end statusCode
        }); // end jQuery.ajax()
		if (!xhr)
			return null;
		xhr.error(CDataStream.error.bind(this));	// more callbacks
		xhr.fail(CDataStream.fail.bind(this));
		xhr.done(CDataStream.done.bind(this));
		xhr.always(CDataStream.always.bind(this));
		//xhr.beforeSend(CDataStream.beforesend.bind(this));	
		var creturn = new CReturn();
		if( !creturn )
			return null;		
		creturn.status( CReturn.BUSY );
		creturn.data( null );
		this.m_creturn = creturn;
		this.m_xhr = xhr;
		return creturn;
	}, // end send()

	// other options
	authenticate: function (strusername, strpassword, strfields){
		this.options( "m_strusername", strusername );
		this.options( "m_strpassword", strpassword );
		this.options( "m_strfields", strfields );
	}, // end authenticate
	
	setDataType: function (strdatatype){
		if (strdatatype)
			this.options("m_strdatatype", strdatatype);
	}, // end setDataType()
	
	// other
	abort: function(){ 
		if(this.m_xhr) 
			this.m_xhr.abort(); 
	}, // end abort() 
	
	setRequestHeader: function(){
	}, // end setRequestHeader()
	
	cancel: function(){ 
		this.options("m_bsend", false); 
	}, // end cancel()
	
	ClassMethods:{
		// callbacks
		error: function (xhr, strstatus, errorthrown){
			if( !this.m_creturn )
				return;
			this.m_creturn.error( errorthrown ) 
			this.m_creturn.status( strstatus );
			this.m_creturn.code( CReturn.ERROR );
			this.m_creturn.data( this.m_response );
		}, // end error();
		
		success: function (data, strstatus, xhr){
			if( !this.m_creturn )
				return;
			// determine the format of the data is 
			if (data.substring(0, 15).indexOf("m_bjson") > -1)
				this.m_response = jQuery.parseJSON(data);
			else this.m_response = data;
			this.m_creturn.error( "" ); 
			this.m_creturn.status( strstatus );
			this.m_creturn.code( CReturn.DONE );
			this.m_creturn.data( this.m_response );
		}, // end success();
		
		beforesend: function (xhr, settings){
			return true;
		}, // end beforeSend()
		
		complete: function (xhr, strstatus){
			if( this.m_creturn )
				this.m_creturn.status( strstatus );	
			this.m_headers = xhr.getAllResponseHeaders();
		}, // end complete()
		
		done: function(){
		}, // end complete()
		
		datafilter: function (data, type){
		}, // end datafilter()
		
		always: function(){
		}, // end always()
		
		fail: function(){
		} // end fail()
	} // end ClassMethods
});	// end CDataStream