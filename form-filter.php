<?php
	/** 
	 * Plugin Name: Form Filter
	*/

	class Form_Fiter_Plugin {

		// hook into admin menu action
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
			add_action( 'admin_init', array( $this, 'setup_sections' ) );
			add_action( 'admin_init', array( $this, 'setup_fields' ) );
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
			switch( $args['id'] ) {
				case 'our_first_section':
					echo 'This is the first section!';
					break;
				case 'our_second_section':
					echo 'This is the second section!';
					break;
				case 'our_third_section':
					echo 'This is the third section!';
					break;
			}
		}

		public function setup_fields() {
    	add_settings_field( 'our_first_field', 'First Fields', array( $this, 'field_callback' ), 'form_filter_fields', 'our_first_section' );
			register_setting( 'form_filter_fields', 'our_first_field' );
		}

		public function field_callback( $args ) {
			var_dump($args);
			echo '<input name="our_first_field" id="our_first_field" type="text" value="' . get_option( 'our_first_field' ) . '" />';
		}
	}

	new Form_Fiter_Plugin();

?>