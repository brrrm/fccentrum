<?php

$category = $args['category'];
$image = get_field('headerafbeelding', $category);
?>


<li class="cat">
	<div class="category-pic">
		<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>">
			<?php echo wp_get_attachment_image( $image, 'medium' ); ?>
		</a>
	</div>
	<h2><a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a></h2>
</li>