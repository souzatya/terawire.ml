<?php
/**
 * Elements for clone
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( 'settings/clone.php' );
?>
<fieldset id="adding-menu-1">
	<legend><?php _e( 'Item ', $this->plugin['text'] ); ?> <span class="item"></span></legend>
	<div class="container">
		<div class="element">
		<?php _e( 'Icon', $this->plugin['text'] ); ?> <?php echo self::pro(); ?><br/>
		<?php echo self::option( $menu_1_item_icon ); ?>
		</div>
		<div class="element">
		<?php echo self::option( $menu_1_item_tooltip_include ); ?> <?php _e( 'Tooltip', $this->plugin['text'] ); ?>
			<br/>
		<?php echo self::option( $menu_1_item_tooltip ); ?>
		</div>
		<div class="element">
		</div>
	</div>
	<div class="container">
		<div class="element">
		<?php _e( 'Button color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_1_button_color ); ?>
		</div>
		<div class="element">
		<?php _e( 'Button hover color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_1_button_hcolor ); ?>
		</div>
		<div class="element">
		<?php _e( 'Icon color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_1_icon_color ); ?>

		</div>
	</div>
	<div class="container">
		<div class="element">
		<?php _e( 'Item type', $this->plugin['text'] ); ?> <?php echo self::pro(); ?><br/>
		<?php echo self::option( $menu_1_item_type ); ?>
		</div>
		<div class="element type-param">
			<div class="type-link">
				<span class="type-link-text">Link</span>:<br/>
		  <?php echo self::option( $menu_1_item_link ); ?>
			</div>
		</div>
		<div class="element">
		</div>
	</div>
</fieldset>
<fieldset id="adding-menu-2">
	<legend><?php _e( 'Item ', $this->plugin['text'] ); ?> <span class="item"></span></legend>
	<div class="container">
		<div class="element">
		<?php _e( 'Icon', $this->plugin['text'] ); ?> <?php echo self::pro(); ?><br/>
		<?php echo self::option( $menu_2_item_icon ); ?>

		</div>
		<div class="element">
		<?php echo self::option( $menu_2_item_tooltip_include ); ?> <?php _e( 'Tooltip', $this->plugin['text'] ); ?>
			<br/>
		<?php echo self::option( $menu_2_item_tooltip ); ?>
		</div>
		<div class="element">
		</div>
	</div>
	<div class="container">
		<div class="element">
		<?php _e( 'Button color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_2_button_color ); ?>
		</div>
		<div class="element">
		<?php _e( 'Button hover color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_2_button_hcolor ); ?>
		</div>
		<div class="element">
		<?php _e( 'Icon color', $this->plugin['text'] ); ?><br/>
		<?php echo self::option( $menu_2_icon_color ); ?>

		</div>
	</div>
	<div class="container">
		<div class="element">
		<?php _e( 'Item type', $this->plugin['text'] ); ?> <?php echo self::pro(); ?><br/>
		<?php echo self::option( $menu_2_item_type ); ?>
		</div>
		<div class="element type-param">
			<div class="type-link">
				<span class="type-link-text">Link</span>:<br/>
		  <?php echo self::option( $menu_2_item_link ); ?>
			</div>
		</div>
		<div class="element">
		</div>
	</div>
</fieldset>
