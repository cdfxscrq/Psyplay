<?php get_template_part('includes/single/parts/controls'); ?>
<?php get_template_part('includes/single/parts/series/ep_sched'); ?>
<?php if( have_rows('temporadas') ): ?>
<div id="seasons">

<?php if( have_rows('temporadas') ): 
$numerado = 1; { ?>
<?php while( have_rows('temporadas') ): the_row(); ?>

<?php if( have_rows('episodios') ): ?>
<div class="tvseason" >    

<div class="les-title"> <i class="fa fa-server mr5"></i><strong><?php _e('Season','psythemes') ?> <?php echo $numerado; ?></strong></div>


<div class="les-content" <?php if ($count == 0) : ?>style="display: block"<?php endif; $count++; ?>>
<?php $numerado2 = 1; { while( have_rows('episodios') ): the_row(); ?>
<?php $url = get_sub_field('slug'); ?>
<?php if(!empty($url)) {?><a href="<?php bloginfo('url'); ?>/episode/<?php echo  $url;?>">
<?php _e('Episode', 'psythemes'); ?> <?php echo $numerado2 ?> <?php if(!empty($url)){  if($title = get_sub_field('titlee')) { echo '- '; echo $title;  } } else{ echo '- '.__('Unvailable'); ?><?php }?>
</a>
<?php }?>
<?php $numerado2++; ?> 
<?php endwhile; } ?> 

</div>








</div>
<?php else : ?>
<?php $toggle = get_option('empty_seasons'); if($toggle != "disable") {?>
<div class="tvseason">    
<div class="les-title"> <i class="fa fa-server mr5"></i><strong><?php _e('Season','psythemes') ?> <?php echo $numerado; ?></strong></div>
<div class="les-content" style="display: block">
<a class="ep-404"><?php _e('No Episodes Available', 'psythemes');?></a>
 </div>
 </div>
<?php }?>
<?php endif; ?>
<?php $numerado++; ?> 
<?php endwhile; } ?> 
<?php endif; ?>
</div>
<?php endif; ?>