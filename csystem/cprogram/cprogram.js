//----------------------------------------------------------------
// file: cprogram.js
// desc: defines a program class
//----------------------------------------------------------------

//----------------------------------------------------------------
// file: CProgram
// desc: defines a program class
//----------------------------------------------------------------
var CProgram = new Class({ 
	Extends: CElement,  
	initialize:function(){ this.parent(); },
	ClassMethods:{
		m_cprograms : null,
		loadCPrograms : function(){
			if( CElement.m_celements == null )
				return false;
			var celements = CElement.m_celements._();
			if( !celements )
				return false;
			if( CProgram.m_cprograms == null )
				CProgram.m_cprograms = new CHash();
			for( var name in celements )
				if( celements[name].main )
					CProgram.m_cprograms.set( name, celements[name] );
			return true;
		}, // end loadCPrograms()
		mainCPrograms : function(){
			//alert("running programs");
			if( CProgram.m_cprograms == null )
				return;
			var cprograms = CProgram.m_cprograms._();
			for( var name in cprograms ){	
				CThread.loadContext(cprograms[name], cprograms[name].main);
				//alert("programs");
			} // end for
		} // end mainPrograms()
	} // end ClassMethods
}); // end CProgram

// hooks
CHook.add("load", CProgram.loadCPrograms );
CHook.add("main", CProgram.mainCPrograms );