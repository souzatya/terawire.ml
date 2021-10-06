<?php
/**
 * Main Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once( 'settings/main.php' );

?>


<div class="container">
	<div class="element">
	  <?php _e( 'Main Icon', $this->plugin['text'] ); ?> <?php echo self::pro(); ?> <br/>
	  <?php echo self::option( $button_icon ); ?>
	</div>
	<div class="element">
	  <input type="checkbox" disabled="disabled"> <?php _e( 'Close Icon Enable', $this->plugin['text'] ); ?>
<?php echo self::tooltip( $close_button_enable_helper ); ?> <?php echo self::pro(); ?>
	</div>
	<div class="element">
		<input type="checkbox" disabled="disabled"> <?php _e( 'Hold buttons open', $this->plugin['text'] ); ?>
	  <?php echo self::tooltip( $hold_buttons_open_helper ); ?><?php echo self::pro(); ?><br/>

	</div>
</div>

<div class="container">
	<div class="element">
		<?php _e( 'Position', $this->plugin['text'] ); ?>
		<?php echo self::tooltip( $position_help ); ?> <?php echo self::pro(); ?>
		<?php echo self::option( $position ); ?>
  </div>

	<div class="element">
	  <?php _e( 'Button shape', $this->plugin['text'] ); ?> <?php echo self::pro(); ?><br/>
	  <?php echo self::option( $shape ); ?>
	</div>


	<div class="element">
		<?php _e( 'Size', $this->plugin['text'] ); ?> <?php echo self::pro(); ?>
		<?php echo self::option( $size ); ?>
  </div>

</div>

<div class="container">

	<div class="element">
	  <?php _e( 'Button animation', $this->plugin['text'] ); ?> <?php echo self::tooltip( $button_animation_helper ); ?> <?php echo self::pro(); ?>
		<select>
			<option><?php _e( 'None', $this->plugin['text'] ); ?></option>
		</select>
	</div>
	<div class="element">
	  <?php _e( 'Sub-buttons Animation', $this->plugin['text'] ); ?> <?php echo self::pro(); ?>
	  <?php echo self::option( $animation ); ?>
	</div>
	<div class="element">
		<input type="checkbox" disabled> <?php _e( 'Tooltip', $this->plugin['text'] ); ?> <?php echo self::pro(); ?>
	</div>
</div>

<div class="container">
	<div class="element">
	  <?php _e( 'Class for element', $this->plugin['text'] ); ?><?php echo self::tooltip( $main_button_class_help ); ?> <?php echo self::pro(); ?>
		<br/>
		<input type="text" disabled>
	</div>

	<div class="element">
	  <?php _e( 'Button type', $this->plugin['text'] ); ?><?php echo self::tooltip( $item_type_help ); ?> <?php echo self::pro(); ?>
	  <?php echo self::option( $item_type ); ?>
	</div>
	<div class="element">
	</div>

</div>

<div class="container">
	<div class="element">
	  <?php _e( 'Button color', $this->plugin['text'] ); ?><br/>
	  <?php echo self::option( $button_color ); ?>
	</div>
	<div class="element">
	  <?php _e( 'Button hover color', $this->plugin['text'] ); ?><br/>
	  <?php echo self::option( $button_hcolor ); ?>
	</div>
	<div class="element">
	  <?php _e( 'Icon color', $this->plugin['text'] ); ?><br/>
	  <?php echo self::option( $icon_color ); ?>
	</div>
</div>

<div class="container">
	<div class="element">
	  <?php _e( 'Tooltip background', $this->plugin['text'] ); ?><br/>
	  <?php echo self::option( $tooltip_background ); ?>
	</div>
	<div class="element">
	  <?php _e( 'Tooltip color', $this->plugin['text'] ); ?><br/>
	  <?php echo self::option( $tooltip_color ); ?>
	</div>
	<div class="element">
	</div>
</div>

