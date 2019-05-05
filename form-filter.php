<?php
	/** 
	 * Plugin Name: Form Filter
	*/

	class Form_Fiter_Plugin {

		// hook into admin menu action
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
		}

		public function create_plugin_settings_page() {
			$page_title = 'Form Filter Settings Page';
			$menu_title = 'Form Fitler Plugin';
			$capability = 'manage_options';
			$slug = 'form_filter';
			$callback = array( $this, 'plugin_settings_page_content' );
			$icon = 'dashicons-admin-plugin';
			$position = 100;

			add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
		}

		public function plugin_settings_page_content() {
			echo 'Hello World';
		}
	}

	new Form_Fiter_Plugin();

?>