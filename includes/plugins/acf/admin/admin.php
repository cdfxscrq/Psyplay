<?php 

class acf_admin {
	
	/*
	*  __construct
	*
	*  Initialize filters, action, variables and includes
	*
	*  @type	function
	*  @date	23/06/12
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
	
		// actions
		add_action('admin_menu', 			array($this, 'admin_menu'));
		add_action('admin_enqueue_scripts',	array($this, 'admin_enqueue_scripts'), 0);
		add_action('admin_notices', 		array($this, 'admin_notices'));
		
	}
	
	
	/*
	*  admin_menu
	*
	*  This function will add the ACF menu item to the WP admin
	*
	*  @type	action (admin_menu)
	*  @date	28/09/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function admin_menu() {
		
		// bail early if no show_admin
		if( !acf_get_setting('show_admin') ) {
			
			return;
			
		}
		
		
		// vars
		$slug = 'edit.php?post_type=acf-field-group';
		$cap = acf_get_setting('capability');
		
		
		// add parent
		add_menu_page(__("Custom Fields",'acf'), __("Custom Fields",'acf'), $cap, $slug, false, 'dashicons-screenoptions', '80.025');
		
		
		// add children
		add_submenu_page($slug, __('Field Groups','acf'), __('Field Groups','acf'), $cap, $slug );
		add_submenu_page($slug, __('Add New','acf'), __('Add New','acf'), $cap, 'post-new.php?post_type=acf-field-group' );
		
	}
	
	
	/*
	*  admin_enqueue_scripts
	*
	*  This function will add the already registered css
	*
	*  @type	function
	*  @date	28/09/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function admin_enqueue_scripts() {
		
		wp_enqueue_style( 'acf-global' );
		
	}
	
	
	/*
	*  admin_notices
	*
	*  This function will render any admin notices
	*
	*  @type	function
	*  @date	17/10/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function admin_notices() {
		
		// vars
		$admin_notices = acf_get_admin_notices();
		
		
		// bail early if no notices
		if( empty($admin_notices) ) {
			
			return;
			
		}
		
		
		foreach( $admin_notices as $notice ) {
			
			$open = '';
			$close = '';
				
			if( $notice['wrap'] ) {
				
				$open = "<{$notice['wrap']}>";
				$close = "</{$notice['wrap']}>";
				
			}
				
			?>
			<div class="notice is-dismissible <?php echo $notice['class']; ?>"><?php echo $open . $notice['text'] . $close; ?></div>
			<?php
				
		}
		
	}
	
}


// initialize
new acf_admin();

?>
