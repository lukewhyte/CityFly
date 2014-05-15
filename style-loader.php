<?php

define("THEME_ROOT_URL", get_theme_root_uri()."/".get_template());
define("STYLE_ROOT", get_stylesheet_directory_uri());

class StyleLoader {

  private static $protocol;
  private static $styleToSrcMap;

  static function init() {
    self::$protocol = is_ssl() ? "https:" : "http:";
    self::$styleToSrcMap = array(
      //Boilerplate
      'boilerplate-normalize' => THEME_ROOT_URL."/vendor/boilerplate/css/normalize.min.css",
      'boilerplate-main' => THEME_ROOT_URL."/vendor/boilerplate/css/main.css",

      //Bootstrap
      'bootstrap-normalize' => THEME_ROOT_URL."/vendor/bootstrap/css/normalize.min.css",
      'bootstrap' => THEME_ROOT_URL."/vendor/bootstrap/css/bootstrap.min.css",
      'font-awesome' => "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css",

      //Blueprint (non-responsive styles)
      'blueprint-ie' => THEME_ROOT_URL."/vendor/blueprint/css/ie.css",
      'blueprint-print' => THEME_ROOT_URL."/vendor/blueprint/css/print.css",
      'blueprint-screen' => THEME_ROOT_URL."/vendor/blueprint/css/screen.css",

      //CDN for jQuery Mobile CSS
      'jquery-mobile' => "//code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css",
      'jquery-mobile-custom-structure' => THEME_ROOT_URL."/vendor/jquerymobile/css/jquery.mobile.custom.structure.css",
      'jquery-mobile-custom-theme' => THEME_ROOT_URL."/vendor/jquerymobile/css/jquery.mobile.custom.theme.css",

      'style' => STYLE_ROOT."/style.css"
    );
  }

  public static function addstyle($key, $deps=false) {
    //if the style doesnt seem to be loading, make sure its defined in
    //$styleToSrcMap
    if(!array_key_exists($key, self::$styleToSrcMap)) return;
    if(!wp_style_is($key, 'registered')) {
      wp_register_style($key, self::$styleToSrcMap[$key], $deps);
    } 
    wp_enqueue_style($key, self::$styleToSrcMap[$key], $deps);
  }
}

StyleLoader::init();