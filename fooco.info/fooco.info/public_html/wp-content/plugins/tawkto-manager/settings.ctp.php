<?php defined( 'ABSPATH' ) or die( 'You do not have sufficient permissions to access this page. PS really?' ); ?>
<div class="wrap">
<h2>Tawk.To Manager Options and Settings</h2>
<form method="post" action="<?php TTM_SCRIPT_URL.'/'.TTM_PLUGIN_FILE; ?>">
    <input type="hidden" name="security" value="<?php echo self::getNonce(); ?>" />
    <?php settings_fields( 'ttm_tawkto_manager_plugin_options' ); ?>
    <?php do_settings_sections( 'ttm_tawkto_manager_plugin_options' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Visibility options / script</th>
        <tr>
            <td>Always show Tawk.To chat</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_show_always ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_show_always" id="ttm_show_always" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Show on front page</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_show_front_page ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_show_front_page" id="ttm_show_front_page" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Show on category pages</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_show_cat_pages ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_show_cat_pages" id="ttm_show_cat_pages" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Show on tag pages</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_show_tag_pages ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_show_tag_pages" id="ttm_show_tag_pages" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Hide for admin users</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_hide_admin ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_hide_admin" id="ttm_hide_admin" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Hide for subscribers</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_hide_subscribers ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_hide_subscribers" id="ttm_hide_subscribers" value="on" <?php echo $checked; ?> />
            
            </td>
        </tr>
        <tr>
            <td>Hide if not logged in</td>
            <td>
                <?php 
                    $checked = ( self::$ttm_hide_not_subscriber ? 'checked' : '' ); 
                ?>
                <input type="checkbox" name="ttm_hide_not_subscriber" id="ttm_hide_not_subscriber" value="on" <?php echo $checked; ?> />&nbsp;&nbsp;
                <a href="javascript:void(0)" class="ttmtooltip"
                   title="Enable to hide chat for all users not logged in and show only to logged in users having role subscriber">point at me for info</a>
            
            </td>
        </tr>
        <tr>
            <td>Your tawk.to script*</td>
            <td>
                <textarea name="ttm_tawktoscript" rows="14" cols="80"><?php echo wp_unslash(self::$ttm_tawktoscript); ?></textarea>
            </td>
        </tr>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
<script>
// if show always changes to checked/unchecked
// uncheck and disable other options or else enable
window.onload = function() {
    if (window.jQuery) {  
         jQuery("#ttm_show_always").change(function(){
            var ischecked = document.getElementById('ttm_show_always').checked;
            if(ischecked === true){
                jQuery("#ttm_show_front_page").prop( "checked",false);
                jQuery("#ttm_show_front_page").attr("disabled", true);
                jQuery("#ttm_show_cat_pages").prop( "checked",false);
                jQuery("#ttm_show_cat_pages").attr("disabled", true);
                jQuery("#ttm_show_tag_pages").prop( "checked",false);
                jQuery("#ttm_show_tag_pages").attr("disabled", true); 
                jQuery("#ttm_hide_admin").prop( "checked",false);
                jQuery("#ttm_hide_admin").attr("disabled", true); 
                jQuery("#ttm_hide_subscribers").prop( "checked",false);
                jQuery("#ttm_hide_subscribers").attr("disabled", true); 
                jQuery("#ttm_hide_not_subscriber").prop( "checked",false);
                jQuery("#ttm_hide_not_subscriber").attr("disabled", true); 
            }else{
                jQuery("#ttm_show_front_page").removeAttr("disabled");
                jQuery("#ttm_show_cat_pages").removeAttr("disabled");
                jQuery("#ttm_show_tag_pages").removeAttr("disabled");
                jQuery("#ttm_hide_admin").removeAttr("disabled");
                jQuery("#ttm_hide_subscribers").removeAttr("disabled");
                jQuery("#ttm_hide_not_subscriber").removeAttr("disabled");
            }
        });
        // Enable/disable options based on show always value
        var ischecked = document.getElementById('ttm_show_always').checked;
        if(ischecked === true){
            jQuery("#ttm_show_front_page").attr("disabled", true);
            jQuery("#ttm_show_cat_pages").attr("disabled", true);
            jQuery("#ttm_show_tag_pages").attr("disabled", true); 
            jQuery("#ttm_hide_admin").attr("disabled", true); 
            jQuery("#ttm_hide_subscribers").attr("disabled", true); 
            jQuery("#ttm_hide_not_subscriber").attr("disabled", true); 
        }  
    } 
} 
</script>
<br />
<p>
    <strong>* Copy and paste the whole script from tawk.to</strong> or read 
    <a href="https://www.tawk.to/knowledgebase/getting-started/adding-a-widget-to-your-website/" target="_blank"> 
    Adding a widget to your website</a> on tawk.to.
</p>  
<p><a href="http://www.tawktomanager.org/documentation/" target="_blank">Plugin documentation</a></p>
</div>



