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

			$terms = get_the_terms($post, 'category');
			$bg_color = 'background-' . get_field('achtergrondkleur', $terms[0]);
			$text_color = 'foreground-' . get_field('tekstkleur', $terms[0]);
			$graphic = get_field('graphic_halverwege', $terms[0]);
			the_post();
			?>
			<div class="post-content <?php echo $bg_color; ?> <?php echo $text_color; ?>">
				<h1><?php the_title(); ?></h1>
				<?php the_content(__('(more...)')); ?>
			</div>


			<div id="mid-graphic">
				<?php if(isset($graphic) && $graphic){ ?>
					<?php echo wp_get_attachment_image( $graphic, 'full' ); ?>
				<?php }else{ ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/header-graphic-1.png" alt="footer logo FC Centrum" />
				<?php } ?>
			</div>

			<div class="stories-container">
				<?php get_postsbycategory($terms[0]); // see functions.php ?>
			</div>

			<?php
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
