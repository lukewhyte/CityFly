<?php
require_once('build_metaboxes.php');

$barRestaurant = new BuildMetabox(
  'bar-restaurants', // metabox ID
  'Custom Fields', // metabox title
  'bar-restaurants', // post type
  array( // array containing array of metabox inputs
    array(
      'label' => 'Website URL',
      'desc' => 'Insert the website URL here',
      'id-suffix' => '-website', // this will be appended to the metabox ID to make the field ID
      'type' => 'text'
    ),
    array(
      'label' => 'Links:',
      'desc' => 'Add fields by clicking \'+\'. Remove by clicking \'-\'. Reorder with \'|||\'.',
      'id-suffix' => '-links', // this will be appended to the metabox ID to make the field ID
      'type' => 'steps_meta'
    )
  )
);

?>