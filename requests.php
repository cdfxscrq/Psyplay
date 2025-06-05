<?php 
/*
Template Name: Request Page
*/
get_header(); ?>
<div id="main" class="page-detail page-profiles">
<div class="container">
<div class="pad"></div>
<div class="main-content main-detail">
<?php psythemes_breadcrumbs();?>

<?php $active = get_option('article-archive-ad-1'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-1-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-1-code')) { ?><div class="content-kuss-ads"><?php echo $ads; ?></div><?php }?>
            </div>
<?php }?> 			
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="infopage">
<div class="infopage-head"><?php the_title(); ?></div>

<?php $active = get_option('article-ad-2'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-2-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-2-code')) { ?><div class="content-kuss-ads"><?php echo $ads; ?></div><?php }?>
            </div>
<?php }?> 			

<div class="content">
<div class="clearfix"></div>
<div class="ip-left">
<?php	include_once 'includes/parts/modal/delivery/mail.php'; ?>
</div>
<div class="ip-right">
<?php $cmnt = get_option('rqst-comment-sys'); if($cmnt != "disabled") { get_template_part('includes/single/parts/comments_r'); }?>
</div>
<div class="clearfix"></div>
</div>


<?php $active = get_option('article-ad-3'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-3-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-3-code')) { ?><div class="content-kuss-ads"><?php echo $ads; ?></div><?php }?>
            </div>
<?php }?> 		
<div class="clearfix"></div>	
</div>

<?php $active = get_option('article-ad-4'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-4-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-4-code')) { ?><div class="content-kuss-ads"><?php echo $ads; ?></div><?php }?>
				
            </div>
<?php }?> 			



<?php $active = get_option('article-archive-ad-5'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-5-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-5-code')) { ?><div class="content-kuss-ads"><?php echo $ads; ?></div><?php }?>
            </div>
<?php }?> 			
</div>
</div>
</div>

<?php endwhile; ?>						
<?php else : ?>
<h3 style="margin-left: 10px"><?php _e('No content available', 'psythemes'); ?></h3>
<?php endif; ?>



<?php  get_footer(); ?>