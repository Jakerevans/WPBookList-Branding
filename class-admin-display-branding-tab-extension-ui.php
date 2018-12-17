<?php
/**
 * BRANDING 'Settings' Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes/UI/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'BRANDING_General_Settings_Tab', false ) ) :
/**
 * BRANDING_General_Settings_Tab.
 */
class BRANDING_General_Settings_Tab {

    public function __construct() {
    	require_once(BRANDING_CLASSES_UI_DISPLAY_DIR.'class-ui-display-template.php');
    	require_once(BRANDING_CLASSES_UI_DISPLAY_DIR.'class-general-settings-form.php');
    	// Instantiate the class
		$this->template = new BRANDING_UI_Display_Template;
		$this->form = new BRANDING_Create_General_Settings_Form('initial');
		$this->output_open_display_container();
		$this->output_tab_content();
		$this->output_close_display_container();
		$this->output_display_template_advert();
    }

    private function output_open_display_container(){
        $icon_url = BRANDING_ROOT_IMG_ICONS_URL.'computer.svg';
        $title = 'Branding Options';
    	echo $this->template->output_open_display_container($title, $icon_url).'<div style="display:none;" id="branding-special-for-editor"></div>';
    }

    private function output_tab_content(){
    	echo $this->form->initial_output;
    }

    private function output_close_display_container(){
    	echo $this->template->output_close_display_container();
    }

    private function output_display_template_advert(){
    	echo $this->template->output_template_advert();
    }

}

endif;


// Instantiate the class
$am = new BRANDING_General_Settings_Tab;