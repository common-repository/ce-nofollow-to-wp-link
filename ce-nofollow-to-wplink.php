<?php
/**
 * Plugin Name: CE Nofollow to WP-Link
 * Plugin URI: http://ppfeufer.de/wordpress-plugin/ce-nofollow-to-wp-link/
 * Description: Adding the rel="nofollow" attribute to a link if wanted.
 * Version: 1.0.2
 * Author: codeenterprise GmbH Osnabrück (written by: H.-Peter Pfeufer)
 * Author URI: http://codeenterprise.de
 * Text Domain: ce-nofollow-to-wplink
 * Domain Path: /l10n
 */
namespace CeNofollowToWpLink;

if(!function_exists('ce_overwrite_wplink')) {
	function ce_overwrite_wplink() {
		// Disable wplink
		wp_deregister_script('wplink');

		// Register a new script file to be linked
		wp_register_script('wplink', plugins_url('js/wplink-min.js', __FILE__), array (
			'jquery',
			'wpdialogs'
		), false, 1);

		$translation_array = array(
			'checkboxlabel' => __(' Add <code>rel="nofollow"</code> to link', 'ce-nofollow-to-wplink')
		);
		wp_localize_script('wplink', 'ce_wplink_translation', $translation_array);
	} // END function ce_overwrite_wplink()

	add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\ce_overwrite_wplink', 999);
} // END if(!function_exists('ce_overwrite_wplink'))

if(!function_exists('ce_plugin_init')) {
	function ce_plugin_init() {
		/**
		 * Sprachdatei wählen
		 */
		if(function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('ce-nofollow-to-wplink', false, dirname(plugin_basename( __FILE__ )) . '/l10n/');
		} // END if(function_exists('load_plugin_textdomain'))
	} // END function ce_plugin_init()

	add_action('init', __NAMESPACE__ . '\\ce_plugin_init');
} // END if(!function_exists('ce_plugin_init'))