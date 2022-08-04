<?php
get_header();
?>

<main id="site-content"  >
	<header class="post-header">

	</header>

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="prefix">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'<em>&ldquo;' . get_search_query() . '&rdquo;</em>'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search.' );
		}
	}

	if ( $archive_title || $archive_subtitle ) {
		?>
		<div class="post-content">

			<?php if ( $archive_title ) { ?>
				<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
			<?php } ?>

			<?php if ( $archive_subtitle ) { ?>
				<div class="archive-subtitle"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
			<?php } ?>

		</div>

		<?php
	}
	?>

	<div class="search-results">
		<?php
		if ( have_posts() ) {
			?>
			
			<?php
			while ( have_posts() ) {
				the_post();
				?>

				<?php
				get_template_part( 'template-parts/search-teaser', null, [] );

			}
		} else {
			?>

			<div class="no-search-results-form section-inner thin">

				

			</div><!-- .no-search-results -->

			<?php
		}
		?>
	</div>
	<?php get_template_part( 'template-parts/pagination' ); ?>
</main><!-- #site-content -->

<?php
get_footer();