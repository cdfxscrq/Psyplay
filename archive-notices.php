<?php get_header(); ?>
<div class="header-pad"></div>
<div id="main" class="page-news">
<div class="container">
<div class="pad"></div>
<div class="main-content main-news">
<?php if(get_option("notice_location") == "global" ){?>
<?php get_template_part('includes/aviso'); ?>
<?php }?>
<?php psythemes_breadcrumbs();?>
<?php $active = get_option('article-archive-ad-1'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-1-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-1-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
 <div class="news-block">
<div class="box news-content news-list">
<div class="box-head news-list-head">
<div class="nlh"><?php _e('Latest Articles', 'psythemes'); ?></div>
<ul class="nav nav-tabs" role="tablist">
<li><a href="<?php bloginfo('url'); ?>/articles"><?php _e('Movies News', 'psythemes'); ?></a></li>
<li class="active"><a><?php _e('Announcements', 'psythemes'); ?></a></li>
</ul>
<div class="clearfix"></div>
</div>
<div class="news-list-body">
<?php  if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="news-list-item ">
<div class="info" style="padding-left:0!important;">
<h2><a href="<?php the_permalink() ?>" title=""><?php the_title(); ?></a></h2>
<p class="desc"><?php the_excerpt(); ?></p>
<p class="time">
<i class="fa fa-clock-o mr5"></i><?php echo get_the_date('Y/m/d');?>                                          
</p>
</div>
<div class="clearfix"></div>
</div>
<?php endwhile; ?>	
<?php else : ?>
<h3 style="margin-left: 10px"><?php _e('No content available', 'psythemes'); ?></h3>
<?php endif; wp_reset_query();?>	                            
                                                    
<?php pagination($wp_query->max_num_pages);?>
                        
</div>

</div>

<div class="news-sidebar">
<?php $active = get_option('article-likebox'); if ($active == "enable") : get_template_part('includes/parts/widgets/nws_sidebar3'); endif;?>
<?php $active = get_option('article-hot'); if ($active == "true") : get_template_part('includes/parts/widgets/nws_sidebar2'); endif; ?>
 </div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php $active = get_option('article-archive-ad-5'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-5-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-5-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
</div>
</div>
</div>



<?php  get_footer(); ?>