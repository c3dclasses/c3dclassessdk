//-----------------------------------------------------------------------------------
// file: cincludefile.js
// desc: provides a way to include a file as a resource to be used in an application
//-----------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------
// name: CIncludeFile
// desc: provides a way to include a file as a resource to be used in an application
//-----------------------------------------------------------------------------------
var CIncludeFile = new Class({
    Extends: CResource,
    open : function(strpath, params) {
        return this.parent(strpath, params);
    } // end open()
}); // end class CIncludeFile

// including and using
function include_file(strpath, strtype, params) {
    return include_resource(strpath, strpath, strtype, params);
} // include_file()

function use_file(strpath) {
    return use_resource(strpath);
} // use_file()