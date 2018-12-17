<?php


function branding_save_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$(document).on("click","#wpbooklist-admin-branding-save-button", function(event){

	  		$('#wpbooklist-spinner-1').animate({'opacity':'1'});

	  		var text1 = $('#wpbooklist-branding-input-text-1').val()
	  		var text2 = $('#wpbooklist-branding-input-text-2').val()
	  		var img1 = $('#wpbooklist-branding-image-url-1').val()
	  		var img2 = $('#wpbooklist-branding-image-url-2').val()


		  	var data = {
				'action': 'branding_save_action',
				'security': '<?php echo wp_create_nonce( "branding_save_action_callback" ); ?>',
				'img1':img1,
				'img2':img2,
				'text1':text1,
				'text2':text2
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {

			    	console.log(response);
			    	if(response == 1){
			    		$('#wpbooklist-spinner-1').animate({'opacity':'0'});
			    		$('#wpbooklist-addbook-success-div').html("<span id='wpbooklist-add-book-success-span'>Success!</span><br/><br/>You've just saved your WPBookList Branding Options!<div id='wpbooklist-addstylepak-success-thanks'>Thanks for using WPBookList, and&nbsp;<a href='http://wpbooklist.com/index.php/extensions/'>be sure to check out the other WPBookList Extensions!</a><br/><br/>If you happen to be thrilled with WPBookList, then by all means,&nbsp;<a id='wpbooklist-addbook-success-review-link' href='https://wordpress.org/support/plugin/wpbooklist/reviews/?filter=5'>Feel Free to Leave a 5-Star Review Here!</a><img id='wpbooklist-smile-icon-1' src='http://evansclienttest.com/wp-content/plugins/wpbooklist/assets/img/icons/smile.png'></div>")
			    	} else {
			    		$('#wpbooklist-addbook-success-div').html("<span id='wpbooklist-add-book-success-span'>Uh-Oh!</span><br/><br/>Looks like there was an error saving your WPBookList Branding Options!<div id='wpbooklist-addstylepak-success-thanks'>&nbsp;Please reload the page and try again.</div>")
			    	}

			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for 
function branding_save_action_callback(){
	global $wpdb;
	check_ajax_referer( 'branding_save_action_callback', 'security' );
	$img1 = filter_var($_POST['img1'],FILTER_SANITIZE_URL);
	$img2 = filter_var($_POST['img2'],FILTER_SANITIZE_URL);
	$text1 = filter_var($_POST['text1'],FILTER_SANITIZE_STRING);
	$text2 = filter_var($_POST['text2'],FILTER_SANITIZE_STRING);


	$table_name = $wpdb->prefix . 'wpbooklist_branding_table';
	$data = array(
        'brandingtext1' => $text1, 
        'brandingtext2' => $text2, 
        'brandinglogo1' => $img1, 
        'brandinglogo2' => $img2, 
    );
    $format = array( '%s');  
    $where = array( 'ID' => ( 1 ) );
    $where_format = array( '%d' );
    $result = $wpdb->update( $table_name, $data, $where, $format, $where_format );
	echo $result;
	wp_die();
}





/*
 * Below is a boilerplate ajax function and callback, 
 * complete with console.logs and echos to verify functionality
 */

/*
// For 
add_action( 'admin_footer', 'branding_save_action_javascript' );
add_action( 'wp_ajax_branding_save_action', 'branding_save_action_callback' );
add_action( 'wp_ajax_nopriv_branding_save_action', 'branding_save_action_callback' );


function branding_save_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$(document).on("click",".branding-trigger-actions-checkbox", function(event){

		  	var data = {
				'action': 'branding_save_action',
				'security': '<?php echo wp_create_nonce( "branding_save_action_callback" ); ?>',
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for 
function branding_save_action_callback(){
	global $wpdb;
	check_ajax_referer( 'branding_save_action_callback', 'security' );
	//$var1 = filter_var($_POST['var'],FILTER_SANITIZE_STRING);
	//$var2 = filter_var($_POST['var'],FILTER_SANITIZE_NUMBER_INT);
	echo 'hi';
	wp_die();
}*/




?>