<?php

/**
 *  * Fired during plugin activation
 *
 * @since      1.0.0
 *
 * @package    EasyVideo
 * @subpackage  EasyVideo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    y											
 * @subpackage EasyVideo/includes
 * @author     Amir <Amirali2k10@gmail.com>
 */
class EasyVideo_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_EasyVideo_textdomain() {

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
