<?php

// set the value of the main container class depending on the selected grid framework
$roots_css_framework = get_option('roots_css_framework');
if (!defined('roots_container_class')) {
  switch ($roots_css_framework) {
    case 'blueprint':
      define('roots_container_class', 'span-24');
      break;
    case '960gs_12':
      define('roots_container_class', 'container_12');
      break;
    case '960gs_16':
      define('roots_container_class', 'container_16');
      break;
    case '960gs_24':
      define('roots_container_class', 'container_24');
      break;
    case '1140':
      define('roots_container_class', 'container');
      break;
    default:
      define('roots_container_class', '');
      break;
  }
}
  
// set the maximum 'Large' image width to the maximum grid width
if (!isset($content_width)) {
  switch ($roots_css_framework) {
    case 'blueprint':
      $content_width = 950;
  break;
    case '960gs_12':
      $content_width = 940;
  break;
    case '960gs_16':
      $content_width = 940;
  break;
    case '960gs_24':
      $content_width = 940;
  break;
    case '1140':
      $content_width = 1140;
  break;
    default:
      $content_width = 950;
  break;
  }
}

function get_roots_stylesheets() {
  $roots_css_framework = get_option('roots_css_framework');
  $template_uri = get_template_directory_uri();
  $styles = '';

  if ($roots_css_framework === 'blueprint') {
    $styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/blueprint/screen.css\">\n";
  } elseif ($roots_css_framework === '960gs_12' || $roots_css_framework === '960gs_16') {
    $styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/960/reset.css\">\n";
    $styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/text.css\">\n";
    $styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/960.css\">\n";
  } elseif ($roots_css_framework === '960gs_24') {
    $styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/960/reset.css\">\n";
    $styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/text.css\">\n";
    $styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/960_24_col.css\">\n";
  } elseif ($roots_css_framework === '1140') {
    $styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/1140/1140.css\">\n";
  }

  if (class_exists('RGForms')) {
    $styles .= "\t<link rel=\"stylesheet\" href=\"" . plugins_url(). "/gravityforms/css/forms.css\">\n";
  }

  $styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/style.css\">\n";

  if ($roots_css_framework === 'blueprint') {
    $styles .= "\t<!--[if lt IE 8]><link rel=\"stylesheet\" href=\"$template_uri/css/blueprint/ie.css\"><![endif]-->\n";
  } elseif ($roots_css_framework === '1140') {
    $styles .= "\t<!--[if lt IE 8]><link rel=\"stylesheet\" href=\"$template_uri/css/1140/ie.css\"><![endif]-->\n";
  }

  return $styles;
}

function roots_robots() {
  echo "Disallow: /cgi-bin\n";
  echo "Disallow: /wp-admin\n";
  echo "Disallow: /wp-includes\n";
  echo "Disallow: /wp-content/plugins\n";
  echo "Disallow: /plugins\n";
  echo "Disallow: /wp-content/cache\n";
  echo "Disallow: /wp-content/themes\n";
  echo "Disallow: /trackback\n";
  echo "Disallow: /feed\n";
  echo "Disallow: /comments\n";
  echo "Disallow: /category/*/*\n";
  echo "Disallow: */trackback\n";
  echo "Disallow: */feed\n";
  echo "Disallow: */comments\n";
  echo "Disallow: /*?*\n";
  echo "Disallow: /*?\n";
  echo "Allow: /wp-content/uploads\n";
  echo "Allow: /assets";
}

// remove container from menus
function roots_nav_menu_args($args = ''){
  $args['container'] = false;
  return $args;
}

?>