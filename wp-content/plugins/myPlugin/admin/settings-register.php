<?php // MyPlugin - Settings Register

// exit if file is called directly
if ( ! defined('ABSPATH') ){
    exit;
}


// register plugin settings
function myPlugin_register_settings(){

    /*

    register_setting(
        string $option_group,
        string $option_name,
        callable $sanitize_callback
    );

    */

    register_setting(
        'myPlugin_options',
        'myPlugin_options',
        'myplugin_callback_validate_options'
    );

    /*

    add_settings_section(
        string $id,
        string $title,
        callable $callback,
        string $page
    );

    */

    add_settings_section(
        'myPlugin_section_login',
        'Customize Login Page',
        'myPlugin_callback_section_login',
        'myPlugin'
    );

    add_settings_section(
        'myPlugin_section_admin',
        'Customize Admin Page',
        'myPlugin_callback_section_admin',
        'myPlugin'
    );

    /*

    add_settings_field(
        string $id,
        string $title,
        callable $callback,
        string $page,
        string $section = 'default',
        array $args = []
    );

    */

    add_settings_field(
        'custome_url',
        'Custome URL',
        'myPlugin_callback_field_text',
        'myPlugin',
        'myPlugin_section_login',
        [ 'id' => 'custome_url' , 'lable' => 'Custome URL for the login logo link' ]
    );

    add_settings_field(
        'custome_title',
        'Custome Title',
        'myPlugin_callback_field_text',
        'myPlugin',
        'myPlugin_section_login',
        [ 'id' => 'custome_title' , 'lable' => 'Custome Title attribute for the logo link' ]
    );

    add_settings_field(
        'custome_style',
        'Custome Style',
        'myPlugin_callback_radio_field',
        'myPlugin',
        'myPlugin_section_login',
        [ 'id' => 'custome_style' , 'lable' => 'Custome CSS for Login screen' ]
    );

    add_settings_field(
        'custome_message',
        'Custome Message',
        'myPlugin_callback_field_textarea',
        'myPlugin',
        'myPlugin_section_login',
        [ 'id' => 'custome_message' , 'lable' => 'Custome text and/or markup' ]
    );

    add_settings_field(
        'custome_footer',
        'Custome Footer',
        'myPlugin_callback_field_text',
        'myPlugin',
        'myPlugin_section_admin',
        [ 'id' => 'custome_footer' , 'lable' => 'Custome footer text' ]
    );

    add_settings_field(
        'custome_toolbar',
        'Custome Toolbar',
        'myPlugin_callback_field_checkbox',
        'myPlugin',
        'myPlugin_section_admin',
        [ 'id' => 'custome_toolbar' , 'lable' => 'Remove new post and comment links from the Toolbar' ]
    );

    add_settings_field(
        'custome_scheme',
        'Custome Scheme',
        'myPlugin_callback_field_select',
        'myPlugin',
        'myPlugin_section_admin',
        [ 'id' => 'custome_scheme' , 'lable' => 'Default color scheme for new users' ]
    );
}
add_action( 'admin_init' , 'myPlugin_register_settings' );
