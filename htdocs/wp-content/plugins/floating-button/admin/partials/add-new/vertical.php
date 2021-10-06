<?php
/**
 * Vertical Buttons Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( 'settings/vertical.php' );
?>

<div class="adding-menu-1">
	<?php if ( $count_i > 0 ) {
		for ( $i = 0; $i < $count_i; $i ++ ) { ?>
					<fieldset>
						<legend><?php _e( 'Item ', $this->plugin['text'] ); ?><?php echo $i + 1; ?></legend>
						<div class="container">
							<div class="element">
				  <?php _e( 'Icon', $this->plugin['text'] ); ?> <?php echo self::pro(); ?> <br/>
				  <?php echo self::option( $item_icon_[ $i ] ); ?>
							</div>
							<div class="element">
				  <?php echo self::option( $item_tooltip_include_[ $i ] ); ?> <?php _e( 'Tooltip',
					  $this->plugin['text'] ); ?>
								<span class="item-tooltip"> -
							<input type="checkbox" disabled> <?php _e( 'Hold Open',
						$this->plugin['text'] ); ?> <?php echo self::pro(); ?>
						</span>
								<br/>
				  <?php echo self::option( $item_tooltip_[ $i ] ); ?>
							</div>
							<div class="element">
							</div>
						</div>
						<div class="container">
							<div class="element">
				  <?php _e( 'Button color', $this->plugin['text'] ); ?><br/>
				  <?php echo self::option( $button_color_[ $i ] ); ?>
							</div>
							<div class="element">
				  <?php _e( 'Button hover color', $this->plugin['text'] ); ?><br/>
				  <?php echo self::option( $button_hcolor_[ $i ] ); ?>
							</div>
							<div class="element">
				  <?php _e( 'Icon color', $this->plugin['text'] ); ?><br/>
				  <?php echo self::option( $icon_color_[ $i ] ); ?>

							</div>
						</div>
						<div class="container">
							<div class="element">
				  <?php _e( 'Item type',
					  $this->plugin['text'] ); ?><?php echo self::tooltip( $item_type_menu_help ); ?> <?php echo self::pro(); ?>
								<br/>
				  <?php echo self::option( $item_type_[ $i ] ); ?>
							</div>
							<div class="element type-param">
								<div class="type-link">
									<span class="type-link-text">Link</span>:<br/>
					<?php echo self::option( $item_link_[ $i ] ); ?>
								</div>
							</div>
							<div class="element">
							</div>
						</div>

						<div class="container">
							<div class="element">
				  <?php _e( 'ID for element', $this->plugin['text'] ); ?> <?php echo self::pro(); ?>
								<input type="text" disabled>
							</div>
							<div class="element">
				  <?php _e( 'Class for element', $this->plugin['text'] ); ?> <?php echo self::pro(); ?>
								<input type="text" disabled>
							</div>
							<div class="element">
							</div>
						</div>

					</fieldset>
			<?php
		}
	}
	?>
</div>

<div class="submit-bottom">
	<input type="button" value="Add item" class="add-item" onclick="itemadd(1)">
	<input type="button" class="delete-item" value="Delete last item" onclick="itemremove(1)">
</div>
