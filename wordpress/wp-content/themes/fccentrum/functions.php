<?php

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
            'has_archive' 	=> true,
            'rewrite' 		=> array('slug' => 'stories'),
            'show_in_rest' 	=> true,
            'menu_position'	=> 4,
 			'menu_icon'		=> 'dashicons-megaphone',
 			'taxonomies'	=> ['category'],
 			'supports'		=> [
 				'title',
 				'editor',
 				'author',
 				'excerpt',
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
 			'supports'		=> [
 				'title',
 				'editor',
 				'author',
 				'excerpt',
 				'revisions'
 			]
        )
    );
}
add_action( 'init', 'create_posttypes' );




function fccentrum_theme_support(){
	add_theme_support( 'post-thumbnails' );

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

// disable gutenberg editor for news post types
function disable_gutenberg_editor($use_block_editor, $post_type){
	if($post_type == 'news'){
		return false;
	}else{
		return true;
	}
}
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor", 10, 2);



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
