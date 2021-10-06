<?php

/**
 * Fired during plugin activation
 *
 * @link       https://pagevisitcounter.com
 * @since      2.5.2
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.5.2
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class Advanced_Visit_Counter_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    2.5.2
	 */
	public static function activate() {
		global $wpdb;

		$avc_config = array();
		$history_table = $wpdb->prefix . "avc_page_visit_history";

		$avc_config['post_types'] = array( "post", "page" );
		$avc_config['ip_address'] = array();
		$avc_config['exclude_counts'] = array();
		$avc_config['exclude_users'] = array(); 
		$avc_config['exclude_show_counter'] = array(); 
		$avc_config['spam_controller'] = "false";
		$avc_config['show_conter_on_fron_side'] = "below_the_content";
		$avc_config['avc_default_text_color_of_counter'] = "#000000";
		$avc_config['apv_default_label'] = "Visits: ";
		$avc_config['apv_default_border_radius'] = 0;
		$avc_config['apv_default_background_color'] = "#ffffff";
		$avc_config['apv_default_border_color'] = "#000000";
		$avc_config['apv_default_border_width'] = "2";
		$avc_config['wid_alignment'] = "left";
		
		add_option("avc_config",json_encode($avc_config));

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sqlAlter = "ALTER TABLE $history_table DROP COLUMN article_title";
		$wpdb->query( $sqlAlter );
		$addColumn = "ALTER TABLE $history_table ADD country TEXT AFTER flag";
		$wpdb->query( $addColumn );
		// dbDelta( $sqlAlter );
		
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$history_table'" ) != $history_table ) {
			$sql = "CREATE TABLE $history_table (
				id int(11) unsigned NOT NULL AUTO_INCREMENT,
				article_id int(11) NOT NULL,
				article_type text NOT NULL,
				user_type text NOT NULL,
				device_type text NOT NULL,
				date  datetime NOT NULL,
				last_date  datetime NOT NULL,
				ip_address varchar(255) NOT NULL,
				browser_full_name varchar(255) NOT NULL,
				browser_short_name varchar(255) NOT NULL,
				browser_version varchar(255) NOT NULL,
				operating_system varchar(255) NOT NULL,
				http_referer varchar(255) NOT NULL,
				user_id int(9) NOT NULL,
				site_id int(9) NOT NULL,
				flag int(1) NULL,
				country varchar(255),
				PRIMARY KEY  (id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		update_option("apvc_version","2.5.2");
		update_option("apvc_newsletter","show");
	}

}
