<?php
/**
 * Provide a settings page for the plugin
 *
 *
 * @link       http://cybercom.com
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Dictionary
 * @subpackage Wp_Plugin_Dictionary/admin/partials
 */
class WP_Plugin_Dictionary_Settings {

	/**
	 * Initialize the plugin settings page
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function init() {

		register_setting( 'wp_plugin_dictionary', 'wp_plugin_dictionary_options' );

		add_settings_section(
			'section_bootstrap',
			__( 'Script- och cssinställningar', 'wp-plugin-dictionary' ),
			array( $this, 'section_bootstrap'),
			'wp_plugin_dictionary'
		);

		add_settings_field(
			'wp_plugin_dictionary_bootstrap',
			__( 'Ladda Bootstrap från plugin', 'wp_plugin_dictionary' ),
			array( $this, 'field_bootstrap_html' ),
			'wp_plugin_dictionary',
			'section_bootstrap',
			[
				'label_for'         => 'wp_plugin_dictionary_field_bootstrap',
				'class'             => 'wp_plugin_dictionary_row',
				'wp_plugin_dictionary_custom_data' => 'custom',
			]
		);


		add_settings_field(
			'wp_plugin_dictionary_tether',
			__( 'Ladda Tether från plugin', 'wp_plugin_dictionary' ),
			array( $this, 'field_tether_html' ),
			'wp_plugin_dictionary',
			'section_bootstrap',
			[
				'label_for'         => 'wp_plugin_dictionary_field_tether',
				'class'             => 'wp_plugin_dictionary_row',
				'wp_plugin_dictionary_custom_data' => 'custom',
			]
		);
	}


	/**
	 * Section description html
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function section_bootstrap( $args ) {
		?>
		<p id="<?= esc_attr( $args['id'] ); ?>"><?= esc_html__( 'Inställningar för laddning av Bootstrap och Tether. Ange nej på inställningarna om du redan har dem laddade.', 'wp-plugin-dictionary' ); ?></p>
		<?php
	}


	/**
	 * Options for the bootstrap field
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function field_bootstrap_html( $args ) {
		$options = get_option( 'wp_plugin_dictionary_options' );
		?>
		<select id="<?= esc_attr( $args['label_for']); ?>" data-custom="<?= esc_attr( $args['wp_plugin_dictionary_custom_data'] ); ?>" name="wp_plugin_dictionary_options[<?= esc_attr( $args['label_for'] ); ?>]">
			<option value="true" <?= isset( $options[$args['label_for']]) ? ( selected( $options[$args['label_for']], 'true', false ) ) : (''); ?>>
				<?= esc_html( 'Ja', 'wp_plugin_dictionary' ); ?>
			</option>
			<option value="false" <?= isset( $options[$args['label_for']]) ? ( selected( $options[$args['label_for']], 'false', false) ) : (''); ?>>
				<?= esc_html( 'Nej', 'wp_plugin_dictionary' ); ?>
			</option>
		</select>
		<?php
	}


	/**
	 * Options for the tether field
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function field_tether_html( $args ) {
		$options = get_option( 'wp_plugin_dictionary_options' );
		?>
		<select id="<?= esc_attr( $args['label_for']); ?>" data-custom="<?= esc_attr( $args['wp_plugin_dictionary_custom_data'] ); ?>" name="wp_plugin_dictionary_options[<?= esc_attr( $args['label_for'] ); ?>]">
			<option value="true" <?= isset( $options[$args['label_for']]) ? ( selected( $options[$args['label_for']], 'true', false ) ) : (''); ?>>
				<?= esc_html( 'Ja', 'wp_plugin_dictionary' ); ?>
			</option>
			<option value="false" <?= isset( $options[$args['label_for']]) ? ( selected( $options[$args['label_for']], 'false', false) ) : (''); ?>>
				<?= esc_html( 'Nej', 'wp_plugin_dictionary' ); ?>
			</option>
		</select>
		<?php
	}


	/**
	 * Add options page to admin menu
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function options_page() {

		add_submenu_page(
			'options-general.php',
			__( 'Inställningar för Ordlista', 'wp-plugin-dictionary' ),
			__( 'Ordlista', 'wp-plugin-dictionary' ),
			'manage_options',
			'wp_plugin_dictionary',
			array( $this, 'options_page_html' )
		);

	}


	/**
	 * Settings page layout and output
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function options_page_html() {
		if (!current_user_can('manage_options')) {
			return;
		}

		settings_errors('wp_plugin_dictionary_messages');
		?>
		<div class="wrap">
			<h1><?= esc_html(get_admin_page_title()); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'wp_plugin_dictionary' );
				do_settings_sections( 'wp_plugin_dictionary' );
				submit_button( __( 'Spara inställningar', 'wp-plugin-dictionary' ) );
				?>
			</form>
		</div>
		<?php
	}

}