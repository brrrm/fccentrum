<?php

$story = $args['story'];
$terms = wp_get_post_terms(get_the_ID(), ['category', 'spots', 'fans']);
?>

<div class="news teaser">
	
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
	<?php the_content(__('(more...)')); ?>
</div>