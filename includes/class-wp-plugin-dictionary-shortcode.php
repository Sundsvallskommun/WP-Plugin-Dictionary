<?php
/**
 * The class for adding and handling logic for the plugin shortcode.
 *
 *
 * @since      1.0.0
 * @package    Wp_Plugin_Dictionary
 * @subpackage Wp_Plugin_Dictionary/includes
 * @author     Andreas Färnstrand <andreas.farnstrand@cybercom.com>
 */
class WP_Plugin_Dictionary_Shortcode {

	/**
	 * Class constructor.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function __construct() {

		$this->add_shortcode();

	}


	/**
	 * Add the shortcode to wp
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function add_shortcode() {

		add_shortcode( 'dictionary', array( $this, 'parse' ) );
		add_shortcode( 'ordlista', array( $this, 'parse' ) );

	}


	/**
	 * Parse the shortcode and lookup correct word from dictionary.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @return   string     shortcode html to return
	 */
	public function parse( $atts, $content = null ) {
		global $wpdb;

		if( !empty( $content ) ) {

			$query = $wpdb->prepare(
				"SELECT post_content 
					FROM $wpdb->posts 
					WHERE 
						LOWER(post_title) = '%s' AND 
						post_type = 'dictionary_word' AND 
						post_status = 'publish' 
					LIMIT 1",
				strtolower($content) );

			$tooltip_text = $wpdb->get_var( $query );
			if( empty( $tooltip_text ) ) $tooltip_text = $content;

			return sprintf( "<a href=\"#\" class=\"wp-plugin-dictionary-word\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"%s\">%s</a>", $tooltip_text, $content );

		}

		return $content;

	}

}
$wp_plugin_dictionary_shortcode = new WP_Plugin_Dictionary_Shortcode();