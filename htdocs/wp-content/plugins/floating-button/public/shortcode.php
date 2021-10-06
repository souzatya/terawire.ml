<?php
/**
 * Shortcode
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

namespace floatingbutton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( shortcode_atts( array( 'id' => "" ), $atts ) );
global $wpdb;
$table  = $wpdb->prefix . 'wow_' . $this->plugin['prefix'];
$sSQL   = $wpdb->prepare( "select * from $table WHERE id = %d", $id );
$result = $wpdb->get_results( $sSQL );
if ( count( $result ) > 0 ) {
	foreach ( $result as $key => $val ) {
		$param = unserialize( $val->param );

		ob_start();
		include( 'partials/public.php' );
		ob_end_clean();

		$time    = ! empty( $param['time'] ) ? $param['time'] : '';
		$slug    = $this->plugin['slug'];
		$version = $this->plugin['version'];

		if ( empty( $param['disable_fontawesome'] ) ) {
			$url_icons = $this->plugin['url'] . 'assets/vendors/fontawesome/css/fontawesome-all.min.css';
			wp_enqueue_style( $slug . '-fontawesome', $url_icons, null, '5.6.3' );
		}

		$url_style = $this->plugin['url'] . 'assets/css/style.min.css';
		wp_enqueue_style( $slug, $url_style, null, $version );

		$inline_style = self::style( $param, $id );
		wp_add_inline_style( $slug, $inline_style );


	}
}

return;