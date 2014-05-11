<?php
  include_once('template-manager.php');

  class PageTemplate extends TemplateManager {
    // This class manages how-top-page & product-page templates

    private static $step = 1; // Used by buildStep()

    public static function makeLink() { // Handle the makeHC functionality
      global $post;
      $baselink = get_option('da_baselink');
      $getMyMeta = get_post_meta($post->ID, '_my_meta');
      $pkVar = (!empty($_GET['pk'])) ? $_GET['pk'] : $getMyMeta[0]['da_productkey'];
      return $baselink['text_string'].$pkVar;
    }

    public static function buildStep($el) {
      // Catch the 'steps_meta' metabox and echo the content
      if (!empty($el['headline'])) {
        self::$step = 1;
        echo '<li><h2>'.$el['headline'].'</h2></li>';
      } elseif (!empty($el['img'])) {
        echo '<li><img src="'.$el['img'].'" /></li>';
      } elseif (!empty($el['textbox'])) {
        $box = '<li class="step"><span class="number-gfx">'.self::$step.'</span>'.$el['textbox'].'</li>';
        self::$step++;
        echo $box;
      }
      return false;
    }

    public static function buildDisclaimer($p) {
      // Builds the disclaimer on product pages based on the product type
      if ($p->product_type === 'OSS') {
        return '
          Clicking the Download button starts the installation process. You can uninstall '.$p->product_name.' by 
          going to the <a href="/uninstall/" target="_blank">add/remove</a> programs section of your computer.
          This software may be available for free elsewhere. '.$p->product_name.' is an open source product developed
          by '.$p->publisher_group.' licensed under the <a href="'.$p->license_link.'" target="_blank">'.$p->license.'</a>. 
          Source code for '.$p->product_name.' can be found <a href="'.$p->sourcecode_link.'" target="_blank" >here</a>.
        ';
      } elseif ($p->product_type === 'DLM') {
        return '
          Clicking the Download button starts the installation process. You can uninstall '.$p->product_name.' by
          going to the <a href="/uninstall/" target="_blank">add/remove</a> programs section of your computer. This 
          software may be available for free elsewhere. '.$p->product_name.' is a product developed by 
          '.$p->publisher_group.'.
        ';
      } else { return false; }
    }

    public static function buildRelatedArticles() {
      // Builds the Related Articles box on the Product single page template
      $args = self::getPostsByCat('how-to-page', 5, 'how-to');
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
          echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        endwhile;
      }
      wp_reset_query();
    }

    public static function buildRelatedProducts() {
      // Builds the Related Products widget on the How-To single page template
      $args = self::getPostsByCat('product_page', -1, 'products');
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
          $postMeta = get_post_meta(get_the_ID(), 'TRProductMetaData', true);
          echo '<li>
                  <a href="'.get_permalink().'">
                    <img src="'.$postMeta['image_logo'].'" alt="'.$postMeta['product_name'].'" 
                      width="125px" height="125px" title="'.$postMeta['product_name'].'" />
                    <p>'.$postMeta['product_name'].'</p>
                  </a>
                </li>';
        endwhile;
      }
      wp_reset_query();
    }

  }
?>