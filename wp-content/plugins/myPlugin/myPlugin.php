<?php
/**
 * @package myPlugin
 */
/*
Plugin Name: myPlugin
Plugin URI: https://myPlugin.com/
Description: This is my first plugin development
Version: 1.1
Author: Fatemeh Goodarzi
Author URI: https://fatemehgoodarzi.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
Text Domain: myPlugin
*/


// exit if file is called directly
if ( ! defined('ABSPATH') ){
    exit;
}

// if admin area
if( is_admin() ){

    // include dependencies
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callback.php';
}

// default plugin options 
function myPlugin_options_default(){

    return array(
        'custome_url' => 'https://wordpress.org/',
        'custome_title' => 'Powered by Wordpress',
        'custome_style' => 'disable',
        'custome_message' => '<p class="custome-message">My Custome Message</p>',
        'custome_footer' => 'Special message for users',
        'custome_toolbar' => false,
        'custome_scheme' => 'default'
    );
}





