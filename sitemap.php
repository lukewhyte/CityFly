<?php
/*
Template Name: Sitemap
*/
get_header(); ?>

	<div id="content">	
		<div class="container <?php // echo roots_container_class; ?>">


			<section id="main" class="<?php echo get_option('roots_main_class'); ?>" role="main">
				
				<!-- "aboveArticle" widget removed -->
					<!-- Begin Page or Post Content -->
					<article>
					<?php get_template_part('loop', 'page'); ?>
                    
                    <!-- list all pages -->
						<div class="sitemap-list">
							<!-- h2><?php bloginfo('name'); ?></h2 --->
							<ul>
							<?php wp_list_pages('title_li='); ?>
							</ul>

						</div>    
				</article>
     

            		 </section><!-- /#main -->
             
			<aside id="sidebar" class="<?php echo get_option('roots_sidebar_class'); ?>" role="complementary">
				<!-- div class="container" -->
					<?php get_sidebar('1'); ?>
			
		   </aside><!-- /#sidebar -->
</div><!-- /container -->
	</div><!-- /#content -->
			
            
<?php get_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>
