<?php

// create custom plugin settings menu

add_action('admin_menu', 'pg_pagespeed_menu');

function pg_pagespeed_menu() {

//create new top-level menu

add_menu_page('Page Speed Plugin Settings', 'Page Speed', 'administrator', __FILE__, 'ps_pagespeed_settings_page',plugins_url('/images/page_speed_icon.png', __FILE__));


$page_hook_suffix = add_submenu_page( __FILE__, 'Page Speed Submenu','Page Speed PRO', 'manage_options',__FILE__.'_pagespeedpro', _pagespeedpro );
 
add_action('admin_print_scripts-' . $page_hook_suffix, 'ps_pagespeed_settings_style');

}

//call register settings function

add_action( 'admin_init', 'pg_pagespeed_register_mysettings' );

add_action( 'wp_print_styles', 'pg_pagespeed_dequeue_my_css', 100 );

add_action( 'wp_print_scripts', 'pg_pagespeed_dequeue_my_js', 100 );

// inline css 

add_action('wp_head','pg_pagespeed_insert_inline_css');



// inline js 

add_action('wp_footer','pg_pagespeed_inline_js');



function pg_pagespeed_register_mysettings() {

	//register our settings

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name1' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name2' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name3' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name4' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name5' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name6' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name7' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name8' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name9' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name10' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name11' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name12' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name13' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name14' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_css_name15' );

	// register js

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name1' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name2' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name3' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name4' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name5' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name6' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name7' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name8' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name9' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name10' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name11' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name12' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name13' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name14' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_js_name15' );

	// register in option

	register_setting( 'ps_pagespeed-settings-group', 'insert_inline_css' );

	register_setting( 'ps_pagespeed-settings-group', 'insert_inline_js' );

	

	register_setting( 'ps_pagespeed-settings-group', 'move_all_script_infooter' );

	register_setting( 'ps_pagespeed-settings-group', 'inline_the_css' );
	
	// activate gzip	

	register_setting( 'ps_pagespeed-settings-group', 'activate_gzip_compression' );	

register_setting( 'ps_pagespeed-settings-group', 'activate_caching' );		
	
	
  for ($xx=0; $xx<=20; $xx++) {

$scriptscount = $xx.'-js';

register_setting( 'ps_pagespeed-settings-group', $scriptscount );


   
}


	

	}

function ps_pagespeed_settings_page() {

?>
<style type="text/css">

.inline-wrap{display:inline-block;margin-right:10px;vertical-align:top}.gzip-inactive{font-weight:700}.gzip-active{color:green;font-weight:700}.col2{display:inline-block;vertical-align:top}.ps-textarea{min-height:100px;width:100%}.js-css-name-wrap{color:green}.wp-admin select{height:auto;padding:0}.ui-accordion-content.ui-helper-reset.ui-widget-content.ui-corner-bottom{height:auto!important}.ui-accordion-header.ui-state-default.ui-accordion-icons.ui-accordion-header-active.ui-state-active.ui-corner-top{background:none repeat scroll 0 0 #f6f6f6;border-bottom:0 none}.ui-accordion-content.ui-helper-reset.ui-widget-content.ui-corner-bottom.ui-accordion-content-active{background:none repeat scroll 0 0 #f6f6f6;padding:0 15px}.ui-widget-content a{text-decoration:none}.ps-content-wrapper h1{display:inline-block}.donation{float:right}


.no-margin {
    margin-top: -10px;
}

</style>


<div class="wrap">

<div class="ps-content-wrapper">

<h1> Page Speed Settings </h1>



<form method="post" action="options.php">

    <?php settings_fields( 'ps_pagespeed-settings-group' ); ?>

    <?php do_settings_sections( 'ps_pagespeed-settings-group' ); ?>


<h2> Enable compression </h2>


<input type="checkbox" name="activate_gzip_compression" value="on" <?php echo get_option('activate_gzip_compression')=='on' ? 'checked="checked"' : '' ?> />
	Activate Gzip and  Deflate. See <a href="https://wordpress.org/plugins/page-speed/faq/" target="_blank"> FAQ </a> for more details.
<hr>
	
<h2> Leverage browser caching </h2>	
	
	<input type="checkbox" name="activate_caching" value="on" <?php echo get_option('activate_caching')=='on' ? 'checked="checked"' : '' ?> />
	
	Set Expiry date or a maximum age in the HTTP headers. See <a href="https://wordpress.org/plugins/page-speed/faq/" target="_blank"> FAQ </a> for more details.
<hr>
	
	
	
	
<h2> Eliminate render-blocking JavaScript and CSS in above-the-fold content </h2>





  <div>



		<h3> Remove render-blocking JavaScript:  </h3> 
    
	
<p>   Deactive the Javascript by puting the Js Name Below.  Copy the js code and paste it  in the field  to inline the Javascript. See <a href="https://wordpress.org/plugins/page-speed/faq/" target="_blank"> FAQ </a> for more details. </p>
   
   
	<div class="inline-wrap">

<p> Javascript Name </p>

<div class="col2">

	<p><input type="text" name="insert_js_name1" value="<?php echo get_option('insert_js_name1'); ?>" /></p>

	<p><input type="text" name="insert_js_name2" value="<?php echo get_option('insert_js_name2'); ?>" /></p>

	<p><input type="text" name="insert_js_name3" value="<?php echo get_option('insert_js_name3'); ?>" /></p>

	<p><input type="text" name="insert_js_name4" value="<?php echo get_option('insert_js_name4'); ?>" /></p>

	<p><input type="text" name="insert_js_name5" value="<?php echo get_option('insert_js_name5'); ?>" /></p>

    <p><input type="text" name="insert_js_name6" value="<?php echo get_option('insert_js_name6'); ?>" /></p>

    <p><input type="text" name="insert_js_name7" value="<?php echo get_option('insert_js_name7'); ?>" /></p>

    <p><input type="text" name="insert_js_name8" value="<?php echo get_option('insert_js_name8'); ?>" /></p>

   
    </div>

    <div class="col2">
	
	 <p><input type="text" name="insert_js_name9" value="<?php echo get_option('insert_js_name9'); ?>" /></p>

    <p><input type="text" name="insert_js_name10" value="<?php echo get_option('insert_js_name10'); ?>" /></p>


    <p><input type="text" name="insert_js_name11" value="<?php echo get_option('insert_js_name11'); ?>" /></p>

    <p><input type="text" name="insert_js_name12" value="<?php echo get_option('insert_js_name12'); ?>" /></p>

    <p><input type="text" name="insert_js_name13" value="<?php echo get_option('insert_js_name13'); ?>" /></p>

    <p><input type="text" name="insert_js_name14" value="<?php echo get_option('insert_js_name14'); ?>" /></p>

    <p><input type="text" name="insert_js_name15" value="<?php echo get_option('insert_js_name15'); ?>" /></p>

    </div>

	</div>

	<div class="inline-wrap">

	<p> Javascript Code </p>

	<p><textarea class="ps-textarea" rows="4" cols="50" name="insert_inline_js">  <?php  echo get_option('insert_inline_js'); ?> </textarea> </p>

	</div>

	<hr>

	<h3> Optimize CSS Delivery  </h3> 
    
    
  <p>   Deactive the Css by puting the Css Name Below. Copy the Css code and paste it  in the field  to inline the Css. See <a href="https://wordpress.org/plugins/page-speed/faq/" target="_blank"> FAQ </a> for more details. </p>

	<div class="inline-wrap">

	<p> Css Name </p>



    <div class="col2">

	<p><input type="text" name="insert_css_name1" value="<?php echo get_option('insert_css_name1');  ?>" /></p>

	<p><input type="text" name="insert_css_name2" value="<?php echo get_option('insert_css_name2');  ?>" /></p>

	<p><input type="text" name="insert_css_name3" value="<?php echo get_option('insert_css_name3');  ?>" /></p>

	<p><input type="text" name="insert_css_name4" value="<?php echo get_option('insert_css_name4');  ?>" /></p>

	<p><input type="text" name="insert_css_name5" value="<?php echo get_option('insert_css_name5');  ?>" /></p>

    <p><input type="text" name="insert_css_name6" value="<?php echo get_option('insert_css_name6');  ?>" /></p>

    <p><input type="text" name="insert_css_name7" value="<?php echo get_option('insert_css_name7');  ?>" /></p>

    <p><input type="text" name="insert_css_name8" value="<?php echo get_option('insert_css_name8');  ?>" /></p>

   
    </div>

    <div class="col2">
	
	 <p><input type="text" name="insert_css_name9" value="<?php echo get_option('insert_css_name9');  ?>" /></p>

    <p><input type="text" name="insert_css_name10" value="<?php echo get_option('insert_css_name10');  ?>" /></p>


    <p><input type="text" name="insert_css_name11" value="<?php echo get_option('insert_css_name11');  ?>" /></p>

    <p><input type="text" name="insert_css_name12" value="<?php echo get_option('insert_css_name12');  ?>" /></p>

    <p><input type="text" name="insert_css_name13" value="<?php echo get_option('insert_css_name13');  ?>" /></p>

    <p><input type="text" name="insert_css_name14" value="<?php echo get_option('insert_css_name14');  ?>" /></p>

    <p><input type="text" name="insert_css_name15" value="<?php echo get_option('insert_css_name15');  ?>" /></p>

    </div>

</div>

<div class="inline-wrap">

<p> Css code </p>

	<p><textarea class="ps-textarea" rows="4" cols="50" name="insert_inline_css">  <?php  echo get_option('insert_inline_css'); ?> </textarea> </p>

</div>



<hr>





	



	</div>

    <?php submit_button(); ?>

</form>


</div>







</div>

<?php 

} 





// ps pro




function _pagespeedpro() {


?>

<div class="wrap">

<div class="psp-header-wrapper">

<div class="psp-header">

<h1> Page Speed PRO </h1>

<p>
Test your website speed performance in speed testing services such as 
<a rel="nofollow" href="http://gtmetrix.com/">GTmetrix</a>
,
<a rel="nofollow" href="http://developers.google.com/speed/pagespeed/insights/">Google PageSpeed</a>
,
<a rel="nofollow" href="http://tools.pingdom.com/fpt/">Pingdom</a>
,
<a rel="nofollow" href="http://www.webpagetest.org/">Webpagetest</a>
,
<a rel="nofollow" href="https://developer.yahoo.com/yslow/">YSlow</a>.<br>
For Frequenly Ask Question and Tips for Web performance Best Practice. See <a target="_blank"  href="http://pagespeedpro.byethost31.com/faq/"> FAQ / Tips </a> for more Details.
</p>


</div>


<div class="right-panel">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="T9TSDSNM5XT7E">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

</div>




</div>


<div id="accordion">
<h3> Enable compression </h3>
<div>
 <p>
<input type="checkbox" name="" value="on"  />
	Activate Gzip and Deflate. Compressing resources with gzip or deflate can reduce the number of bytes sent over the network.
	
	See <a class="red" href="http://pagespeedpro.byethost31.com/faq/" target="_blank"> FAQ </a> for more details.

</p>
</div>
<h3>   Leverage browser caching </h3>
<div>
<p>
<input type="checkbox" name="" value="on" />
	Setting an expiry date or a maximum age in the HTTP headers for static resources instructs the browser to load previously downloaded resources from local disk rather than over the network.	
	See <a class="red"  href="http://pagespeedpro.byethost31.com/faq/" target="_blank"> FAQ </a> for more details.

	
	</p>
</div>

<h3> Eliminate render-blocking JavaScript and CSS in above-the-fold content  </h3>

<div>


<h4> Remove render-blocking JavaScript </h4>


<p> Select The Script that mark as Remove render-blocking JavaScript in google Insight. See <a class="red" href="http://pagespeedpro.byethost31.com/faq/" target="_blank"> FAQ </a> for more details.  </p>


<?php

$scripts = get_option('ps_free_script_name_list');

if ( $scripts !== false ) {


foreach ($scripts as $count => $scripts_name) {

?>
 
 <input type="checkbox" name="" value="" />
 


<a href="<?php echo $scripts_name; ?>" target="_blank"><?php echo $scripts_name; ?></a>
<br>

<?php
}

}
else {
?>
<a style="color:red;" target="_blank" href="<?php echo home_url(); ?>"> Click Me! Refresh your Home Page to get the list of the Js then refresh this page again  </a> 
	 
<?php
}




?>

<h4> Optimize CSS Delivery </h4>

<p> Select the css you want to inline. <span style="color:red;">note: </span> Don't inline large data URIs as Google Insight Recomended. See <a class="red" href="http://pagespeedpro.byethost31.com/faq/" target="_blank"> FAQ </a> for more details.   </p>



 <?php
	 $styles  = get_option('ps_free_css_name_list');
	 
	 
	  if ( $styles !== false ) {
	
foreach ($styles as $count => $css_name) {



?>

<input type="checkbox" name="" value="" />
 
 <a target="_blank" href="<?php echo $css_name; ?>"> <?php echo $css_name; ?> </a>
<br>
<?php




}
	  
	  
	  }
	  
	 else {
	 
	 ?>
	 <a style="color:red;" target="_blank" href="<?php echo home_url(); ?>"> Click Me!   Refresh your Home Page to get the list of the Css then refresh this page again  </a> 
	 
	 <?php

}

?>
 

<p> <br> </p>


	
</div>

<h3> Minify JavaScript   </h3>

<div>

<p>
 Select JavaScripts  that mark as Minify JavaScript in Google Insight. <span style="color:red;">note: </span> Don't forget to copy and paste the code that you selected in the field. 
 See <a class="red" href="http://pagespeedpro.byethost31.com/faq/" target="_blank"> FAQ </a> for more details.  
 </p>
 
 
 
<?php

$scripts = get_option('ps_free_script_name_list');

if ( $scripts !== false ) {


foreach ($scripts as $count => $scripts_name) {

?>
 
 <input type="checkbox" name="" value="" />
 


<a href="<?php echo $scripts_name; ?>" target="_blank"><?php echo $scripts_name; ?></a>
<br>

<?php
}

}
else {
?>
<a style="color:red;" target="_blank" href="<?php echo home_url(); ?>"> Click Me! Refresh your Home Page to get the list of the Js then refresh this page again  </a> 
	 
<?php
}




?>


<p> JavaScript Code </p>

	<p><textarea class="ps-textarea" rows="4" cols="50" name="insert_inline_css">  <?php  echo get_option('insert_inline_css'); ?> </textarea> </p>

</div>





</div>

<hr>

<a id="purchase-button" href="http://pagespeedpro.byethost31.com/" target="_blank"> Page Speed PRO  </a>








</div>






<?php






}

?>