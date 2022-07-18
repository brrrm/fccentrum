(function( $ ) {

	$(document).ready(function(){

		$('.search-toggle, .search-untoggle').click(function(e){
			e.preventDefault();
			$('.search-modal').toggle();
			$('body').removeClass('hideHeader');
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