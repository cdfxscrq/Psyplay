<?php if (is_singular(array('post', 'tvshows','episodes') )) {?>
<!-- Modal -->
<?php if($values = info_movie_get_meta("youtube_id")) { ?>
<?php get_template_part('includes/parts/modal/modal-trailer'); ?>
<?php }?>
<?php get_template_part('includes/parts/modal/modal-report'); ?>
<!--/ modal -->
<?php }?>