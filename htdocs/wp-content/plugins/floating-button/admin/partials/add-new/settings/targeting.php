<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Tergeting settings
 *
 * @package     Lead_Generation
 * @subpackage  Settings
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Show on screens helper
$show_screen_help = array(
	'text' => __( 'Specify the window breakpoint in px when the button will be shown.', $this->plugin['text'] ),
);

// Enable Don’t show on screens less than
$include_mobile = array(
	'id'   => 'include_mobile',
	'name' => 'param[include_mobile]',
	'type' => 'checkbox',
	'val'  => isset( $param['include_mobile'] ) ? $param['include_mobile'] : 0,
	'func' => 'screen_less(this);',
);

// Enable Don’t show on screens less than helper
$include_mobile_help = array(
	'text' => __( 'Specify the window breakpoint ( mix width) in px.', $this->plugin['text'] ),
);

// Min screen value
$screen = array(
	'id'     => 'screen',
	'name'   => 'param[screen]',
	'type'   => 'number',
	'val'    => isset( $param['screen'] ) ? $param['screen'] : 480,
	'option' => array(
		'min'         => '0',
		'max'         => '3000',
		'step'        => '1',
		'placeholder' => '480',
	),
);

// Disable FontAwesome on front-end of the site
$disable_fontawesome = array(
	'id'   => 'disable_fontawesome',
	'name' => 'param[disable_fontawesome]',
	'type' => 'checkbox',
	'val'  => isset( $param['disable_fontawesome'] ) ? $param['disable_fontawesome'] : 0,
);

$disable_fontawesome_help = array(
	'title' => __( 'Disable Font Awesome 5 style on front-end of the site.', $this->plugin['text'] ),
	'ul'    => array(
		__( 'If you already have a Font Awesome 5 installed on the site, you can disable the include the Font Awesome 5 style.',
			$this->plugin['text'] ),
	),
);