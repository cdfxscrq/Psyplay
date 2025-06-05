<?php 

if( ! function_exists( 'psythemes_styles' ) ) {
	function psythemes_styles()  {
		$default = get_option('psy-default-style');
		$premade = get_option('premade_style1');		
		wp_enqueue_style('theme-style', PT_URI .'/assets/css/theme.style.css' , array(), DT_VERSION );		
		if($premade == "true") {
		wp_enqueue_style('main', PT_URI .'/assets/css/theme.main.css' , array(), DT_VERSION );
		}elseif($default == "dark"){
		 wp_enqueue_style('maindark', PT_URI .'/assets/css/theme.main.dark.css' , array(), DT_VERSION );
		 }else{
		 wp_enqueue_style('main', PT_URI .'/assets/css/theme.main.css' , array(), DT_VERSION );
		 }
		//wp_enqueue_style('bootstrap', PT_URI .'/assets/css/bootstrap.min.css' , array(), DT_VERSION );
		//wp_enqueue_style('cluetip', PT_URI .'/assets/css/jquery.cluetip.css' , array(), DT_VERSION );
		//wp_enqueue_style('qtip', PT_URI .'/assets/css/jquery.qtip.min.css' , array(), DT_VERSION );
		//wp_enqueue_style('custom', PT_URI .'/assets/css/custom.css' , array(), DT_VERSION );
		//wp_enqueue_style('slide', PT_URI .'/assets/css/slide.css' , array(), DT_VERSION );
	}
	add_action('wp_enqueue_scripts', 'psythemes_styles');
}

if( ! function_exists( 'psythemes_scripts' ) ) {
	function psythemes_scripts() {
		$mode_switch = get_option('night-mode');
		$fvisit_notice = get_option('first-visit-notice');
		$lazyload = get_option('xtras_imglazy');
		$slideshow = get_option('images-slideshow-mv');
		$slider = get_option('featslidmodule');
		$search = get_option('homepage-search');
		$home = get_option('psy_home');
		$page_h = url_to_postid($home);
		$preview = get_option('content-preview');
		$slider_news = get_option('news-module');
		$slider_notices = get_option('notice-module');
		$acc = get_option('account_page');
		$req = get_option('request_page');
		$page_a = url_to_postid($acc);
		$page_r = url_to_postid($req);
		wp_enqueue_script('jquery-main',  'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js' , array('jquery'), '2.1.3', false  );
		if($search == "true") {
			if(!is_home()) {
				if($lazyload == "true") :	wp_enqueue_script('lazyload',  PT_URI .'/assets/js/jquery.lazyload.js' , array('jquery'), DT_VERSION, false  ); endif;
				if($preview == "true"): wp_enqueue_script('qtip',  PT_URI .'/assets/js/jquery.qtip.min.js' , array('jquery'), DT_VERSION, false  ); endif;
			}
		} else {
			if($lazyload == "true") :	wp_enqueue_script('lazyload',  PT_URI .'/assets/js/jquery.lazyload.js' , array('jquery'), DT_VERSION, false  ); endif;
			if($preview == "true"): wp_enqueue_script('qtip',  PT_URI .'/assets/js/jquery.qtip.min.js' , array('jquery'), DT_VERSION, false  ); endif;	
		}
		if($mode_switch == "true" || $fvisit_notice == "enable") {
		wp_enqueue_script('cookie',  PT_URI .'/assets/js/jquery.cookie.js' , array('jquery'), DT_VERSION, false  );
		}
		if(is_singular('post') or is_singular('episodes')) : wp_enqueue_script('idtabs',  PT_URI .'/assets/js/jquery.idTabs.min.js' , array('jquery'), DT_VERSION, false  ); endif;
		if(is_singular(array('post','tvshows','episodes'))  && $slideshow == "enable" ) : wp_enqueue_script('owl-carousel',  PT_URI .'/assets/js/owl.carousel.js' , array('jquery'), DT_VERSION, false  ); endif;
		if(is_singular(array('post','tvshows','episodes')) || get_the_ID() == $page_r || get_the_ID() == $page_a && isset($_GET['action']) && $_GET['action'] == "register" ) { if( get_option('public_key_rcth') != null AND get_option('private_key_rcth') != null ): wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js', array(), DT_VERSION, false ); endif; }
		wp_enqueue_script('bootstrap',  PT_URI .'/assets/js/bootstrap.min.js' , array('jquery'), DT_VERSION, true  );		
		if($search == "true") {
			if(is_page($page_h)) { 
				if($slider == "true") { wp_enqueue_script('mobile-slide',  PT_URI .'/assets/js/slide.min.js' , array('jquery'), DT_VERSION, true  ); 
				if($slider_news == "enable" or $slider_notices == "enable") { wp_enqueue_script('psbar',  PT_URI .'/assets/js/psbar.jquery.min.js' , array('jquery'), DT_VERSION, true  ); } }
			}  
		} else { 
			if(is_home()) { 
				if($slider == "true") { wp_enqueue_script('mobile-slide',  PT_URI .'/assets/js/slide.min.js' , array('jquery'), DT_VERSION, true  ); 
				if($slider_news == "enable" or $slider_notices == "enable") { wp_enqueue_script('psbar',  PT_URI .'/assets/js/psbar.jquery.min.js' , array('jquery'), DT_VERSION, true  ); } }
			} 
		}
		////wp_enqueue_script('custom',  PT_URI .'/assets/js/psyplay.custom.min.js' , array('jquery'), DT_VERSION, false  );
		//wp_enqueue_script('bootstrap-select',  PT_URI .'/assets/js/bootstrap-select.js' , array('jquery'), DT_VERSION, true  );
		//wp_enqueue_script('detectmobile',  PT_URI .'/assets/js/detectmobilebrowser.js' , array('jquery'), DT_VERSION, false  );
		//wp_enqueue_script('owl-carousel',  PT_URI .'/assets/js/psyplay.min.js' , array('jquery'), DT_VERSION, false  );		
	}
	add_action('wp_enqueue_scripts', 'psythemes_scripts');
}

if( ! function_exists( 'psy_front_ajax' ) ) {
	function psy_front_ajax() {
			wp_enqueue_script('psy_front_ajax',  PT_URI .'/assets/js/theme.script.min.js', array('jquery'), DT_VERSION, false );
			wp_localize_script('psy_front_ajax', 'psyAjax', array(
			'url'		=>	admin_url('admin-ajax.php'),
			'like' => __( 'Favorite'),
			'unlike' => __( 'Remove Favorite'),
			));
		}
	add_action('wp_enqueue_scripts', 'psy_front_ajax');
}

if( ! function_exists( 'psythemes_scripts_footer' ) ) {
	function psythemes_scripts_footer() {
		global $post;
		$lazyload = get_option('xtras_imglazy');
		$admin_bar = get_option('bcontrols_admin_bar');
		$ganalytics = get_option('analitica');
		$mov_archive = get_option('mov_archive');
		$default_style = get_option('psy-default-style');
		$fnotice = get_option('first-visit-notice');
		$mode_switch = get_option('night-mode');
		$accountp = get_option('account_page');
		$page_acc = url_to_postid($accountp);
		$search = get_option('homepage-search');
		$home = get_option('psy_home');
		$page_h = url_to_postid($home);
		$fake_player = get_option('activar-fake');
		$preview = get_option('content-preview');
		$slideshow = get_option('images-slideshow-mv');
		$slider = get_option('featslidmodule');
		$slider_news = get_option('news-module');
		$slider_notices = get_option('notice-module');
		$splash = get_option('psy-splash-screen');
		$trailer = get_post_meta($post->ID, "youtube_id", true);		
		$trailer_s = array ('[',']');
		$trailer_r = array('//www.youtube.com/embed/', '/');
		$trailer_embed = str_replace($trailer_s, $trailer_r, $trailer);
		
		$cond[0] = ($default_style == "light") ? "main-dark" : "main-light";
		$cond[1] = ($slider == "true") ? "var swiper=new Swiper('#slider',{pagination:'.swiper-pagination',paginationClickable:true,loop:true,autoplay:4000});" : "";
		$cond[2] = ( $slider_news == "enable" || $slider_notices == "enable" ) ? "$(function(){ $('.tn-news, .tn-notice').perfectScrollbar();});" : "";
		$cond[3] = ( $admin_bar == "true" && !is_admin() && current_user_can('edit_others_pages')) ? "32" : "0";
		
		echo "<script type='text/javascript'>";
		echo "jQuery(document).ready(function() {";		
		if (!empty($ganalytics))  {
			echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create','".$ganalytics."','auto');ga('send','pageview');";
		}
		if( $fnotice == 'enable') { 
			echo 'window.twttr=function(t,e,r){var n,i=t.getElementsByTagName(e)[0],w=window.twttr||{};return t.getElementById(r)?w:(n=t.createElement(e),n.id=r,n.src="https://platform.twitter.com/widgets.js",i.parentNode.insertBefore(n,i),w._e=[],w.ready=function(t){w._e.push(t)},w)}(document,"script","twitter-wjs");';
		}	
		if($slider == "true") { if($search == "true") {
			if(get_the_ID() == $page_h) { 
				echo $cond[1].$cond[2]; 
			}  
		} else { 
			if(is_home()) { 
				echo $cond[1].$cond[2]; 
			} 
			}   }
		if($preview == "true") {
			echo "$('a.jt').each(function(){ $(this).qtip({content:{text: $(this).next('#hidden_tip')}, position:{my:'top left', at:'top right', viewport:$(window), effect:!1, target:'mouse', adjust:{mouse:!1}, show:{effect:!1}}, hide:{fixed:!0}, style:{classes:'qtip-light qtip-bootstrap', width:320}})});"; 
		}	
		if($search == "true") {
			if(!is_home() && $lazyload == "true") {
			echo "$('img.lazy').lazyload({effect:'fadeIn'});";
			}
			
		} else {				
				if($lazyload == "true") {
				echo "$('img.lazy').lazyload({effect:'fadeIn'});";
				}
		}
		echo 'function a(){$(this).find(".sub-container").css("display","block")}function b(){$(this).find(".sub-container").css("display","none")}$("#search a.box-title").click(function(){$("#search .box").toggleClass("active")}),$(".mobile-menu").click(function(){$("#menu,.mobile-menu").toggleClass("active"),$("#search, .mobile-search").removeClass("active")}),$(".mobile-search").click(function(){$("#search,.mobile-search").toggleClass("active"),$("#menu, .mobile-menu").removeClass("active")}),$(".filter-toggle").click(function(){$("#filter").toggleClass("active"),$(".filter-toggle").toggleClass("active")}),$(".bp-btn-light").click(function(){$(".bp-btn-light, #overlay, #media-player, #content-embed, #comment-area").toggleClass("active")}),$("#overlay").click(function(){$(".bp-btn-light, #overlay, #media-player, #content-embed, #comment-area").removeClass("active")}),$(".bp-btn-auto").click(function(){$(".bp-btn-auto").toggleClass("active")}),$("#toggle, .cac-close").click(function(){$("#comment").toggleClass("active")}),$(".top-menu> li").bind("mouseover",a),$(".top-menu> li").bind("mouseout",b);var c=0;$(window).on("scroll",function(){$(window).scrollTop()<c?"fixed"!=$("header").css("position")&&($("header").css({position:"fixed",top:-$("header").outerHeight(),backgroundColor:"#fff"}),$("header").animate({top:"'.$cond[3].'px"},500),$("#main").css("padding-top",$("header").outerHeight())):($("header").css({position:"relative",top:"0px"}),$("#main").css("padding-top","0px")),c=$(window).scrollTop()});';		
		if(is_singular(array('post','tvshows','episodes'))) {
			echo "$('.averagerate').each(function(t){len=$(this).text().length,len>3&&$(this).text($(this).text().substr(0,3))});";
			if($fake_player == "true") {
				echo "var timer=0;var perc=0;function updateProgress(percentage){ $('#pbar_innerdiv').css('width',percentage+'%'); $('#pbar_innertext').text(percentage+'%');} function animateUpdate(){perc++;updateProgress(perc);if(perc<100){timer=setTimeout(animateUpdate,550);}} $(document).ready(function(){ $('#pbar_outerdiv').click(function(){clearTimeout(timer);perc=0;animateUpdate();});}); $(document).ready(function(){ $('#arriba').click(function(){return $('html, body').animate({scrollTop:0},1250),!1})});";
			}
		
			if($slideshow == "enable") { 
				echo "$('#backdrops').owlCarousel({items:4, lazyLoad:!0, autoPlay:!0, pagination:!1, navigation:!0, navigationText:['',''], itemsDesktop:[800,3], itemsDesktopSmall:[600,2], itemsTablet:[500,2], itemsMobile:[400,2], autoHeight:!0}); $('.mvi-images').addClass('show');"; 
			}
			if($splash == "enable") {
				echo "$('a.splash-image').click(function() { $( '.splash-image' ).remove(); $('#content-embed').css('display', 'block');});";
			}
			if(!empty($trailer)) {
				echo "$(function() { $('a.pop-trailer').on('click', function(e) { $('#iframe-trailer').attr('src', '". $trailer_embed."');});var container = $('.modal-content');$(document).mouseup(function(e) {if (!container.is(e.target) && container.has(e.target).length === 0){ $('#iframe-trailer').attr('src', '');}});});";
			}
		}		
		if($search == "true") {
			if(get_the_ID() == $page_h) { 
				echo "$('a[data-toggle=".'tab'."]').on('shown.bs.tab', function(a) { $(window).trigger('scroll'); }); $('#sug-nav li:first').addClass('active');$('#sug-cont div:first').addClass('active');";
			}  
		} else { 
			if(is_home()) { 
				echo "$('a[data-toggle=".'tab'."]').on('shown.bs.tab', function(a) { $(window).trigger('scroll'); }); $('#sug-nav li:first').addClass('active');$('#sug-cont div:first').addClass('active');";
			} 
		}   		
		if($fnotice == "enable") {
			echo "if( !$.cookie('domain-alert')){ $.cookie('domain-alert',1,{expires:1,path:'/'}); $('.alert-bottom').css('display','block');setInterval(function(){ $('.alert-bottom').remove();},15000);} $('#alert-bottom-close').click( function(){ $('.alert-bottom').remove();});"; 
		}
		echo "});";
		echo "</script>";
	}
	add_action('wp_footer', 'psythemes_scripts_footer');
}

if( ! function_exists( 'psythemes_style_header' ) ) {
	function psythemes_style_header() {
		$premade = get_option('premade_style1');
		$admin_bar = get_option('bcontrols_admin_bar');
		$mode_switch = get_option('night-mode');
		$default_style = get_option('psy-default-style');
		$search = get_option('homepage-search');
		$home = get_option('psy_home');
		$page_h = url_to_postid($home);
		$slider = get_option('sli-module');
		$suggestion = get_option('suggmodule');
		$logo_d = get_option('psy-dark-logo');
		$logo_l = get_option('psy-light-logo');
		$slider_socials = get_option('sli-social'); 
		$slider_news = get_option('news-module'); 
		$slider_notice = get_option('notice-module');
		$splash = get_option('psy-splash-screen');
		$fake = get_option('activar-fake');
		$fake_buttons = get_option('fake-buttons');
		$fake_color = get_option('color_adplayer');
		$style1 = get_option('rounded-corners'); 
		$style2 = get_option('border-effect');
		$notice = get_option('activar_notice');
		$notice_color = get_option('color_lnknotice');
		$cmnt = get_option('rqst-comment-sys');
		$fv_notice_bg = get_option('first_visit_notice_bg');
		
		$cond[0] = ($mode_switch == "false") ? "95px" : "137px";
		$cond[1] = ( $admin_bar == "true") ? "32" : "0";
		
		if(get_option('premade_style1') == 'true') { $bordercolor = '#0397D6'; } elseif(get_option('psy-color-scheme') == 'blue') { $bordercolor = '#0397D6'; } elseif(get_option('psy-color-scheme') == 'purple') { $bordercolor = '#9e39e8'; } elseif(get_option('psy-color-scheme') == 'pink') { $bordercolor = '#e45cc0'; } elseif(get_option('psy-color-scheme') == 'orange') { $bordercolor = '#ff7b39'; } elseif(get_option('psy-color-scheme') == 'red') { $bordercolor = '#d60303'; } else { $bordercolor = '#79C142'; }
		
		echo "<style type='text/css'>";
		echo '@media screen and (max-width: 1325px) {#slider:hover .slide-caption { left: auto; right: 320px!important; opacity: 1;}}@media screen and (max-width: 1199px) {#slider:hover .slide-caption { right: 280px!important;}}@media screen and (max-width: 991px) {#slider .slide-caption { right: -280px!important;}#slider:hover .slide-caption {right: 0!important;}}';
		echo '.fb-comments. span iframe, .fb_iframe_widget_fluid_desktop iframe {min-width:100%!important;}.pad { height:20px;}div#content-embed #next-ep-notice .alert-warning { margin: 0; }';
		if($premade == "true"){
			echo '#slider:hover .slide-caption { left: 0; right: auto; opacity: 1; } #slider .slide-caption { right: auto; left: -380px; }';
		}
		if($slider_news != "enable" && $slider_notice != "enable") {
			echo '#slider{width:100%} ';
			if($premade == "true") {
				echo '#slider .slide-caption { right: auto!important; left: -380px!improtant; } #slider:hover .slide-caption { left: 0!important; riight: auto!important; opacity: 1; } .swiper-container-horizontal > .swiper-pagination { right: 20px!important; }';
			}else {
				echo '#slider .slide-caption { left: auto!important; right: -380px!important; } #slider:hover .slide-caption { right: 0!important; left: auto!important; opacity: 1; }';
			}
		}else{
			if($premade == "true") {
			echo '.swiper-container-horizontal > .swiper-pagination { right: 20px!important; }';
			}else{
			echo '#slider:hover .slide-caption { right: 0!important;}';
			}
		}					
		if(is_single() || is_archive()){
			echo '.breadcrumb>li+li:before {padding-left:9px;}';
		}
		if(!function_exists('the_ratings') && $fake_buttons != "true") {
		echo "#mv-info .mvi-content .mvic-desc { width: calc(100% - 160px);padding-right:0;margin-right:0;border-right:0;}#mv-info .mvi-content .mvic-btn{display:none;}@media screen and (max-width: 991px) { #mv-info .mvi-content .mvic-desc {width:100%;} }";
		}
		echo ".wp-video-shortcode video, video.wp-video-shortcode {height:100%!important;}.movieplay .mejs-container.mejs-container-fullscreen { max-height: 100%!important; height: 100%!important; }";
		echo "#main {min-height: calc(100vh - 371px);}";
		if(!is_admin() && current_user_can('edit_others_pages')) {
			echo "header {top: ".$cond[1]."px; }";
		}
		if($cmnt == "disabled") { 
			echo '.infopage .ip-left { width: 100%!important; display: inline-block!important; }.infopage .ip-left .uc-form { max-width: 100%!important; }';
		}
		if(!empty($fv_notice_bg)) {
			echo ".alert-bottom { background: #".$fv_notice_bg."; }";
		}
		if (get_option('users_can_register') == "1") {
			echo "@media screen and (max-width: 520px){#switch-mode{top:8px;right:95px}.mobile-search{left:auto;right:55px}}@media screen and (max-width: 991px){#switch-mode{right:95px}.mobile-search{right:55px}.user-content .uct-avatar{display:none}.user-content .uct-info{padding-left:0}}@media screen and (max-width: 670px){.profiles-wrap .pp-main .ppm-content.user-content.profile,.ppm-content.user-content.profile-comment{padding:40px 20px !important}}@media screen and (max-width: 350px){.user-content .uct-info .block label{width:100%}}";
			if (!is_user_logged_in()) { 
				echo "@media screen and (max-width: 520px) {#switch-mode { top: 8px; right: 137px;}.mobile-search { left: auto; right: 95px;}}@media screen and (max-width: 991px) {#switch-mode { right: 95px; } .mobile-search {right:".$cond[0].";}}";
			}
		}		
		if(!empty($fake_color)) {
			echo "fake_player section span.barra span.played { background: #".$fake_color.";}.fake_player section span.barra span.played { background: #".$fake_color.";}.fake_player section span.controles i.fa:hover { color: #".$fake_color.";}.fake_player a.lnkplay:hover>.playads i.fa.fa-play { color: #".$fake_color.";}.fake_player a.lnkplay:hover>span.playads { background: rgba(0,0,0,0);}";
		}
		if(!empty($notice_color)) {
			echo "ann-home a { color: #".$notice_color.";}";
		}
		if($search == "true" ) {
			if(get_the_ID() == $page_h) {
				echo '.movies-list-wrap:first-child { margin-top: 40px!important; }';
				}
		} else {
			if(is_home()) {
				echo '.movies-list-wrap:first-child { margin-top: 40px!important; }';
				}			
		}			
		if(!empty($logo_d)){
			echo "#logo.night, #logo-home.night {background-image: url(".$logo_d.");}";
		}
		if(!empty($logo_l)){
			echo "#logo.light, #logo-home.light {background-image: url(".$logo_l.");}";
		}
		if($default_style == "dark") {
			if(!empty($logo_d)){
				echo "#logo, #logo-home {background-image: url(".$logo_d.");}";
			}
		} else {
			if(!empty($logo_l)){
				echo "#logo, #logo-home {background-image: url(".$logo_l.");}";
			}
		}
		if($slider_socials == "disable") {
			echo ".top-content{box-shadow:0 3px 3px 0 rgba(0,0,0,0.2)}";
		}
		if($style1 == "true") {
			echo '.movies-list .ml-item, .movies-list .ml-item .mli-info {border-radius: 5px!important;}';
		}
		if($style2 == "true") { 
			echo '.movies-list .ml-item:hover {border: 4px solid '.$bordercolor.';}';
		}
		if($splash == "enable") {
			echo "#content-embed{display:none;}";
		}
		get_template_part('includes/parts/theme_colors');
		echo "</style>";
	}
	add_action('wp_head', 'psythemes_style_header');
}


if( ! function_exists( 'psythemes_socialb' ) ) {
	function psythemes_socialb() {
		$search = get_option('homepage-search');
		$home = get_option('psy_home');
		$page_h = url_to_postid($home);
		$socialid = get_option('sli-social-id');
		$social_slider = get_option('sli-social');
		$social_homes = get_option('homes-social');
		$social_mv = get_option('mov-social');
		$social_tv = get_option('tv-social');
		$social_ep = get_option('ep-social');
		$social_article = get_option('article-social');
		global $post;
		$pt = $post->post_type;
		
		if($search == "true"){
			if(is_home() && $social_homes == "true" || get_the_ID() == $page_h && $social_slider ) { 
			echo '<!-- Go to www.addthis.com/dashboard to customize your tools --> 
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-'.$socialid.'"></script> ';	
			} 
		}else{
			if(is_home() && $social_slider == "true" ) { 
			echo '<!-- Go to www.addthis.com/dashboard to customize your tools --> 
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-'.$socialid.'"></script> ';	
			}		
		}
		if($pt == "post" && $social_mv == "true" || $pt == "tvshows" && $social_tv == "true" || $pt == "episodes" || $pt == "noticias" && $social_article == "true" || $pt == "notrices" && $social_article == "true") {
			echo '<!-- Go to www.addthis.com/dashboard to customize your tools --> 
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-'.$socialid.'"></script> ';	
		}		
		
	}
	add_action('wp_footer', 'psythemes_socialb');
}

if( ! function_exists( 'psythemes_nightmode' ) ) {
	function psythemes_nightmode() {
		$nm = get_option('night-mode'); if($nm == "true") { 
		$default = get_option('psy-default-style');
		$premade = get_option('premade_style1');?>
<script type="text/javascript">$(document).ready(function(){if($.cookie("night-mode")){$("#switch-mode").addClass("active");<?php if($default == "light" || $premade == "true") {?>$("#logo").addClass("night");$("#logo-home").addClass("night");<?php } elseif(get_option('psy-default-style') == "dark") {?>$("#logo").addClass("light");$("#logo-home").addClass("light");<?php }?>$("head").append("<link href='<?php echo get_template_directory_uri(); ?>/assets/css/<?php if($default == 'light' || $premade == "true") { echo 'main-dark'; } else { echo 'main-light';}?>.css' type='text/css' rel='stylesheet' />");}$('#switch-mode').click(function(){if($.cookie("night-mode")){$.removeCookie("night-mode",{path:'/'});}else{$.cookie("night-mode",1,{expires:365,path:'/'});}location.reload();}); });</script>
	<?php
			}
	}
	add_action('wp_footer', 'psythemes_nightmode');
}
