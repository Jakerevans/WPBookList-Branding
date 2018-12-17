<?php

/**
 * Verifies that the core WPBookList plugin is installed and activated - otherwise, the Extension doesn't load and a message is displayed to the user.
 */
function wpbooklist_branding_core_plugin_required() {

  // Require core WPBookList Plugin.
  if ( ! is_plugin_active( 'wpbooklist/wpbooklist.php' ) && current_user_can( 'activate_plugins' ) ) {

    // Stop activation redirect and show error.
    wp_die( 'Whoops! This WPBookList Extension requires the Core WPBookList Plugin to be installed and activated! <br><a target="_blank" href="https://wordpress.org/plugins/wpbooklist/">Download WPBookList Here!</a><br><br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
  }
}

function branding_add_ajax_library() {
 
    $html = '<script type="text/javascript">';

    // checking $protocol in HTTP or HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        // this is HTTPS
        $protocol  = "https";
    } else {
        // this is HTTP
        $protocol  = "http";
    }
    $tempAjaxPath = admin_url( 'admin-ajax.php' );
    $goodAjaxUrl = $protocol.strchr($tempAjaxPath,':');

    $html .= 'var ajaxurl = "' . $goodAjaxUrl . '"';
    $html .= '</script>';
    echo $html;
    
} // End add_ajax_library

// Adding the front-end ui css file for this extension
function branding_frontend_ui_style() {
    wp_register_style('branding-frontend-ui', BRANDING_ROOT_CSS_URL.'branding-frontend-ui.css' );
    wp_enqueue_style('branding-frontend-ui');
}

// Code for adding the general admin CSS file
function branding_admin_style() {
  if(current_user_can('administrator' )){
      wp_register_style('branding-admin-ui', BRANDING_ROOT_CSS_URL.'branding-admin-ui.css');
      wp_enqueue_style('branding-admin-ui');
  }
}

//Function to add the admin menu
function branding_admin_menu() {
  add_menu_page( 'BRANDING Options', 'BRANDING', 'manage_options', 'BRANDING-Options', 'branding_admin_page_function', BRANDING_ROOT_IMG_URL.'brandingdashboardicon.png', 6  );

  $submenu_array = array(
    "Settings"
  );

  // Filter to allow the addition of a new subpage
  if(has_filter('branding_add_sub_menu')) {
    $submenu_array = apply_filters('branding_add_sub_menu', $submenu_array);
  }

  foreach($submenu_array as $key=>$submenu){
    $menu_slug = strtolower(str_replace(' ', '-', $submenu));
    add_submenu_page('BRANDING-Options', 'BRANDING', $submenu, 'manage_options', 'BRANDING-Options-'.$menu_slug, 'branding_admin_page_function');
  }

  remove_submenu_page('BRANDING-Options', 'BRANDING-Options');

}

function branding_admin_page_function(){
  global $wpdb;
  require_once(BRANDING_CLASSES_UI_ADMIN_DIR.'class-admin-master-ui.php');
}

// Function to add table names to the global $wpdb
function branding_register_table_name() {
    global $wpdb;
    $wpdb->wpbooklist_branding_table = "{$wpdb->prefix}wpbooklist_branding_table";

}

// Runs once upon plugin activation and creates tables
function branding_create_tables() {
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  global $wpdb;
  global $charset_collate; 

  // Call this manually as we may have missed the init hook
  branding_register_table_name();
  
  $sql_create_table1 = "CREATE TABLE {$wpdb->wpbooklist_branding_table} 
  (
        ID bigint(190) auto_increment,
        brandinglogo1 varchar(255),
        brandingtext1 varchar(255),
        brandinglogo2 varchar(255),
        brandingtext2 varchar(255),
        PRIMARY KEY  (ID),
          KEY brandinglogo1 (brandinglogo1)
  ) $charset_collate; ";
  dbDelta( $sql_create_table1 );

  
  $table_name = $wpdb->prefix . 'wpbooklist_branding_table';
  $wpdb->insert( $table_name, array('ID' => 1));




}

function branding_jre_admin_pointers_javascript(){
  wp_enqueue_style( 'wp-pointer' );
  wp_enqueue_script( 'wp-pointer' );
  wp_enqueue_script( 'utils' ); // for user settings
  ?>
  <script type="text/javascript" >
  "use strict";
  jQuery(document).ready(function($) {
    // Clicking on 'Approve Checked Comments' button
    $('body').on('mouseenter', ".branding-icon-image", function () {
      var label = $(this).attr('data-label');
      var pointer;

      switch(label) {
        case 'plaintexthtml':
            pointer = $(this).pointer({
              content: '<h3>Blah Blah</h3><p class="branding-admin-pointer">Blahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblahblah</p>',
              position: {
                  edge: 'right',
                  align: 'right',
              },
              close: function() {
                  //
              }
            })
            break;
        default:
            //code block
      }
      
      // open the pointer on mouseenter
      pointer.pointer('open');

      // close the pointer on mouseleave
      $('body').on('mouseleave', ".branding-icon-image", function () {
        pointer.pointer('close');
      });

    });
  });
  </script>
  <?php
}

/*
 * Below is a boilerplate function with Javascript
 *
/*

// For 
add_action( 'admin_footer', 'branding_boilerplate_javascript' );

function branding_boilerplate_action_javascript() { 
  ?>
    <script type="text/javascript" >
    "use strict";
    jQuery(document).ready(function($) {
      $(document).on("click",".branding-trigger-actions-checkbox", function(event){

        event.preventDefault ? event.preventDefault() : event.returnValue = false;
      });
  });
  </script>
  <?php
}
*/

?>