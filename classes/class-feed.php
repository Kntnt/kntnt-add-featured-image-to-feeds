<?php

namespace Kntnt\Img_Feeds;

class Feed {

  public function __construct($plugin) {}
  
  public function run() {
    add_filter('the_content_feed', [ $this, 'featured_image_in_feeds' ]);
    add_filter('the_excerpt_rss', [ $this, 'featured_image_in_feeds' ]);
  }
  
  public function featured_image_in_feeds($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
      $image_format = 'medium_large';
      $image_style = 'margin-bottom:10px;';
      $image_html = get_the_post_thumbnail($post->ID, Plugin::option('format'), [ 'style' => esc_attr(Plugin::option('style')) ]);
      $content = "<p>$image_html</p>\n$content";
    }
    return $content;
  }

}
