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

$term = get_queried_object();
$bg_color = 'background-' . get_field('achtergrondkleur', $term);
$text_color = 'foreground-' . get_field('tekstkleur', $term);
$graphic = get_field('graphic_halverwege', $term);
?>


<main id="site-content" class="<?php echo $bg_color; ?> <?php echo $text_color; ?>" >
	<header class="post-header">

	</header>
	
	<?php if ( have_posts() ) : ?>

		<div class="post-content">
		<?php the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>
		</div>
		<div class="stories-container ">
			<?php while ( have_posts() ) : ?>

				<?php the_post(); ?>
				<?php get_template_part( 'template-parts/story-teaser', null, [] ); ?>
				
			<?php endwhile; ?>
		</div>
		
	<?php else : ?>

		<div class="post-content">
			<?php the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>
			<p>Geen posts</p>
		</div>

	<?php endif; ?>

	<div id="mid-graphic">
		<?php if(isset($graphic) && $graphic){ ?>
			<?php echo wp_get_attachment_image( $graphic, 'full' ); ?>
		<?php }else{ ?>
			<img src="<?php echo get_template_directory_uri(); ?>/img/header-graphic-1.png" alt="footer logo FC Centrum" />
		<?php } ?>
	</div>

	<div class="always-white">
		<h2>Stories</h2>
		<?php get_template_part( 'template-parts/categories-listing', null, [] ); ?>
	</div>

	
</main><!-- #site-content -->

<?php get_footer(); ?>
