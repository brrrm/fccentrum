(function( $ ) {
	let lastKnownScrollPosition = 0;
	let ticking = false;
	let htmlTopMargin = parseInt( $('html').css('marginTop'));
	
	$(document).ready(function(){
		htmlTopMargin = parseInt($('html').css('marginTop'));

		$('#hamburger').click(function(e){
			e.preventDefault();
			console.log('click');
			$('nav.primary-menu-wrapper').toggleClass('show');
		});

		
	});
	document.addEventListener('scroll', function(e) {
	  if (!ticking) {
	    window.requestAnimationFrame(function() {
	      headerScrollEffect(window.scrollY);
	      ticking = false;
	    });

	    ticking = true;
	  }
	});

	function headerScrollEffect(scrollPos) {
	  let headerPos = $('#site-header').offset();
	  console.log(scrollPos);
	  if(scrollPos < 5){
	  	$('body').addClass('showHeader');
	  	$('#site-header').css('top', htmlTopMargin);
	  }else if(scrollPos < lastKnownScrollPosition){
	  	$('body').addClass('showHeader');
	  	$('#site-header').css('top', htmlTopMargin);
	  }else{	  	
	  	$('body').removeClass('showHeader');
	  	$('#site-header').css('top', headerPos.top);
	  }
	  lastKnownScrollPosition = scrollPos;
	}
})(jQuery);