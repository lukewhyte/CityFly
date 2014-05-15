<?php

class CustomTaxonomies {

  // Register Neighborhoods
  static function register_neighborhoods() {
    $slug = 'neighborhoods';
    $post_types = array('bars-restaurants');
    $labels = array (
      'name' => _x( 'Neighborhoods', $slug ),
      'singular_name' => _x( 'Neighborhood', $slug ),
      'search_items' => __('Search Neighborhoods', $slug),
      'popular_items' => __('Popular Neighborhoods', $slug),
      'all_items' => __('All Neighborhoods', $slug),
      'edit_item' => __('Edit Neighborhood', $slug),
      'update_item' => __('Update Neighborhood', $slug),
      'add_new_item' => __('Add New Neighborhood', $slug),
      'new_item_name' => __('New Neighborhood', $slug),
      'separate_items_with_commas' => __('Separate Neighborhoods with commas', $slug),
      'add_or_remove_items' => __('Add or Remove Neighborhoods', $slug),
      'choose_from_most_used' => __('Choose from the most used Neighborhoods')
    );

    $args = array( 
      'hierarchical' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'neighborhoods',
        'hierarchical' => true,    
      ),
      'labels' => $labels
    );

    register_taxonomy($slug, $post_types, $args);
  }
}

add_action('init', array('CustomTaxonomies', 'register_neighborhoods'), 1);

?>
