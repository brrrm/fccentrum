<?php

$story = $args['story'];
$terms = wp_get_post_terms(get_the_ID(), ['category','news_cats']);
?>

<div class="search-result">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="" >
		<?php	
		if(has_post_thumbnail()){
			the_post_thumbnail('medium');
		}
		?>
	</a>
	<div class="post-info">
		<?php if($terms){ ?>
			<ul class="post-terms">
			<?php
			foreach($terms as $term){
				?>
				<li class="term">
					<a href="<?php echo get_category_link( $term->term_id ); ?>" title="<?php echo $term->name; ?>">
						<?php echo $term->name; ?>
					</a>
				</li>
				<?php
			}
			?>
			</ul>
		<?php } ?>
		<h2><a href="<?php echo esc_url( get_permalink() ); ?>" ><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
</div>