<?php

/**
 * Admin
 * 
 * Admin class handles all the adminstration functionality. Adds menues and sub menues. Loads admin
 * views. Generates form fields.
 *
 * @author     James Sedillo <jin91706@yahoo.com>
 */

namespace Admin;


class Admin {

	/**
	 * This variable holds the value of the main plugin file.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      __FILE__    $plugin    The main plugin file.
	 */
	private $plugin;

	public function __construct($plugin = '') {

		$this->plugin = $plugin;

		add_action( 'admin_menu', array($this, 'add_admin_menu') );
		add_action('admin_init', array($this, 'setup_sections'));
		add_action('admin_init', array($this, 'setup_fields'));
		
	}

	public function add_admin_menu() {

		// Main Menu Item
	  	add_menu_page(
			'Email and Pages',
			'Email and Pages',
			'manage_options',
			'email_page',
			array($this, 'display_custom_plugin_admin_page'),
			'dashicons-store',
			1);

		// Sub Menu Item One
		add_submenu_page(
			'email_page',
			'Settings',
			'Settings',
			'manage_options',
			'email_page',
			array($this, 'display_custom_plugin_admin_page')
		);
		// Sub Menu Item Two
		add_submenu_page(
			'email_page',
			'Secondary Page',
			'Secondary Page',
			'manage_options',
			'email_page/settings-page-two',
			array($this, 'display_custom_plugin_admin_page_two')
		);
	}

	/**
	 * Callback function for displaying the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function display_custom_plugin_admin_page(){

		require_once plugin_dir_path($this->plugin) . 'src/Views/admin/display.php';
	}

	/**
	 * Callback function for displaying the second sub menu item page.
	 *
	 * @since    1.0.0
	 */
	public function display_custom_plugin_admin_page_two(){

		require_once plugin_dir_path($this->plugin) . 'src/Views/admin/two-display.php';
	}

	/**
	 * Setup sections in the settings
	 *
	 * @since    1.0.0
	 */
	public function setup_sections() {
		add_settings_section( 'section_one', 'Section One', array($this, 'section_callback'), 'wordpress-custom-plugin-options' );
		add_settings_section( 'section_two', 'Section Two', array($this, 'section_callback'), 'wordpress-custom-plugin-options' );
	}

	/**
	 * Callback for each section
	 *
	 * @since    1.0.0
	 */
	public function section_callback( $arguments ) {
		switch( $arguments['id'] ){
			case 'section_one':
				echo '<p>This is settings for section one, you can put some more information here if needed.</p>';
				break;
			case 'section_two':
				echo '<p>Section two! More information on this section can go here.</p>';
				break;
		}
	}

	/**
	 * Field Configuration, each item in this array is one field/setting we want to capture
	 *
	 * @since    1.0.0
	 */
	public function setup_fields() {
		$fields = array(
			// array(
			// 	'uid' => 'custom_plugin_image_example',
			// 	'label' => 'Image Example',
			// 	'section' => 'section_one',
			// 	'type' => 'image',
			// 	'helper' => 'This is where some helper text could go for this image settings',
			// 	'supplemental' => '',
			// 	'default' => plugin_dir_url($this->plugin) . 'public/img/markus-spiske-109588-unsplash.jpg',
			// ),
			array(
				'uid' => 'custom_plugin_text_example',
				'label' => 'Save a value',
				'section' => 'section_one',
				'type' => 'text',
				'placeholder' => 'Save Something',
				'helper' => 'You can enter some helper text here on what to do with this field.',
				'supplemental' => 'Here we can tell the user what format to enter if needed.',
				'default' => "",
			)
			// array(
			// 	'uid' => 'custom_plugin_checkbox_example',
			// 	'label' => 'Checkbox Example',
			// 	'section' => 'section_one',
			// 	'type' => 'checkbox',
			// 	'helper' => 'Click this checkbox to select it.',
			// 	'supplemental' => '',
			// 	'options' => array(
			// 		'selected' => 'Select this checkbox.',
			// 	),
			// 	'default' => array(),
			// ),
			// array(
			// 	'uid' => 'custom_plugin_password_example',
			// 	'label' => 'Sample Password Field',
			// 	'section' => 'section_one',
			// 	'type' => 'password',
			// ),
			// array(
			// 	'uid' => 'custom_plugin_number_example',
			// 	'label' => 'Sample Number Field',
			// 	'section' => 'section_two',
			// 	'type' => 'number',
			// ),
			// array(
			// 	'uid' => 'custom_plugin_textarea_example',
			// 	'label' => 'Sample Text Area',
			// 	'section' => 'section_two',
			// 	'type' => 'textarea',
			// ),
			// array(
			// 	'uid' => 'custom_plugin_select_example',
			// 	'label' => 'Sample Select Dropdown',
			// 	'section' => 'section_two',
			// 	'type' => 'select',
			// 	'options' => array(
			// 		'option1' => 'Option 1',
			// 		'option2' => 'Option 2',
			// 		'option3' => 'Option 3',
			// 		'option4' => 'Option 4',
			// 		'option5' => 'Option 5',
			// 	),
			// 	'default' => array()
			// ),
			// array(
			// 	'uid' => 'custom_plugin_multiselect_example',
			// 	'label' => 'Sample Multi Select',
			// 	'section' => 'section_two',
			// 	'type' => 'multiselect',
			// 	'options' => array(
			// 		'option1' => 'Option 1',
			// 		'option2' => 'Option 2',
			// 		'option3' => 'Option 3',
			// 		'option4' => 'Option 4',
			// 		'option5' => 'Option 5',
			// 	),
			// 	'default' => array()
			// ),
			// array(
			// 	'uid' => 'custom_plugin_radio_example',
			// 	'label' => 'Sample Radio Buttons',
			// 	'section' => 'section_two',
			// 	'type' => 'radio',
			// 	'options' => array(
			// 		'option1' => 'Option 1',
			// 		'option2' => 'Option 2',
			// 		'option3' => 'Option 3',
			// 		'option4' => 'Option 4',
			// 		'option5' => 'Option 5',
			// 	),
			// 	'default' => array()
			// ),
			// array(
			// 'uid' => 'custom_plugin_checkboxes_example',
			// 'label' => 'Sample Checkboxes',
			// 'section' => 'section_two',
			// 'type' => 'checkbox',
			// 'options' => array(
			// 	'option1' => 'Option 1',
			// 	'option2' => 'Option 2',
			// 	'option3' => 'Option 3',
			// 	'option4' => 'Option 4',
			// 	'option5' => 'Option 5',
			// ),
			// 'default' => array()
			// )
		);
		
		foreach( $fields as $field ){
			add_settings_field( $field['uid'], $field['label'], array($this, 'field_callback'), 'wordpress-custom-plugin-options', $field['section'], $field );
			register_setting( 'wordpress-custom-plugin-options', $field['uid'] );
		}
	}

	/**
	 * This handles all types of fields for the settings
	 *
	 * @since    1.0.0
	 */
	public function field_callback($arguments) {
		
		$value = get_option( $arguments['uid'] );
		
		if(!$value) {
			$value = $arguments['default'];
		}
		
		switch( $arguments['type'] ){
			case 'text':
			case 'password':
			case 'number':
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
				break;
			case 'textarea':
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
				break;
			case 'select':
			case 'multiselect':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$attributes = '';
					$options_markup = '';
					foreach( $arguments['options'] as $key => $label ){
						$options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
					}
					if( $arguments['type'] === 'multiselect' ){
						$attributes = ' multiple="multiple" ';
					}
					printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
				}
				break;
			case 'radio':
			case 'checkbox':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$options_markup = '';
					$iterator = 0;
					foreach( $arguments['options'] as $key => $label ){
						$iterator++;
						$is_checked = '';
						
						if(isset($value[ array_search( $key, $value, true ) ])) {
							$is_checked = checked( $value[ array_search( $key, $value, true ) ], $key, false );
						} else {
							$is_checked = "";
						}
						
						$options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, $is_checked, $label, $iterator );
					}
					printf( '<fieldset>%s</fieldset>', $options_markup );
				}
				break;
			case 'image':
				
				$options_markup = '';
				$image = [];
				$image['id'] = '';
				$image['src'] = '';

				$width = '1800';
				$height = '1068';

				$image_attributes = wp_get_attachment_image_src( $value, array( $width, $height ) );
				
				if ( !empty( $image_attributes ) ) {
					$image['id'] = $value;
					$image['src'] = $image_attributes[0];
				} else {
					$image['id'] = '';
					$image['src'] = $value;
				}

				$options_markup .= '
				<img data-src="' . $image['src'] . '" src="' . $image['src'] . '" width="180px" height="107px" />
				<div>
					<input type="hidden" name="' . $arguments['uid'] . '" id="' . $arguments['uid'] . '" value="' . $image['id'] . '" />
					<button type="submit" class="upload_image_button button">Upload</button>
					<button type="submit" class="remove_image_button button">&times; Delete</button>
				</div>';
				printf('<div class="upload">%s</div>',$options_markup);
				break;
		}
		
		if( array_key_exists('helper',$arguments) && $helper = $arguments['helper']) {
			printf( '<span class="helper"> %s</span>', $helper );
		}
		
		if( array_key_exists('supplemental',$arguments) && $supplemental = $arguments['supplemental'] ){
			printf( '<p class="description">%s</p>', $supplemental );
		}
	}

	/**
	 * This displays the notice in the admin page for the user
	 *
	 * @since    1.0.0
	 */
	public function admin_notice($message) { ?>
		<div class="notice notice-success is-dismissible">
			<p><?php echo($message); ?></p>
		</div><?php
	}

}