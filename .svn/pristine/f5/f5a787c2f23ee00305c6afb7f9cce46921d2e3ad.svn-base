<!doctype html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title><?php wp_title('', true, 'right'); ?></title>
    <!-- for Mobile Devices... https://developer.mozilla.org/en/Mobile/Viewport_meta_tag/ -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
	<!-- cross-platform favicon support -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<!-- optional icons, remember to remove php comments before "echo" -->
	<!-- 
	<link rel="icon" href="<?php //echo get_stylesheet_directory_uri(); ?>/favicon.png">
	<link rel="apple-touch-icon" href="<?php //echo get_stylesheet_directory_uri(); ?>/touchicon.png">
	<meta name="msapplication-TileColor" content="#D83434">
	<meta name="msapplication-TileImage" content="<?php //echo get_stylesheet_directory_uri(); ?>/tileicon.png">
	-->
	<!-- base css files --> 
	<?php AB_StyleLoader::addStyle('boilerplate-normalize'); ?>
	<?php AB_StyleLoader::addStyle('boilerplate-main'); ?>

<!-- base script files --> 
<?php AB_ScriptLoader::addScript('boilerplate-modernizr'); ?>
<?php AB_ScriptLoader::addScript('boilerplate-main', true); ?>
<?php if (get_option('roots_google_analytics') != "") { ?>
	<script>
		var _gaq=[['_setAccount','<?php echo get_option('roots_google_analytics') ?>'],
      ['_trackPageview'],['_trackPageLoadTime']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
<?php } ?>

<!-- wp_head() -->
<?php wp_head(); ?>
<!-- /wp_head() -->

</head>

<!--[if !IE]><!--><body id="notIE" <?php $page_slug = $post->post_name; body_class($page_slug); ?>><!--<![endif]-->
<!--[if gt IE 8]><!--> <body id="IE" <?php $page_slug = $post->post_name; body_class($page_slug); ?>> <!--<![endif]-->
<!--[if IE 8]><body id="ie8" <?php $page_slug = $post->post_name; body_class($page_slug); ?>><![endif]-->

<!--[if lt IE 8]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
<!-- make sure to close header in your template -->