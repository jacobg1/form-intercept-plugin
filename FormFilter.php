<?php 
/** 
	* Plugin Name: Form Filter
*/
include 'FormFilterSettings.php';

class FormFilter {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array($this, 'localize_variables' ) );
	}


	public function localize_variables() {
		$admin_post_url = esc_url( admin_url('admin-post.php') );

		// pull list of form ids from database
		// remove any special characters and split into array
		$formIds = get_option( 'list_of_form_ids' );
		$formIds = preg_replace( '/\s+/', '', $formIds );
		$formIds = explode( ",", $formIds );

		wp_enqueue_script( 'form_filter_scripts', plugin_dir_url( __FILE__ ) . 'js/formFilter.js', false, '', true );
		
		// localize variables 
		wp_localize_script('form_filter_scripts', 'formFilter', array(
    	'adminPost' => $admin_post_url,
			'formIds' => $formIds
		));
	}
}

new FormFilter();

?>