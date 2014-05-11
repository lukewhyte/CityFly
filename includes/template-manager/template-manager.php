<?php
  class TemplateManager { 
    // Functions used by most or all templates

    private function catHasParent($cat, $parent) {
      if (is_bool($parent)) { return $parent; }
      else {
        $pObj = get_category_by_slug($parent);
        return ($cat->category_parent == $pObj->term_id) ? true : false;
      }
    }

    private function pagePathToID($path) {
      $page = get_page_by_path($path);
      if(!empty($page)) { return $page->ID; }
      else { return ''; } 
    }

    protected function getPostsByCat($postType, $maxNum, $parent = true) {
      // Pull posts of a specified post_type that share categories with the current post
      // Returns an array of arguments for use with WP_Query or whatever else
      $catsArg = array();
      $cats = get_the_category();
      foreach ($cats as $cat) {
        if (self::catHasParent($cat, $parent)) { $catsArg .= $cat->term_id.','; }
      }
      if (empty($catsArg)) { return false; }
      return array(
        'cat' => rtrim($catsArg, ','),
        'post_type' => $postType,
        'posts_per_page' => $maxNum,
        'post_status' => 'publish'
      );
    }

    public static function makePostList($type, $parent = false) {
      // Get and display a list of all post in certain post_type
      $query = null;
      $args = array(
        'post_type' => $type,
        'posts_per_page' => -1,
        'post_status' => 'publish'
      );
      if (!empty($parent)) { $args['post_parent'] = $parent; }
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
          echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        endwhile;
      }
      wp_reset_query();
    }

    public static function breadcrumbBuilder() {
      // The breadcrumb widget
      $pType = get_post_type();
      $title = get_the_title();
      // The three variables represent beginning middle end & are returned as a string
      $b = '<a href="'.get_home_url().'">home</a> > ';
      $m = '';
      $e = '';

      if (strpos($pType, 'how') !== false) { // if this is How-To hierarchy
        if ($pType == 'how-to-page') { // is this a how-to page (not a sub-category)
          $args = self::getPostsByCat('how-to-sub', -1, 'how-to');
          $parents = get_posts($args); // get all sub-category posts sharing categories with this post
          $e = '<a href="'.get_permalink($parents[0]->ID).'">'.get_the_title($parents[0]->ID).'</a> > ';
        }
        $pID = self::pagePathToID('how-to-categories'); // Get the top-level page
        $m = '<a href="'.get_permalink($pID).'">'.get_the_title($pID).'</a> > ';

      } elseif (strpos($pType, 'product') !== false) { // if this is product hierarchy
        if ($pType === 'product_page') { // is this a product page (not a sub-category)
          $args = self::getPostsByCat('product-sub', -1, 'products');
          $parents = get_posts($args); // get all sub-category posts sharing categories with this post
          $e = '<a href="'.get_permalink($parents[0]->ID).'">'.get_the_title($parents[0]->ID).'</a> > ';
        }
        $pID = self::pagePathToID('products'); // Get the top-level page
        $m = '<a href="'.get_permalink($pID).'">'.get_the_title($pID).'</a> > ';
      }

      return strtolower($b.$m.$e.$title);
    }
  }
?>