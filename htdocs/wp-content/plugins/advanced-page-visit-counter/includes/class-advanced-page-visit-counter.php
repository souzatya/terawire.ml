<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://pagevisitcounter.com
 * @since      2.5.2
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.5.2
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class Advanced_Visit_Counter {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.5.2
	 * @access   protected
	 * @var      Advanced_Visit_Counter_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.5.2
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.5.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.5.2
	 */
	public function __construct() {
		if ( defined( 'ADVANCED_PAGE_VISIT_COUNTER' ) ) {
			$this->version = ADVANCED_PAGE_VISIT_COUNTER;
		} else {
			$this->version = '2.5.2';
		}
		$this->plugin_name = 'advanced-page-visit-counter';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Advanced_Visit_Counter_Loader. Orchestrates the hooks of the plugin.
	 * - Advanced_Visit_Counter_i18n. Defines internationalization functionality.
	 * - Advanced_Visit_Counter_Admin. Defines all hooks for the admin area.
	 * - Advanced_Visit_Counter_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.5.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-page-visit-counter-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-page-visit-counter-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-advanced-page-visit-counter-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-advanced-page-visit-counter-public.php';

		$this->loader = new Advanced_Visit_Counter_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Advanced_Visit_Counter_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.5.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Advanced_Visit_Counter_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.5.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Advanced_Visit_Counter_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles', 10 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 10 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'avc_settings_page_init' );
		$this->loader->add_action( 'wp_ajax_save_avc_config', $plugin_admin, 'save_avc_config' );
		$this->loader->add_action( 'wp_ajax_avc_reset_settings', $plugin_admin, 'avc_reset_settings' );
		$this->loader->add_action( 'wp_ajax_avc_reset_counters', $plugin_admin, 'avc_reset_counters' );
		$this->loader->add_action( 'wp_ajax_generate_shortcode', $plugin_admin, 'generate_shortcode' );
		$this->loader->add_action( 'wp_ajax_get_pie_chart_data', $plugin_admin, 'get_pie_chart_data' );
		$this->loader->add_action( 'wp_ajax_get_pie_chart_data_for_country', $plugin_admin, 'get_pie_chart_data_for_country' );
		$this->loader->add_action( 'wp_ajax_get_ip_address_chart_data', $plugin_admin, 'get_ip_address_chart_data' );
		$this->loader->add_action( 'wp_ajax_get_referrer_chart_data', $plugin_admin, 'get_referrer_chart_data' );
		$this->loader->add_action( 'wp_ajax_get_weekly_chart_data', $plugin_admin, 'get_weekly_chart_data' );
		$this->loader->add_action( 'wp_ajax_get_monthly_chart_data', $plugin_admin, 'get_monthly_chart_data' );
		$this->loader->add_action( 'wp_ajax_get_trending_this_week_post_data', $plugin_admin, 'get_trending_this_week_post_data' );

		$this->loader->add_action( 'upgrader_process_complete', $plugin_admin, 'apv_upgrader_process_complete' );

		$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'add_apvc_dashboard_widgets' );

		$this->loader->add_action( 'admin_head', $plugin_admin, 'add_apvc_dashboard_css' );

		$this->loader->add_action( 'save_post', $plugin_admin, 'apvc_advanced_save_metaboxes' );

		$this->loader->add_action('wp_ajax_stats_datatable', $plugin_admin, 'apvc_get_all_stats');
		$this->loader->add_action('wp_ajax_nopriv_stats_datatable', $plugin_admin, 'apvc_get_all_stats');

		$this->loader->add_action('wp_ajax_stats_datatable_details', $plugin_admin, 'apvc_get_all_stats_details');
		$this->loader->add_action('wp_ajax_nopriv_stats_datatable_details', $plugin_admin, 'apvc_get_all_stats_details');

		$this->loader->add_action('upgrader_process_complete', $plugin_admin, 'apvc_upgrader_process_complete', 10, 2);

		$this->loader->add_action('wp_ajax_apvc_get_top_10_page_data', $plugin_admin, 'apvc_get_top_10_page_data');
		$this->loader->add_action('wp_ajax_apvc_get_top_10_ipaddress_data', $plugin_admin, 'apvc_get_top_10_ipaddress_data');
		$this->loader->add_action('wp_ajax_apvc_get_top_10_referer_data', $plugin_admin, 'apvc_get_top_10_referer_data');
		$this->loader->add_action('wp_ajax_apvc_get_top_10_browsers_data', $plugin_admin, 'apvc_get_top_10_browsers_data');
		$this->loader->add_action('wp_ajax_apvc_get_top_10_os_data', $plugin_admin, 'apvc_get_top_10_os_data');
		$this->loader->add_action('wp_ajax_apvc_get_all_articles_sh', $plugin_admin, 'apvc_get_all_articles_sh');
		$this->loader->add_action('wp_ajax_apvc_update_subscriber_option', $plugin_admin, 'apvc_update_subscriber_option');

		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.5.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Advanced_Visit_Counter_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp', $plugin_public, 'update_page_visit_stats' );
		$this->loader->add_shortcode( 'avc_visit_counter', $plugin_public, 'public_avc_visit_counter' );
		$this->loader->add_shortcode( 'apvc_embed', $plugin_public, 'public_avc_visit_counter' );
		$this->loader->add_filter( 'the_content', $plugin_public, 'public_add_counter_to_content' );
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.5.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.5.2
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.5.2
	 * @return    Advanced_Visit_Counter_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.5.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
