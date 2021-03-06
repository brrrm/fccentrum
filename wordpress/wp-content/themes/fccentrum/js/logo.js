(function( $ ) {
	let lastKnownScrollPosition = 0;
	let ticking = false;

	$(document).ready(function(){
		window.logoanim = bodymovin.loadAnimation({
			container: document.getElementById('logo'), // Required
			path: '/wp-content/themes/fccentrum/js/logo/data.json', // Required
			renderer: 'svg', // Required
			loop: false, // Optional
			autoplay: false, // Optional
			name: "Logo", // Name for future reference. Optional.
		});
		window.logoanim.setSpeed(2);

		document.addEventListener('scroll', function(e) {
		  if (!ticking) {
		    window.requestAnimationFrame(function() {
		      logoScrollEffect(window.scrollY);
		      ticking = false;
		    });

		    ticking = true;
		  }
		});
	});

	

	function logoScrollEffect(scrollPos) {
		if(typeof window.logoanim !== 'undefined'){
	  		window.logoanim.pause();
	  		if(scrollPos < 40){
				window.logoanim.setDirection(-1);
				$('#logo').removeClass('lager');
	  		}else if(scrollPos < lastKnownScrollPosition){
				// scroll up
				window.logoanim.setDirection(-1);
				$('#logo').removeClass('lager');
			}else{	  	
				// down
				window.logoanim.setDirection(1);
				$('#logo').addClass('lager');
			}
			lastKnownScrollPosition = scrollPos;
			window.logoanim.play();
		}
	}

})(jQuery);