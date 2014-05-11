
<?php get_header(); ?>
	<div id="content">	
		<div class="container <?php // echo roots_container_class; ?>">


			<section id="main" class="<?php echo get_option('roots_main_class'); ?>" role="main">
				
				
					<!-- Begin Page or Post Content -->
					<article>
					<h1><?php _e('File Not Found', 'roots'); ?></h1>
					<div class="error">
						<p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'roots'); ?></p>
					</div>
					<p><?php _e('Please try the following:', 'roots'); ?></p>
					<ul> 
						<li><?php _e('Check your spelling', 'roots'); ?> </li>
						<li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
						<li>Try to find what you are looking for below...</li>
					</ul>
                    
                    <!-- sitemap list -->
					<div class="sitemap-list">
						<h2><?php bloginfo('name'); ?></h2>
						<ul>
							<?php wp_list_pages('title_li='); ?>
						</ul>
				</article>
                <!-- "under Article" widget removed -->

            		 </section><!-- /#main -->
             
			<aside id="sidebar" class="<?php echo get_option('roots_sidebar_class'); ?>" role="complementary">
				<!-- div class="container" -->
					<?php get_sidebar('1'); ?>
			
		   </aside><!-- /#sidebar -->
</div><!-- /container -->
	</div><!-- /#content -->
			<!-- #footer2  removed -->
            
		
	
<?php get_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>

