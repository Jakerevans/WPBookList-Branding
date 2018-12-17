<?php
/**
 * BRANDING Create Pop-Up Form Class
 *
 * @author   Jake Evans
 * @category Display
 * @package  Includes/Classes/UI/Display
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'BRANDING_Create_General_Settings_Form', false ) ) :
/**
 * BRANDING_Create_General_Settings_Form.
 */
class BRANDING_Create_General_Settings_Form {


	public function __construct($form) {

		$this->output_create_general_settings_form();


	}


	private function output_create_general_settings_form(){

		global $wpdb;
		$table_name = $wpdb->prefix . 'wpbooklist_branding_table';
		$opt_results = $wpdb->get_row("SELECT * FROM $table_name");

		// For grabbing an image from media library
		wp_enqueue_media();

		$string1 = '<div id="branding-create-popup-container">
					
						<p>To Brand your WPBookList Plugin, simply choose the logos and text you\'d like to be displayed below, click the \'Save Branding Options\' button, and that\'s it!</p>

						<p class="wpbooklist-branding-title">Book View \'Loading\' Options (displayed as the Book View loads)</p>
						<div class="wpbooklist-branding-loading-div">
							<label class="wpbooklist-branding-input-label">Text:  </label><input id="wpbooklist-branding-input-text-1" type="text" value="'.$opt_results->brandingtext1.'"/><br/><br/>
							<label>Logo URL:  </label><input type="text" id="wpbooklist-branding-image-url-1" name="book-image" value="'.$opt_results->brandinglogo1.'"><input id="wpbooklist-branding-img-button-1" type="button" value="Choose Image"/><img id="wpbooklist-branding-preview-img-1" data-active="false" src="'.$opt_results->brandinglogo1.'">
						</div>

						<p class="wpbooklist-branding-title">Book View \'Loaded\' Options (displayed once the Book View is done loading)</p>
						<div class="wpbooklist-branding-loading-div">
							<label class="wpbooklist-branding-input-label">Text:  </label><input id="wpbooklist-branding-input-text-2" type="text" value="'.$opt_results->brandingtext2.'"/><br/><br/>
							<label>Logo URL:  </label><input type="text" id="wpbooklist-branding-image-url-2" name="book-image" value="'.$opt_results->brandinglogo2.'"><input id="wpbooklist-branding-img-button-2" type="button" value="Choose Image"/><img id="wpbooklist-branding-preview-img-2" data-active="false" src="'.$opt_results->brandinglogo2.'">
						</div>
						<button type="button" id="wpbooklist-admin-branding-save-button">'.__('Save Branding Options','wpbooklist').'</button>
                		<div class="wpbooklist-spinner" id="wpbooklist-spinner-1"></div>
                		<div id="wpbooklist-addbook-success-div" data-bookid="" data-booktable="">

                		</div>
					</div>';


		$this->initial_output = $string1;

	}



  
}

endif;