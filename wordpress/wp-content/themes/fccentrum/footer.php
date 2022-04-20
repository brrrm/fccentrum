<?php
if(is_home()){
	$bg_color = 'background-zwart';
	$text_color = 'foreground-wit';
}else{
	$terms = get_the_terms($post, 'category');
	$bg_color = get_field('achtergrondkleur', $terms[0]);
	$text_color = get_field('tekstkleur', $terms[0]);

	$bg_color = 'background-' . $bg_color;
	$text_color = 'foreground-' . $text_color;
}
?>
			<footer id="site-footer" class="header-footer-group <?php echo $bg_color; ?> <?php echo $text_color; ?>">
					<div class="footer-graphic">
						<?php if(is_singular() && $bg_color == 'background-zwart'){ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/footer-img-dark.png" alt="Echt Amsterdams!" />
						<?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/footer-kerk2.png" alt="Echt Amsterdams!" />
						<?php } ?>
					</div>

					<div class="footer-content">
						<div class="footer-logo">
							<a href="/" title="Naar de homepage"><img src="<?php echo get_template_directory_uri(); ?>/img/footer_logo.svg" alt="footer logo FC Centrum" /></a>
						</div><!-- .footer-credits -->

						<ul class="footer-socials">
							<li class="footer-social youtube"><a href="https://www.youtube.com/c/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Youtube</a></li>
							<li class="footer-social facebook"><a href="https://www.facebook.com/FanclubCentrum/" target="_blank" rel="nofollow">FC Centrum op Facebook</a></li>
							<li class="footer-social instagram"><a href="https://www.instagram.com/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Instagram</a></li>
						</ul>

						<p class="footer-address">
							<a href="https://goo.gl/maps/U28bk1W6UBeHjo3Q8" target="_blank" rel="nofollow">Vinkenstraat 17H<br />1013 JL Amsterdam </a>
						</p>

						<?php wp_nav_menu( ['menu' => 'footer_menu']); ?>
					</div>
			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>