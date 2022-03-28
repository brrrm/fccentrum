<?php

$link = get_field('slide_link');
$image = get_field('slide_afbeelding');
$video = get_field('slide_video');
if($video && $image){
	preg_match('/src="(.+?)"/', $video, $matches);
	$src = $matches[1];
	// Add extra parameters to src and replace HTML.
	$params = array(
	    'autoplay'  => 1,
	    'hd'        => 1,
	);
	$new_src = add_query_arg($params, $src);
	$video = str_replace($src, $new_src, $video);
}
?>

<div class="carousel-slide">
	<?php if($video){ ?>
		<div class="slide-video <?php if($image){ echo 'with-preview'; } ?>">
			<?php echo wp_get_attachment_image( $image, [2000, 1500], false, ['class' => 'video-poster'] ); ?>
			<?php if($image){ ?>
			<!-- <?php echo $video; ?> -->
			<?php }else{ ?>
				<?php echo $video; ?>
			<?php } ?>
		</div>
	<?php }else{ ?>
		<div class="slide-image">
			<a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo wp_get_attachment_image( $image, [2000, 1500] ); ?></a>
		</div>
	<?php } ?>
	<h2><a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a></h2>
</div>