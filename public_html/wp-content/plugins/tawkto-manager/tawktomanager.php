<?php
namespace TTM\Plugin;
defined( 'ABSPATH' ) or die( 'You do not have sufficient permissions to access this page. PS really?' );
/*
Plugin Name: TawkTo Manager
Plugin URI: http://www.tawktomanager.org/
Description: Tawk.To Manager enables extensive visibility control for tawk.to chat with a shortcode for post and pages and extra display options for the front page, category and tag pages and for administrators and subscribers.
Author: Daniël Mulder
Version: 2.0.4
Author URI: http://www.omnileads.nl/daniel-mulder-all-star/
*/

/*
 * Define TTM_Controller base class
 * 
*/

if ( !class_exists('TTM_Controller') ){
    
    
    class TTM_Controller{
        
        
        protected static $ttm_tawktoscript;
        protected static $ttm_show_always;
        protected static $ttm_show_front_page;
        protected static $ttm_show_cat_pages;
        protected static $ttm_show_tag_pages;
        protected static $ttm_hide_admin;
        protected static $ttm_hide_subscribers;
        protected static $ttm_hide_not_subscriber;
        protected static $ajax_nonce;
        
        
        function __construct(){
            self::__init_constants();
        }
        
        
        protected static function __init_constants(){
            define( 'TTM_TEXTDOMAIN', 'tawkto-manager' );
            define( 'TTM_SETTINGS_PAGE', 'ttm-tawkto-manager' );
            define( 'TTM_ABSPATH', WP_PLUGIN_DIR . '/' . TTM_TEXTDOMAIN );
            define( 'TTM_PLUGIN_FILE', 'tawktomanager.php' );
            define('TTM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
            define( 'TTM_SCRIPT_URL', WP_PLUGIN_URL.'/'.TTM_TEXTDOMAIN );
        }
        
        
        protected static function __register_settings(){
            /** register wp settings */
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_tawktoscript' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_show_always' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_show_front_page' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_show_cat_pages' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_show_tag_pages' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_hide_admin' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_hide_subscribers' ) );
            register_setting( 'ttm_tawkto_manager_plugin_options', array(__CLASS__, 'ttm_hide_not_subscriber' ) );
        }
        
        
        protected static function __ttm_init_options(){       
            /* load settings */
            self::$ttm_tawktoscript = get_option('ttm_tawktoscript');
            self::$ttm_show_always = get_option('ttm_show_always');
            self::$ttm_show_front_page = get_option('ttm_show_front_page');
            self::$ttm_show_cat_pages = get_option('ttm_show_cat_pages');
            self::$ttm_show_tag_pages = get_option('ttm_show_tag_pages');
            self::$ttm_hide_admin = get_option('ttm_hide_admin');
            self::$ttm_hide_subscribers = get_option('ttm_hide_subscribers');
            self::$ttm_hide_not_subscriber = get_option('ttm_hide_not_subscriber');
        }
        
        /* 
         * Secure callback with referer for (api) callbacks options page 
         * @void()
        */
        
        protected function createNonce(){
            if(self::is_admin_logged_in()){
                self::$ajax_nonce = wp_create_nonce( "sec-callback" );
            }
        }
        
        
        public function getNonce(){
            if(self::is_admin_logged_in()){
                return self::$ajax_nonce;
            }
        }

        /* 
         * Determine if user is logged in with admin rights
         * @bolean 
         * 
        */
        
        protected static function is_admin_logged_in(){
            $userInfo = wp_get_current_user();
            if (in_array( 'administrator', (array) $userInfo->roles)){
                return true;
            }
            return false;
        }     
        
        /* 
         * Determine if user is logged and confirm role or return roles
         * @array (count(array) is 0 for false or contains user roles) 
         * 
        */
        
        protected static function role_is_logged_in($role=''){
            if( is_user_logged_in() && !self::is_admin_logged_in() ){
                if($role != ''){
                    $userInfo = wp_get_current_user();
                    if (in_array( $role, (array) $userInfo->roles)){
                        return (bool) true;
                    }
                }
                else{
                    $userInfo = wp_get_current_user();
                    return (array) $userInfo->roles;
                }
            }
            return (array) $null;
        }
        
    } // end ctrl class 
   
} //endif exist ctrl


/** admin actions in dashboard */ 


if ( is_admin() && !class_exists('TTM_SettingsController') ){ 
    
    /*
     *  TawkTo Manager Setttings Controller
     *  Creates and manages admin settings page back-end
    */

    class TTM_SettingsController extends TTM_Controller{
        
        public function __construct() {  
            parent::__construct();
            add_action( 'admin_menu', array(__CLASS__, 'ttm_tawkto_manager_plugin_menu') ); // wp dash menu
            add_action('admin_init', array(__CLASS__, '__ttm_init') ); // options page
        }
        

        static function __ttm_init(){
            self::__register_settings();
            self::__ttm_init_options();
        }

        /* create admin options menu */
        
        static function ttm_tawkto_manager_plugin_menu() {
            add_options_page('TawkTo Manager Plugin Options',
                             'TawkTo settings','manage_options',
                             TTM_SETTINGS_PAGE,array( __CLASS__, 
                             'ttm_tawkto_manager_plugin_options' ) );
        }
        

        static function ttm_tawkto_manager_plugin_options() {
            /** check if admin */
            if ( !current_user_can( 'manage_options' ) )  {
             wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
            }
            
            // process settings form on submit
            if($_SERVER['REQUEST_METHOD'] == 'POST'){  
                
                /** Validate secure referrer nonce  */
                $nonce = $_POST['security'];
                if ( ! wp_verify_nonce( $nonce, 'sec-callback' ) ) {
                    wp_die(); // nonce not valid so die
                    return;
                } 
                
                /** process user input and update script */
                $replace = "<!--Start of Tawk.to Script-->";
                $_POST['ttm_tawktoscript'] = trim(str_replace($replace, "", $_POST['ttm_tawktoscript']));
                $replace = '<script type=\"text/javascript\">';
                $_POST['ttm_tawktoscript'] = trim(str_replace($replace, "", $_POST['ttm_tawktoscript']));
                $replace = '</script>';
                $_POST['ttm_tawktoscript'] = str_replace($replace, "", $_POST['ttm_tawktoscript']);
                $replace = '<!--End of Tawk.to Script-->';
                $_POST['ttm_tawktoscript'] = str_replace($replace, "", $_POST['ttm_tawktoscript']);

                /* eval and persist to wordpress options */
                self::$ttm_tawktoscript = $_POST['ttm_tawktoscript'];
                update_option('ttm_tawktoscript', self::$ttm_tawktoscript );
                if(isset($_POST['ttm_show_always']) && $_POST['ttm_show_always'] == "on" ){
                    self::$ttm_show_always = "on";
                    update_option('ttm_show_always', self::$ttm_show_always);
                }else{
                    self::$ttm_show_always = '';
                    update_option('ttm_show_always', self::$ttm_show_always);
                }
                if(isset($_POST['ttm_show_front_page']) && $_POST['ttm_show_front_page'] == "on" ){
                    self::$ttm_show_front_page = "on";
                    update_option('ttm_show_front_page', self::$ttm_show_front_page);
                }else{
                    self::$ttm_show_front_page = '';
                    update_option('ttm_show_front_page', self::$ttm_show_front_page);
                }
                if(isset($_POST['ttm_show_cat_pages']) && $_POST['ttm_show_cat_pages'] == "on" ){
                    self::$ttm_show_cat_pages = "on";
                    update_option('ttm_show_cat_pages', self::$ttm_show_cat_pages);
                }else{
                    self::$ttm_show_cat_pages = '';
                    update_option('ttm_show_cat_pages', self::$ttm_show_cat_pages);
                }
                if(isset($_POST['ttm_show_tag_pages']) && $_POST['ttm_show_tag_pages'] == "on" ){
                    self::$ttm_show_tag_pages = "on";
                    update_option('ttm_show_tag_pages', self::$ttm_show_tag_pages);
                }else{
                    self::$ttm_show_tag_pages = '';
                    update_option('ttm_show_tag_pages', self::$ttm_show_tag_pages);
                }
                if(isset($_POST['ttm_hide_admin']) && $_POST['ttm_hide_admin'] == "on" ){
                    self::$ttm_hide_admin = "on";
                    update_option('ttm_hide_admin', self::$ttm_hide_admin);
                }else{
                    self::$ttm_hide_admin = '';
                    update_option('ttm_hide_admin', self::$ttm_hide_admin);
                }
                if(isset($_POST['ttm_hide_subscribers']) && $_POST['ttm_hide_subscribers'] == "on" ){
                    self::$ttm_hide_subscribers = "on";
                    update_option('ttm_hide_subscribers', self::$ttm_hide_subscribers);
                }else{
                    self::$ttm_hide_subscribers = '';
                    update_option('ttm_hide_subscribers', self::$ttm_hide_subscribers);
                }
                if(isset($_POST['ttm_hide_not_subscriber']) && $_POST['ttm_hide_not_subscriber'] == "on" ){
                    self::$ttm_hide_not_subscriber = "on";
                    update_option('ttm_hide_not_subscriber', self::$ttm_hide_not_subscriber);
                }else{
                    self::$ttm_hide_not_subscriber = '';
                    update_option('ttm_hide_not_subscriber', self::$ttm_hide_not_subscriber);
                }

            }
            
            self::createNonce(); // secure referrer nonce
            include( TTM_ABSPATH . '/settings.ctp.php'); // page view file with html form
            
        }
        
    } // end class ctrlsettings

    
    $ttmSettingsPage = new TTM_SettingsController();
    
    
/* front-side end of plugin */
    
    
}elseif( !class_exists('TTM_PluginController') ) {  
    
    /*
     * TawkTo Manager Plugin controller 
     * Manages tawk.to window front-side
     * 
    */

    class TTM_PluginController extends TTM_Controller{

        public function __construct(){
            add_shortcode('tawkto_show', array(__CLASS__, 'ttm_eval_short_code') ); 
            add_action( 'wp_head', array(__CLASS__, 'ttm_add_to_header') ); // add as inline script to header
            self::__ttm_init_options();
        }
       
         /* short code eval hide/show chat */
        
        static function ttm_eval_short_code(){   
            if(!is_category() && !is_tag()){
                if(self::ttm_eval_show() != false){
                    self::ttm_out_script(); // add inline to body
                }

            }
        }

        /* Evaluate show/hide logged in users */
        
        static  function ttm_eval_show(){
            if(is_user_logged_in()){
                // hide if admin and hide on
                if(self::is_admin_logged_in()){ 
                    if(self::$ttm_hide_admin == 'on'){
                        return false;
                    }
                }else{ // eval for user role
                    $roles = self::role_is_logged_in();
                    switch ($roles[0]) {
                        case 'subscriber':
                                if(self::$ttm_hide_subscribers == 'on'){
                                    return false;
                                }
                            break;
                        default:
                                return true;
                            break;
                    }
                }
            }else{ 
                    // eval for user not logged in
                    if(self::$ttm_hide_not_subscriber == 'on'){
                        return false;
                    }
            }
            return true;
        }

        /* eval show tawkto (hook wp_head action) adds inline */

        static function ttm_add_to_header(){   
            if(self::ttm_eval_show() == false){
                return;
            }
            /* if  show_always */
            if(self::$ttm_show_always){
                self::ttm_out_script();
                return;
            }
            /* front page */
            if(is_front_page() || is_home()){
                if(self::$ttm_show_front_page){
                    self::ttm_out_script();
                    return;
                }
            }
            /* category pages */
            if(is_category()){
                if(self::$ttm_show_cat_pages){
                    self::ttm_out_script();
                    return;
                }
            }
            /* tag pages */
            if(is_tag()){
                if(self::$ttm_show_tag_pages){
                    self::ttm_out_script();
                    return;
                }
            }
        }
        
        /* outputs inline to html source where called  */

        private static function ttm_out_script(){  
            echo '<script>'.PHP_EOL;
            echo wp_unslash(self::$ttm_tawktoscript).PHP_EOL;
            echo '</script>'.PHP_EOL;

        }

    } // end class ctrl plugin

    
    $ttmPlugin = new TTM_PluginController();
    
    
} // endif exist ctrl plugin

