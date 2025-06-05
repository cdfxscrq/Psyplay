<?php
// Notices
if ( ! function_exists( 'notices' ) ) {
function notices() {
	$labels = array(
		'name'                => _x( 'Notices', 'Post Type General Name', 'psythemes' ),
		'singular_name'       => _x( 'Article', 'Post Type Singular Name', 'psythemes' ),
		'menu_name'           => __( 'Notices', 'psythemes' ),
		'parent_item_colon'   => __( 'Parent Item:', 'psythemes' ),
		'all_items'           => __( 'All Notices', 'psythemes' ),
		'view_item'           => __( 'View Notices', 'psythemes' ),
		'add_new_item'        => __( 'Add Notices', 'psythemes' ),
		'add_new'             => __( 'Add Notices', 'psythemes' ),
		'edit_item'           => __( 'Edit', 'psythemes' ),
		'update_item'         => __( 'Update', 'psythemes' ),
		'search_items'        => __( 'Search', 'psythemes' ),
		'not_found'           => __( 'It was not found', 'psythemes' ),
		'not_found_in_trash'  => __( 'Was found in the trash', 'psythemes' ),
	);
	$rewrite = array(
		'slug'                => 'notice',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Notices', 'psythemes' ),
		'description'         => __( 'Add Notices', 'psythemes' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
		'taxonomies'          => array( 'article_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 1,
		'menu_icon'           => 'dashicons-warning',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'notices', $args );
}
add_action( 'init', 'notices', 0 );
}