<?php


$terms = wp_get_post_terms(get_the_ID(), ['category', 'spots', 'fans']);
$image_layout = get_field('afmetingen_teaser-foto');
$text_pos = get_field('positie_van_titel');
$font = 'font--' . get_field('font');
$color = 'color--' . get_field('rubriekkleur');
?>

<div class="story teaser <?php echo $text_pos; ?> <?php echo $font; ?> <?php echo $color; ?> <?php echo 'post--' . get_the_ID(); ?>"><div class="inner">
	<header class="post-header">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="<?php echo 'image-orientation-' . $image_layout; ?>" >
			<?php	
			if(has_post_thumbnail()){
				the_post_thumbnail('large');
			}
			?>
		</a>
	</header>
	<div class="link-container">
		
		<?php if($terms){ ?>
			<ul class="post-terms">
				<?php foreach($terms as $term){ ?>
					<li class="term">
						<a href="<?php echo get_category_link( $term->term_id ); ?>" title="<?php echo $term->name; ?>">
							<?php echo $term->name; ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
		<h2><a href="<?php echo esc_url( get_permalink() ); ?>" ><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
</div></div>