<?php
/**
* Template Name: Stories-template
*
* @package WordPress
* @subpackage FC Centrum
* @since FC Centrum 1.0
*/

get_header();

$bg_color = 'background-' . get_field('achtergrondkleur');
$text_color = 'foreground-' . get_field('tekstkleur');

$mid_graphic = get_field('graphic_halverwege');
?>

<main id="site-content" class="<?php echo $bg_color; ?> <?php echo $text_color; ?>">
	
	<header class="post-header">
	<?php	
	if(has_post_thumbnail()){
		the_post_thumbnail();
	}
	?>
	</header>

	<div class="post-content">
		<?php

		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();
				?>
				
				<h1 class="page-title"><span><?php the_title(); ?></span></h1>
				<?php 
				the_content(__('(more...)')); 
			}
		}
		?>
	</div>

	<?php get_template_part( 'template-parts/categories-listing', null, [] ); ?>
</main><!-- #site-content -->

<?php get_footer(); ?>
