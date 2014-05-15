<!doctype html>
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title><?php wp_title('', true, 'right'); ?></title>
  <!-- for Mobile Devices... https://developer.mozilla.org/en/Mobile/Viewport_meta_tag/ -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
	<!-- cross-platform favicon support -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

	<!-- base css files --> 
	<?php StyleLoader::addStyle('boilerplate-normalize'); ?>
	<?php StyleLoader::addStyle('style'); ?>

	<!-- base script files --> 
	<?php ScriptLoader::addScript('boilerplate-modernizr'); ?>
	<?php ScriptLoader::addScript('boilerplate-main', true); ?>

	<!-- wp_head() -->
	<?php wp_head(); ?>
	<!-- /wp_head() -->