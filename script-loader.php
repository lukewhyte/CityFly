<?php

define("THEME_ROOT_URL", get_theme_root_uri()."/".get_template());
define("STYLE_ROOT", get_stylesheet_directory_uri());

class ScriptLoader {

  private static $protocol;
  private static $scriptToSrcMap;

  static function init() {
    self::$protocol = is_ssl() ? "https:" : "http:";
    self::$scriptToSrcMap = array(
      //Boilerplate
      'boilerplate-jquery' => THEME_ROOT_URL."/vendor/boilerplate/js/jquery-1.10.1.min.js",
      'boilerplate-modernizr' => THEME_ROOT_URL."/vendor/boilerplate/js/modernizr-2.6.2-respond-1.1.0.min.js",
      // custom boilerplate specific responsive js
      'boilerplate-main' => THEME_ROOT_URL."/vendor/boilerplate/js/main.min.js",

      //Bootstrap
      'bootstrap' => THEME_ROOT_URL."/vendor/bootstrap/bootstrap.min.js",
      'bootstrap-modernizr' => THEME_ROOT_URL."/vendor/boilerplate/js/modernizr-2.6.2-respond-1.1.0.min.js",

      //CDN for jQuery Mobile
      'jquery-mobile' => "//code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js",
      'jquery-mobile-custom' => THEME_ROOT_URL."/vendor/jquerymobile/js/jquery.mobile.custom.js",

      //Page specific scripts
      // 'slideshow' => THEME_ROOT_URL.'/js/slideshow.js',
      'scripts' => THEME_ROOT_URL."/js/scripts.js"
    );
  }

  public static function addScript($key, $in_footer=false, $deps=false, $ver=false) {
    //if the script doesnt seem to be loading, make sure its defined in
    //$scriptToSrcMap
    if(!array_key_exists($key, self::$scriptToSrcMap)) return;
    if(!wp_script_is($key, 'registered')) {
      wp_register_script($key, self::$scriptToSrcMap[$key], $deps, $ver, $in_footer);
    } 
    wp_enqueue_script($key, self::$scriptToSrcMap[$key], $deps, $ver, $in_footer);
  }
}

ScriptLoader::init();