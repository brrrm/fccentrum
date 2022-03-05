<?php

$story = $args['story'];
$terms = wp_get_post_terms(get_the_ID(), ['category', 'spots', 'fans']);
?>

<div class="story teaser">
	<header class="post-header">
	<?php	
	if(has_post_thumbnail()){
		the_post_thumbnail('medium');
	}
	?>
	</header>
	<h2><?php the_title(); ?></h2>
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
	<?php } ?>
</div>