<?php
if ( ! function_exists( 'newsletterz' ) ) {
function newsletterz() {

	$labels = array(
		'name'                => _x( 'Newsletter', 'Post Type General Name', 'psythemes' ),
		'singular_name'       => _x( 'Newsletter', 'Post Type Singular Name', 'psythemes' ),
		'menu_name'           => __( 'Newsletter', 'psythemes' ),
		'name_admin_bar'      => __( 'Newsletter', 'psythemes' ),
		'add_new_item'        => __( 'Add Newsletter', 'psythemes' ),
		'add_new'             => __( 'Add Newsletter', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                => 'newsletter',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Newsletter', 'psythemes' ),
		'description'         => __( 'Newsletter manage', 'psythemes' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'taxonomies'          => array( ''),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-email-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
//		'capabilities' => array('create_posts' => 'do_not_allow', ),
	);
	register_post_type( 'newsletterz', $args );
}
add_action( 'init', 'newsletterz', 0 );
}


function set_newsletterz_columns($columns) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title'),
        'date' => __('Subscribed Date'),
		'uname' => __('Username'),
        'user_ip' =>__( 'IP Address'),
    );
}
add_filter('manage_newsletterz_posts_columns' , 'set_newsletterz_columns');