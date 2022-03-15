(function( $ ) {

	$(document).ready(function(){
		$('#carousel').slick();

		$('.search-toggle, .search-untoggle').click(function(e){
			e.preventDefault();
			$('.search-modal').toggle();
		});
	});
})(jQuery);