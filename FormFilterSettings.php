<?php

	class Form_Fiter_Plugin_Settings {

		// hook into admin menu action
		public function __construct() {
			$this->slug = 'form_filter_fields';
			add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
			add_action( 'admin_init', array( $this, 'setup_sections' ) );
			add_action( 'admin_init', array( $this, 'setup_fields' ) );
		}

		public function create_plugin_settings_page() {
			$page_title = 'Form Filter Settings Page';
			$menu_title = 'Form Fitler Plugin';
			$capability = 'manage_options';
			// $slug = 'form_filter_fields';
			$callback = array( $this, 'plugin_settings_page_content' );
			$icon = 'dashicons-admin-plugin';
			$position = 100;

			add_menu_page( $page_title, $menu_title, $capability, $this->slug, $callback, $icon, $position );
		}

		public function plugin_settings_page_content() { ?>
			<div class="wrap">
				<h2>Form Filter Plugin</h2>
				<?php settings_errors(); ?>
				<form method="post" action="options.php">
					<?php
						settings_fields( $this->slug );
						do_settings_sections( $this->slug );
						submit_button();
					?>
				</form>
			</div> <?php
		}

		public function setup_sections() {
			add_settings_section( 'first_section', 'Iterable Integration Settings', array( $this, 'section_callback' ), $this->slug );
			// add_settings_section( 'our_second_section', 'My Second Section Title', array( $this, 'section_callback' ), $this->slug );
			// add_settings_section( 'our_third_section', 'My Third Section Title', array( $this, 'section_callback' ), $this->slug );
		}

		public function section_callback($args) {
			switch( $args['id'] ) {
				case 'first_section':
					echo 'Set up Iterable form integration';
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
    	// add_settings_field( 'our_first_field', 'First Fields', array( $this, 'field_callback' ), $this->slug, 'first_section' );
			// register_setting( $this->slug, 'our_first_field' );
			$fields = array(
				array(
					'uid' => 'iterable_api_key',
					'label' => 'Iterable API Key',
					'section' => 'first_section',
					'type' => 'text',
					'options' => 'false',
					'placeholder' => 'Enter API Key',
					// 'helper' => 'Helper Text',
					'supplemental' => 'Enter your Iterable API Key.',
					// 'default' => '**************'
				),
				array(
					'uid' => 'iterable_list_id',
					'label' => 'Iterable List Id',
					'section' => 'first_section',
					'type' => 'text',
					'options' => 'false',
					'placeholder' => 'Enter List Id',
					// 'helper' => 'Helper Text',
					'supplemental' => 'Enter your Iterable List Id.',
					// 'default' => '**************'
				),
				array(
					'uid' => 'list_of_form_ids',
					'label' => 'My Text Area',
					'section' => 'first_section',
					'type' => 'textarea',
					'options' => false,
					// 'placeholder' => 'Ex: form_id_1',
					// 'helper' => 'This is helper text',
					'supplemental' => 'Enter form ids, separated by a comma.',
					// 'default' => 'hello text area'
				),
				// array(
				// 	'uid' => 'our_third_field',
				// 	'label' => 'Select Field',
				// 	'section' => 'first_section',
				// 	'type' => 'select',
				// 	'options' => array(
				// 		'yes' => 'Yes!!',
				// 		'no' => 'No way dude!',
				// 		'maybe' => 'Maybe?!'
				// 	),
				// 	'placeholder' => 'This is placeholder text',
				// 	'helper' => 'some more helper text',
				// 	'supplemental' => 'I am underneath!',
				// 	'default' => 'maybe'
				// )
			);
			foreach( $fields as $field ) {
				add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), $this->slug, $field['section'], $field );
				register_setting( $this->slug, $field['uid'] );
			}
		}

		public function field_callback( $args ) {
			$value = get_option( $args['uid'] );

			if( ! $value ) {
				$value = $args['default'];
			}

			switch( $args['type'] ) {
				case 'text':
					printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $args['uid'], $args['type'], $args['placeholder'], $value );
					break;
				case 'textarea':
					printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $args['uid'], $args['placeholder'], $value );
					break;
				case 'select':
					if( ! empty( $args['options'] ) && is_array( $args['options'] ) ) {
						$options_markup = '';
						foreach( $args['options'] as $key => $label) {
							$options_markup .= sprintf('<option value="%s" %s>%s</option>', $key, selected( $value, $key, false), $label);
						}
						printf('<select name="%1$s" id="%1$s">%2$s</select>', $args['uid'], $options_markup );
					}
					break;	
			}

			if( $helper = $args['helper'] ) {
				printf( '<span class="helper">%s</span>', $helper );
			}

			if( $supplemental = $args['supplemental'] ) {
				printf( '<p class="description">%s</p>', $supplemental );
			}
		}
	}

	new Form_Fiter_Plugin_Settings();

?>