<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://pagevisitcounter.com
 * @since      2.5.2
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.5.2
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class Advanced_Visit_Counter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.5.2
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'advanced-visit-counter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
