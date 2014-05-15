<?php get_header(); ?>

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
		<div class="logo">
			<div class="box"></div>
			<span>C</span>ITY<span>F</span>LY</div>
		<div class="top-nav"></div>
	</div>
</header>

<?php get_template_part('loop', 'single'); ?>

        	
<!-- Site wide footer (can be removed if customization is needed) -->	
<?php get_footer(); ?>


<?php wp_footer(); ?>
</body>
</html>