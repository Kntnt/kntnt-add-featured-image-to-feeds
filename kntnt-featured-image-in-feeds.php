<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Featured Image in Feed
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Adds featured image to feeds.
 * Version:           2.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


namespace Kntnt\Featured_Image_Feed;

defined( 'ABSPATH' ) && new Plugin;

class Plugin {

	public function __construct() {
		add_filter( 'the_content_feed', [ $this, 'featured_image_in_feeds' ] );
		add_filter( 'the_excerpt_rss', [ $this, 'featured_image_in_feeds' ] );
	}

	public final function featured_image_in_feeds( $content ) {
		global $post;
		if ( has_post_thumbnail( $post ) ) {

			/**
			 * Filters the post thumbnail size.
			 *
			 * @param string|int[] $size Requested image size. Can be any registered image size name, or
			 *                           an array of width and height values in pixels (in that order), or
			 *                           null to prevent image to be added.
			 * @param WP_Post $post The post.
			 */
			$format = apply_filters( 'kntnt-featured-image-feed-image-format', 'medium_large', $post );

			if ( $format ) {

				/**
				 * Filters the post thumbnail size.
				 *
				 * @param string|array $attr Attributes for the image markup.
				 * @param WP_Post $post The post.
				 */
				$attr = apply_filters( 'kntnt-featured-image-feed-attributes', [ 'style' => 'margin-bottom:1em;' ], $post );

				if ( $image_html = get_the_post_thumbnail( $post, $format, $attr ) ) {
					$content = "$image_html<br>\n$content";
				}
			}
		}
		return $content;
	}

}