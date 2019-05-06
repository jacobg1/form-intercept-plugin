<?php 
/** 
	* Plugin Name: Form Filter
*/
include 'FormFilterSettings.php';

class FormFilter {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'localize_variables' ) );
		add_action( 'wp_ajax_test_action', array( $this, 'form_handler') );
	}

	public function localize_variables() {
		$admin_post_url = esc_url( admin_url('admin-ajax.php') );

		// pull list of form ids from database
		// remove any special characters and split into array
		$formIds = get_option( 'list_of_form_ids' );
		$formIds = preg_replace( '/\s+/', '', $formIds );
		$formIds = explode( ",", $formIds );

		wp_enqueue_script( 'form_filter_scripts', plugin_dir_url( __FILE__ ) . 'js/formFilter.js', false, '', true );
		
		// localize variables 
		wp_localize_script('form_filter_scripts', 'formFilter', array(
    	'adminAjax' => $admin_post_url,
			'formIds' => $formIds
		));
	}

	public function form_handler() {
		if ( ! empty( $_POST ) ) {
			// echo 'test';
			var_export($_POST);
			// Sanitize the POST field
			// Generate email content
			// Send to appropriate email
			// wp_redirect('/homepage', $_POST);
			wp_die();
		}
		
	}
}

new FormFilter();

?>