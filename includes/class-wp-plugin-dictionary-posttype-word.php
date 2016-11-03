<?php
/**
 * Created by PhpStorm.
 * User: andreasfarnstrand
 * Date: 21/10/16
 * Time: 11:27
 */

class WP_Plugin_Dictionary_Posttype_Word {

	public function register() {

		register_post_type( 'dictionary_word', $this->posttype_arguments() );

	}


	/**
	 * The labels used for the post type
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return   array
	 */
	private function posttype_labels() {

		return array(
			'name'               => _x( 'Ordlista', 'post type general name', 'wp-plugin-dictionary' ),
			'singular_name'      => _x( 'Ordlista', 'post type singular name', 'wp-plugin-dictionary' ),
			'menu_name'          => _x( 'Ordlista', 'admin menu', 'wp-plugin-dictionary' ),
			'name_admin_bar'     => _x( 'Ordlista', 'add new on admin bar', 'wp-plugin-dictionary' ),
			'add_new'            => _x( 'Nytt ord', 'material', 'wp-plugin-dictionary' ),
			'add_new_item'       => __( 'Lägg till nytt ord', 'wp-plugin-dictionary' ),
			'new_item'           => __( 'Nytt ord', 'wp-plugin-dictionary' ),
			'edit_item'          => __( 'Ändra ord', 'wp-plugin-dictionary' ),
			'view_item'          => __( 'Visa ord', 'wp-plugin-dictionary' ),
			'all_items'          => __( 'Alla ord', 'wp-plugin-dictionary' ),
			'search_items'       => __( 'Sök ord', 'wp-plugin-dictionary' ),
			'parent_item_colon'  => __( 'Nuvarande ord:', 'wp-plugin-dictionary' ),
			'not_found'          => __( 'Inga ord funna.', 'wp-plugin-dictionary' ),
			'not_found_in_trash' => __( 'Inga ord funna i papperskorgen.', 'wp-plugin-dictionary' )
		);

	}


	/**
	 * The argumets used for registering the post type
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return   array
	 */
	private function posttype_arguments() {

		return array(
			'labels'             => $this->posttype_labels(),
			'description'        => __( 'Description.', 'wp-plugin-dictionary' ),
			'public'             => false,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' )
		);

	}


	/**
	 * Hook triggered on saving a dictionary word.
	 * Save a transient for all dictionary words.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param integer   the post id
	 */
	public function save( $post_id, $post, $update ) {

		// Security checks
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		// Check if this is a valid post type
		if ( $_POST['post_type'] != 'dictionary_word' ) return $post_id;


		self::generate_transient();

	}


	/**
	 * Generate and set a transient for all dictionary words.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 */
	public static function generate_transient() {

		$posts = get_posts( array( 'post_type' => 'dictionary_word', 'number_of_posts' => -1, 'post_status' => 'publish' ) );
		$transient = array();

		if ( is_array( $posts ) && count( $posts ) > 0 ) {

			foreach( $posts as $post ) {

				$transient[strtolower( $post->post_title )] = $post->post_content;

			}

			set_transient( 'dictionary_words', $transient, 30 * DAY_IN_SECONDS );

		}

	}

}