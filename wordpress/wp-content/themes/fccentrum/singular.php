<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">
	<header class="post-header">
		<?php 
		$video = get_field('video');
		if($video){
		?>
		<div class="mainVideo">
			<?php echo $video; ?>
		</div>
		<?php
		}elseif(has_post_thumbnail()){
			the_post_thumbnail();
		}
		?>
	</header>
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			?>
			<div class="post-content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(__('(more...)')); ?>
			</div>

			<?php
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
