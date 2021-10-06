<?php
/**
 * Main Settings param
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

$position = array(
	'id'     => 'position',
	'name'   => 'param[position]',
	'type'   => 'select',
	'val'    => isset( $param['position'] ) ? $param['position'] : 'bottom-right',
	'option' => array(
		'flBtn-position-br' => __( 'bottom-right', $this->plugin['text'] ),
	),
);

$position_help = array(
	'text' => __( 'Specify floating button location on screen.', $this->plugin['text'] ),
);

include_once( 'icons.php' );
$icons_new = array();
foreach ( $icons as $key => $value ) {
	$icons_new[ $value ] = $value;
}

$button_icon = array(
	'id'     => 'button_icon',
	'name'   => 'param[button_icon]',
	'class'  => 'icons',
	'type'   => 'select',
	'val'    => isset( $param['button_icon'] ) ? $param['button_icon'] : 'fas fa-hand-point-up',
	'option' => $icons_new,
	'func'   => '',
);

$button_icon_help = array(
	'text' => __( 'Select the Icon for button', $this->plugin['text'] ),
);

$shape = array(
	'id'     => 'shape',
	'name'   => 'param[shape]',
	'type'   => 'select',
	'val'    => isset( $param['shape'] ) ? $param['shape'] : 'flBtn-shape-circle',
	'option' => array(
		'flBtn-shape-circle'  => __( 'Circle', $this->plugin['text'] ),
	),
	'func'   => '',
);

$size = array(
	'id'     => 'size',
	'name'   => 'param[size]',
	'type'   => 'select',
	'val'    => isset( $param['size'] ) ? $param['size'] : 'flBtn-size-medium',
	'option' => array(
		'flBtn-size-medium' => __( 'Medium', $this->plugin['text'] ),
	),
	'func'   => '',
);

$animation = array(
	'id'     => 'animation',
	'name'   => 'param[animation]',
	'type'   => 'select',
	'val'    => isset( $param['animation'] ) ? $param['animation'] : '',
	'option' => array(
		''                                    => __( 'Fade', $this->plugin['text'] ),
	),
	'func'   => '',
);

$button_color = array(
	'id'   => 'button_color',
	'name' => 'param[button_color]',
	'type' => 'color',
	'val'  => isset( $param['button_color'] ) ? $param['button_color'] : '#009688',
);

$button_hcolor = array(
	'id'   => 'button_hcolor',
	'name' => 'param[button_hcolor]',
	'type' => 'color',
	'val'  => isset( $param['button_hcolor'] ) ? $param['button_hcolor'] : '#009688',
);

$icon_color = array(
	'id'   => 'icon_color',
	'name' => 'param[icon_color]',
	'type' => 'color',
	'val'  => isset( $param['icon_color'] ) ? $param['icon_color'] : '#fff',
);

$tooltip_background = array(
	'id'   => 'tooltip_background',
	'name' => 'param[tooltip_background]',
	'type' => 'color',
	'val'  => isset( $param['tooltip_background'] ) ? $param['tooltip_background'] : '#585858',
);

$tooltip_color = array(
	'id'   => 'tooltip_color',
	'name' => 'param[tooltip_color]',
	'type' => 'color',
	'val'  => isset( $param['tooltip_color'] ) ? $param['tooltip_color'] : '#fff',
);


$item_type  = array(
	'name'   => 'param[item_type]',
	'type'   => 'select',
	'class'  => 'item-type',
	'id'     => 'mainType',
	'val'    => isset( $param['item_type'] ) ? $param['item_type'] : 'main',
	'option' => array(
		'main'         => __( 'Main Button', $this->plugin['text'] ),
	),
	'func'   => 'itemtype(this);',
);


$item_type_help = array(
	'title' => __( 'Types of the button which can be select', $this->plugin['text'] ),
	'ul'    => array(
		__( '<strong>Main Button</strong> - button has some sub buttons', $this->plugin['text'] ),
		__( '<strong>Link</strong> - insert any link', $this->plugin['text'] ),
		__( '<strong>Share</strong> - share the page in selected social network', $this->plugin['text'] ),
		__( '<strong>Print</strong> - print the page', $this->plugin['text'] ),
		__( '<strong>Scroll to Top</strong> - go to header of the site', $this->plugin['text'] ),
		__( '<strong>Go Back</strong> - the previous URL in the history list', $this->plugin['text'] ),
		__( '<strong>Go Forward</strong> - the next URL in the history list', $this->plugin['text'] ),
		__( '<strong>Smooth Scroll</strong> - scroll the page to the element with ID', $this->plugin['text'] ),
	),
);

$main_button_class_help = array(
	'title' => __( 'Set Class for element.', $this->plugin['text'] ),
	'ul'    => array(
		__( 'You may enter several classes separated by a space.', $this->plugin['text'] ),
	),
);

$item_type_menu_help = array(
	'title' => __( 'Types of the button which can be select', $this->plugin['text'] ),
	'ul'    => array(
		__( '<strong>Link</strong> - insert any link', $this->plugin['text'] ),
		__( '<strong>Share</strong> - share the page in selected social network', $this->plugin['text'] ),
		__( '<strong>Print</strong> - print the page', $this->plugin['text'] ),
		__( '<strong>Scroll to Top</strong> - go to header of the site', $this->plugin['text'] ),
		__( '<strong>Go Back</strong> - the previous URL in the history list', $this->plugin['text'] ),
		__( '<strong>Go Forward</strong> - the next URL in the history list', $this->plugin['text'] ),
		__( '<strong>Smooth Scroll</strong> - scroll the page to the element with ID', $this->plugin['text'] ),
	),
);

$close_button_enable_helper = array(
	'text' => esc_attr__( 'Enable the close icon. This icon will show when buttons opening', $this->plugin['text'] ),
);

$hold_buttons_open_helper = array(
	'text' => esc_attr__( 'Hold buttons open when the page load', $this->plugin['text'] ),
);

$button_animation_helper = array(
	'text' => esc_attr__( 'Animation for main button', $this->plugin['text'] ),
);