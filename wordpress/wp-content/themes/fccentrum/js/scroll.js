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

		$('#scrollDown-arrow, #carousel-scrollDown-arrow').click(function(e){
			e.preventDefault();
			let target = $(this).attr('href');
			let targetPosition = $(target).position();
			$("html, body").animate({ scrollTop: targetPosition.top }, 200);
		})
	});

	function headerScrollEffect(scrollPos) {
		if(scrollPos < 40){
			$('body').addClass('showHeader');
			//$('#site-header').css('top', htmlTopMargin);
		}else if(scrollPos < lastKnownScrollPosition){
			$('body').removeClass('hideHeader');
			$('body').addClass('showHeader');
			//$('#site-header').css('top', htmlTopMargin);
		}else{
			$('body').removeClass('showHeader');
			$('body').addClass('hideHeader');
			//$('#site-header').css('top', headerPos.top);
		}
	  	lastKnownScrollPosition = scrollPos;
	}
})(jQuery);