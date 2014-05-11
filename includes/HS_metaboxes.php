<?php
require_once('build_metaboxes.php');

$stagesMetaBox = new BuildMetabox(
  'how-to-page', // metabox ID
  'Custom Fields', // metabox title
  'how-to-page', // post type
  array( // array containing array of metabox inputs
    array(
      'label' => 'How-To Steps:',
      'desc' => 'Add fields by clicking \'+\'. Remove by clicking \'-\'. Reorder with \'|||\'.',
      'id-suffix' => '-steps', // this will be appended to the metabox ID to make the field ID
      'type' => 'steps_meta'
    )
  )
);

?>