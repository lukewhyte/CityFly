<?php 

  function familyTree() {
    // create a new taxonomy
    register_taxonomy(
      'family_tree',
      array('how-to-page', 'how-to-sub', 'product-sub', 'product_page'),
      array(
        'label' => __( 'Family Tree' ),
        'hierarchical' => true
      )
    );
  }
  add_action( 'init', 'familyTree' );

  function setTaxonomyDefaults( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
      $defaults = array(
        'post_tag' => array( 'taco', 'banana' )
      );
      $taxonomies = get_object_taxonomies( $post->post_type );
      foreach ( (array) $taxonomies as $taxonomy ) {
        $terms = wp_get_post_terms( $post_id, $taxonomy );
        if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
          wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
        }
      }
    }
  }
  add_action( 'save_post', 'setTaxonomyDefaults', 100, 2 );

  function addTaxonomySlug($tag) {
    $t_id = $tag->term_id;
    $term_meta = get_option('taxonomy_term_$tID'); ?>

    <tr class="form-field">
      <th scope="row" valign="top">  
        <label for="slug">Branch slug</label>  
      </th>  
      <td>  
        <input type="text" name="term_meta[slug]" id="term_meta[slug]" size="25" style="width:60%;" value="<?php echo $term_meta['slug'] ? $term_meta['slug'] : ''; ?>"><br />  
        <span class="description">Enter the branch slug</span>  
      </td>  
    </tr> 
  <?php }

  function saveTaxonomyCustomFields($term_id) {
    if (isset($_POST['term_meta'])) {
      $t_id = $term_id;
      $term_meta = get_option('taxonomy_term_$tID');
      $cat_keys = array_keys($_POST['term_meta']);
      foreach ($cat_keys as $key) {
        if (isset($_POST['term_meta'][$key])) {
          $term_meta[$key] = $_POST['term_meta'][$key];
        }
      }
      update_option('taxonomy_term_$t_id', $term_meta);
    }
  }

  // Add the fields to the "presenters" taxonomy, using our callback function  
  add_action( 'family_tree_edit_form_fields', 'addTaxonomySlug', 10, 2 );  
    
  // Save the changes made on the "presenters" taxonomy, using our callback function  
  add_action( 'edited_family_tree', 'saveTaxonomyCustomFields', 10, 2 ); 

?>