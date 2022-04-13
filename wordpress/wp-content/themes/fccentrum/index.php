<?php
get_header();
?>



<main id="site-content">
	<div class="stories-container">
		<?php

		$archive_title    = '';
		$archive_subtitle = '';

		if ( is_search() ) {
			global $wp_query;

			$archive_title = sprintf(
				'%1$s %2$s',
				'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
				'&ldquo;' . get_search_query() . '&rdquo;'
			);

			if ( $wp_query->found_posts ) {
				$archive_subtitle = sprintf(
					/* translators: %s: Number of search results. */
					_n(
						'We found %s result for your search.',
						'We found %s results for your search.',
						$wp_query->found_posts,
						'twentytwenty'
					),
					number_format_i18n( $wp_query->found_posts )
				);
			} else {
				$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
			}
		} elseif ( is_archive() && ! have_posts() ) {
			$archive_title = __( 'Nothing Found', 'twentytwenty' );
		} elseif ( ! is_home() ) {
			$archive_title    = get_the_archive_title();
			$archive_subtitle = get_the_archive_description();
		}

		if ( $archive_title || $archive_subtitle ) {
			?>

			<header class="archive-header has-text-align-center header-footer-group">

				<div class="archive-header-inner section-inner medium">

					<?php if ( $archive_title ) { ?>
						<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
					<?php } ?>

					<?php if ( $archive_subtitle ) { ?>
						<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
					<?php } ?>

				</div><!-- .archive-header-inner -->

			</header><!-- .archive-header -->

			<?php
		}
		if ( have_posts() ) {

			$i = 0;

			while ( have_posts() ) {
				the_post();
				?>

				<?php
				get_template_part( 'template-parts/story-teaser', null, [] );

			}
		} elseif ( is_search() ) {
			?>

			<div class="no-search-results-form section-inner thin">

				<?php
				get_search_form(
					array(
						'aria_label' => __( 'search again', 'twentytwenty' ),
					)
				);
				?>

			</div><!-- .no-search-results -->

			<?php
		}
		?>

		<?php get_template_part( 'template-parts/pagination' ); ?>
	</div>
	<aside id="news-list">
		<?php
		// news listing
		
	   $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //pagination
	   $args = array(
	        'paged'           => $paged,
	        'posts_per_page'  => 12, //or any other number
	        'post_type'       => 'news' //your custom post type
	        );

	    $the_query = new WP_Query( $args ); // The Query 

	    if ( $the_query->have_posts() ) {  // The Loop
	        while ( $the_query->have_posts() ) {
	           $the_query->the_post();

	           get_template_part( 'template-parts/news-teaser', null, [] );
	        }

	       	/* Restore original Post Data */
	        

	    } 
	    wp_reset_postdata();
	    ?>
    </aside>
</main><!-- #site-content -->

<?php
get_footer();