<?php 
$note1 = get_option('cstm-nt-1');
$note2 = get_option('cstm-nt-2');
$note3 = get_option('cstm-nt-3');
?>
<?php if(!empty($note1)) {?>
<div class="alert alert-warning notice-1" style="margin-bottom: 0; border-radius: 0;">
<i class="fa fa-warning mr5"></i> <b><?php echo $note1;?></b>
</div>
<?php }?>
<?php if(!empty($note2)) {?>
<div class="alert alert-warning notice-2" style="margin-bottom: 0; border-radius: 0;">
<i class="fa fa-warning mr5"></i> <b><?php echo $note2;?></b>
</div>
<?php }?>
<?php if(!empty($note3)) {?>
<div class="alert alert-warning notice-3" style="margin-bottom: 0; border-radius: 0;">
<i class="fa fa-warning mr5"></i> <b><?php echo $note3;?></b>
</div>
<?php }?>
<?php if( have_rows('notice_s') ): ?>
<?php $numerado = 1; { while( have_rows('notice_s') ): the_row(); $icon = get_sub_field('n_icon');?>
<?php  if($dato = get_sub_field('n_message')) {  ?>
<div class="alert alert-warning notice-<?php echo $numerado; ?>" style="margin-bottom: 0; border-radius: 0;">
<i class="fa <?php echo $icon;?> mr5"></i> <b><?php echo $dato;?></b>
</div>
<?php }  ?>
<?php endwhile; } ?>
<?php endif;?>