<div class="top-content" <?php  if(get_option('sli-social') == "false") { echo 'style="margin-bottom:20px;"'; }?>>
<!-- slider -->
<div id="slider" class="swiper-container-horizontal">
<?php get_template_part('includes/parts/modules/slider/slides'); ?>
<div class="swiper-pagination swiper-pagination-clickable"></div>
<div class="clearfix"></div>
</div>
<!--/slider -->
<!--top news-->
<?php get_template_part('includes/parts/modules/slider/modules'); ?>
<!--/top news-->
<div class="clearfix"></div>
</div>
<?php get_template_part('includes/parts/modules/slider/social'); ?>