<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" <?php language_attributes(); ?>>
 <head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="robots" content="index,follow">
<meta http-equiv="content-language" content="en">
<?php get_template_part('includes/parts/seo'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="Generator" content="PsyPlay <?php recoger_version();?> and WordPress">
<?php $favicon = get_option('general-favicon'); if (!empty($favicon)) { ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon" />
<?php } ?>
<?php if (!function_exists('automatic_feed_links')) { ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<?php } ?>
<?php wp_head(); ?>
<?php $activar = get_option('activate_css'); if ($activar == "true") { $css = get_option('code_css'); if(!empty($css)) { echo '<style>'.$css.'</style>';  } } ?>
<?php $activar = get_option('activate_js'); if ($activar == "true") { $js = get_option('code_js'); if(!empty($js)) { echo '<script type="text/javascript">'.$js.'</script>';  } } ?>
</head>
<body>
<?php $activar = get_option('night-mode'); if ($activar == "true") { ?>		
<div id="switch-mode">
<?php $default = get_option('psy-default-style'); $premade = get_option('premade_style1'); if($default == 'light' || $premade == "true") {?>
<div class="sm-icon"><i class="fa fa-moon-o"></i></div>
<div class="sm-text"> <?php _e('Night Mode','psythemes'); ?></div>
 <?php } else {?>
 <div class="sm-icon"><i class="fa fa-sun-o"></i></div>
 <div class="sm-text"> <?php _e('Light Mode','psythemes'); ?></div>
 <?php }?>
<div class="sm-button"><span></span></div>
</div>
<?php }?>
<!--header-->
<header>
<div class="container">
<div class="header-logo">
<a title="<?php bloginfo('name') ?>" href="<?php bloginfo('url'); ?>" id="logo"></a>
</div>
<div class="mobile-menu"><i class="fa fa-reorder"></i></div>
<div class="mobile-search"><i class="fa fa-search"></i></div>
<div id="menu">
<?php if(get_option('edd_sample_theme_license_key')) {
function_exists('wp_nav_menu') && has_nav_menu('menu_navegador' );
if (has_nav_menu('menu_navegador')) {
wp_nav_menu( array( 'theme_location' => 'menu_navegador', 'container' => '',  'menu_class' => 'top-menu', 'walker' => new WPSE_78121_Sublevel_Walker) );
}
} ?>
<div class="clearfix"></div>
</div>
<div id="top-user">
<div class="top-user-content <?php if (is_user_logged_in()) {echo 'logged'; } else { echo 'guest';} ?>">
<?php $active = get_option('users_can_register'); if ($active == "1") { ?>
<?php

 if (is_user_logged_in()) { ?>
<div class="logged-user">
<a href="#" class="avatar user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo get_template_directory_uri(); ?>/assets/css/img/default_avatar.jpg"><i class="fa fa-chevron-down"></i></a>
<ul class="dropdown-menu">
<li><a href="<?php echo get_option('account_page').'/?action=profile'; ?>"><i class="fa fa-user mr5"></i> <?php _e('Profile','psythemes'); ?></a></li>
<li><a href="<?php echo get_option('account_page').'/?action=favorites';?>"><i class="fa fa-heart mr5"></i> <?php _e('My Favorites','psythemes'); ?></a></li>
<li><a href="<?php echo get_option('account_page').'/?action=edit';?>"><i class="fa fa-pencil mr5"></i> <?php _e('Update Profile','psythemes'); ?></a></li>
<li><a href="<?php echo wp_logout_url(); ?>"><i class="fa fa-power-off mr5"></i> <?php _e('Logout','psythemes'); ?></a></li>
</ul>
</div>

<?php } else { ?>
<style tyle="text/css">

</style>
<a href="#pt-login" class="btn btn-successful btn-login" title="Login" data-target="" data-toggle="modal"> <?php _e('LOGIN','psythemes'); ?></a>
<?php } ?>
<?php } ?>
</div>
</div>
<div id="search">
<div class="search-content">
<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">
<input class="form-control search-input" type="text" placeholder="<?php _e('Search..', 'psythemes'); ?>" name="s" id="s" value="<?php echo get_search_query(); ?>" <?php if(get_option('live-search') == "true") { echo 'data-swplive="true"';}?>>
<button type="submit"><i class="fa fa-search"></i></button>

</form>
</div>
</div>
<div class="clearfix"></div>
</div>
</header>
<!--/header-->
<div class="header-pad"></div>

