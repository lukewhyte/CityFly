<?php

class BuildMetabox {
  private $customMetaFields = null;
  private $id = null;
  private $title = null;
  private $postType = null;
  private $moveBtn = '<span style="margin-right:5px;" class="sort hndle">|||</span>';
  private $deleteBtn = '<a class="repeatable-remove button" style="margin-left:5px;" href="#">-</a>';

  public function __construct($id, $title, $postType, $position, $fields) {
    global $post;
    $this->customMetaFields = self::buildMetaFields($fields);
    $this->id = $id;
    $this->title = $title;
    $this->position = $position;
    $this->postType = $postType;

    add_action('add_meta_boxes', array($this, 'addNewMetaBox'));
    add_action('admin_enqueue_scripts', array($this, 'loadScripts'));
    add_action('save_post', array($this, 'saveCustomMeta'));
  }

  public function loadScripts($hook_suffix) {
    if ('post.php' == $hook_suffix || 'post-new.php' == $hook_suffix) {
      wp_enqueue_script('metaboxes', get_template_directory_uri().'/js/metaboxes.js');
    }
  }

  // Add the Meta Box
  public function addNewMetaBox() {
    add_meta_box(
      $this->id,
      $this->title,
      array($this, 'buildMetaBox'), // $callback
      $this->postType,
      $this->position, // $context
      'high' // $priority
    );
  }

  // Build the customMetaFields arrays used by buildMetaBox
  private static function buildMetaFields($fields) {
    $cmf = array();
    foreach ($fields as $field) {
      $cmf[] = array(
        'label' => $field['label'],
        'desc' => $field['desc'],
        'id' => $field['id'],
        'type' => $field['type']
      );
    }
    return $cmf;
  }

  // the callback
  public function buildMetaBox() {
    global $post;
    // Use nonce for verification
    $dom = '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    $dom .= '<table class="form-table">';
    foreach ($this->customMetaFields as $field) {
      // get value of this field if it exists for this post
      $meta = get_post_meta($post->ID, $field['id'], true);
      $dom .= '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
      switch ($field['type']) {
        // text
        case 'text':
          $dom .= '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" style="width:80%;" />
                <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // textarea
        case 'textarea':
          $dom .= '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // checkbox
        case 'checkbox':
          $dom .= '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.$meta ? ' checked="checked"' : ''.'/>
                <label for="'.$field['id'].'">'.$field['desc'].'</label>';
        break;
        // select
        case 'select':
          $dom .= '<select name="'.$field['id'].'" id="'.$field['id'].'">';
          foreach ($field['options'] as $option) {
            $dom .= '<option'. $meta == $option['value'] ? ' selected="selected"' : ''. ' value="'.$option['value'].'">'.$option['label'].'</option>';
          }
          $dom .= '</select><br /><span class="description">'.$field['desc'].'</span>';
        break;
        // These are dynamic, reorderable metaboxes
        case 'slideshow':
          $i = 0;
          $dom .= '<span style="display: inline-block; margin-top: 5px;">Add New:</span> 
                  <a class="add-headline button" href="#">+</a>';
          $dom .= '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
          if ($meta) {
            foreach ($meta as $row) {
              $dom .= $this->setDynamicInputs($field['id'], 'photo', false, $row, $i);
              $i++;
            }
          } else {
            $dom .= $this->setDynamicInputs($field['id'], 'photo', true);
          }
          $dom .= '</ul>
                <span class="description">'.$field['desc'].'</span>';
        break;
        case 'links':
          $i = 0;
          $dom .= '<span style="display: inline-block; margin-top: 5px;">Add New:</span> 
                  <a class="add-headline button" href="#">+</a>';
          $dom .= '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
          if ($meta) {
            foreach ($meta as $row) {
              $dom .= $this->setDynamicInputs($field['id'], 'link', false, $row, $i);
              $i++;
            }
          } else {
            $dom .= $this->setDynamicInputs($field['id'], 'link', true);
          }
          $dom .= '</ul>
                <span class="description">'.$field['desc'].'</span>';
        break;
      } // end switch
      $dom .= '</td></tr>';
    } // end foreach
    $dom .= '</table>';
    echo $dom;
  }

  private function setDynamicInputs($id, $class, $new = true, $row = false, $i = false) {
    if ($new === false) {
      $input = '<input type="text" name="'.$id.'['.$i.']" 
                  class="'.$class.'-input" size="30" value="'.$row.'" style="width:70%;" />';
      return '<li class="'.$class.'">'.$this->moveBtn.$input.$this->deleteBtn.'</li>';
    } else {
      return '
        <li class="'.$class.'">'
          .$this->moveBtn
          .'<input placeholder="Enter Here" name="'.$id.'[0]" class="'.$class.'-input" value="" size="30" style="width:70%;" />'
          .$this->deleteBtn
        .'</li>
      ';
    }
  }

  public function saveCustomMeta($post_id) {
    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
      return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id))
        return $post_id;
      } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // loop through fields and save the data
    foreach ($this->customMetaFields as $field) {
      $old = get_post_meta($post_id, $field['id'], true);
      $new = $_POST[$field['id']];
      if ($new && $new != $old) {
        update_post_meta($post_id, $field['id'], $new);
      } elseif ('' == $new && $old) {
        delete_post_meta($post_id, $field['id'], $old);
      }
    } // end foreach    
  }
}

?>