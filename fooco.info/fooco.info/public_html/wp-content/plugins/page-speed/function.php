<?php
function pg_pagespeed_dequeue_my_css() {
$css1 = get_option('insert_css_name1');
$css2 = get_option('insert_css_name2');
$css3 = get_option('insert_css_name3');
$css4 = get_option('insert_css_name4');
$css5 = get_option('insert_css_name5');
$css6 = get_option('insert_css_name6');
$css7 = get_option('insert_css_name7');
$css8 = get_option('insert_css_name8');
$css9 = get_option('insert_css_name9');
$css10 = get_option('insert_css_name10');
$css11 = get_option('insert_css_name11');
$css12 = get_option('insert_css_name12');
$css13 = get_option('insert_css_name13');
$css14 = get_option('insert_css_name14');
$css15 = get_option('insert_css_name15');
wp_deregister_style($css1);
wp_deregister_style($css2);
wp_deregister_style($css3);
wp_deregister_style($css4);
wp_deregister_style($css5);
wp_deregister_style($css6);
wp_deregister_style($css7);
wp_deregister_style($css8);
wp_deregister_style($css9);
wp_deregister_style($css10);
wp_deregister_style($css11);
wp_deregister_style($css12);
wp_deregister_style($css13);
wp_deregister_style($css14);
wp_deregister_style($css15);
}

// add a priority if you need it
// add_action('wp_enqueue_scripts','dequeue_my_css',100);

function pg_pagespeed_dequeue_my_js() {
$js1 = get_option('insert_js_name1');
$js2 = get_option('insert_js_name2');
$js3 = get_option('insert_js_name3');
$js4 = get_option('insert_js_name4');
$js5 = get_option('insert_js_name5');
$js6 = get_option('insert_js_name6');
$js7 = get_option('insert_js_name7');
$js8 = get_option('insert_js_name8');
$js9 = get_option('insert_js_name9');
$js10 = get_option('insert_js_name10');
$js11 = get_option('insert_js_name11');
$js12 = get_option('insert_js_name12');
$js13 = get_option('insert_js_name13');
$js14 = get_option('insert_js_name14');
$js15 = get_option('insert_js_name15');
wp_deregister_script( $js1 );
	wp_deregister_script( $js2 );
	wp_deregister_script( $js3 );
	wp_deregister_script( $js4 );
	wp_deregister_script( $js5 );
	wp_deregister_script( $js6 );
	wp_deregister_script( $js7 );
	wp_deregister_script( $js8 );
	wp_deregister_script( $js9 );
	wp_deregister_script( $js10 );
	wp_deregister_script( $js11 );
	wp_deregister_script( $js12 );
	wp_deregister_script( $js13 );
	wp_deregister_script( $js14 );
	wp_deregister_script( $js15 );
}
function pg_pagespeed_insert_inline_css()
{
?>
<style type="text/css"> 
<?php
echo get_option('insert_inline_css');
?>
</style>
<?php
}
function pg_pagespeed_inline_js()
{
?>
<script type="text/javascript">
<?php
echo get_option('insert_inline_js');
?>
</script>
<?php
}	  


/***** activate GZIP ****/
function activate_gzip_cache( $rules ) {
     

	 if (get_option('activate_gzip_compression')=='on') {
    return $rules . "
	#Gzip - compress text, html, javascript, css, xml
<ifmodule mod_deflate.c>
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
</ifmodule>
#End Gzip

<ifModule mod_headers.c>
Header set Connection keep-alive
</ifModule>";
	}
	
	else {
	// do nothing 

	return $rules;
	
	
	}
	

}



/***** activate Leverage Cache ****/
function activate_cache( $rules ) {
     

	 if (get_option('activate_caching')=='on') {
    return $rules . "
	## EXPIRES CACHING ##
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg 'access 1 year'
ExpiresByType image/jpeg 'access 1 year'
ExpiresByType image/gif 'access 1 year'
ExpiresByType image/png 'access 1 year'
ExpiresByType text/css 'access 1 month'
ExpiresByType application/pdf 'access 1 month'
ExpiresByType text/x-javascript 'access 1 month'
ExpiresByType application/x-shockwave-flash 'access 1 month'
ExpiresByType image/x-icon 'access 1 year'
ExpiresDefault 'access 1 month'
</IfModule>
## EXPIRES CACHING ##";
	}
	
	else {
	// do nothing 

	return $rules;
	
	
	}
	

}


add_filter('mod_rewrite_rules', 'activate_gzip_cache');

add_filter('mod_rewrite_rules', 'activate_cache');


// add




 
	 function ps_pagespeed_settings_style() {
         wp_register_style( 'ps_page_speed_settings_css', plugin_dir_url( __FILE__ ) . 'css/ps-page-speed-settings-css.css' );
        wp_enqueue_style( 'ps_page_speed_settings_css' );
		
		wp_register_style( 'ps_page_speed_settings_jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css' );
        wp_enqueue_style( 'ps_page_speed_settings_jquery-ui' );
		
		wp_register_script( 'ps_page_speed_settings_jquery', plugin_dir_url( __FILE__ ). '/js/jquery-1.10.js' );
		wp_enqueue_script( 'ps_page_speed_settings_jquery' );
		
		wp_register_script( 'ps_page_speed_settings_jquery-ui', plugin_dir_url( __FILE__ ) . '/js/jquery-ui.js' );
		wp_enqueue_script( 'ps_page_speed_settings_jquery-ui' );
		
}



	 
	 
	 function my_custom_admin_head(){
?>


<script>
$(function() {
$( "#accordion" ).accordion();
});
</script>

<?php

}
add_action('admin_head', 'my_custom_admin_head');

function ps_get_css() {
     
 global $wp_styles;
 
$style_name_css_list = array();
 

 foreach( $wp_styles->queue as $style =>  $ps_styles) {

  $style_url_css = $wp_styles->registered[$ps_styles]->src;
 $style_name_css_list[$style] = $style_url_css;
 
  $option_name = 'ps_free_css_name_list';
  $new_value = $style_name_css_list;
  
  
   if ( get_option( $option_name) !== false ) {
    // The option already exists, so we just update it.
    update_option( $option_name, $new_value );
	
} else {
    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
    $deprecated = null;
    $autoload = 'yes';
	
    add_option( $option_name, $new_value, $deprecated, $autoload );
	
}
 
 }
 
 
 }
 
 
 add_action('wp_head', 'ps_get_css');
 
 
 // save the script
function ps_get_script() {
     
global $wp_scripts;

$script_name_list = array();

 foreach( $wp_scripts->queue as $script => $ps_scripts) {
 
 $script_url  = $wp_scripts->registered[$ps_scripts]->src;
 $script_name_list[$script] = $script_url;
 
 $option_name = 'ps_free_script_name_list';
$new_value = $script_name_list;
 
 if ( get_option( $option_name ) !== false ) {

    // The option already exists, so we just update it.
    update_option( $option_name, $new_value );
	

} else {

    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
    $deprecated = null;
    $autoload = 'yes';
	
    add_option( $option_name, $new_value, $deprecated, $autoload );
}
 
 }
 
 
 }
 
 
  add_action('wp_head', 'ps_get_script');
 





?>