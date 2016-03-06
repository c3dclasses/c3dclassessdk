//-----------------------------------------------------------------------------------------
// file: carray.js
// desc: overrides the javascript Array Object prototype 
//-----------------------------------------------------------------------------------------

// added methods
Array.prototype._= function() { return this.valueOf(); }
Array.prototype.visit = function(fnvisit) { if(!fnvisit) return; for (var i=0; i<this.length; i++) fnvisit(i, this[i]); } 
Array.prototype.remove = function(value) { var i = this.indexOf(value); this.splice(i,1); return i > -1; }
Array.prototype.removeAt = function(index) { this.splice(index,index); }
Array.prototype.removeAll = function(value) { while(this.remove(value)) {} }
Array.prototype.insertAt = function(index, value) { this.splice(index,1,value); return this.length; }
Array.prototype.shuffle = function() {
   if(this.length < 1)
    	return false;
	var arr = this, temp, index;
	for (var i=0; i < this.length; i++) {
		index = Math.floor((Math.random()*(this.length - i) + i));
		//alert(index + " " + arr[index]);
		temp = arr[i];
		arr[i] = arr[index];
		arr[index] = temp;
	} // end for    
	return true;
} // end shuffle()
