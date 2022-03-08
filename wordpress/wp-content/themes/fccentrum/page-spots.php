<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<style type="text/css">
.acf-map {
    width: 100%;
    height: 400px;
    border: #ccc solid 1px;
    margin: 20px 0;
}

// Fixes potential theme css conflict.
.acf-map img {
   max-width: inherit !important;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYtTpBXwzon3LA0TTzVGAl69h8qoMqFoc"></script>




<main id="site-content">
	<header class="post-header">
		<?php
			// Get the current queried object
			// $term    = get_queried_object();
			// $term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

			$categories = get_categories( array(
			    'taxonomy'   => 'spots', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
			    'orderby'    => 'name',
			    'parent'     => 0,
			    'hide_empty' => 0, // change to 1 to hide categores not having a single post
			) );

			$locations = [];
		?>
		<div class="acf-map" data-zoom="16">
		<?php
			foreach ( $categories as $category ) {
			    get_template_part( 'template-parts/location-teaser', null, ['spot' => $category] );
			}
			print_r($locations);

		?>
		</div>
	</header>
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			?>
			
			<h1><span><?php the_title(); ?></span></h1>
			<?php the_content(__('(more...)')); ?>

			<?php
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
