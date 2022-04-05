<?php
$terms = get_the_terms($post, 'category');
$bg_color = get_field('achtergrondkleur', $terms[0]);
$text_color = get_field('tekstkleur', $terms[0]);

$bg_color = 'background-' . $bg_color;
$text_color = 'foreground-' . $text_color;
?>
			<footer id="site-footer" class="header-footer-group <?php echo $bg_color; ?> <?php echo $text_color; ?>">
					<div class="footer-graphic">
						<?php if(is_singular() && $bg_color == 'background-zwart'){ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/footer-img-dark.png" alt="Echt Amsterdams!" />
						<?php }else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/footer-kerk.png" alt="Echt Amsterdams!" />
						<?php } ?>
					</div>

					<div class="footer-content">
						<div class="footer-logo">
							<a href="/" title="Naar de homepage"><img src="<?php echo get_template_directory_uri(); ?>/img/footer_logo.svg" alt="footer logo FC Centrum" /></a>
						</div><!-- .footer-credits -->

						<ul class="footer-socials">
							<li class="footer-social youtube"><a href="https://www.youtube.com/c/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Youtube</a></li>
							<li class="footer-social twitter"><a href="https://twitter.com/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Twitter</a></li>
							<li class="footer-social facebook"><a href="https://www.facebook.com/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Facebook</a></li>
							<li class="footer-social instagram"><a href="https://www.instagram.com/fccentrum/" target="_blank" rel="nofollow">FC Centrum op Instagram</a></li>
						</ul>

						<p class="footer-address">
							<a href="https://goo.gl/maps/BxF8wzv5woFyqgaX7" target="_blank" rel="nofollow">Alberdink Thijmstraat 123<br />1033 AA Amsterdam </a>
						</p>
					</div>
			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>