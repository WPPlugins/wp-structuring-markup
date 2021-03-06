<?php
/**
 * Schema.org Type Person
 *
 * @author  Kazuya Takami
 * @version 3.1.2
 * @since   2.4.0
 * @see     wp-structuring-admin-db.php
 * @link    https://schema.org/Person
 * @link    https://developers.google.com/search/docs/data-types/social-profile-links
 */
class Structuring_Markup_Type_Person {

	/**
	 * Variable definition.
	 *
	 * @version 2.4.0
	 * @since   2.4.0
	 */
	/** Social Profile */
	private $social_array = array(
		array("type" => "facebook",   "display" => "Facebook"),
		array("type" => "twitter",    "display" => "Twitter"),
		array("type" => "google",     "display" => "Google+"),
		array("type" => "instagram",  "display" => "Instagram"),
		array("type" => "youtube",    "display" => "Youtube"),
		array("type" => "linkedin",   "display" => "LinkedIn"),
		array("type" => "myspace",    "display" => "Myspace"),
		array("type" => "pinterest",  "display" => "Pinterest"),
		array("type" => "soundcloud", "display" => "SoundCloud"),
		array("type" => "tumblr",     "display" => "Tumblr")
	);

	/**
	 * Constructor Define.
	 *
	 * @version 2.4.0
	 * @since   2.4.0
	 * @param   array $option
	 */
	public function __construct ( array $option ) {
		/** Default Value Set */
		$option_array = $this->get_default_options();

		if ( !empty( $option ) ) {
			$option_array = array_merge( $option_array, $option );
		}

		$this->page_render( $option_array );
	}

	/**
	 * Form Layout Render
	 *
	 * @version 3.1.2
	 * @since   2.4.0
	 * @param   array $option
	 */
	private function page_render ( array $option ) {
		/** Basic Settings */
		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>Basic Settings</caption>';
		$html .= '<tr><th class="require"><label for="name">Name :</label></th><td>';
		$html .= '<input type="text" name="option[' . "name" . ']" id="name" class="regular-text" required value="' . esc_attr( $option['name'] ) . '">';
		$html .= '<small>Default : bloginfo("name")</small>';
		$html .= '</td></tr>';
		$html .= '<tr><th class="require"><label for="url">url :</label></th><td>';
		$html .= '<input type="text" name="option[' . "url" . ']" id="url" class="regular-text" required value="' . esc_attr( $option['url'] ) . '">';
		$html .= '<small>Default : bloginfo("url")</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		/** Place Settings */
		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>Place Settings</caption>';
		$html .= '<tr><th class="require"><label for="addressCountry">addressCountry :</label></th><td>';
		$html .= '<input type="text" name="option[' . "addressCountry" . ']" id="addressCountry" class="regular-text" required value="' . esc_attr( $option['addressCountry'] ) . '">';
		$html .= '<small>e.g. Japan</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		/** Social Profiles */
		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>Social Profiles</caption>';
		foreach ( $this->social_array as $value ) {
			$html .= '<tr><th><label for="' . $value['type'] . '">' . $value['display'] . ' :</label></th><td>';
			$html .= '<input type="text" name="option[' . "social" . '][' . $value['type'] . ']" id="' . $value['type'] . '" class="regular-text" value="' . esc_attr( $option['social'][$value['type']] ) . '">';
			$html .= '</td></tr>';
		}
		$html .= '</table>';
		echo $html;

		echo '<p>Setting Knowledge : <a href="https://developers.google.com/search/docs/data-types/social-profile-links" target="_blank">https://developers.google.com/search/docs/data-types/social-profile-links</a></p>';
		submit_button();
	}

	/**
	 * Return the default options array
	 *
	 * @since   3.1.2
	 * @version 2.4.0
	 * @return  array $args
	 */
	private function get_default_options () {
		$args['name']           = get_bloginfo('name');
		$args['url']            = get_bloginfo('url');
		$args['addressCountry'] = '';

		foreach ( $this->social_array as $value ) {
			$args['social'][$value['type']] = '';
		}

		return (array) $args;
	}
}