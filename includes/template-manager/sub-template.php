<?php
  include_once('template-manager.php');

  class SubTemplate extends TemplateManager {

    private function lastInRow($i) {
      // A nightmare approach to adding CSS to each post at the end of a row
      return ($i === 2 || $i === 4 || $i === 7 || $i === 9) ? '-last' : '';
    }

    private function getProductLogo() {
      global $post;
      $link = TR_Product::makeFromPost($post)->image_logo;
      return '<img src="'.$link.'" />';
    }

    // The following monstrosity builds the boxes that make up the meat of the sub-cat pages
    public static function buildPostBoxes($pType, $parent) {
      $args = self::getPostsByCat($pType, -1, $parent); // get all the posts
      $result = ''; $i = 0; $class = '';
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
          $img = '';
          if ($i === 3 || $i === 9) { // 2 out of 10 boxes have images, 3 & 9 are their index
            $class = 'green-underline-box-pic'.self::lastInRow($i);
            $img = ($pType === 'product_page') ? self::getProductLogo() : get_the_post_thumbnail();
          } elseif ($i % 2 === 0) { 
            $class = 'green-underline-box'.self::lastInRow($i);
          } else {
            $class = 'green-box'.self::lastInRow($i);
          }
          $i = ($i === 9) ? 0 : $i + 1; // Reset $i every 10 posts
          $result .= '
            <li class="'.$class.'">
              <a href="'.get_permalink().'">'.$img.get_the_title().'</a>
            </li>';
        endwhile;
      }
      wp_reset_query();
      return $result;
    }

  }
?>