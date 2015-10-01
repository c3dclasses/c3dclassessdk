/* this is the stuff after */
// fghfghhgstuff after

_if( function(){ return A=10;},function(){});

_if(function(){return A;},function(){
});

for(var i=0; i<10; i++){
	_if( function(){ return a=10;},function(){
		this._return();
	});
}

_for( a=0 ){
}

_if( function(){ return ;},function(){
	this._return();
})
._elseif( function(){ return A=10;},function(){
})
._else(function(){
	this._return();
});
/* this is the stuff after */
// fghfghhgstuff after