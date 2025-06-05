<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SearchWP_Live_Search_Form extends SearchWP_Live_Search {

	public $configs = array(
			'default' => array(                         // 'default' config
				'engine' => 'default',                  // search engine to use (if SearchWP is available)
				'input' => array(
					'delay'     => 500,                 // wait 500ms before triggering a search
					'min_chars' => 3,                   // wait for at least 3 characters before triggering a search
				),
				'results' => array(
					'position'  => 'bottom',            // where to position the results (bottom|top)
					'width'     => 'auto',              // whether the width should automatically match the input (auto|css)
					'offset'    => array(
						'x' => 0,                       // x offset (in pixels)
						'y' => 5                        // y offset (in pixels)
					),
				),
				'spinner' => array(                     // powered by http://fgnass.github.io/spin.js/
					'lines'         => 10,              // number of lines in the spinner
					'length'        => 8,               // length of each line
					'width'         => 4,               // line thickness
					'radius'        => 8,               // radius of inner circle
					'corners'       => 1,               // corner roundness (0..1)
					'rotate'        => 0,               // rotation offset
					'direction'     => 1,               // 1: clockwise, -1: counterclockwise
					'color'         => '#000',          // #rgb or #rrggbb or array of colors
					'speed'         => 1,               // rounds per second
					'trail'         => 60,              // afterglow percentage
					'shadow'        => false,           // whether to render a shadow
					'hwaccel'       => false,           // whether to use hardware acceleration
					'className'     => 'spinner',       // CSS class assigned to spinner
					'zIndex'        => 2000000000,      // z-index of spinner
					'top'           => '50%',           // top position (relative to parent)
					'left'          => '50%',           // left position (relative to parent)
				),
			),
		);


	function setup() {
		$site = EDD_SL_STORE_URL;
		$site2 = get_option('edd_sample_theme_license_key_status');;
		if ($site == "https://psythemes.com" && $site2 == "valid" ){
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
		add_filter( 'get_search_form', array( $this, 'get_search_form' ), 999, 1 );
		}
		$this->configs = apply_filters( 'searchwp_live_search_configs', $this->configs );
		
	}


	function assets() {

		//wp_enqueue_style( 'livesearch', $this->url . '/assets/styles/style.css', null, $this->version );


        wp_enqueue_script( 'jquery' );

		$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ) || ( isset( $_GET['script_debug'] ) ) ? true : false;


		if ($debug){
			wp_register_script(
                'swp-live-search-client',
                $this->url . '/assets/javascript/build/psythemes-live-search.js',
                array( 'jquery' ),
                $this->version,
                true
            );
        } else {
			wp_register_script(
                'swp-live-search-client',
                $this->url . '/assets/javascript/build/psythemes-live-search.min.js',
                array( 'jquery' ),
                $this->version,
                true
            );
        }


		$params = array(
			'ajaxurl'               => admin_url( 'admin-ajax.php' ),
			'config'                => $this->configs,
			'msg_no_config_found'   => __( 'No valid Live Search configuration found!', 'searchwp' ),
		);


		$encoded_data = array(
			'l10n_print_after' => 'searchwp_live_search_params = ' . json_encode( $params ) . ';'
		);

		wp_localize_script( 'swp-live-search-client', 'searchwp_live_search_params', $encoded_data );
		wp_enqueue_script( 'swp-live-search-client' );
	}


	function get_search_form( $html ) {
		if ( apply_filters( 'searchwp_live_search_hijack_get_search_form', true ) ) {
			$engine = apply_filters( 'searchwp_live_search_get_search_form_engine', 'default' );
			$config = apply_filters( 'searchwp_live_search_get_search_form_config', 'default' );

			$html = str_replace( 'name="s"', 'name="s" data-swplive="true" data-swpengine="' . esc_attr( $engine ) . '" data-swpconfig="' . esc_attr( $config ) . '"', $html );
		}
		return $html;
	}



}
