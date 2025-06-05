<?php
// Register category Series TV Shows
if ( ! function_exists( 'tvshows_taxonomy' ) ) {
function tvshows_taxonomy() {
register_taxonomy('tvshows_categories', array('tvshows,episodes',),
array(
	'show_admin_column' => true, 
	'hierarchical' => true, 
	'rewrite' => array('slug' => get_option('tvshows-category')),)
);
}
add_action('init', 'tvshows_taxonomy', 0);
}

if ( ! function_exists( 'prefijo_series' ) ) {
function prefijo_series() {
flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'prefijo_series' );
}


// Register Series
if ( ! function_exists( 'series' ) ) {
function series() {

	$labels = array(
		'name'                => _x( 'TV-Series', 'Post Type General Name', 'psythemes' ),
		'singular_name'       => _x( 'TV-Serie', 'Post Type Singular Name', 'psythemes' ),
		'menu_name'           => __( 'TV-Series', 'psythemes' ),
		'name_admin_bar'      => __( 'TV-Series', 'psythemes' ),
		'add_new_item'        => __( 'Add TV-Series', 'psythemes' ),
		'add_new'             => __( 'Add TV-Series', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                => 'series',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'TV-Serie', 'psythemes' ),
		'description'         => __( 'TV series manage', 'psythemes' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail','comments' ),
		'taxonomies'          => array('category','post_tag', 'quality', 'director','stars','country','release-year'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-welcome-view-site',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'tvshows', $args );
}
add_action( 'init', 'series', 0 );
}

if ( ! function_exists( 'tax_studio' ) ) {
// Studio
function tax_studio() {
	$labels = array(
		'name'                       => _x( 'Studio', 'Taxonomy General Name', 'psythemes' ),
		'singular_name'              => _x( 'Studio', 'Taxonomy Singular Name', 'psythemes' ),
		'menu_name'                  => __( 'Studio', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                       => ('studio'),
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'studio', array( 'tvshows' ), $args );
}
add_action( 'init', 'tax_studio', 0 );
}


// Neworks
if ( ! function_exists( 'tax_networks' ) ) {
function tax_networks() {
	$labels = array(
		'name'                       => _x( 'Networks', 'Taxonomy General Name', 'psythemes' ),
		'singular_name'              => _x( 'Networks', 'Taxonomy Singular Name', 'psythemes' ),
		'menu_name'                  => __( 'Networks', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                       => ('networks'),
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'networks', array( 'tvshows' ), $args );
}
add_action( 'init', 'tax_networks', 0 );
}