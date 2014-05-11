<?php

class BuildMetabox {
  private $customMetaFields = null;
  private $id = null;
  private $title = null;
  private $postType = null;
  private $moveBtn = '<span class="sort hndle">|||</span>';
  private $deleteBtn = '<a class="repeatable-remove button" href="#">-</a>';

  public function __construct($id, $title, $postType, $fields) {
    global $post;
    $this->customMetaFields = self::buildMetaFields($id, $fields);
    $this->id = $id;
    $this->title = $title;
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
      'normal', // $context
      'high' // $priority
    );
  }

  // Build the customMetaFields arrays used by buildMetaBox
  private static function buildMetaFields($prefix, $fields) {
    $cmf = array();
    foreach ($fields as $field) {
      $cmf[] = array(
        'label' => $field['label'],
        'desc' => $field['desc'],
        'id' => $prefix.$field['id-suffix'],
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
          echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
                <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // textarea
        case 'textarea':
          echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // checkbox
        case 'checkbox':
          echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
                <label for="'.$field['id'].'">'.$field['desc'].'</label>';
        break;
        // select
        case 'select':
          echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
          foreach ($field['options'] as $option) {
            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
          }
          echo '</select><br /><span class="description">'.$field['desc'].'</span>';
        break;
        // These are dynamic, reorderable metaboxes
        case 'steps_meta':
          $i = 0;
          $dom .= '<span style="display: inline-block; margin-top: 5px;">Add Headline:</span> 
                  <a class="add-headline button" href="#">+</a>&nbsp;&nbsp;';
          $dom .= '<span>Add Step:</span> <a class="add-step button" href="#">+</a>&nbsp;&nbsp;';
          $dom .= '<span>Add Image:</span> <a class="add-img button" href="#">+</a>';
          $dom .= '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
          if ($meta) {
            foreach ($meta as $row) {
              $dom .= $this->setDynamicInputTypes($field['id'], $row, $i);
              $i++;
            }
          } else {
            $dom .= $this->defaultInputSet($field['id']);
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

  // Used by 'type' => 'steps_meta' to build inputs from existing metadata
  private function setDynamicInputTypes($id, $row, $i) {
    if (isset($row['headline'])) {
      $input = '<input type="text" name="'.$id.'['.$i.'][headline]" 
                class="steps-headline" size="30" value="'.$row['headline'].'" style="width:70%;" />';
      return '<li class="headline">'.$this->moveBtn.$input.$this->deleteBtn.'</li>';
    } elseif (isset($row['img'])) {
      $input = '<input type="text" name="'.$id.'['.$i.'][img]" class="steps-img" 
                size="30" value="'.$row['img'].'" style="width:70%;background: #FFCCCC;" />';
      return '<li class="img">'.$this->moveBtn.$input.$this->deleteBtn.'</li>';
    } elseif (isset($row['textbox'])) {
      $input = '<textarea name="'.$id.'['.$i.'][textbox]" class="steps-textbox" cols="60" 
                rows="4" style="width:70%;">'.$row['textbox'].'</textarea>';
      return '<li class="tbox">'.$this->moveBtn.$input.$this->deleteBtn.'</li>';
    }
  }

  // Used by 'type' => 'steps_meta' to build empty inputs when no metadata exists
  private function defaultInputSet($id) {
    return '
      <li class="headline">'
        .$this->moveBtn
        .'<input placeholder="Headline" name="'.$id.'[0][headline]" class="steps-headline" value="" size="30" style="width:70%;" />'
        .$this->deleteBtn
      .'</li>
      <li class="img">'
        .$this->moveBtn
        .'<input placeholder="Image" name="'.$id.'[1][img]" class="steps-img" value="" style="width:70%;background: #FFCCCC;" size="30" />'
        .$this->deleteBtn
      .'</li>
      <li class="tbox">'
        .$this->moveBtn
        .'<textarea placeholder="Step" name="'.$id.'[2][textbox]" class="steps-textbox" style="width:70%;" cols="60" rows="4"></textarea>'
        .$this->deleteBtn
      .'</li>
    ';
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