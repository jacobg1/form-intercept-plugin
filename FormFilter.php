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
		$admin_url = esc_url( admin_url('admin-post.php') );
		wp_enqueue_script( 'form_filter_scripts', plugin_dir_url( __FILE__ ) . 'js/formFilter.js' );

	}
}

new FormFilter();

?>