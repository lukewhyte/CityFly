<?php
  include_once('template-manager.php');
  
  class HomePage extends TemplateManager {

    public static function buildHowToBlocks() {
      $i = 0; $j = 0;
      $subs = get_posts(
        array(
          'post_type' => 'how-to-sub',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        )
      );
      $posts = get_posts(
        array(
          'post_type' => 'how-to-page',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        )
      );
      shuffle($posts);
      foreach ($subs as $sub) {
        echo '<ul class="indiv-listing'.($i % 2 === 0 ? '' : '-last').'">
                <li>
                  <h2><a href="/how-to-sub/'.$sub->post_name.'">'.$sub->post_title.'</a></h2>
                  <div class="imgWrap">
                    <a href="/how-to-sub/'.$sub->post_name.'">'.get_the_post_thumbnail($sub->ID).'</a>
                  </div>
                  <ul class="sublisting">';
        foreach ($posts as $post) {
          if ($j < 3 && has_category($sub->post_name, $post)) {
            echo '<li>
                    <a href="/how-to-page/'.$post->post_name.'">'.$post->post_title.'</a>
                  </li>';
            $j++;
          }
        }
        echo '<li class="last-item"><a href="/how-to-sub/'.$sub->post_name.'">See More ></a></li>
            </ul>
          </li>
        </ul>';
        $j = 0; $i++;
      }
    }

    public static function makePageList($slug) {
      $page = get_page_by_path($slug);
      if ($page) {
        return self::makePostList('page', $page->ID);
      } else {
        return null;
      }
    }

  }

?>