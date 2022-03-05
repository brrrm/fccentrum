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

<main id="site-content">
	<header class="post-header">
	<?php	
	if(has_post_thumbnail()){
		the_post_thumbnail();
	}
	?>
	</header>
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			?>
			
			<h1><?php the_title(); ?></h1>
			<?php the_content(__('(more...)')); ?>

			<?php
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	get_template_part( 'template-parts/categories-listing', null, [] );

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
