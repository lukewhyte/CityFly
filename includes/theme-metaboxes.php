<?php
require_once('build-metaboxes.php');

$barRestaurant = new BuildMetabox(
  'restuarant-meta', // metabox ID
  'Establishment Details', // metabox title
  'bars-restaurants', // post type
  'normal', // the context: normal, side or advanced
  array( // array containing array of metabox inputs
    array(
      'label' => 'Street Address',
      'desc' => 'Eg. 123 Main Street',
      'id' => 'street', // this will be appended to the metabox ID to make the field ID
      'type' => 'text'
    ),
    array(
      'label' => 'City & State',
      'desc' => 'Eg. San Francisco, CA',
      'id' => 'city',
      'type' => 'text'
    ),
    array(
      'label' => 'Zipcode',
      'desc' => 'Eg. 12345',
      'id' => 'zip',
      'type' => 'text'
    ),
    array(
      'label' => 'Photos:',
      'desc' => 'Add fields by clicking \'+\'. Remove by clicking \'-\'. Reorder with \'|||\'.',
      'id' => 'photos',
      'type' => 'dynamic_list'
    ),
    array(
      'label' => 'Website URL',
      'desc' => 'Insert the website URL here',
      'id' => 'url',
      'type' => 'text'
    ),
    array(
      'label' => 'Links:',
      'desc' => 'Add fields by clicking \'+\'. Remove by clicking \'-\'. Reorder with \'|||\'.',
      'id' => 'links',
      'type' => 'dynamic_list'
    ),
    array(
      'label' => 'Facebook',
      'desc' => 'Insert the Facebook URL here',
      'id' => 'facebook',
      'type' => 'text'
    ),
    array(
      'label' => 'Twitter',
      'desc' => 'Insert the Twitter URL here',
      'id' => 'twitter',
      'type' => 'text'
    ),
    array(
      'label' => 'Instagram',
      'desc' => 'Instagram That Hoe',
      'id' => 'instagram',
      'type' => 'text'
    )
  )
);

?>