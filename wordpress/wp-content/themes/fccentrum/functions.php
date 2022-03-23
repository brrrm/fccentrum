<?php


remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


// Our custom post type function
function create_posttypes() {
 	$storyLabels = array(
		'name' => __( 'Stories' ),
		'singular_name' => __( 'Story' ),
		'add_new' => __( 'New story' ),
		'add_new_item' => __( 'Add new story' ),
		'edit_item' => __( 'Edit story' ),
		'new_item' => __( 'New story' ),
		'view_item' => __( 'View story' ),
		'search_items' => __( 'Search stories' ),
		'not_found' =>  __( 'No stories Found' ),
		'not_found_in_trash' => __( 'No stories found in Trash'),
	);

    register_post_type( 'story',
    // CPT Options
        array(
            'labels' 		=> $storyLabels,
            'public' 		=> true,
            'exclude_from_search'	=> false,

            'has_archive' 	=> true,
            'rewrite' 		=> array('slug' => 'story'),
            'show_in_rest' 	=> true,
            'menu_position'	=> 4,
 			'menu_icon'		=> 'dashicons-megaphone',
 			'taxonomies'	=> ['category'],
 			'supports'		=> [
 				'title',
 				'editor',
 				'author',
 				'revisions',
 				'thumbnail'
 			]
        )
    );

 	$newsLabels = array(
		'name' => __( 'News' ),
		'singular_name' => __( 'News article' ),
		'add_new' => __( 'New news article' ),
		'add_new_item' => __( 'Add new news article' ),
		'edit_item' => __( 'Edit news article' ),
		'new_item' => __( 'New news article' ),
		'view_item' => __( 'View news article' ),
		'search_items' => __( 'Search news articles' ),
		'not_found' =>  __( 'No news article Found' ),
		'not_found_in_trash' => __( 'No news article found in Trash'),
	);

    register_post_type( 'news',
    // CPT Options
        array(
            'labels' 		=> $newsLabels,
            'public' 		=> true,
            'has_archive' 	=> true,
            'rewrite' 		=> array('slug' => 'nieuws'),
            'show_in_rest' 	=> true,
            'menu_position'	=> 5,
 			'menu_icon'		=> 'dashicons-admin-site-alt',
 			'taxonomies'	=> ['news_cats'],
 			'supports'		=> [
 				'title',
 				'editor',
 				'author',
 				'revisions'
 			]
        )
    );

    $carouselLabels = array(
		'name' => __( 'Carousel slides' ),
		'singular_name' => __( 'Carousel slide' ),
		'add_new' => __( 'New carousel slide' ),
		'add_new_item' => __( 'Add new carousel slide' ),
		'edit_item' => __( 'Edit carousel slide' ),
		'new_item' => __( 'New carousel slide' ),
		'view_item' => __( 'View carousel slide' ),
		'search_items' => __( 'Search carousel slides' ),
		'not_found' =>  __( 'No carousel slides Found' ),
		'not_found_in_trash' => __( 'No carousel slide found in Trash'),
	);

    register_post_type( 'carouselslide',
    // CPT Options
        array(
            'labels' 		=> $carouselLabels,
            'public' 		=> true,
            'has_archive' 	=> true,
            'rewrite' 		=> array('slug' => 'slide'),
            'show_in_rest' 	=> false,
            'menu_position'	=> 6,
 			'menu_icon'		=> 'dashicons-format-gallery',
 			'supports'		=> [
 				'title',
 				'revisions'
 			]
        )
    );

    
}
add_action( 'init', 'create_posttypes' );


// Show posts of 'post', 'page' and 'movie' post types on home page
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'story' ) );
    return $query;
}
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );



function alter_archive_title($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }
    return $title;    
};
add_filter( 'get_the_archive_title', 'alter_archive_title', 10, 1);



// ACF Google Maps Key Setting.
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyAYtTpBXwzon3LA0TTzVGAl69h8qoMqFoc');
}
add_action('acf/init', 'my_acf_init');

function create_taxonomy() {
 
	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI
	$spotsLabels = array(
		'name' 				=> _x( 'Spots', 'taxonomy general name' ),
		'singular_name' 	=> _x( 'Spot', 'taxonomy singular name' ),
		'search_items' 		=> __( 'Search spots' ),
		'all_items' 		=> __( 'All spots' ),
		'parent_item' 		=> __( 'Parent spot' ),
		'parent_item_colon' => __( 'Parent spot:' ),
		'edit_item' 		=> __( 'Edit spot' ), 
		'update_item' 		=> __( 'Update spot' ),
		'add_new_item' 		=> __( 'Add new spot' ),
		'new_item_name' 	=> __( 'New subject spot' ),
		'menu_name' 		=> __( 'Spots' ),
	);    

	// Now register the taxonomy
	register_taxonomy('spots', array('story'), array(
		'hierarchical' 		=> false,
		'labels' 			=> $spotsLabels,
		'show_ui' 			=> true,
		'show_in_rest' 		=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'sort'				=> true,
		'rewrite' 			=> array( 
			'slug' => 'spot'
		),
	));

	$fansLabels = array(
		'name' 				=> _x( 'Fans', 'taxonomy general name' ),
		'singular_name' 	=> _x( 'Fan', 'taxonomy singular name' ),
		'search_items' 		=> __( 'Search Fans' ),
		'all_items' 		=> __( 'All fans' ),
		'parent_item' 		=> __( 'Parent fan' ),
		'parent_item_colon' => __( 'Parent fan:' ),
		'edit_item' 		=> __( 'Edit fan' ), 
		'update_item' 		=> __( 'Update fan' ),
		'add_new_item' 		=> __( 'Add new fan' ),
		'new_item_name' 	=> __( 'New subject fan' ),
		'menu_name' 		=> __( 'Fans' ),
	);    

	// Now register the taxonomy
	register_taxonomy('fans', array('story'), array(
		'hierarchical' 		=> false,
		'labels' 			=> $fansLabels,
		'show_ui' 			=> true,
		'show_in_rest' 		=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'sort'				=> true,
		'rewrite' 			=> array( 
			'slug' => 'fan'
		),
	));

	$rubriekLabels = array(
		'name' 				=> _x( 'News categories', 'taxonomy general name' ),
		'singular_name' 	=> _x( 'News category', 'taxonomy singular name' ),
		'search_items' 		=> __( 'Search news categories' ),
		'all_items' 		=> __( 'All news categories' ),
		'parent_item' 		=> __( 'Parent news category' ),
		'parent_item_colon' => __( 'Parent news category:' ),
		'edit_item' 		=> __( 'Edit news category' ), 
		'update_item' 		=> __( 'Update news category' ),
		'add_new_item' 		=> __( 'Add new news category' ),
		'new_item_name' 	=> __( 'New subject news category' ),
		'menu_name' 		=> __( 'news categories' ),
	);    

	// Now register the taxonomy
	register_taxonomy('news_cats', array('story'), array(
		'hierarchical' 		=> true,
		'labels' 			=> $rubriekLabels,
		'show_ui' 			=> true,
		'show_in_rest' 		=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array( 
			'slug' => 'news-category'
		),
	));
 
}
add_action( 'init', 'create_taxonomy', 0 );

function hide_description_row() {
    echo "<style> .term-description-wrap { display:none; } </style>";
}

add_action( "category_edit_form", 'hide_description_row');
add_action( "category_add_form", 'hide_description_row');
add_action( "spots_edit_form", 'hide_description_row');
add_action( "spots_add_form", 'hide_description_row');

function fccentrum_theme_support(){
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'fccentrum_theme_support' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function fccentrum_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}
add_action( 'init', 'fccentrum_menus' );

function my_scripts_method() {
    wp_enqueue_script(
        'spots',
        get_stylesheet_directory_uri() . '/js/spots.js', #your JS file
        array( 'jquery' ) #dependencies
    );
    wp_enqueue_style( 'fccentrum-styles', get_stylesheet_uri() );
    wp_enqueue_style( 'typekit', 'https://use.typekit.net/fnf5oyg.css');
    wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    wp_enqueue_style('slickstyles', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('bodymovin', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.1/lottie.min.js');
    wp_enqueue_script('carousel', get_stylesheet_directory_uri() . '/js/carousel.js', array( 'jquery' ));
    wp_enqueue_script('scroll', get_stylesheet_directory_uri() . '/js/scroll.js', array( 'jquery' ));
    wp_enqueue_script('logo', get_stylesheet_directory_uri() . '/js/logo.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

// disable gutenberg editor for news post types
function disable_gutenberg_editor($use_block_editor, $post_type){
	if($post_type == 'news'){
		return false;
	}else{
		return true;
	}
}
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor", 10, 2);


function namespace_add_custom_types( $query ) {
  if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 
     'story',
        ));
    }
}
add_action( 'pre_get_posts', 'namespace_add_custom_types' );


// verwijder (verberg) de normale wp-posts 
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_add_new_post_href_in_admin_bar() {
    ?>
    <script type="text/javascript">
        function remove_add_new_post_href_in_admin_bar() {
            var add_new = document.getElementById('wp-admin-bar-new-content');
            if(!add_new) return;
            var add_new_a = add_new.getElementsByTagName('a')[0];
            if(add_new_a) add_new_a.setAttribute('href','#!');
        }
        remove_add_new_post_href_in_admin_bar();
    </script>
    <?php
}
add_action( 'admin_footer', 'remove_add_new_post_href_in_admin_bar' );

function remove_frontend_post_href(){
    if( is_user_logged_in() ) {
        add_action( 'wp_footer', 'remove_add_new_post_href_in_admin_bar' );
    }
}
add_action( 'init', 'remove_frontend_post_href' );




function get_postsbycategory($term) {
	// the query
	$the_query = new WP_Query( array( 
	    'category_name' => $term->name, 
	    'posts_per_page' => 6,
				    'post_type'			=> 'story'
	) ); 
	   
	// The Loop
	if ( $the_query->have_posts() ) {
	    while ( $the_query->have_posts() ) {
	        $the_query->the_post();
	        get_template_part( 'template-parts/story-teaser', null, [] );
	    }
	}
	   
	/* Restore original Post Data */
	wp_reset_postdata();
}

function get_carousel(){

	// the query
	$the_query = new WP_Query( array(
	    'posts_per_page' 	=> 6,
		'post_type'			=> 'carouselslide'
	) ); 
	   
	// The Loop
	if ( $the_query->have_posts() ) {
		echo '<div id="carouselWrap"><a id="prevslide"></a><div id="carousel">';
	    while ( $the_query->have_posts() ) {
	        $the_query->the_post();
	        get_template_part( 'template-parts/carousel', null, [] );
	    }
	    echo '</div><a id="nextslide"></a></div>';
	    echo '<a id="carousel-scrollDown-arrow" href="#site-content">Scroll naar beneden</a>';
	}
	   
	/* Restore original Post Data */
	wp_reset_postdata();
}
