<?php

$spot = $args['spot'];
$image = get_field('headerafbeelding', $spot);
$location = get_field('locatie', $spot);
?>

<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-singular="<?php echo (isset($args['singular']) && $args['singular'] === true)? 1 : 0; ?>" >
	<div class="marker-inner">
		<div class="spot-pic">
			<a href="<?php echo get_category_link( $spot->term_id ); ?>" title="<?php echo $spot->name; ?>">
				<?php echo wp_get_attachment_image( $image, 'medium' ); ?>
			</a>
		</div>
		<h2><a href="<?php echo get_category_link( $spot->term_id ); ?>" title="<?php echo $spot->name; ?>"><?php echo $spot->name; ?></a></h2>
		<p><?php echo $location['street_name'] . ' ' . $location['street_number']; ?>
	</div>
</div>