<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<meta name="facebook-domain-verification" content="licc5ah75316vf2zm16juk3ju9b3dx" />

		<?php wp_head(); ?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-WFJ7FBM');</script>
		<!-- /Google tag -->

	</head>

	<body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WFJ7FBM"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group">
			<a href="/" title="Ga naar de home-pagina" id="logo">
				<small>FanClub voor onze oude binnenstad</small>
			</a>

			<button id="hamburger">
				<span class="stripe top"></span>
				<span class="stripe middle"></span>
				<span class="stripe bottom"></span>
			</button>
			

			<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">

				<ul class="primary-menu reset-list-style">

				<?php
				if ( has_nav_menu( 'primary' ) ) {

					wp_nav_menu(
						array(
							'container'  => '',
							'items_wrap' => '%3$s',
							'theme_location' => 'primary',
						)
					);

				} elseif ( ! has_nav_menu( 'expanded' ) ) {

					wp_list_pages(
						array(
							'match_menu_classes' => true,
							'show_sub_menu_icons' => true,
							'title_li' => false,
							//'walker'   => new TwentyTwenty_Walker_Page(),
						)
					);

				}
				?>

				</ul>

			</nav><!-- .primary-menu-wrapper -->

			<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
				<span class="toggle-inner">
					<span class="toggle-icon">
						HIER SEARCH ICON
					</span>
					<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
				</span>
			</button><!-- .search-toggle -->

		</header><!-- #site-header -->
		
		<?php 
		$modal_always_open = '';
		if ( is_search() ) {
			$modal_always_open = 'always-open';
		}
		?>

		<div class="search-modal cover-modal header-footer-group <?php echo $modal_always_open; ?>" data-modal-target-string=".search-modal">

			<div class="search-modal-inner modal-inner">

				<div class="section-inner">

					<?php
					get_search_form(
						array(
							'aria_label' => __( 'Search for:' ),
						)
					);
					?>

					<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field">
						<span class="screen-reader-text"><?php _e( 'Close search', 'twentytwenty' ); ?></span>
						
					</button><!-- .search-toggle -->

				</div><!-- .section-inner -->

			</div><!-- .search-modal-inner -->

		</div><!-- .search-modal -->
		
		<?php
		/* 
		if(is_home()){
			get_carousel();
		}
		*/
		?>

		<?php
			$object = get_queried_object();
			$graphic = get_field('graphic_boven', $object);
		?>
		<div id="header-graphic">
			<?php if(isset($graphic) && $graphic){ ?>
				<?php echo wp_get_attachment_image( $graphic, 'full' ); ?>
			<?php }elseif(is_home()){ ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/header-graphic-2-black.png" alt="footer logo FC Centrum" />
			<?php } ?>
		</div>

		
