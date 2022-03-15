<?php

$link = get_field('slide_link');
$image = get_field('slide_afbeelding');
$video = get_field('slide_video');
?>

<div class="carousel-slide">
	<?php if($video){ ?>
		<div class="slide-video">
			<?php echo $video; ?>
		</div>
	<?php }else{ ?>
		<div class="slide-image">
			<a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo wp_get_attachment_image( $image, [2000, 1500] ); ?></a>
		</div>
	<?php } ?>
	<h2><a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a></h2>
</div>