<?php
/**
 * Clone Elements Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Elements for clone Menu 1
$menu_1_item_icon            = array(
	'name'   => 'param[menu_1][item_icon][]',
	'class'  => 'icons',
	'type'   => 'select',
	'val'    => 'fas fa-hand-point-up',
	'option' => $icons_new,
);
$menu_1_item_tooltip_include = array(
	'name'  => 'param[menu_1][item_tooltip_include][]',
	'class' => 'tooltip-include',
	'type'  => 'checkbox',
	'val'   => '0',
	'func'  => 'itemtooltip(this);checkboxchecked(this);',
);
$menu_1_item_tooltip         = array(
	'name'  => 'param[menu_1][item_tooltip][]',
	'class' => 'item-tooltip',
	'type'  => 'text',
	'val'   => '',

);
$menu_1_button_color         = array(
	'name' => 'param[menu_1][button_color][]',
	'type' => 'color',
	'val'  => '#009688',
);
$menu_1_button_hcolor        = array(
	'name' => 'param[menu_1][button_hcolor][]',
	'type' => 'color',
	'val'  => '#009688',
);
$menu_1_icon_color           = array(
	'name' => 'param[menu_1][icon_color][]',
	'type' => 'color',
	'val'  => '#ffffff',
);
$menu_1_item_type            = array(
	'name'   => 'param[menu_1][item_type][]',
	'type'   => 'select',
	'val'    => 'link',
	'class'  => 'item-type',
	'option' => array(
		'link'         => __( 'Link', $this->plugin['text'] ),
		'login'        => __( 'Login', $this->plugin['text'] ),
		'logout'       => __( 'Logout', $this->plugin['text'] ),
		'register'     => __( 'Register', $this->plugin['text'] ),
		'lostpassword' => __( 'Lostpasswordt', $this->plugin['text'] ),
	),
	'func'   => 'itemtype(this);',
);
$menu_1_item_link            = array(
	'name' => 'param[menu_1][item_link][]',
	'type' => 'text',
	'val'  => '',
);

// Elements for clone Menu 2
$menu_2_item_icon            = array(
	'name'   => 'param[menu_2][item_icon][]',
	'class'  => 'icons',
	'type'   => 'select',
	'val'    => 'fas fa-hand-point-up',
	'option' => $icons_new,
);
$menu_2_item_tooltip_include = array(
	'name'  => 'param[menu_2][item_tooltip_include][]',
	'class' => 'tooltip-include',
	'type'  => 'checkbox',
	'val'   => '0',
	'func'  => 'itemtooltip(this);checkboxchecked(this);',
);
$menu_2_item_tooltip         = array(
	'name'  => 'param[menu_2][item_tooltip][]',
	'class' => 'item-tooltip',
	'type'  => 'text',
	'val'   => '',

);
$menu_2_button_color         = array(
	'name' => 'param[menu_2][button_color][]',
	'type' => 'color',
	'val'  => '#009688',
);
$menu_2_button_hcolor        = array(
	'name' => 'param[menu_2][button_hcolor][]',
	'type' => 'color',
	'val'  => '#009688',
);
$menu_2_icon_color           = array(
	'name' => 'param[menu_2][icon_color][]',
	'type' => 'color',
	'val'  => '#ffffff',
);
$menu_2_item_type            = array(
	'name'   => 'param[menu_2][item_type][]',
	'type'   => 'select',
	'class'  => 'item-type',
	'val'    => 'link',
	'option' => array(
		'link'         => __( 'Link', $this->plugin['text'] ),
		'login'        => __( 'Login', $this->plugin['text'] ),
		'logout'       => __( 'Logout', $this->plugin['text'] ),
		'register'     => __( 'Register', $this->plugin['text'] ),
		'lostpassword' => __( 'Lostpasswordt', $this->plugin['text'] ),
	),
	'func'   => 'itemtype(this);',
);
$menu_2_item_link            = array(
	'name' => 'param[menu_2][item_link][]',
	'type' => 'text',
	'val'  => '',
);