<div role="tabpanel" class="tab-pane fade" id="tn-notice">
<ul class="tn-news ps-container ps-active-y" >
<?php $args = array( 'post_type' => 'notices', 'showposts' => '10','orderby' => 'date');$my_query = new WP_Query($args); ?>
<?php if ( $my_query->have_posts()) : ?>
<?php while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; $IDPost = get_the_ID(); ?>
<li>
<div class="tnc-info" style="padding-left:0!important;">
 <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
 <span class="notice-date"><i class="fa fa-clock-o mr5"></i> <?php echo get_the_date( 'Y-m-d' ); ?></span>
</div>
<div class="clearfix"></div>
 </li>
<?php endwhile; wp_reset_query(); ?>
 <li class="view-more"><a href="<?php bloginfo('url'); ?>/notice"> <?php _e('View More', 'psythemes'); ?> <i class="fa fa-chevron-circle-right"></i></a></li>
 <?php endif;?>
 <?php get_template_part('includes/parts/modules/slider/mobile_app'); ?>
 <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 365px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 137px;"></div></div>
</ul>
</div>