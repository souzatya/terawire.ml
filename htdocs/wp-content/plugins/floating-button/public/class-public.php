<?php
/**
 * Public Class
 *
 * @package     Wow_Plugin
 * @subpackage  Public
 * @author      Dmytro Lobov <d@dayes.dev>
 * @copyright   2019 Wow-Company
 * @license     GNU Public License
 * @version     1.0
 */

namespace floatingbutton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Wow_Plugin_Public
 *
 * @package wow_plugin
 *
 * @property array plugin   - base information about the plugin
 * @property array url      - home, pro and other URL for plugin
 * @property array rating   - website and link for rating
 * @property string basedir - filesystem directory path for the plugin
 * @property string baseurl - URL directory path for the plugin
 */
class Wow_Plugin_Public {

	/**
	 * Setup to frontend of the plugin
	 *
	 * @param array $info general information about the plugin
	 *
	 * @since 1.0
	 */

	public function __construct( $info ) {

		$this->plugin = $info['plugin'];
		$this->url    = $info['url'];
		$this->rating = $info['rating'];

		add_shortcode( $this->plugin['shortcode'], array( $this, 'shortcode' ) );

		// Display on the site
		add_action( 'wp_footer', array( $this, 'display' ) );

	}



	/**
	 * Display a shortcode
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function shortcode( $atts ) {

		ob_start();
		require plugin_dir_path( __FILE__ ) . 'shortcode.php';
		ob_end_clean();

		if ( isset ( $menu ) ) {
			return $menu;
		} else {
			return false;
		}

	}

	/**
	 * Display the Item on the specific pages, not via the Shortcode
	 */
	public function display() {
		require plugin_dir_path( __FILE__ ) . 'display.php';
	}

	/**
	 * Create Inline style for elements
	 */
	public function style( $param, $id ) {
		$css = '';
		require 'generator-style.php';

		return $css;

	}


}
