<div class="comentarios">
<?php $comment = get_option('rqst-comment-sys'); if ($comment == "fb_comment") { ?>
<div id="fb-root"></div>
<style>.fb_iframe_widget_fluid_desktop, .fb_iframe_widget_fluid_desktop span, .fb_iframe_widget_fluid_desktop iframe {width:100%!important;min-width:100%!important;}</style>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php if($lang = get_option('fb_idioma')) { echo $lang; } else { echo 'en_EN'; } ?>/sdk.js#xfbml=1&appId=<?php if($appid = get_option('fb_id')) { echo $appid; } else { echo "209955335852854"; } ?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="100%" data-order-by="reverse_time" data-numposts="<?php if($dato = get_option('fb_numero')) { echo $dato; } else { echo '5'; } ?>" data-colorscheme="<?php if($color = get_option('fb_color')) { echo $color; } else { echo 'light'; } ?>"></div>
<?php } elseif ($comment == "dq_comment") { ?>
<div id="disqus_thread"></div>
<script type="text/javascript">
        var disqus_shortname = '<?php $code = get_option('disqus_id'); if (!empty($code)) echo stripslashes(get_option('disqus_id')); ?>';
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
</script>
<?php } else { ?>
<?php if(!is_author()) {?><h3 class="title"><?php _e('Comments', 'psythemes'); ?> </h3><?php }?>
<?php  comments_template('/comments.php',true);  ?>
<?php }  
?>
</div>


