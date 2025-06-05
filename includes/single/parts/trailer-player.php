<?php 
if(get_option('psy-trailer-player') == "enable"):
$values = info_movie_get_meta("youtube_id"); if(!empty($values)) { ?>
<div id="tab-trailer"  >
<div class="movieplay">
<?php $yt = get_post_meta($post->ID, "youtube_id", $single = true); 
$id = array('[',']');
$embed =  array('<iframe width="100%" height="100%" src="//www.youtube.com/embed/', '" frameborder="0" allowfullscreen=""></iframe>');
echo str_replace($id, $embed, $yt);
 ?>
</div>
</div>
<?php }
endif;?>