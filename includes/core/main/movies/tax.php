<?php
if ( ! function_exists( 'psy_director' ) ) {
function psy_director() {
	register_taxonomy 
	( 'director', 'post', array(
	/* ============================================= */
	'hierarchical' => false,  'label' => __( 'Directors', 'psythemes' ),
	'query_var' => true, 'rewrite' => true)
	);
	}
	add_action( 'init', 'psy_director', 0 );
}

if ( ! function_exists( 'psy_mstars' ) ) {
function psy_mstars() {
	register_taxonomy 
	( 'stars', 'post', array(
	/* ============================================= */
	'hierarchical' => false,  'label' => __( 'Actors', 'psythemes' ),
	'query_var' => true, 'rewrite' => true)
	);
}
	add_action( 'init', 'psy_mstars', 0 );
}
	// register_taxonomy 
	// ( 'cast', 'post', array(
	// /* ============================================= */
	// 'hierarchical' => false,  'label' => __( 'Cast', 'psythemes' ),
	// 'query_var' => true, 'rewrite' => true)
	// );
	
if ( ! function_exists( 'psy_country' ) ) {
function psy_country() {
	register_taxonomy 
	( 'country', 'post', array(
	/* ============================================= */
	'hierarchical' => false,  'label' => __( 'Country', 'psythemes' ),
	'query_var' => true, 'rewrite' => true)
	);
}
	add_action( 'init', 'psy_country', 0 );
}

if ( ! function_exists( 'psy_releasey' ) ) {
function psy_releasey() {
	register_taxonomy 
	( 'release-year', 'post', array(
	/* ============================================= */
	'hierarchical' => false,  'label' => __( 'Year', 'psythemes' ),
	'query_var' => true, 'rewrite' => true)
	);
}
	add_action( 'init', 'psy_releasey', 0 );
}

if ( ! function_exists( 'psy_quality' ) ) {
function psy_quality() {
	register_taxonomy 
	( 'quality', 'post', array(
	/* ============================================= */
	'hierarchical' => false,  'label' => __( 'Quality', 'psythemes' ),
	'query_var' => true, 'rewrite' => true)
	);
}
	add_action( 'init', 'psy_quality', 0 );
}