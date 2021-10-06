<?php
/**
 * Horizontal Buttons Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

$count_ii = ( ! empty( $param['menu_2']['item_type'] ) ) ? count( $param['menu_2']['item_type'] ) : '0';
if ( $count_ii > 0 ) {
	for ( $i = 0; $i < $count_ii; $i ++ ) {
		$item_icon_[ $i ]            = array(
			'name'   => 'param[menu_2][item_icon][]',
			'class'  => 'icons',
			'type'   => 'select',
			'val'    => isset( $param['menu_2']['item_icon'][ $i ] ) ? $param['menu_2']['item_icon'][ $i ]
				: 'fas fa-hand-point-up',
			'option' => $icons_new,
		);
		$item_tooltip_include_[ $i ] = array(
			'name'  => 'param[menu_2][item_tooltip_include][]',
			'type'  => 'checkbox',
			'class' => 'tooltip-include',
			'val'   => isset( $param['menu_2']['item_tooltip_include'][ $i ] )
				? $param['menu_2']['item_tooltip_include'][ $i ] : 0,
			'func'  => 'itemtooltip(this);',
		);
		$item_tooltip_[ $i ]         = array(
			'name'  => 'param[menu_2][item_tooltip][]',
			'class' => 'item-tooltip',
			'type'  => 'text',
			'val'   => isset( $param['menu_2']['item_tooltip'][ $i ] ) ? $param['menu_2']['item_tooltip'][ $i ] : '',

		);
		$button_color_[ $i ]         = array(
			'name' => 'param[menu_2][button_color][]',
			'type' => 'color',
			'val'  => isset( $param['menu_2']['button_color'][ $i ] ) ? $param['menu_2']['button_color'][ $i ]
				: '#009688',
		);
		$button_hcolor_[ $i ]        = array(
			'name' => 'param[menu_2][button_hcolor][]',
			'type' => 'color',
			'val'  => isset( $param['menu_2']['button_hcolor'][ $i ] ) ? $param['menu_2']['button_hcolor'][ $i ]
				: '#009688',
		);
		$icon_color_[ $i ]           = array(
			'name' => 'param[menu_2][icon_color][]',
			'type' => 'color',
			'val'  => isset( $param['menu_2']['icon_color'][ $i ] ) ? $param['menu_2']['icon_color'][ $i ] : '#ffffff',
		);
		$item_type_[ $i ]            = array(
			'name'   => 'param[menu_2][item_type][]',
			'type'   => 'select',
			'class'  => 'item-type',
			'val'    => isset( $param['menu_2']['item_type'][ $i ] ) ? $param['menu_2']['item_type'][ $i ] : '',
			'option' => array(
				'link'         => __( 'Link', $this->plugin['text'] ),
				'login'        => __( 'Login', $this->plugin['text'] ),
				'logout'       => __( 'Logout', $this->plugin['text'] ),
				'register'     => __( 'Register', $this->plugin['text'] ),
				'lostpassword' => __( 'Lostpasswordt', $this->plugin['text'] ),
			),
			'func'   => 'itemtype(this);',
		);
		$item_link_[ $i ]            = array(
			'name' => 'param[menu_2][item_link][]',
			'type' => 'text',
			'val'  => isset( $param['menu_2']['item_link'][ $i ] ) ? $param['menu_2']['item_link'][ $i ] : '',
		);
	}

}