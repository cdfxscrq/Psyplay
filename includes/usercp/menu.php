<?php 
global $current_user; get_currentuserinfo(); 
$username = $current_user->user_login; 
$acc_page = get_option('account_page');
$a = $_GET['action'];
?>
<div class="sidebar">
<div class="sidebar-menu">
<div class="sb-title"><i class="fa fa-navicon mr5"></i> <?php _e('Menu','psythemes'); ?></div>
<ul>
<li <?php if ($a == 'profile' or is_author()) { echo 'class="active"';} else { ''; }?>>
<a href="<?php echo esc_url( home_url('/user/')).$username.'/'; ?>">
<i class="fa fa-user mr5"></i> <?php _e('Profile','psythemes'); ?>
</a>
</li>
<li <?php echo $_GET['action'] == 'favorites' ? 'class="active"' : ''; ?>>
<a href="<?php echo $acc_page; ?>?action=favorites">
<i class="fa fa-heart mr5"></i> <?php _e('My Favorites','psythemes'); ?>
</a>
</li>
<li <?php echo $_GET['action'] == 'edit' ? 'class="active"' : ''; ?>>
<a href="<?php echo $acc_page; ?>?action=edit">
<i class="fa fa-pencil mr5"></i> <?php _e('Update Profile','psythemes'); ?>
</a>
</li>
</ul>
</div>
</div>