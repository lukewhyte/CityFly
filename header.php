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
	<?php ScriptLoader::addScript('slideshow', true); ?>

	<!-- wp_head() -->
	<?php wp_head(); ?>
	<!-- /wp_head() -->

	</head>

<!--[if !IE]><!--><body id="notIE" <?php body_class($post->post_name); ?>><!--<![endif]-->
<!--[if gt IE 8]><!--> <body id="IE" <?php body_class($post->post_name); ?>> <!--<![endif]-->
<!--[if IE 8]><body id="ie8" <?php body_class($post->post_name); ?>><![endif]-->
<?php include_once('includes/google-analytics.php'); ?>

<!--[if lt IE 8]>
   <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->

<header>
	<div class="wrapper">
		<div class="logo"><img src="/wp-content/uploads/logo.png" width="150px" height="auto" /></div>
		<div class="top-nav"></div>
	</div>
</header>