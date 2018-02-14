<?php

namespace Kntnt\Img_Feeds;

require_once __DIR__ . '/class-abstract-settings.php';

class Settings extends Abstract_Settings {

  // Returns title used as menu item and as head of settings page.
  protected function title() {
    return __('Featured Image in Feeds', 'kntnt-img-feeds');
  }
  
  // Returns all fields used on the settigs page.
  protected function form() { return [

      'format' => [
        'type'        => 'select',
        'options'     => array_combine(get_intermediate_image_sizes(), get_intermediate_image_sizes()),
        'label'       => __('Image format', 'kntnt-img-feeds'),
        'description' => __('Select image format to be used in feeds.', 'kntnt-img-feeds'),
        'sanitizer'   => function($format) {
          return in_array($format, get_intermediate_image_sizes()) ? $format : Plugin::option('format');
        },
      ],

      'style' => [
        'type'        => 'text',
        'label'       => __('Style', 'kntnt-img-feeds'),
        'description' => __('Enter style that should be applied to the image element, e.g. <code>margin-bottom: 10px;</code>', 'kntnt-img-feeds'),
        'sanitizer'   => 'esc_attr',
      ],

  ];}
  
}
