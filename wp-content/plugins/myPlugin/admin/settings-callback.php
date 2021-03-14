<?php // MyPlugin - Settings Callback

// exit if file is called directly
if ( ! defined('ABSPATH') ){
    exit;
}


// validate plugin settings
function myplugin_callback_validate_options( $inputs ){
   // custom url
   if( isset( $input['custome_url'] ) ){
        $input['custom_url'] = esc_url( $input['custom_url'] );
   }

   // custom title
   if( isset( $input['custome_title'] ) ){
        $input['custome_title'] = sanitize_text_field( $input['custome_title'] );
   }

   // custom style
   $radio_options = array(
       'enable' => 'Enable custom styles',
       'disable' => 'Disable custom styles'
   );

   if( ! isset( $input['custome_style'] ) ){
        $input['custome_style'] = null;
   }
   if( ! array_key_exists( $input['custome_style'] , $radio_options ) ) {
        $input['custome_style'] = null;
   }

   // custom message 
   if( isset( $input['custome_message'] ) ){
        $input['custome_message'] = wp_kses_post( $input['custome_message'] );
   }

   // custom footer
   if( isset( $input['custome_footer'] ) ){
        $input['custome_footer'] = sanitize_text_field( $input['custome_footer'] );
   }

   // custom toolbar
   if( ! isset( $input['custome_toolbar'] ) ){
        $input['custome_toolbar'] = null;
   }
   $input['custome_toolbar'] = ($input['custome_toolbar'] == 1 ? 1 : 0);

   // custom scheme
   $select_options = array(
    'default' => 'Default',
    'light' => 'Light',
    'blue' => 'Blue',
    'coffee' => 'Coffee',
    'ectoplasm' => 'Ectoplasm',
    'midnight' => 'Midnight',
    'ocean' => 'Ocean',
    'sunrise' => 'Sunrise'
   );

   if( ! isset( $input['custom_scheme'] ) ){
        $input['custom_scheme'] = null;
   }
   if( ! array_key_exists( $input['custom_scheme'] , $select_options) ){
        $input['custom_scheme'] = null;
   }
   
   return $input;
}

// callback: login section
function myPlugin_callback_section_login(){
    echo '<p> These settings enable you to customize the WP Login section. </p>';
}

// callback: admin section
function myPlugin_callback_section_admin(){
    echo '<p> These settings enable you to customize the WP Admin section. </p>';
}

//callback: text field
function myPlugin_callback_field_text( $args ){

   $options = get_option( 'myPlugin_options' , myPlugin_options_default() );
    $id = isset( $args['id'] ) ? $args['id'] : '';
    $lable = isset( $args['lable'] ) ? $args['lable'] : '';

    $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    echo '<input id="myPlugin_options_'. $id .'" name="myPlugin_options['. $id .']" type="text" size="40" value="'.$value.'"><br/>';
    echo '<lable for="myPlugin_options_'. $id .'">'. $lable .'</lable>';
}

//callback: radio field
function myPlugin_callback_radio_field( $args ){

    $options = get_option( 'myPlugin_options' , myPlugin_options_default() );
     $id = isset( $args['id'] ) ? $args['id'] : '';
     $lable = isset( $args['lable'] ) ? $args['lable'] : '';
 
     $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
     $radio_options = array(
        'enable' => 'Enable custom styles',
        'disable' => 'Disable custom styles'
     );
     
     foreach( $radio_options as $value => $lable ){

         $checked = checked( $selected_option == $value, true , false);
         echo '<lable><input name="myPlugin_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
         echo '<span>'. $lable . '</span></lable><br/>';

     }
}

//callback: textarea field
function myPlugin_callback_field_textarea( $args ){

    $options = get_option( 'myPlugin_options' , myPlugin_options_default() );
    $id = isset( $args['id'] ) ? $args['id'] : '';
    $lable = isset( $args['lable'] ) ? $args['lable'] : '';

    $allowed_tags = wp_kses_allowed_html( 'post' );

    $value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';

    echo '<textarea id="myPlugin_options_'. $id .'" name="myPlugin_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br/>';
    echo '<lable for="myPlugin_options_'. $id .'">'. $lable .'</lable>';
}

//callback: checkbox field
function myPlugin_callback_field_checkbox( $args ){

    $options = get_option( 'myPlugin_options' , myPlugin_options_default() );
    $id = isset( $args['id'] ) ? $args['id'] : '';
    $lable = isset( $args['lable'] ) ? $args['lable'] : '';

    $checked = checked( $options[$id] ) ? checked( $options[$id] , 1 ,false ) : '';

    echo '<input id="myPlugin_options_'. $id .'" name="myPlugin_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
    echo '<lable for="myPlugin_options_'. $id .'">'. $lable .'</lable>';
}

//callback: select field
function myPlugin_callback_field_select( $args ){

    $options = get_option( 'myPlugin_options' , myPlugin_options_default() );
    $id = isset( $args['id'] ) ? $args['id'] : '';
    $lable = isset( $args['lable'] ) ? $args['lable'] : '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
    $select_options = array(
       'default' => 'Default',
       'light' => 'Light',
       'blue' => 'Blue',
       'coffee' => 'Coffee',
       'ectoplasm' => 'Ectoplasm',
       'midnight' => 'Midnight',
       'ocean' => 'Ocean',
       'sunrise' => 'Sunrise'
    );

    echo '<select id="myPlugin_options_'. $id .'" name="myPlugin_options['. $id .']"> ';
    foreach( $select_options as $value => $option ){
        $selected = selected( $selected_option === $value, true , false );
        echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
    }
    echo '</select> <lable for="myPlugin_options_'. $id .'">'. $lable .'</lable>';
}
