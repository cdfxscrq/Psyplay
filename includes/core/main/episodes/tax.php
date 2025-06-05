<?php
if ( ! function_exists( 'episodios' ) ) {
function episodios() {

	$labels = array(
		'name'                => _x( 'Episode', 'Post Type General Name', 'psythemes' ),
		'singular_name'       => _x( 'Episodes', 'Post Type Singular Name', 'psythemes' ),
		'menu_name'           => __( 'Episodes', 'psythemes' ),
		'name_admin_bar'      => __( 'Episodes', 'psythemes' ),
		'add_new_item'        => __( 'Add Episodes', 'psythemes' ),
		'add_new'             => __( 'Add Episodes', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                => 'episode',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Episode', 'psythemes' ),
		'description'         => __( 'Episode manage', 'psythemes' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail','comments' ),
		'taxonomies'          => array( 'post_tag', 'director','quality'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-controls-play',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'episodes', $args );
}
add_action( 'init', 'episodios', 0 );
}

// Year
if ( ! function_exists( 'tax_episode_serien' ) ) {
function tax_episode_serien() {
	$labels = array(
		'name'                       => _x( 'Series Name', 'Taxonomy General Name', 'psythemes' ),
		'singular_name'              => _x( 'Series Name', 'Taxonomy Singular Name', 'psythemes' ),
		'menu_name'                  => __( 'Series', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                       => 'series-name',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'episodeserie', array( 'episodes' ), $args );
}
//add_action( 'init', 'tax_episode_serien', 0 );
}

// Year
if ( ! function_exists( 'tax_episode_date' ) ) {
function tax_episode_date() {
	$labels = array(
		'name'                       => _x( 'Year', 'Taxonomy General Name', 'psythemes' ),
		'singular_name'              => _x( 'Year', 'Taxonomy Singular Name', 'psythemes' ),
		'menu_name'                  => __( 'Year', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                       => 'episode-date',
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
	register_taxonomy( 'episodedate', array( 'episodes' ), $args );
}
add_action( 'init', 'tax_episode_date', 0 );
}

// Guest star
if ( ! function_exists( 'tax_guest_star' ) ) {
function tax_guest_star() {
	$labels = array(
		'name'                       => _x( 'Guest Star', 'Taxonomy General Name', 'psythemes' ),
		'singular_name'              => _x( 'Guest Star', 'Taxonomy Singular Name', 'psythemes' ),
		'menu_name'                  => __( 'Guest Star', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                       => 'guest-star',
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
	register_taxonomy( 'gueststar', array( 'episodes' ), $args );
}
add_action( 'init', 'tax_guest_star', 0 );
}

