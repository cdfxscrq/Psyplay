<?php
$active1 = get_option('mobile_ios'); 
$active2 = get_option('mobile_android'); 
$and_a = get_option('android-link');
$ios_a = get_option('ios-link');
 if ($active1 == "true" || $active2 == "true") {?>
 <?php  if (!empty($and_a) or !empty($ios_a)) :?>
 <li class="tn-apps">
<?php if ($active1 =="true" && !empty($ios_a)) { ?><a href="<?php echo $ios_a;?>" class="tnca-block ios"><i class="fa fa-apple"></i><span><?php bloginfo('name'); ?></span><?php _e(' for Apple iOs','psythemes'); ?></a><?php }?>
<?php if ($active2 =="true" && !empty($and_a)) { ?><a href="<?php echo $and_a;?>" class="tnca-block android"><i class="fa fa-android"></i><span><?php bloginfo('name'); ?></span><?php _e(' for Android','psythemes'); ?></a><?php }?>
</li>
 <?php endif;?>
 <?php }?>

 