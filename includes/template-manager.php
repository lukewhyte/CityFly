<?php 

class TemplateManager {

	public function displayMeta($contentID) {
		global $post;
		return get_post_meta($post->ID, $contentID, true);
	}

	public function buildSlideshow() {
		global $post;
		$photos = self::displayMeta('photos');
		if (count($photos) < 2) return '<img src="' . $photos[0] . '" class="slideshowImg" />';
		else {
			$toDom = '<div class="slideshow">';
			for ($i = 0; $i < count($photos); $i++) {
				$toDom .= '<img src="' . $photos[$i] . '" class="slideshowImg" />';
			}
			$toDom .= '</div>';
			return $toDom;
		}
	}
}

?>