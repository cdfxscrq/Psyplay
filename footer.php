<?php get_template_part('includes/parts/modal/modal'); ?>
<?php get_template_part('includes/parts/site_alert'); ?>
<!--footer-->
<footer>
<div id="footer">
<div class="container">
<?php get_template_part('includes/parts/widgets/ftr_sidebar'); ?>
<?php get_template_part('includes/parts/keywords'); ?>
</div>
</div>
</footer>
<!--/footer-->
<?php $code = get_option('html_integration'); if (!empty($code)) echo stripslashes(get_option('html_integration')); ?>

<?php wp_footer(); ?>
   
</body>
</html>