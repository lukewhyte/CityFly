<?php  

function roots_get_home_path() {
	$home = trailingslashit(get_option( 'home' ));
	$siteurl = trailingslashit(get_option( 'siteurl' ));
	if ( $home != '' && $home != $siteurl ) {
	        $wp_path_rel_to_home = str_replace($home, '', $siteurl); /* $siteurl - $home */
	        $pos = strpos($_SERVER["SCRIPT_FILENAME"], $wp_path_rel_to_home);
	        $home_path = substr($_SERVER["SCRIPT_FILENAME"], 0, $pos);
		$home_path = trailingslashit( $home_path );
	} else {
		$home_path = ABSPATH;
	}
	return $home_path;
}

$home_path = roots_get_home_path();

if (!is_writable($home_path . '.htaccess')) {
	add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>" . sprintf(__('Please make sure your <a href="%s">htaccess</a> file is writeable ', 'roots'), admin_url('options-permalink.php')) . "</p></div>';"));
};

// thanks to Scott Walkinshaw (scottwalkinshaw.com)

function roots_add_htaccess($rules) {

	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Better website experience for IE users";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# Force the latest IE version, in various cases when it may fall back to IE7 mode";
	$rules .= "\n#  github.com/rails/rails/commit/123eb25#commitcomment-118920";
	$rules .= "\n# Use ChromeFrame if it's installed for a better experience for the poor IE folk";
	$rules .= "\n";
	$rules .= "\n<IfModule mod_setenvif.c>";
	$rules .= "\n  <IfModule mod_headers.c>";
	$rules .= "\n    BrowserMatch MSIE ie";
	$rules .= "\n    Header set X-UA-Compatible \"IE=Edge,chrome=1\" env=ie";
	$rules .= "\n  </IfModule>";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n<IfModule mod_headers.c>";
	$rules .= "\n# Because X-UA-Compatible isn't sent to non-IE (to save header bytes),";
	$rules .= "\n#   We need to inform proxies that content changes based on UA";
	$rules .= "\n  Header append Vary User-Agent";
	$rules .= "\n# Cache control is set only if mod_headers is enabled, so that's unncessary to declare";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Cross-domain AJAX requests";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# Serve cross-domain ajax requests, disabled.   ";
	$rules .= "\n# enable-cors.org";
	$rules .= "\n# code.google.com/p/html5security/wiki/CrossOriginRequestSecurity";
	$rules .= "\n";
	$rules .= "\n#  <IfModule mod_headers.c>";
	$rules .= "\n#    Header set Access-Control-Allow-Origin "*"";
	$rules .= "\n#  </IfModule>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Webfont access";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# allow access from all domains for webfonts";
	$rules .= "\n# alternatively you could only whitelist";
	$rules .= "\n#   your subdomains like \"sub.domain.com\"";
	$rules .= "\n";
	$rules .= "\n<FilesMatch \"\.(ttf|otf|eot|woff|font.css)$\">";
	$rules .= "\n  <IfModule mod_headers.c>";
	$rules .= "\n    Header set Access-Control-Allow-Origin "*"";
	$rules .= "\n  </IfModule>";
	$rules .= "\n</FilesMatch>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Proper MIME type for all files";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# audio";
	$rules .= "\nAddType audio/ogg                      oga ogg";
	$rules .= "\n";
	$rules .= "\n# video";
	$rules .= "\nAddType video/ogg                      ogv";
	$rules .= "\nAddType video/mp4                      mp4";
	$rules .= "\nAddType video/webm                     webm";
	$rules .= "\n";
	$rules .= "\n# Proper svg serving. Required for svg webfonts on iPad";
	$rules .= "\n#   twitter.com/FontSquirrel/status/14855840545";
	$rules .= "\nAddType     image/svg+xml              svg svgz ";
	$rules .= "\nAddEncoding gzip                       svgz";
	$rules .= "\n                                       ";
	$rules .= "\n# webfonts                             ";
	$rules .= "\nAddType application/vnd.ms-fontobject  eot";
	$rules .= "\nAddType font/truetype                  ttf";
	$rules .= "\nAddType font/opentype                  otf";
	$rules .= "\nAddType application/x-font-woff        woff";
	$rules .= "\n";
	$rules .= "\n# assorted types                                      ";
	$rules .= "\nAddType image/x-icon                   ico";
	$rules .= "\nAddType image/webp                     webp";
	$rules .= "\nAddType text/cache-manifest            appcache manifest";
	$rules .= "\nAddType text/x-component               htc";
	$rules .= "\nAddType application/x-chrome-extension crx";
	$rules .= "\nAddType application/x-xpinstall        xpi";
	$rules .= "\nAddType application/octet-stream       safariextz";
	$rules .= "\nAddType text/x-vcard       			vcf";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# gzip compression";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n<IfModule mod_deflate.c>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# force deflate for mangled headers developer.yahoo.com/blogs/ydn/posts/2010/12/pushing-beyond-gzipping/";
	$rules .= "\n<IfModule mod_setenvif.c>";
	$rules .= "\n  <IfModule mod_headers.c>";
	$rules .= "\n    SetEnvIfNoCase ^(Accept-EncodXng|X-cept-Encoding|X{15}|~{15}|-{15})$ ^((gzip|deflate)\s,?\s(gzip|deflate)?|X{4,13}|~{4,13}|-{4,13})$ HAVE_Accept-Encoding";
	$rules .= "\n    RequestHeader append Accept-Encoding \"gzip,deflate\" env=HAVE_Accept-Encoding";
	$rules .= "\n  </IfModule>";
	$rules .= "\n</IfModule>";
	$rules .= "\n# html, txt, css, js, json, xml, htc:";
	$rules .= "\n<IfModule filter_module>";
	$rules .= "\n  FilterDeclare   COMPRESS";
	$rules .= "\n  FilterProvider  COMPRESS  DEFLATE resp=Content-Type /text/(html|css|javascript|plain|x(ml|-component))/";
	$rules .= "\n  FilterProvider  COMPRESS  DEFLATE resp=Content-Type /application/(javascript|json|xml|x-javascript)/";
	$rules .= "\n  FilterChain     COMPRESS";
	$rules .= "\n  FilterProtocol  COMPRESS  change=yes;byteranges=no";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n<IfModule !mod_filter.c>";
	$rules .= "\n  # Legacy versions of Apache";
	$rules .= "\n  AddOutputFilterByType DEFLATE text/html text/plain text/css application/json";
	$rules .= "\n  AddOutputFilterByType DEFLATE text/javascript application/javascript application/x-javascript ";
	$rules .= "\n  AddOutputFilterByType DEFLATE text/xml application/xml text/x-component";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n# webfonts and svg:";
	$rules .= "\n  <FilesMatch \"\.(ttf|otf|eot|svg)$\" >";
	$rules .= "\n    SetOutputFilter DEFLATE";
	$rules .= "\n  </FilesMatch>";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Stop screen flicker in IE on CSS rollovers";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# The following directives stop screen flicker in IE on CSS rollovers - in";
	$rules .= "\n# combination with the \"ExpiresByType\" rules for images (see above). If";
	$rules .= "\n# needed, un-comment the following rules.";
	$rules .= "\n";
	$rules .= "\n# BrowserMatch \"MSIE\" brokenvary=1";
	$rules .= "\n# BrowserMatch \"Mozilla/4.[0-9]{2}\" brokenvary=1";
	$rules .= "\n# BrowserMatch \"Opera\" !brokenvary";
	$rules .= "\n# SetEnvIf brokenvary 1 force-no-vary";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Prevent SSL cert warnings";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# Rewrite secure requests properly to prevent SSL cert warnings, e.g. prevent ";
	$rules .= "\n# https://www.domain.com when your cert only allows https://secure.domain.com";
	$rules .= "\n# Uncomment the following lines to use this feature.";
	$rules .= "\n";
	$rules .= "\n# <IfModule mod_rewrite.c>";
	$rules .= "\n#   RewriteCond %{SERVER_PORT} !^443";
	$rules .= "\n#   RewriteRule (.*) https://example-domain-please-change-me.com/$1 [R=301,L]";
	$rules .= "\n# </IfModule>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# Prevent 404 errors for non-existing redirected folders";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# without -MultiViews, Apache will give a 404 for a rewrite if a folder of the same name does not exist ";
	$rules .= "\n#   e.g. /blog/hello : webmasterworld.com/apache/3808792.htm";
	$rules .= "\n";
	$rules .= "\nOptions -MultiViews ";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# UTF-8 encoding";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n# use utf-8 encoding for anything served text/plain or text/html";
	$rules .= "\nAddDefaultCharset utf-8";
	$rules .= "\n";
	$rules .= "\n# force utf-8 for a number of file formats";
	$rules .= "\nAddCharset utf-8 .html .css .js .xml .json .rss";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n# A little more security";
	$rules .= "\n# ----------------------------------------------------------------------";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# Do we want to advertise the exact version number of Apache we're running?";
	$rules .= "\n# Probably not.";
	$rules .= "\n## This can only be enabled if used in httpd.conf - It will not work in .htaccess";
	$rules .= "\n# ServerTokens Prod";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# \"-Indexes\" will have Apache block users from browsing folders without a default document";
	$rules .= "\n# Usually you should leave this activated, because you shouldn't allow everybody to surf through";
	$rules .= "\n# every folder on your server (which includes rather private places like CMS system folders).";
	$rules .= "\nOptions -Indexes";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# Block access to \"hidden\" directories whose names begin with a period. This";
	$rules .= "\n# includes directories used by version control systems such as Subversion or Git.";
	$rules .= "\n<IfModule mod_rewrite.c>";
	$rules .= "\n  RewriteRule \"(^|/)\.\" - [F]";
	$rules .= "\n</IfModule>";
	$rules .= "\n";
	$rules .= "\n";
	$rules .= "\n# If your server is not already configured as such, the following directive";
	$rules .= "\n# should be uncommented in order to set PHP's register_globals option to OFF.";
	$rules .= "\n# This closes a major security hole that is abused by most XSS (cross-site";
	$rules .= "\n# scripting) attacks. For more information: http://php.net/register_globals";
	$rules .= "\n#";
	$rules .= "\n# IF REGISTER_GLOBALS DIRECTIVE CAUSES 500 INTERNAL SERVER ERRORS :";
	$rules .= "\n#";
	$rules .= "\n# Your server does not allow PHP directives to be set via .htaccess. In that";
	$rules .= "\n# case you must make this change in your php.ini file instead. If you are";
	$rules .= "\n# using a commercial web host, contact the administrators for assistance in";
	$rules .= "\n# doing this. Not all servers allow local php.ini files, and they should";
	$rules .= "\n# include all PHP configurations (not just this one), or you will effectively";
	$rules .= "\n# reset everything to PHP defaults. Consult www.php.net for more detailed";
	$rules .= "\n# information about setting PHP directives.";
	$rules .= "\n";
	$rules .= "\n# php_flag register_globals Off";
	$rules .= "\n";
	$rules .= "\n# rename session cookie to something else, than PHPSESSID";
	$rules .= "\n# php_value session.name sid";
	$rules .= "\n";
	$rules .= "\n# do not show you are using php";
	$rules .= "\n# php_flag expose_php Off";
	$rules .= "\n";
	$rules .= "\n# level of log detail - log all errors";
	$rules .= "\n# php_value error_reporting -1";
	$rules .= "\n";
	$rules .= "\n# write errors to log file";
	$rules .= "\n# php_flag log_errors On";
	$rules .= "\n";
	$rules .= "\n# do not display errors in browser (production - Off, development - On)";
	$rules .= "\n# php_flag display_errors Off";
	$rules .= "\n";
	$rules .= "\n# do not display startup errors (production - Off, development - On)";
	$rules .= "\n# php_flag display_startup_errors Off";
	$rules .= "\n";
	$rules .= "\n# format errors in plain text";
	$rules .= "\n# php_flag html_errors Off";
	$rules .= "\n";
	$rules .= "\n# show multiple occurrence of error";
	$rules .= "\n# php_flag ignore_repeated_errors Off";
	$rules .= "\n";
	$rules .= "\n# show same errors from different sources";
	$rules .= "\n# php_flag ignore_repeated_source Off";
	$rules .= "\n";
	$rules .= "\n# size limit for error messages";
	$rules .= "\n# php_value log_errors_max_len 1024";
	$rules .= "\n";
	$rules .= "\n# don't precede error with string (doesn't accept empty string, use whitespace if you need)";
	$rules .= "\n# php_value error_prepend_string \" \"";
	$rules .= "\n";
	$rules .= "\n# don't prepend to error (doesn't accept empty string, use whitespace if you need)";
	$rules .= "\n# php_value error_append_string \" \"";
	$rules .= "\n";
	$rules .= "\n# Increase cookie security";
	$rules .= "\n<IfModule php5_module>";
	$rules .= "\n  php_value session.cookie_httponly true";
	$rules .= "\n</IfModule>";
	
	return $rules;
}

//add_action('mod_rewrite_rules', 'roots_add_htaccess');
?>