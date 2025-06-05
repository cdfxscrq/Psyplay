<?php 
$url = get_option('request_page');
$pgid = url_to_postid( $url );
$smtpencr = get_option('rprt-smtp-encr');
$smtpsrv = get_option('rprt-smtp-servr');
$smtpusr = get_option('rprt-smtp-usern');
$smtppsw = get_option('rprt-smtp-passw');
$smtpprt = get_option('rprt-smtp-port');
if(is_page($pgid)) { 
$s_tit = __('Request Sent!','psythemes');
$s_msg = __('We have successfully received your request, thank you.','psythemes');
$e_tit = __('Request Error!','psythemes');
$e_msg = __('We can not send your request, try again','psythemes');
$mailr = get_option('requestemail'); 
$sendingm = $_GET['request'];
} else { 
$s_tit = __('Report Sent!','psythemes');
$s_msg = __('We have successfully received your report, thank you.','psythemes');
$e_tit = __('Report Error!','psythemes');
$e_msg = __('We can not send your report, try again','psythemes');
$mailr = get_option('reportemail');
$sendingm = $_GET['report'];
} 
$email = $mailr;
$snd = $sendingm;
if($snd) { 
require_once "formularios/recaptchalib.php";
require("formularios/PHPMailer.php");
require("formularios/SMTP.php");
require("formularios/Exception.php");
$siteKey = get_option('public_key_rcth');
$secret = get_option('private_key_rcth');
$resp = null;
$error = null;
$reCaptcha = new ReCaptcha($secret);
if ($_POST["g-recaptcha-response"]) {
$resp = $reCaptcha->verifyResponse(
$_SERVER["REMOTE_ADDR"],
$_POST["g-recaptcha-response"] ); }
if ($resp != null && $resp->success) { 
$msg = "";
if ($_POST['action'] == "send") {
$varname = $_FILES['archivo']['name'];
$vartemp = $_FILES['archivo']['tmp_name'];
if(is_page($pgid)){
$body = "
<strong>".__( "User IP", "psythemes" ).":</strong>&nbsp;".$_POST['ip']."<br><br>
<strong>".__( "User's Email", "psythemes" ).":</strong>&nbsp; ".$_POST['email']."<br><br>
<strong>".__( "Requested Content", "psythemes" )."</strong> 
<table>
<tr><td>".__( "Title", "psythemes" ).":</td><td>".$_POST['movie_name']."</td></tr>
<tr><td>".__( "Info", "psythemes" ).":</td><td>".$_POST['detalles']."</td></tr>
</table>
<br>
<strong>".__( "Message", "psythemes" ).":</strong><br><br>
".$_POST['mensaje']."
<br>";
} else {
$body = "
<strong>".__( "Reporter IP", "psythemes" ).":</strong>&nbsp;".$_POST['ip']."&nbsp;&nbsp;&nbsp;&nbsp;<strong>".__( "Post ID", "psythemes" ).":</strong>".$_POST['titulo']."<br><br>
<strong>".__( "Permalink", "psythemes" ).":</strong>&nbsp;<a href='".$_POST['enlaces']."' target='_blank'>".$_POST['enlace']."</a><br><br>
<strong>".__( "User's Email", "psythemes" ).":</strong>&nbsp; ".$_POST['email']."<br><br>
<strong>".__( "Problem Report", "psythemes" )."</strong> 
<table>
<tr><td>".__( "Video", "psythemes" ).":</td><td>".$_POST['videos']."</td></tr>
<tr><td>".__( "Audio", "psythemes" ).":</td><td>".$_POST['audio']."</td></tr>
<tr><td>".__( "Subtitle", "psythemes" ).":</td><td>".$_POST['subtitle']."</td></tr>
<tr><td>".__( "Downloads", "psythemes" )."</td><td>".$_POST['dloads']."</td></tr>
</table>
<br>
<strong>".__( "Description", "psythemes" ).":</strong><br><br>
".$_POST['detalles']."
<br><br>
<a href='".$_POST['enlace']."' style='background-color:#676767;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:500;line-height:30px;text-align:center;text-decoration:none;width:135px;-webkit-text-size-adjust:none;mso-hide:all;' target='_blank'>".__( "View Content", "psythemes" )."&nbsp;&rarr;</a>&nbsp;&nbsp;&nbsp;
<a href='".$_POST['link']."/wp-admin/post.php?post=".$_POST['id']."&action=edit' style='background-color:#79C143;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:500;line-height:30px;text-align:center;text-decoration:none;width:135px;-webkit-text-size-adjust:none;mso-hide:all;' target='_blank'>".__( "Edit Post", "psythemes" )."&nbsp;&rarr;</a>
<br><br>";
}
$message = $body;
$mail = new PHPMailer\PHPMailer\PHPMailer();
if(is_page($pgid)){
	$type = get_option('rqst-em-type'); if ($type == "smtp") {
	$mail->isSMTP();           
	$mail->Host = $smtpsrv;  
	$mail->SMTPAuth = true;                    
	$mail->Username = $smtpusr;   
	$mail->Password = $smtppsw;                 
	$mail->SMTPSecure = $smtpencr;                     
	$mail->Port = $smtpprt;    
	} else {
	$mail->Host = "localhost";	
	}
$mail->setFrom('noreply@erquest.site', 'User Request');
$mail->Subject = "New Request!";
}else{
	$type = get_option('rprt-em-type'); if ($type == "smtp") {
	$mail->isSMTP();           
	$mail->Host = $smtpsrv;  
	$mail->SMTPAuth = true;                    
	$mail->Username = $smtpusr;   
	$mail->Password = $smtppsw;                 
	$mail->SMTPSecure = $smtpencr;                     
	$mail->Port = $smtpprt;    
	} else {
	$mail->Host = "localhost";	
	}
$mail->setFrom('noreply@report.site', 'Site Report');
$mail->Subject = "Reported Content";
}
$mail->addAddress($email);
if ($varname != "") {
$mail->AddAttachment($vartemp, $varname); }
$mail->Body = $message;
$mail->IsHTML(true);
$mail->Send();
$msg = "ok"; } ?>
<box class="test">
<script type="text/javascript"><?php if(is_page($pgid)){ ?>$(document).ready(function() { setTimeout(function() { $('#aviso2').fadeOut(); }, 1500); });<?php } else {?>$(window).load(function(){$('.modal-report').modal('show');});<?php }?></script>
<div <?php if(is_page($pgid)){ echo 'id="aviso2"'; }?> class="aviso2 success">
<div class="icon"><b class="icon-check-circle"></b></div>
<div class="contenido32">
<span><?php echo $s_tit; ?></span>
<?php echo $s_msg; ?></div>
</div>
<?php } else { ?>
<box class="test">
<script type="text/javascript"><?php if(is_page($pgid)){ ?>$(document).ready(function() { setTimeout(function() { $('#aviso2').fadeOut(); }, 1500); });<?php } else {?>$(window).load(function(){$('.modal-report').modal('show');});<?php }?></script>
<div <?php if(is_page($pgid)){ echo 'id="aviso2"'; }?> class="aviso2 error">
<div class="icon"><b class="icon-exclamation-circle"></b></div>
<div class="contenido32">
<div class="report_icon"></div><div class="report_message"><span class="report_title"><?php echo $e_tit; ?></span>
<?php echo $e_msg; ?></div>
</div>
</div>
<?php }  } ?>

<?php if(is_page($pgid)){	?>
<p><?php echo get_the_content();?></p>
<form method="post" action="<?php the_permalink() ?>?request=<?php echo validar_key(10); ?>#uwee"> 
<div class="form-group">
<label for="email" class="col-sm-3 control-label"><?php echo __('Your Email').' *';?></label>
<div class="col-sm-9"><input class="form-control" type="email" name="email"  required placeholder="<?php _e('Enter your email. (It will not be shared)','psythemes'); ?>"></div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="movie_name" class="col-sm-3 control-label"><?php echo __('Movie Title').' *';?></label>
<div class="col-sm-9"><input class="form-control" type="text" name="movie_name"  required placeholder="<?php _e('Mission Impossible','psythemes'); ?>"></div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="detalles" class="col-sm-3 control-label"><?php _e('More info', 'psythemes');?></label>
<div class="col-sm-9"><textarea class="form-control" rows="4" name="detalles" required placeholder="<?php _e('Years/Actors/Directors.','psythemes'); ?>"></textarea></div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="mensaje" class="col-sm-3 control-label"><?php _e('Message', 'psythemes');?></label>
<div class="col-sm-9"><textarea class="form-control" rows="4" name="mensaje" required placeholder="<?php _e('I love it!.','psythemes'); ?>"></textarea></div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="recaptcha" class="col-sm-3 control-label"><?php echo __('Verification').' *';?></label>
<div class="col-sm-9"><div class="g-recaptcha" data-sitekey="<?php echo get_option('public_key_rcth') ?>"></div></div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="send" class="col-sm-3 control-label"></label>
<div class="col-sm-3"><input type="submit" value="<?php _e('Send Report','psythemes'); ?>" class="btn btn-successful btn-approve mt10"></div>
<div class="clearfix"></div>
</div>

<input type="hidden" name="titulo" value="<?php the_title(); ?>">
<input type="hidden" name="enlace" value="<?php the_permalink() ?>">
<input type="hidden" name="id" value="<?php the_id(); ?>">
<input type="hidden" name="ip" value="<?php echo la_ip(); ?>">
<input type="hidden" name="link" value="<?php bloginfo('url'); ?>">
<input type="hidden" name="action" value="send" />
</form>
<?php } else {?>
<div class="reportform">
<p><?php _e('Please help us to describe the issue so we can fix it asap.','psythemes'); ?></p>
<form method="post" action="<?php the_permalink() ?>?report=<?php echo validar_key(10); ?>#uwee"> 
<div class="aff">

<?php if(is_singular('tvshows')) { ?>
<div class="rep_cont">
<label><?php _e('Episodes','psythemes'); ?></label>
<select name="videos" style="margin-bottom: 5px;">
<option value="n/a" disabled selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Incorrect episode','psythemes'); ?>"><?php _e('Incorrect episode','psythemes'); ?></option>
<option value="<?php _e('Broken link','psythemes'); ?>"><?php _e('Broken link','psythemes'); ?></option>
<option value="<?php _e('Others','psythemes'); ?>"><?php _e('Others','psythemes'); ?></option>
</select>
</div>
<div class="rep_cont">
<label><?php _e('Contents','psythemes'); ?></label>
<select name="audio" style="margin-bottom: 5px;">
<option value="n/a" disabled selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Incorrect details','psythemes'); ?>"><?php _e('Incorrect details','psythemes'); ?></option>
<option value="<?php _e("Wrong images","psythemes"); ?>"><?php _e("Wrong images","psythemes"); ?></option>
<option value="<?php _e('Others','psythemes'); ?>"><?php _e('Others','psythemes'); ?></option>
</select>
</div>
<?php } else {?>
<div class="rep_cont">
<label><?php _e('Video','psythemes'); ?></label>
<select name="videos" style="margin-bottom: 5px;">
<option value="n/a" selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Wrong video','psythemes'); ?>"><?php _e('Wrong video','psythemes'); ?></option>
<option value="<?php _e('Broken video','psythemes'); ?>"><?php _e('Broken video','psythemes'); ?></option>
<option value="<?php _e('Others','psythemes'); ?>"><?php _e('Others','psythemes'); ?></option>
</select>
</div>
<div class="rep_cont">
<label><?php _e('Audio','psythemes'); ?></label>
<select name="audio" style="margin-bottom: 5px;">
<option value="n/a" disabled selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Not Synced','psythemes'); ?>"><?php _e('Not Synced','psythemes'); ?></option>
<option value="<?php _e("There's no Audio","psythemes"); ?>"><?php _e("There's no Audio","psythemes"); ?></option>
<option value="<?php _e('Others','psythemes'); ?>"><?php _e('Others','psythemes'); ?></option>
</select>
</div>
<div class="rep_cont">
<label><?php _e('Subtitle','psythemes'); ?></label>
<select name="subtitle" style="margin-bottom: 5px;">
<option value="n/a" disabled selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Not Synced','psythemes'); ?>"><?php _e('Not Synced','psythemes'); ?></option>
<option value="<?php _e('Wrong subtitle',"psythemes"); ?>"><?php _e('Wrong subtitle','psythemes'); ?></option>
<option value="<?php _e('Missing subtitle','psythemes'); ?>"><?php _e('Missing subtitle','psythemes'); ?></option>
</select>
</div>
<div class="rep_cont">
<label><?php _e('Downloads','psythemes'); ?></label>
<select name="dloads" style="margin-bottom: 5px;">
<option value="n/a" disabled selected><?php _e('-----','psythemes'); ?></option>
<option value="<?php _e('Wrong links','psythemes'); ?>"><?php _e('Wrong links','psythemes'); ?></option>
<option value="<?php _e('Broken links',"psythemes"); ?>"><?php _e('Broken links','psythemes'); ?></option>
<option value="<?php _e('Missing download','psythemes'); ?>"><?php _e('Missing download','psythemes'); ?></option>
<option value="<?php _e('Add new mirror links','psythemes'); ?>"><?php _e('Add new mirror links','psythemes'); ?></option>
</select>
</div>
<?php }?>
<div class="rep_cont2">
<input type="email" name="email"  required placeholder="<?php _e('Enter your email. (It will not be shared)','psythemes'); ?>">
<textarea name="detalles" required placeholder="<?php _e('Describe the issue here.','psythemes'); ?>"></textarea>
<div class="g-recaptcha" data-sitekey="<?php echo get_option('public_key_rcth') ?>"></div>
<input type="submit" value="<?php _e('Send Report','psythemes'); ?>" class="btn btn-block btn-successful">
</div>
   <div class="clearfix"></div>
</div>
<input type="hidden" name="titulo" value="<?php the_title(); ?>">
<input type="hidden" name="enlace" value="<?php the_permalink() ?>">
<input type="hidden" name="id" value="<?php the_id(); ?>">
<input type="hidden" name="ip" value="<?php echo la_ip(); ?>">
<input type="hidden" name="link" value="<?php bloginfo('url'); ?>">
<input type="hidden" name="action" value="send" />
</form>
</div>
<?php }?>