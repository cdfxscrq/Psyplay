<?php global $user_ID; if( $user_ID ) : ?>
<?php if( current_user_can('level_10') ) : ?>

<div class="psythemes">
<a class="links editar" href="<?php bloginfo('url'); ?>/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit"><b class="icon-pencil2"></b> <span><?php _e('Edit content', 'psythemes'); ?></span></a>
<a class="links agregar" href="<?php bloginfo('url'); ?>/wp-admin/post-new.php?post_type=<?php echo get_post_type( $post ) ?>"><b class="icon-plus3"></b> <span><?php _e('Add content', 'psythemes'); ?></span></a>
<a class="links admin" href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=psyplay"><b class="icon-cog"></b> <span>PsyPlay</span></a>

</div>
<?php endif; ?>
<?php endif; ?>
