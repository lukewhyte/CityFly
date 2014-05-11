<?php

class HS_CustomPosts {

  // Register How-To Sub Level Categories
  static function register_how_to_sub_level() {
    $default_lp_slug = 'how-to-sub';
    $labels = array (
      'name' => _x( 'How-To Sub Level Category', 'how-to-sub' ),
      'singular_name' => _x( 'How-To Sub Level Category', 'how-to-sub' ),
      'add_new' => _x( 'Add New How-To Sub Level Category', 'how-to-sub' ),
      'add_new_item' => _x( 'Add New How-To Sub Level Category', 'how-to-sub' ),
      'edit_item' => _x( 'Edit How-To Sub Level Category', 'how-to-sub' ),
      'new_item' => _x( 'New How-To Sub Level Category', 'how-to-sub' ),
      'view_item' => _x( 'View How-To Sub Level Category', 'how-to-sub' ),
      'search_items' => _x( 'Search How-To Sub Level Category', 'how-to-sub' ),
      'not_found' => _x( 'No how-to sub level cats found', 'how-to-sub' ),
      'not_found_in_trash' => _x( 'No how-to sub level cats found in Trash', 'how-to-sub' ),
      'parent_item_colon' => _x( 'Parent How-To Sub Level:', 'how-to-sub' ),
      'menu_name' => _x( 'How-To Sub', 'how-to-sub' )
    );

    $args = array( 
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'How-To Sub Level Categories. These are the mid-level How-To pages.',
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 10,
      'show_in_nav_menus' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      //This is needed by init() in custom
      //post permalinks, 'permalink_epmask'
      'permalink_epmask' => 'how_to_sub_level_mask',
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => array('slug'=>$default_lp_slug, 'with_front'=> FALSE),
      'capability_type' => 'page',
      'taxonomies' => array('post_tag', 'category'),   
      'supports' => array('title','editor','comments','thumbnail','custom-fields','revisions','page-attributes','excerpt')
    );
    register_post_type('how-to-sub', $args);
  }

  // Register How-To Posts
  static function register_how_to_pages() {
    $default_lp_slug = 'how-to-page';
    $labels = array (
      'name' => _x( 'How-To Pages', 'how-to-page' ),
      'singular_name' => _x( 'How-To Page', 'how-to-page' ),
      'add_new' => _x( 'Add New How-To Page', 'how-to-page' ),
      'add_new_item' => _x( 'Add New How-To Page', 'how-to-page' ),
      'edit_item' => _x( 'Edit How-To Page', 'how-to-page' ),
      'new_item' => _x( 'New How-To Page', 'how-to-page' ),
      'view_item' => _x( 'View How-To Page', 'how-to-page' ),
      'search_items' => _x( 'Search How-To pages', 'how-to-page' ),
      'not_found' => _x( 'No how-to pages found', 'how-to-page' ),
      'not_found_in_trash' => _x( 'No how-to Pages found in Trash', 'how-to-page' ),
      'parent_item_colon' => _x( 'Parent How-To Page:', 'how-to-page' ),
      'menu_name' => _x( 'How-To Pages', 'how-to-page' )
    );

    $args = array( 
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'How-To Pages. These are the single How-To pages.',
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_nav_menus' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      //This is needed by init() in custom
      //post permalinks, 'permalink_epmask'
      'permalink_epmask' => 'how_to_page_mask',
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => array('slug'=>$default_lp_slug, 'with_front'=> true),
      'capability_type' => 'page',
      'taxonomies' => array('post_tag', 'category'),   
      'supports' => array('title','editor','comments','thumbnail','custom-fields','revisions','page-attributes','excerpt')
    );
    register_post_type('how-to-page', $args);
  }

  // Register Product Sub Level Categories
  static function register_product_sub_level() {
    $default_lp_slug = 'product-sub';
    $labels = array (
      'name' => _x( 'Product Sub Level Category', 'product-sub' ),
      'singular_name' => _x( 'Product Sub Level Category', 'product-sub' ),
      'add_new' => _x( 'Add New Product Sub Level Category', 'product-sub' ),
      'add_new_item' => _x( 'Add New Product Sub Level Category', 'product-sub' ),
      'edit_item' => _x( 'Edit Product Sub Level Category', 'product-sub' ),
      'new_item' => _x( 'New Product Sub Level Category', 'product-sub' ),
      'view_item' => _x( 'View Product Sub Level Category', 'product-sub' ),
      'search_items' => _x( 'Search Product Sub Level Category', 'product-sub' ),
      'not_found' => _x( 'No product sub level cats found', 'product-sub' ),
      'not_found_in_trash' => _x( 'No product sub level cats found in Trash', 'product-sub' ),
      'parent_item_colon' => _x( 'Parent Product Sub Level:', 'product-sub' ),
      'menu_name' => _x( 'Product Sub', 'product-sub' )
    );

    $args = array( 
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'Product Sub Level Categories. These are the sub level product pages.',
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 10,
      'show_in_nav_menus' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      //This is needed by init() in custom
      //post permalinks, 'permalink_epmask'
      'permalink_epmask' => 'product_sub_level_mask',
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => array('slug'=>$default_lp_slug, 'with_front'=> FALSE),
      'capability_type' => 'page',
      'taxonomies' => array('post_tag', 'category'),   
      'supports' => array('title','editor','comments','thumbnail','custom-fields','revisions','page-attributes','excerpt')
    );
    register_post_type('product-sub', $args);
  }

  static function HS_CPTPostTypes($post_types) {
    $post_types[] = 'how-to-page';
    $post_types[] = 'how-to-sub';
    $post_types[] = 'product-sub';
    return $post_types;
  }
}

add_action('init', array('HS_CustomPosts', 'register_how_to_pages'), 1);
add_action('init', array('HS_CustomPosts', 'register_how_to_sub_level'), 1);
add_action('init', array('HS_CustomPosts', 'register_product_sub_level'), 1);
add_filter('cpt_post_types', array('HS_CustomPosts', 'HS_CPTPostTypes'));

?>
