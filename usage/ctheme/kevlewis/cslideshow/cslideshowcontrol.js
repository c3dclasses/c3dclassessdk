//--------------------------------------------------------
// file: cslideshowcontrol.js
// desc: displays simple slideshow control
//--------------------------------------------------------

//--------------------------------------------------------
// name: CSlideShowControl
// desc: slideshow control
//--------------------------------------------------------
var CSlideShowControl = new Class
({
	// interfaces
	Implements: [Options,Events],
	
	// instance members
	options: {
		showControls: true,
		showDuration: 7000,
		showTOC: false,
		tocWidth: 20,
		tocClass: 'toc',
		tocActiveClass: 'toc-active',
		thumbOpacity: 0.7,
		captionHeight: 90
	}, // end options
	
	//----------------------------------------------------
	// name: initialize()
	// desc: constructor
	//----------------------------------------------------
	initialize:function( container, elements, options ) 
	{
		// settings
		this.container = $(container);
		this.elements = $$(elements);
		
		if( !this.container || !this.elements || this.elements.length==0 )
		{
			return; 
		}
		this.currentIndex = 0;
		this.interval = '';
		
		if(this.options.showTOC) 
			this.toc = [];
		
		this.captionDIV = new Element('div',{ styles: { opacity: this.options.thumbOpacity } } )
		//this.captionDIV.inject(this.container);
		this.captionDIV.addClass( 'slideshow-container-caption' );
		//this.captionHeight = this.options.captionHeight;//70;//this.captionDIV.getSize().y;
  		this.captionDIV.setStyle('height',0);
				
		// for each slide element
		this.elements.each(
			function(el,i)
			{
				if(this.options.showTOC) 
				{
					// create a link
					var alink = new Element( 'a' );
					alink.addClass( this.options.tocClass + '' + (i == 0 ? ' ' + this.options.tocActiveClass : '') );
					alink.set('html',""+(i+1));
        			alink.setStyle('left', ((i + 1) * (this.options.tocWidth + 10)));
					alink.addEvent('click', function(e) { if(e) e.stop(); this.stop(); this.show(i); }.bind(this) );
					alink.inject(this.container);				
					
					// push it into the table of contents list
					this.toc.push( alink );
				} // end if
				
				// set the opacity of all except the first slide
				if(i > 0) el.set('opacity',0);
			}, // end function()
		this ); // end this.elements.each() - make sure the this ptr is passed
				
		// create the next,previous links
		if(this.options.showControls)
		{
			this.createControls();
		} // end if
				
		// create the events
		this.container.addEvents({
			mouseenter: function() { this.stop(); }.bind(this),
			mouseleave: function() { this.start(); }.bind(this)
		}); // end addEvents()
	}, // end initialize()
	
	//-----------------------------------------------
	// name: show()
	// desc: shows the next slide
	//-----------------------------------------------		
	show: function(to) 
	{	
		if( !this.container || !this.elements || this.elements.length==0 )
		{
			return; 
		}
		
		
		// fade out the current slide
		this.elements[this.currentIndex].fade('out');
		if(this.options.showTOC) this.toc[this.currentIndex].removeClass(this.options.tocActiveClass);
		
		// fade in the next slide
		this.currentIndex = ($defined(to) ? to : (this.currentIndex < this.elements.length - 1 ? this.currentIndex + 1 : 0));
		this.elements[this.currentIndex].fade('in');		
		if(this.options.showTOC) this.toc[this.currentIndex].addClass(this.options.tocActiveClass);
		
		// define a oncomplete tweening function		
		var oncomplete_func = function() 
		{
        /*	var title = '';
        	var captionText = '';
        	var cap = null;		
			this.captionDIV.set('tween',{ onComplete: $empty }).tween('height',this.options.captionHeight);
			if(this.elements[this.currentIndex].get('alt')) 
			{
          		var cap = this.elements[this.currentIndex].get('alt').split('::');
          		title = cap[0];
          		captionText = cap[1];
          		this.captionDIV.set('html','<h3 align="center">' + title + '</h3>' + (captionText ? '<p>' + captionText + '</p>' : ''));
        	} // end if()
		*/
		}.bind(this) // end functween()			
		
		// set to tween from height 0 to 70 ex
		this.captionDIV.set('tween',{ onComplete:oncomplete_func }).tween('height',0); 
	}, // end show()
	
	//---------------------------------------------
	// name: start()
	// desc: strats the slideshow
	//---------------------------------------------		
	start: function() 
	{
		if( !this.container || !this.elements || this.elements.length==0 )
		{
			return; 
		}
		
		this.interval = this.show.bind(this).periodical(this.options.showDuration);
	}, // end start()
			
	//---------------------------------------------
	// name: stop()
	// desc: stops the slideshow
	//---------------------------------------------		
	stop: function() 
	{
		$clear(this.interval);
	}, // end stop()
			
	//---------------------------------------------
	// name: createControls()
	// desc: creates control for the slidesho
	//---------------------------------------------
	createControls: function() 
	{
		// create the next control
		var next = new Element('a',{
					href: '#',
					id: 'next',
					text: '',
					events: {
						click: function(e) {
							if(e) e.stop();
							this.stop(); 
							this.show();
						}.bind(this)
					}
				}).inject(this.container);
		
		// create the previous control
		var previous = new Element('a',{
					href: '#',
					id: 'previous',
					text: '',
					events: {
						click: function(e) {
							if(e) e.stop();
							this.stop(); 
							this.show(this.currentIndex != 0 ? this.currentIndex -1 : this.elements.length-1);
						}.bind(this)
					}
				}).inject(this.container);
	} // end createControls()
}); // end CSlideShowControl