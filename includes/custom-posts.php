<?php

class CustomPosts {

  // Register Bar & Restaurant posts
  static function register_bar_and_restaurant() {
    $slug = 'bars-restaurants';
    $labels = array (
      'name' => _x( 'Bar & Restaurant Posts', $slug ),
      'singular_name' => _x( 'Bar & Restaurant Post', $slug ),
      'add_new' => _x( 'Add New Bar & Restaurant Post', $slug ),
      'add_new_item' => _x( 'Add New Bar & Restaurant Post', $slug ),
      'edit_item' => _x( 'Edit Bar & Restaurant Post', $slug ),
      'new_item' => _x( 'New Bar & Restaurant Post', $slug ),
      'view_item' => _x( 'View Bar & Restaurant Post', $slug ),
      'search_items' => _x( 'Search Bar & Restaurant Posts', $slug ),
      'not_found' => _x( 'No Bar & Restaurant Posts found', $slug ),
      'not_found_in_trash' => _x( 'No Bar & Restaurant Posts found in Trash', $slug ),
      'parent_item_colon' => _x( 'Parent Bar & Restaurant Post:', $slug ),
      'menu_name' => _x( 'Bar & Restaurant Posts', $slug )
    );

    $args = array( 
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'Bar & Restaurant Posts. These are the bar & restaurant venue pages.',
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 10,
      'menu_icon' => '/wp-content/uploads/beer_icon.png',
      'show_in_nav_menus' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'permalink_epmask' => 'bar_and_restaurant_mask',
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => array('slug'=>$slug, 'with_front'=> FALSE),
      'capability_type' => 'page',
      'taxonomies' => array('post_tag', 'category', 'neighborhoods'),   
      'supports' => array('title','editor','comments','thumbnail','revisions','page-attributes')
    );
    register_post_type($slug, $args);
  }
}

add_action('init', array('CustomPosts', 'register_bar_and_restaurant'), 1);

?>
