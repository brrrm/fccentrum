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

			<footer class="post-closure">
				<p class="author"><strong><?php the_author(); ?>.</strong> <?php the_date(); ?></p>
				<div class="share-btns">
					<h3>Deel dit verhaal</h3>
					<?php 
					$share_url = urlencode(esc_url( get_permalink() ));
					?>
					<ul class="share-btns-list">
						<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank">Deel op Facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo $share_url; ?>" target="_blank">Deel op Twitter</a></li>
						<li class="email"><a href="mailto:?SUBJECT=Leuk verhaal op FCcentrum.nl: <?php the_title(); ?>&BODY=Zie <?php echo esc_url( get_permalink()); ?>" title="klik om een mail te sturen">Mail een link</a></li>
						<li class="link"><button class="linkcopy" >testtest<?php echo esc_url( get_permalink()); ?></button></li>
					</ul>
				</div>
			</footer>


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
