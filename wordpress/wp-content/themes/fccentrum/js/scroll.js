(function( $ ) {
	let lastKnownScrollPosition = 0;
	let ticking = false;
	let htmlTopMargin = parseInt( $('html').css('marginTop'));
	var headerPos;
	
	$(document).ready(function(){
		htmlTopMargin = parseInt($('html').css('marginTop'));
		headerPos = $('#site-header').offset();
		$('#hamburger').click(function(e){
			e.preventDefault();
			console.log('click');
			$('nav.primary-menu-wrapper').toggleClass('show');
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
	});

	function headerScrollEffect(scrollPos) {
		console.log(scrollPos);
		if(scrollPos < 40){
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