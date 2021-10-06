<?php
/**
 * DataBase Update
 *
 * @package     Wow_Plugin
 * @subpackage  Includes/Database
 * @author      Dmytro Lobov <i@lobov.dev>
 * @copyright   2019 Wow-Company
 * @license     GNU Public License
 * @version     2.0

 */

namespace floatingbutton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates and updates a record in the database
 *
 * @since 1.0
 *
 * @property string plugin_dir - filesystem directory path for the plugin
 * @property string basedir    - URL to the file which saving CSS and JS files
 */
class Wow_DB_Update {
	
	/**
	 * Create a new Item in the database
	 *
	 * @param string $table name of the datatable
	 * @param string $info  array of parameters to save to the database
	 *
	 * @since 1.0
	 */
	function create_item( $table, $info ) {
		global $wpdb;
		$fields = $wpdb->get_col( "DESC " . $table, 0 );
		// Collect all passed parameters
		$data = array();
		foreach ( $fields as $key ) {
			if ( is_array( $info[ $key ] ) == true ) {
				$data[ $key ] = serialize( $info[ $key ] );
			} else {
				$data[ $key ] = $info[ $key ];
			}
		}
		// Insert in database
		$wpdb->insert( $table, $data );
	}
	
	/**
	 * Update an existing item in the database
	 *
	 * @param string $table name of the datatable
	 * @param string $info  array of parameters to save to the database
	 *
	 * @since 1.0
	 */
	function update_item( $table, $info ) {
		global $wpdb;
		$fields = $wpdb->get_col( "DESC " . $table, 0 );
		// Collect all passed parameters
		$data = array();
		foreach ( $fields as $key ) {
			if ( is_array( $info[ $key ] ) == true ) {
				$data[ $key ] = serialize( $info[ $key ] );
			} else {
				$data[ $key ] = $info[ $key ];
			}
		}
		
		$id = absint( $info["id"] );
		$wpdb->update( $table, $data, array( 'id' => $id ), $format = null, $where_format = null );

	}
}
