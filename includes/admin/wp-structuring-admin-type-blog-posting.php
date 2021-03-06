<?php
/**
 * Schema.org Type BlogPosting
 *
 * @author  Kazuya Takami
 * @version 4.1.0
 * @since   1.2.0
 * @see     wp-structuring-admin-db.php
 * @link    http://schema.org/BlogPosting
 * @link    https://developers.google.com/search/docs/data-types/articles
 */
class Structuring_Markup_Type_Blog_Posting {

	/**
	 * Constructor Define.
	 *
	 * @version 3.2.2
	 * @since   1.0.0
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
	 * @version 4.1.0
	 * @since   1.2.0
	 * @param   array $option
	 */
	private function page_render ( array $option ) {
		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>Basic Setting</caption>';
		$html .= '<tr><th>headline :</th><td><small>Default : post_title</small></td></tr>';
		$html .= '<tr><th>datePublished :</th><td><small>Default : get_the_time( DATE_ISO8601, ID )</small></td></tr>';
		$html .= '<tr><th>dateModified :</th><td><small>Default : get_the_modified_time( DATE_ISO8601, false, ID )</small></td></tr>';
		$html .= '<tr><th>description :</th><td><small>Default : post_excerpt</small></td></tr>';
		$html .= '</table>';
		echo $html;

		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>mainEntityOfPage</caption>';
		$html .= '<tr><th>@type :</th><td><small>"WebPage"</small></td></tr>';
		$html .= '<tr><th>@id :</th><td><small>Default : get_permalink( ID )</small></td></tr>';
		$html .= '</table>';
		echo $html;

		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>image</caption>';
		$html .= '<tr><th>@type :</th><td><small>"ImageObject"</small></td></tr>';
		$html .= '<tr><th>url :</th><td><small>Default : Featured Image</small></td></tr>';
		$html .= '<tr><th>height :</th><td><small>Auto : The height of the image, in pixels.</small></td></tr>';
		$html .= '<tr><th>width :</th><td><small>Auto : The width of the image, in pixels. Images should be at least 696 pixels wide.</small></td></tr>';
		$html .= '<tr><th><label for="content_image">Setting image url :</label></th><td>';
		$html .= '<input type="checkbox" name="option[' . "content_image" . ']" id="content_image" value="on"';
		if ( isset( $option['content_image'] ) &&  $option['content_image'] === 'on' ) {
			$html .= ' checked="checked"';
		}
		$html .= '>Set the first image in the content.<br><small>Pattern without feature image set (feature image takes precedence)</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>author</caption>';
		$html .= '<tr><th>@type :</th><td><small>"Person"</small></td></tr>';
		$html .= '<tr><th>name :</th><td><small>Default : get_the_author_meta( "display_name", author )</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>publisher</caption>';
		$html .= '<tr><th>@type :</th><td><small>"Organization"</small></td></tr>';
		$html .= '<tr><th><label for="name">Organization Name :</label></th><td>';
		$html .= '<input type="text" name="option[' . "name" . ']" id="name" class="regular-text" value="' . esc_attr( $option['name'] ) . '">';
		$html .= '<small>Default : bloginfo("name")</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		$html  = '<table class="schema-admin-table">';
		$html .= '<caption>publisher.logo</caption>';
		$html .= '<tr><th>@type :</th><td><small>"ImageObject"</small></td></tr>';
		$html .= '<tr><th><label for="logo">url :</label></th><td>';
		$html .= '<input type="text" name="option[' . "logo" . ']" id="logo" class="regular-text" value="' . esc_attr( $option['logo'] ) . '">';
		$html .= '<button id="media-upload" class="schema-admin-media-button dashicons-before dashicons-admin-media"><span>Add Media</span></button>';
		$html .= '</td></tr>';
		$html .= '<tr><th><label for="logo-width">width :</label></th><td>';
		$html .= '<input type="number" name="option[' . "logo-width" . ']" id="logo-width" min="0" value="' . esc_attr( $option['logo-width'] ) . '">px';
		$html .= '<small>height <= 600px.</small>';
		$html .= '</td></tr>';
		$html .= '<tr><th><label for="logo-height">height :</label></th><td>';
		$html .= '<input type="number" name="option[' . "logo-height" . ']" id="logo-height" min="0" value="' . esc_attr( $option['logo-height'] ) . '">px';
		$html .= '<small>height <= 60px.</small>';
		$html .= '</td></tr>';
		$html .= '</table>';
		echo $html;

		echo '<p>Setting Knowledge : <a href="https://developers.google.com/search/docs/data-types/articles" target="_blank">https://developers.google.com/search/docs/data-types/articles</a></p>';
		submit_button();
	}

	/**
	 * Return the default options array
	 *
	 * @version 3.2.2
	 * @since   2.2.0
	 * @return  array $args
	 */
	private function get_default_options () {
		$args['name']          = get_bloginfo('name');
		$args['content_image'] = '';
		$args['logo']          = '';
		$args['logo-height']   = 0;
		$args['logo-width']    = 0;

		return (array) $args;
	}
}