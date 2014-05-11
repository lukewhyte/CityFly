----------------------------------------------------------------------
Responsive WordPress Theme Development  | Version 1.0 | 12/23/2013
----------------------------------------------------------------------


General Usage Notes
----------------------------------------------------------------------
- This is the working repository for the new WordPress theme for all 
responsive conversions. Be aware that this is not to be used for any 
landing pages or sites till it is furnished in proper wordpress theme 
templating. For information regarding files in this repo, please 
contact Andy or Luke.



Theme Resource Hierarchy
----------------------------------------------------------------------
ace-of-base2.0:(svn repo and root of a WP theme.)
|
|
|--> style.css (project specific styles)
|--> editor-style.css
|
|
|--> functions.php <--{ScriptLoader and StyleLoader called}
|--> AB_ScriptLoader.php
|--> AB_StyleLoader.php
|
|
|--> /vendor:
|	|
|	|
|	|--> /boilerplate:
|	|	|
|	|	|		
|	|	|--> /css:
|	|	|	|
|	|	|	|
|	|	|	|--> normalize.css (browser comp.)
|	|	|	|--> main.css (media query default)
|	|	|--> /js:
|	|	|	|
|	|	|	|
|	|	|	|--> modernizr.js (browser comp.)
|	|	|	|--> main.js (responsive default)
|	|	|--> /img:
|	|--> /bootstrap:
|	|	|
|	|	|		
|	|	|--> /css:
|	|	|	|
|	|	|	|
|	|	|	|--> normalize.css (browser comp.)
|	|	|	|--> main.css (media query default)
|	|	|--> /js:
|	|	|	|
|	|	|	|
|	|	|	|--> modernizr.js (browser comp.)
|	|	|	|--> main.js (responsive default)
|	|	|--> /img:
|	|--> /blueprint:
|	|	|
|	|	|		
|	|	|--> /css:
|	|	|	|
|	|	|	|
|	|	|	|--> normalize.css (browser comp.)
|	|	|	|--> main.css (media query default)
|	|	|--> /js:
|	|	|	|
|	|	|	|
|	|	|	|--> modernizr.js (browser comp.)
|	|	|	|--> main.js (responsive default)
|	|	|--> /img:


