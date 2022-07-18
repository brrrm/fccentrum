(function( $ ) {
	let scrollInterval;
	let isAjaxLoading = false;

	$(document).ready(function(){
		
		resizeAllGridItems();
		$(window).resize(function(){
			resizeAllGridItems();
		});
		scrollInterval = setInterval(scrollCheck, 100);
	});

	function scrollCheck(){
		let containerTop = $('.stories-container').position().top;
		let containerHeight = $('.stories-container').outerHeight();
		if(((1.2 * $(window).height()) + $(window).scrollTop()) >= (containerTop + containerHeight)){
			if(!isAjaxLoading && $('.navigation.pagination a.next').length){
				loadNextPosts($('.navigation.pagination a.next'));
			}else if(!isAjaxLoading && $('.cat-continue-nav a.next').length){
				loadNextCategoryPosts($('.cat-continue-nav a.next'));
			}
		}
	}

	function loadNextPosts(nextLink){
		isAjaxLoading = true;
		let url = nextLink.attr('href');

				
		let ajaxdata = {
			url 	: url,
			action : 'fccentrum_load_blog_posts',
			nonce	: 'sd'
		};
		$.get(
		  	url,
		  	[],
		  	function(data){
		  		let content = $(data).find('.stories-container').html();
		  		let pager = $(data).find('.navigation.pagination');
		  		$('.stories-container').append(content);
		  		$('.navigation.pagination').html(pager.html());
		  		resizeAllGridItems();
		  		isAjaxLoading = false;
			}
		);
	}

	function loadNextCategoryPosts(nextLink){
		isAjaxLoading = true;
		let url = nextLink.attr('href');
		let termId = $('.cat-continue-nav').data('term');
		let paged = $('.cat-continue-nav a.next').data('paged');
				
		let ajaxdata = {
			term_id: termId,
			paged: paged,
			action: 'fccentrum_load_blog_posts',
			nonce: 'sd'
		};
		$.get(
		  	infinite_scroll_settings.ajaxurl,
		  	ajaxdata,
		  	function(data){
		  		$('.stories-container .cat-continue-nav').remove();
		  		$('.stories-container').append(data);
		  		resizeAllGridItems();
		  		isAjaxLoading = false;
			}
		);
	}





	function resizeGridItem(item){
	  	grid = $(".stories-container");
	  	rowHeight = parseInt(grid.css('grid-auto-rows'));
	  	rowGap = parseInt(grid.css('grid-row-gap'));
	  	itemHeight = $(item).find('.inner').height();
	  	rowSpan = Math.ceil((itemHeight + rowGap) / (rowHeight+rowGap));
	    $(item).css({gridRowEnd: "span "+rowSpan });
	}

	function resizeAllGridItems(){
		if($(window).width() > 768){
		  	allItems = $(".stories-container .teaser");
		  	for(x=0;x<allItems.length;x++){
		    	resizeGridItem(allItems[x]);
		  	}
		}
	}

	if($(window).width() > 768){
		allItems = $(".stories-container .teaser");
		allItems.each(function(){
			imagesLoaded($(this), resizeGridItem($(this)) );
		});
	}

})(jQuery);