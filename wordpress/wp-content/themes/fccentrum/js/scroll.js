(function( $ ) {
	let lastKnownScrollPosition = 0;
	let ticking = false;
	let htmlTopMargin = parseInt( $('html').css('marginTop'));
	$(document).ready(function(){
		htmlTopMargin = parseInt($('html').css('marginTop'));
	});

	function doSomething(scrollPos) {
	  // Do something with the scroll position
	  console.log(scrollPos + '--' + lastKnownScrollPosition);
	  let headerPos = $('#site-header').offset();
	  if(scrollPos < lastKnownScrollPosition){
	  	$('body').addClass('showHeader');
	  	$('#site-header').css('top', htmlTopMargin);
	  }else{	  	
	  	$('body').removeClass('showHeader');
	  	$('#site-header').css('top', headerPos.top);
	  }
	  lastKnownScrollPosition = scrollPos;
	}

	document.addEventListener('scroll', function(e) {
	  

	  if (!ticking) {
	    window.requestAnimationFrame(function() {
	      doSomething(window.scrollY);
	      ticking = false;
	    });

	    ticking = true;
	  }
	});
})(jQuery);