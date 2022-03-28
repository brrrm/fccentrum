(function( $ ) {

	$(document).ready(function(){
		let videos  = $(".slide-video");
		videos.on("click", function(){
            var elm = $(this),
                conts   = elm.contents(),
                le      = conts.length,
                ifr     = null;

            for(var i = 0; i<le; i++){
              if(conts[i].nodeType == 8) ifr = conts[i].textContent;
            }

            elm.addClass("playing").html(ifr);
            elm.off("click");
        });

		$('#carousel').slick({
			'prevArrow': $('#prevslide'),
			'nextArrow': $('#nextslide')
		});

		$('.search-toggle, .search-untoggle').click(function(e){
			e.preventDefault();
			$('.search-modal').toggle();
			if($('.search-modal').css('display') == 'block'){
				$('.search-modal .search-field').focus();
			}
		});

		$('.share-btns-list li.link button').click(function(e){
			e.preventDefault();
			let linktext = $(this).text();
			copyLink(linktext);
			
		});
	});

	async function copyLink(linktext){
		await navigator.clipboard.writeText(linktext)
			.then(()=> alert('Link gekopieerd!'));
			//document.execCommand('copy');
			
	}
})(jQuery);