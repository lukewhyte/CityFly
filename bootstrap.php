<?php
/*
Template Name Posts: Bootstrap
*/

get_header(); ?>
<link rel="stylesheet" href="<?php echo get_theme_root_uri()."/".get_template(); ?>/vendor/bootstrap/css/bootstrap.min.css">
<? AB_ScriptLoader::addScript('bootstrap'); ?>
</head>

<!--[if !IE]><!--><body id="notIE" <?php $page_slug = $post->post_name; body_class($page_slug); ?>><!--<![endif]-->
<!--[if gt IE 8]><!--> <body id="IE" <?php $page_slug = $post->post_name; body_class($page_slug); ?>> <!--<![endif]-->
<!--[if IE 8]><body id="ie8" <?php $page_slug = $post->post_name; body_class($page_slug); ?>><![endif]-->

<!--[if lt IE 8]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
<!-- make sure to close header in your template -->


<?php get_template_part('loop', 'landing_page'); ?>


            	
<!-- Site wide footer (can be removed if customization is needed) -->	
<?php get_footer(); ?>
<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>
