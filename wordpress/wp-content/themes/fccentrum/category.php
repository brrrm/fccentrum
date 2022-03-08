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

	</header>

<?php if ( have_posts() ) : ?>
	<?php the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>
	<div class="stories-container">
		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/story-teaser', null, [] ); ?>
			
		<?php endwhile; ?>
	</div>
<?php else : ?>

	<p>Geen posts</p>

<?php endif; ?>

<?php get_template_part( 'template-parts/categories-listing', null, [] ); ?>

</main><!-- #site-content -->

<?php get_footer(); ?>
