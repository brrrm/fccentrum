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
$image = get_field('headerafbeelding', $term);
?>

<main id="site-content" class="<?php echo $bg_color; ?> <?php echo $text_color; ?>" >
	<header class="post-header">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	</header>
	

			<div class="post-content">
			<?php the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>			

			<?php

			// Check value exists.
			if( have_rows('omschrijving', $term) ):
			    // Loop through rows.
			    while ( have_rows('omschrijving', $term) ) : the_row();

			        // Case: Paragraph layout.
			        if( get_row_layout() == 'textblock' ):
			            echo get_sub_field('text');
			            // Do something...

			        // Case: Download layout.
			        elseif( get_row_layout() == 'pic' ): 
			            $img = get_sub_field('afbeelding');
			            echo wp_get_attachment_image( $img, 'full' );

			        elseif( get_row_layout() == 'video' ): 
			            echo get_sub_field('video');

			        endif;

			    // End loop.
			    endwhile;

			// No value.
			else :
			    // Do something...
			endif;
			?>

			</div>


			<footer class="post-closure">
				<?php 
					$author = get_field('auteur', $term); 
				?>
				<p class="author"><strong><?php echo $author['user_nicename']; ?>.</strong> <?php echo get_field('publicatiedatum', $term); ?></p>
				<div class="share-btns">
					<h3>Deel dit verhaal</h3>
					<?php 
					$share_url = esc_url( get_term_link($term) );
					?>
					<ul class="share-btns-list">
						<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($share_url); ?>" target="_blank">Deel op Facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode($share_url); ?>" target="_blank">Deel op Twitter</a></li>
						<li class="email"><a href="mailto:?SUBJECT=Leuk verhaal op FCcentrum.nl: <?php the_title(); ?>&BODY=Zie <?php echo urlencode($share_url); ?>" title="klik om een mail te sturen">Mail een link</a></li>
						<li class="link"><button class="linkcopy" ><?php echo $share_url; ?></button></li>
					</ul>
				</div>
			</footer>

			
		<?php if ( have_posts() ) : ?>

			<div id="mid-graphic">
				<?php if(isset($graphic) && $graphic){ ?>
					<?php echo wp_get_attachment_image( $graphic, 'full' ); ?>
				<?php }else{ ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/header-graphic-1.png" alt="footer logo FC Centrum" />
				<?php } ?>
			</div>
		
			<h2 class="align-center">Stories over <?php echo $term->name; ?></h2>

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

	
</main><!-- #site-content -->

<?php get_footer(); ?>
