<?php

/**
 * Plugin main file.
 *
 * @wordpress-plugin
 * Plugin Name:       Kntnt's Featured Image in Feeds
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Add featured image to feeds.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kntnt-img-feeds
 * Domain Path:       /languages
 */
 
namespace Kntnt\Img_Feeds;

defined('WPINC') || die;

require_once __DIR__ . '/classes/class-abstract-plugin.php';

final class Plugin extends Abstract_Plugin {

  public function run() {
    $ctx = Plugin::context();
    Plugin::debug("Runs in %s mode", $ctx);
    switch ($ctx) {
      case 'index':
      $this->instance('Feed')->run();
        break;
      case 'admin':
        $this->instance('Settings')->run();
        break;
    }
  }

}

add_action('plugins_loaded', function() {
  Plugin::instance()->run();
});
