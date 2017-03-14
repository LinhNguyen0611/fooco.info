<?php
# Donation Message #
if( get_site_option( 'fdx1_hidden_time_2' ) && get_site_option( 'fdx1_hidden_time_2' ) < time() ) {
echo '<div class="updated"><form method="post" action=""><input type="hidden" name="fdx_page_2" value="hide_message_2" /><p>';
echo '<strong>'.__('Do you like this Plugin? Rate', $this->plugin_slug).' <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span> '.__('on', $this->plugin_slug).' WordPress.org</strong> &nbsp;&nbsp;<input type="button" class="button button-primary" onClick="location.href=\''. $this->sbar_wpratelink . '\'" value="' . __( 'Vote & Rate Now', $this->plugin_slug ) . '">&nbsp;&nbsp;&nbsp;';
submit_button( __('Hide this message', $this->plugin_slug ), 'secondary', 'Submit', false, array( 'id' => '' ) ) ;
echo '</p></form></div>';
}
/*---------------------------------------*/
echo '<div id="postbox-container-1" class="postbox-container">';
echo '<div id="side-sortables" class="meta-box-sortables">';

/* class="postbox closed"
----------------------------------------*/
echo '<div class="postbox fdx-responsive"><div class="handlediv" title="'.__('Click to toggle', $this->plugin_slug) .'"><br /></div><h3 class="hndle"><span>'. $this->pluginname . ' <small style="float: right">v'. WP_Mobile_Edition::VERSION . '</small></span></h3>';
echo '<div class="inside">';
echo '<a href="'. $this->sbar_homepage . '" target="_blank"><div id="logo"></div></a>';
echo '<a class="sm_button sm_code" href="'. $this->sbar_homepage . '" target="_blank">' . __( 'Suggest a Feature', $this->plugin_slug ) . '</a>';
echo '<a class="sm_button sm_bug" href="'. $this->sbar_homepage . '" target="_blank">' . __( 'Report a Bug', $this->plugin_slug ) . '</a>';
echo '<a class="sm_button sm_lang" href="' . $this->sbar_glotpress . '" target="_blank">' . __( 'Help translating it', $this->plugin_slug ) . '</a>';
echo '<a class="sm_button sm_star" href="'. $this->sbar_wpratelink . '" target="_blank">'. __( 'Rate the plugin 5 star on WordPress', $this->plugin_slug ) .'.</a>';
echo '<hr><div style="text-align: center; margin-top: 13px"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BABHNAQX4HLLW" target="_blank" title="Donate"><img src="'. plugins_url( 'assets/images/paypal.png', dirname(__FILE__)).'" width="147" height="47" border="0" alt="*" style="text-align: center" /></a>';
//echo '<a href="http://api.addthis.com/oexchange/0.8/offer?title='. $this->pluginname . '&amp;url='. $this->sbar_homepage .'&amp;pubid=ra-52eb02b34be83059" data-width="500" data-height="690" rel="1" id="pop_6" class="newWindow" title="'. __( 'Share on', $this->plugin_slug ) .' Addthis"><img src="'. plugins_url( 'assets/images/h3_icons/addthis.png', dirname(__FILE__)).'" width="32" height="32" border="0" alt="*" /></a>';
echo '</div></div></div>';

//----------------------------------------
echo '<div class="postbox fdx-responsive"><div class="handlediv" title="'.__('Click to toggle', $this->plugin_slug) .'"><br /></div><h3 class="hndle"><span>'. __( 'QR-Code', $this->plugin_slug ) . '</span></h3>';
echo '<div class="inside">'; ?>
                  <div class="qrcodes">
                <?php
                 $urldemo = get_bloginfo('url');
                 $width = $height = 170;
                 $url = urlencode($urldemo);
                 $error = "H"; // handle up to 30% data loss, or "L" (7%), "M" (15%), "Q" (25%)
                 $border = 1;
                 echo "<img src=\"http://chart.googleapis.com/chart?". "chs={$width}x{$height}&cht=qr&chld=$error|$border&chl=$url\"  width=\"{$width}\" height=\"{$height}\" /><br />";
                 echo $urldemo ?>
                 </div>

<?php
echo '</div></div>';
//----------------------------------------/
echo '</div></div>';

/* End of file sidebar-left.php */
/* Location: ./admin/sidebar-left.php */