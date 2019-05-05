<?php
	/** 
	 * Plugin Name: Form Filter
	*/

	class Form_Fiter_Plugin {

		// hook into admin menu action
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
			add_action( 'admin_init', array( $this, 'setup_sections' ) );
		}

		public function create_plugin_settings_page() {
			$page_title = 'Form Filter Settings Page';
			$menu_title = 'Form Fitler Plugin';
			$capability = 'manage_options';
			$slug = 'form_filter_fields';
			$callback = array( $this, 'plugin_settings_page_content' );
			$icon = 'dashicons-admin-plugin';
			$position = 100;

			add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
		}

		public function plugin_settings_page_content() { ?>
			<div class="wrap">
				<h2>Form Filter Plugin</h2>
				<form method="post" action="options.php">
					<?php
						settings_fields( 'form_filter_fields' );
						do_settings_sections( 'form_filter_fields' );
						submit_button();
					?>
				</form>
			</div> <?php
		}

		public function setup_sections() {
			add_settings_section( 'our_first_section', 'My First Section Title', array( $this, 'section_callback' ), 'form_filter_fields');
			add_settings_section( 'our_second_section', 'My Second Section Title', array( $this, 'section_callback' ), 'form_filter_fields');
			add_settings_section( 'our_third_section', 'My Third Section Title', array( $this, 'section_callback' ), 'form_filter_fields');
		}

		public function section_callback($args) {
			echo 'Hello World';
		}
	}

	new Form_Fiter_Plugin();

?>