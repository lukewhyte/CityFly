<?php get_header(); ?>
<?php include_once('includes/template-manager.php'); ?>

<div class="wrapper clearfix">
	<div class="left">
		<h1><?= get_the_title(); ?></h1>
		<div class="photos"><?= TemplateManager::buildSlideshow(); ?></div>
		<div class="main"><?php get_template_part('loop', 'single'); ?></div>
	</div>
	<div class="right"></div>
</div>
        	
<!-- Site wide footer (can be removed if customization is needed) -->	
<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>