<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pagevisitcounter.com
 * @since      2.5.2
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class Advanced_Visit_Counter_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.5.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.5.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.5.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.5.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Visit_Counter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if( isset($_GET['page']) && ( $_GET['page'] == 'apvc-settings' ||  $_GET['page'] == 'apvc-reports'  || $_GET['page'] == 'apvc-shortcode-generator' || $_GET['page'] == 'apvc-reports-visual' || $_GET['page'] == 'apvc-dashboard' ) ){

			wp_enqueue_style( 'apvc-materialize-css', plugin_dir_url( __FILE__ ) . 'css/materialize.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'apvc-minicolors-css', plugin_dir_url( __FILE__ ) . 'css/jquery.minicolors.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'apvc-charts-css', plugin_dir_url( __FILE__ ) . 'css/apexcharts.css', array(), $this->version, 'all' );

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/advanced-page-visit-counter-admin.css', array(), $this->version, 'all' );

		}

		
		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.5.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Visit_Counter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if( isset($_GET['page']) && ( $_GET['page'] == 'apvc-settings' ||  $_GET['page'] == 'apvc-reports' || $_GET['page'] == 'apvc-shortcode-generator' || $_GET['page'] == 'apvc-reports-visual' || $_GET['page'] == 'apvc-dashboard' ) ){

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'apvc_materialize_js', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, true );

			wp_enqueue_script( 'apvc_cp_js', plugin_dir_url( __FILE__ ) . 'js/jquery.minicolors.min.js', array( 'jquery' ), $this->version, true );

			wp_enqueue_script( 'apvc_charts_js', plugin_dir_url( __FILE__ ) . 'js/apexcharts.min.js', array( 'jquery' ), $this->version, true );

			// wp_enqueue_script( 'apvc_misc_js', plugin_dir_url( __FILE__ ) . 'js/misc.js', array( 'jquery' ), $this->version, true );

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/advanced-page-visit-counter-admin.js', array( 'jquery' ), $this->version, true );
			
			wp_localize_script( $this->plugin_name, 'apv_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'apvc_url' => 'https://pagevisitcounter.com/' ) );	
			
		}

		
	}

	
	/**
	 * Advanced Page Visit Counter Settings Page Init
	 *
	 * @since    2.5.2
	 */
	public function avc_settings_page_init() {

		add_menu_page( __('Advanced Page Visit Counter'), __('Advanced Page Visit Counter'), 'manage_options', 'apvc-dashboard', array($this,'avc_dashboard'),'dashicons-chart-area' );
		
		add_submenu_page('apvc-dashboard', __('Shortcode Generator'), __('Shortcode Generator'), 'manage_options', 'apvc-shortcode-generator', array($this,'avc_shortcode_generator'));

		add_submenu_page('apvc-dashboard', __('Visual Charts'), __('Visual Charts'), 'manage_options', 'apvc-reports-visual', array($this,'avc_reports_page'));

		add_submenu_page('apvc-dashboard', __('Advanced Page Visit Counter'), __('Reports'), 'manage_options', 'apvc-reports', array($this,'avc_reports'));

		add_submenu_page('apvc-dashboard', __('Settings'), __('Settings'), 'manage_options', 'apvc-settings', array($this,'avc_settings_page'));

	}	

	public function apvc_update_subscriber_option() {
		global $wpdb;
		update_option("apvc_newsletter","hide");
		wp_die();
	}
	public function apvc_get_top_10_page_data(){
		global $wpdb;
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$top10Articles = $wpdb->get_results("SELECT article_id, count(*) as count, posts.post_title FROM {$tbl_history} apvc LEFT JOIN $wpdb->posts posts ON apvc.article_id = posts.ID WHERE article_id != '' GROUP BY article_id ORDER BY count DESC LIMIT 10");
		?>
			<table class="striped responsive-table">
		        <thead>
		          <tr>
		              <th><?php echo __("No.","advanced-page-visit-counter");?></th>
		              <th><?php echo __("Article ID","advanced-page-visit-counter");?></th>
		              <th><?php echo __("Article Title","advanced-page-visit-counter");?></th>
		              <th><?php echo __("Visit Count","advanced-page-visit-counter");?></th>
		          </tr>
		        </thead>
		        <tbody>
		        <?php 
		        	$top10Cnt = 1;
		        	foreach( $top10Articles as $top10Article ):
						echo '<tr>';
							echo '<td>'.$top10Cnt.'</td>';
							echo '<td>'.$top10Article->article_id.'</td>';
							echo '<td>'.$top10Article->post_title.'</td>';
							echo '<td>'.$top10Article->count.'</td>';
						echo '</tr>';
						$top10Cnt++;
		        	endforeach;
		        ?>
		        </tbody>
		    </table>
	    <?php
	    wp_die();
	}

	public function apvc_get_top_10_ipaddress_data(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$top10IPAddress = $wpdb->get_results("SELECT ip_address, country, count(*) as count FROM {$tbl_history} WHERE ip_address != '' GROUP BY ip_address ORDER BY count DESC LIMIT 10");
		?>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	              <th><?php echo __("No.","advanced-page-visit-counter");?></th>
	              <th><?php echo __("IP Address","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Country","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Count","advanced-page-visit-counter");?></th>
	          </tr>
	        </thead>
	        <tbody>
	        <?php 
	        	$top10IPCnt = 1;
	        	foreach( $top10IPAddress as $top10IP ):
					echo '<tr>';
						echo '<td>'.$top10IPCnt.'</td>';
						echo '<td>'.$top10IP->ip_address.'</td>';
						echo '<td>'.$top10IP->country.'</td>';
						echo '<td>'.$top10IP->count.'</td>';
					echo '</tr>';
					$top10IPCnt++;
	        	endforeach;
        	?>
	        </tbody>
	    </table>
		<?php
		wp_die();
	}

	public function apvc_get_top_10_referer_data(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$top10Referer = $wpdb->get_results("SELECT http_referer, count(*) as count FROM {$tbl_history} WHERE http_referer != '' GROUP BY http_referer ORDER BY count DESC LIMIT 10");
		?>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	          	<th><?php echo __("No.","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Referer","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Count","advanced-page-visit-counter");?></th>
	          </tr>
	        </thead>
	        <tbody>
	            <?php 
	            $top10RefCnt = 1;
	        	foreach( $top10Referer as $top10Ref ):
					echo '<tr>';
						echo '<td>'.$top10RefCnt.'</td>';
						echo '<td><a href="'.$top10Ref->http_referer.'" target="_blank">'.$top10Ref->http_referer.'</a></td>';
						echo '<td>'.$top10Ref->count.'</td>';
					echo '</tr>';
					$top10RefCnt++;
	        	endforeach;
	        	?>
	        </tbody>
	    </table>
		<?php
		wp_die();
	}

	public function apvc_get_top_10_browsers_data(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$top10Browsers = $wpdb->get_results("SELECT browser_full_name, count(*) as count FROM {$tbl_history} WHERE browser_full_name != '' GROUP BY browser_full_name ORDER BY count DESC LIMIT 5");
		?>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	          	<th><?php echo __("No.","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Browser Name","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Count","advanced-page-visit-counter");?></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php 
	          	$top10BRCnt = 1;
	        	foreach( $top10Browsers as $top10Browser ):
					echo '<tr>';
						echo '<td>'.$top10BRCnt.'</td>';
						echo '<td>'.$top10Browser->browser_full_name.'</td>';
						echo '<td>'.$top10Browser->count.'</td>';
					echo '</tr>';
					$top10BRCnt++;
	        	endforeach;
        		?>
	        </tbody>
	    </table>
		<?php
		wp_die();
	}

	public function apvc_get_top_10_os_data(){
		global $wpdb;
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$top10OS = $wpdb->get_results("SELECT operating_system, count(*) as count FROM {$tbl_history} WHERE operating_system != '' GROUP BY operating_system ORDER BY count DESC LIMIT 5");
		?>
		<table class="striped responsive-table ">
	        <thead>
	          <tr>
	          	<th><?php echo __("No.","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Operating System","advanced-page-visit-counter");?></th>
	              <th><?php echo __("Count","advanced-page-visit-counter");?></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php 
	          	$top10OsCnt = 1;
	        	foreach( $top10OS as $top10Os ):
					echo '<tr>';
						echo '<td>'.$top10OsCnt.'</td>';
						echo '<td>'.ucwords($top10Os->operating_system).'</td>';
						echo '<td>'.$top10Os->count.'</td>';
					echo '</tr>';
					$top10OsCnt++;
	        	endforeach;
        		?>
	        </tbody>
	    </table>
		<?php
		wp_die();
	}

	public function avc_dashboard() {
		global $wpdb;
		$promotionalBlock = get_option("apvc_newsletter",true);
		?>
		<input type="hidden" id="page_type" value="apvc_dashboard_page">
		<?php if( $promotionalBlock == "show" ) { ?>
		<div class="apvc_promotional_block center-align">
			<div class="row">
      			<div class="col s12">
      				<h4><?php echo __("PRO Version is releasing soon...","advanced-page-visit-counter");?></h4>
      				<h6><?php echo __("Subscribe to Our Newsletter to get special discount.","advanced-page-visit-counter");?></h6>
      				  <button class="btn waves-effect waves-light apvc_subscribe_now" type="button" ref="sub_now"><?php echo __("Subscribe Now","advanced-page-visit-counter");?><i class="material-icons right">favorite</i></button>
      				  <button class="btn waves-effect waves-light apvc_subscribe_now" type="button" ref="already"><?php echo __("Already Subscribed","advanced-page-visit-counter");?><i class="material-icons right">favorite_border</i></button>

      			</div>
      		</div>	
		</div>
		<?php } ?>

		<div class="row apvc_dashboard">
		  <div class="col s12">
		  	<div class="top_container center-align">
			    <h5><?php echo __("Top 10 Articles","advanced-page-visit-counter");?></h5>
			    <div id="top10Pages">
					<div class="progress">
						<div class="indeterminate"></div>
					</div>
		    	</div>
		    </div>
		  </div>

		  <div class="col s6">
		  	<div class="top_container center-align">
			    <h5><?php echo __("Top 10 IP Addresses","advanced-page-visit-counter");?></h5>
		    	<div id="top10IP">
		    		<div class="progress">
						<div class="indeterminate"></div>
					</div>
		    	</div>
			</div>
		  </div>
		  
		  <div class="col s6">
		  	<div class="top_container center-align">
			    <h5><?php echo __("Top 10 Referer","advanced-page-visit-counter");?></h5>
		    	<div id="top10REF">
		    		<div class="progress">
						<div class="indeterminate"></div>
					</div>
		    	</div>
			</div>
		  </div>

		  <div class="col s6">
		    <div class="top_container center-align">
			    <h5><?php echo __("Visits by Browser","advanced-page-visit-counter");?></h5>
		    	<div id="top10Browsers">
		    		<div class="progress">
						<div class="indeterminate"></div>
					</div>
		    	</div>
			</div>
		  </div>
		  
		  <div class="col s6">
		    <div class="top_container center-align">
			    <h5><?php echo __("Site Visit By Operating System","advanced-page-visit-counter");?></h5>
		    	<div id="top10OS">
		    		<div class="progress">
						<div class="indeterminate"></div>
					</div>
		    	</div>
			</div>
		  </div>

		  
		</div>
		<?php
	}

	/**
	 * Advanced Page Visit Counter Settings Page
	 *
	 * @since    2.5.2
	 */
	public function avc_settings_page() {
		global $wpdb, $post;
		$avc_config = json_decode((get_option("avc_config")));
		?>
		<input type="hidden" id="page_type" value="apvc_settings_page">
		<div class="row">
	      <div class="col s12">
	      	<h5><?php echo __("Advanced Page Visit Counter - Settings","advanced-page-visit-counter");?></h5>
	      </div>
	      <div class="divider"></div>
	      <div class="col s10 z-depth-1 apvc_shortcode_generator_block">
	      	<div class="apvc_headings"><?php echo __("Settings","advanced-page-visit-counter");?></div>
	      	<div class="apvc_shortcode_settings">
				<div class="input-field col s12">
					<p class="caption"><?php echo __("Post Types:","advanced-page-visit-counter");?></p>
					<select multiple id="apv_post_types">
						<option value="" disabled>Choose your post types</option>
						<?php 
			    			$avc_post_types = get_post_types(); 
			    			foreach( $avc_post_types as $avc_pt ):
		    					if( in_array($avc_pt, $avc_config->post_types) )
		    						$selected = 'selected="selected"';
		    					else 
		    						$selected = "";
			    				echo '<option value="'.esc_html($avc_pt).'" '.$selected.'>'.esc_html($avc_pt).'</option>';
			    			endforeach;
			    		?>
					</select>
					<span><i><?php echo __("*This post types are included in visit counter.","advanced-page-visit-counter");?></i></span>
				</div>
	      		<div class="input-field col s12">
	      			<p class="caption"><?php echo __("Exclude IP Addresses","advanced-page-visit-counter");?></p>
					<div class="chips apv_ip_addresses"></div>
					<span><i><?php echo __("*Please enter ip addresses","advanced-page-visit-counter");?></i></span>
					<input type="hidden" id="apvc_ip_data" value='<?php echo (!empty($avc_config->ip_address)) ? stripslashes($avc_config->ip_address) : ''; ?>'>
	      		</div>
	      		<div class="input-field col s12">
	      			<p class="caption"><?php echo __("Exclude Post/Pages Counts","advanced-page-visit-counter");?></p>
					<div class="chips apv_exclude_counts"></div>
					<span><i><?php echo __("Please enter page/posts ids to exclude from counting.","advanced-page-visit-counter");?></i></span>
					<input type="hidden" id="apvc_ex_data" value='<?php echo (!empty($avc_config->exclude_counts)) ? stripslashes($avc_config->exclude_counts) : ''; ?>'>
					<?php //echo trim(implode(",",$avc_config->exclude_counts)); ?>
	      		</div>
	      		<div class="input-field col s12">
	      			<p class="caption"><?php echo __("Exclude Showing Counter Widget on Pages/Posts","advanced-page-visit-counter");?></p>
					<div class="chips apv_exclude_show_counter"></div>
					<span><i><?php echo __("*Please enter page/posts ids to exclude for showing counter on these pages or posts.");?></i></span>
					<input type="hidden" id="apvc_wd_data" value='<?php echo (!empty($avc_config->exclude_show_counter)) ? stripslashes($avc_config->exclude_show_counter) : ''; ?>'>
					<?php //echo trim(implode(",",$avc_config->exclude_show_counter)); ?>
	      		</div>

	      		<div class="input-field col s12">
	      			<p class="caption"><?php echo __("Exclude Users","advanced-page-visit-counter");?></p>
					<div class="chips apv_exclude_users"></div>
					<span><i><?php echo __("Enter user id only","advanced-page-visit-counter");?></i></span>
					<input type="hidden" id="apvc_usr_data" value='<?php echo (!empty($avc_config->exclude_users)) ? stripslashes($avc_config->exclude_users) : ''; ?>'>
	      		</div>

	      		<div class="input-field col s12">
	      			<p class="caption"><?php echo __("Spam Controller","advanced-page-visit-counter");?></p>
					<!-- Switch -->
					<div class="switch">
						<label>
						  <?php echo __("Off","advanced-page-visit-counter");?>
						  <input type="checkbox" id="apv_spam_controller" <?php if($avc_config->spam_controller == "true") echo "checked"; ?>>
						  <span class="lever"></span>
						  <?php echo __("On","advanced-page-visit-counter");?>
						</label><Br /><Br />
						<span><i><?php echo __("*This setting will ignore visit counts comes from spammers or continues refresh browser windows. ( by enabling this settings we count 1 visit in every 5 minutes from each ip address )","advanced-page-visit-counter");?></i></span>
					</div>
	      		</div>

	      		<div class="apvc_headings"><?php echo __("Widget Styling","advanced-page-visit-counter");?></div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Show Counter on Front End","advanced-page-visit-counter");?></p>
					<select id="show_conter_on_fron_side">
				      	<option value="" disabled selected>Choose your option</option>
						<option value="disable" selected=""><?php echo __("Hide","advanced-page-visit-counter"); ?></option>
				        <option value="above_the_content" <?php if($avc_config->show_conter_on_fron_side=="above_the_content") echo "selected";?>><?php echo __("Above the content","advanced-page-visit-counter");?></option>
				        <option value="below_the_content" <?php if($avc_config->show_conter_on_fron_side=="below_the_content") echo "selected";?>><?php echo __("Below the content","advanced-page-visit-counter");?></option>
				    </select>
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Counter Text Color","advanced-page-visit-counter");?></p>
					<input id="apv_default_text_color" value="<?php echo $avc_config->avc_default_text_color_of_counter;?>" type="text" class="color no-alpha">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Counter Border Color","advanced-page-visit-counter");?></p>
					<input value="<?php echo $avc_config->apv_default_border_color;?>" id="apv_default_border_color" type="text" class="color no-alpha">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Background Color","advanced-page-visit-counter");?></p>
					<input id="apv_default_background_color" value="<?php echo $avc_config->apv_default_background_color;?>" type="text" class="color no-alpha">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Border Radius","advanced-page-visit-counter");?></p>
					<input id="apv_default_border_radius" value="<?php echo $avc_config->apv_default_border_radius;?>" min="0" value="0" type="number">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Border Width","advanced-page-visit-counter");?></p>
					<input id="apv_default_border_width" min="0" value="<?php echo $avc_config->apv_default_border_width;?>" value="2" type="number">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Default Label","advanced-page-visit-counter");?></p>
					<input id="apv_default_label" value="<?php echo $avc_config->apv_default_label; ?>" placeholder="Visits:" type="text" value="Visits">
	      		</div>
	      		<div class="input-field col s6">
	      			<p class="caption"><?php echo __("Widget Alignment","advanced-page-visit-counter");?></p>
					<select name="wid_alignment" id="wid_alignment">
				      <option value="" disabled><?php echo __("Choose your option","advanced-page-visit-counter");?></option>
						<option value="left" <?php if($avc_config->wid_alignment=="left") echo "selected";?> selected=""><?php echo __("Left - Default","advanced-page-visit-counter"); ?></option>
				        <option value="right" <?php if($avc_config->wid_alignment=="right") echo "selected";?>><?php echo __("Right","advanced-page-visit-counter"); ?></option>
				        <option value="center" <?php if($avc_config->wid_alignment=="center") echo "selected";?>><?php echo __("Center","advanced-page-visit-counter"); ?></option>
				    </select>
	      		</div>
	      		<a class="waves-effect waves-light btn-large submit_config modal-trigger" onclick="showSwal()"><i class="material-icons left">build</i><?php echo __("Save Changes","advanced-page-visit-counter");?></a>
				<a class="waves-effect waves-red btn-large modal-trigger" href="#modalResetAll" onclick="showSwal()"><i class="material-icons left">loop</i><?php echo __("Reset All","advanced-page-visit-counter");?></a>
				<a class="waves-effect waves-red btn-large modal-trigger"  href="#modalResetAllCounter" onclick="showSwal()"><i class="material-icons right">loop</i><?php echo __("Reset All Counters","advanced-page-visit-counter");?></a>

				<script type="text/javascript">
					function showSwal( string = null ){
						jQuery('.modal').modal();
					}
				</script>

				  <!-- Modal Structure -->
				  <div id="modalResetAll" class="modal">
				    <div class="modal-content">
				      <div class="modal-body center-align">
				      	<i class="large material-icons">delete_forever</i>
				        <h5><?php echo esc_html(__("Are you sure to reset all settings?"));?></h5>
				      </div>
				    </div>
				    <div class="modal-footer center-align">
				      <a href="#!" class="btn btn-primary modal-close waves-effect waves-green btn-flat reset_all" id="reset_all"><?php echo __("Yes","advanced-page-visit-counter");?></a>  
				      <a href="#!" class="btn btn-primary modal-close waves-effect waves-green btn-flat"><?php echo __("No","advanced-page-visit-counter");?></a>
				    </div>
				  </div>

				  <div id="modalResetAllCounter" class="modal">
				    <div class="modal-content center-align">
				    	<i class="large material-icons">delete_sweep</i>
				      <h5><?php echo esc_html(__("Are you sure to reset all statistics?","advanced-page-visit-counter"));?></h5>
				    </div>
				    <div class="modal-footer">
		        	<a href="#!" class="btn btn-primary modal-close waves-effect waves-green btn-flat reset_counts"><?php echo __("Yes","advanced-page-visit-counter");?></a>
				    <a href="#!" class="btn btn-primary modal-close waves-effect waves-green btn-flat"><?php echo __("No","advanced-page-visit-counter");?></a>
				    </div>
				  </div>
	      	</div>
	      </div>
	    </div>
	<?php
	}

	/**
	 * Advanced Page Visit Counter Settings Page
	 *
	 * @since    2.5.2
	 */
	public function avc_shortcode_generator() {
		global $wpdb;
		?>
		<input type="hidden" id="page_type" value="apvc_shortcode_gen_page">
		<div class="row apvc_shortocode_gen">
	      <div class="col s12">
	      	<h5><?php echo __("Advanced Page Visit Counter - Shortcode Designer","advanced-page-visit-counter");?>
	      	</h5>
	      </div>
	      <div class="divider"></div>

	      <div class="col s6 z-depth-1 apvc_shortocode_output center-align">
			<div class="apvc_headings"><?php echo __("Shortcode Generator","advanced-page-visit-counter");?></div>
			<div class="shortcode_output" id="genOutput">
				<?php echo __("Shortcode output","advanced-page-visit-counter");?>
			</div>
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
	      </div>

	      <div class="col s6 z-depth-1 apvc_shortcode_generator_block">
	      	<div class="apvc_headings"><?php echo __("Shortcode Designer","advanced-page-visit-counter");?></div>
	      	<div class="apvc_shortcode_designer">
	      		<div class="col s6 input-field">
	      			<p class="caption"><?php echo __("Border Size (in pixels)","advanced-page-visit-counter");?></p>
	      			<input placeholder="<?php echo __("Border Size in pixels","advanced-page-visit-counter");?>" id="border_size" type="number" min="0" max="8" value="2" class="validate">
          		</div>
	      		<div class="col s6 input-field">
	      			<p class="caption"><?php echo __("Border Radius (in pixels)","advanced-page-visit-counter");?></p>
	      			<input placeholder="<?php echo __("Border Radius in pixels","advanced-page-visit-counter");?>" id="border_radius" type="number" min="0" value="5">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Border Style","advanced-page-visit-counter");?></p>
      			    <select id="border_style">
				      <option value="" disabled selected><?php echo __("Choose your option","advanced-page-visit-counter");?></option>
						<option value="none"><?php echo __("None","advanced-page-visit-counter");?></option>
						<option value="dotted"><?php echo __("Dotted","advanced-page-visit-counter");?></option>
						<option value="dashed"><?php echo __("Dashed","advanced-page-visit-counter");?></option>
						<option value="solid" selected=""><?php echo __("Solid","advanced-page-visit-counter");?></option>
						<option value="double"><?php echo __("Double","advanced-page-visit-counter");?></option>
				    </select>
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Border Color","advanced-page-visit-counter");?></p>
      			    <input id="border_color" type="text" class="color no-alpha">
      				
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Font Size","advanced-page-visit-counter");?></p>
	      			<input placeholder="<?php echo __("Font Size in pixels","advanced-page-visit-counter");?>" value="14" id="font_size" type="number" min="7">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Font Color","advanced-page-visit-counter");?></p>
      			    <input id="font_color" type="text" class="color no-alpha">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Font Style","advanced-page-visit-counter");?></p>
      			    <select id="font_style">
				      <option value="" disabled selected><?php echo __("Choose your option","advanced-page-visit-counter");?></option>
						<option value=""><?php echo __("Please Select","advanced-page-visit-counter");?></option>
						<option value="normal"><?php echo __("Normal","advanced-page-visit-counter");?></option>
						<option value="bold"><?php echo __("Bold","advanced-page-visit-counter");?></option>
						<option value="italic"><?php echo __("Italic","advanced-page-visit-counter");?></option>
				    </select>
          		</div>

          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Background Color","advanced-page-visit-counter");?></p>
      			    <input id="bg_color" type="text" class="color no-alpha">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Padding","advanced-page-visit-counter");?></p>
	      			<input placeholder="<?php echo __("Padding in pixels","advanced-page-visit-counter");?>" value="15" id="padding" type="number" min="0">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Width","advanced-page-visit-counter");?></p>
	      			<input placeholder="<?php echo __("Width in pixels","advanced-page-visit-counter");?>" value="200" id="width" type="number" min="100">
          		</div>
          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Counter Label","advanced-page-visit-counter");?></p>
	      			<input value="Visits: " id="counter_label" type="text">
          		</div>

          		<div class="col s6 input-field">
          			<p class="caption"><?php echo __("Shortcode Type","advanced-page-visit-counter");?></p>
      			    <select id="shortcode_type">
				      <option value="" disabled selected><?php echo __("Choose your option","advanced-page-visit-counter");?></option>
						<option value="customized" selected><?php echo __("Customized","advanced-page-visit-counter");?></option>
						<option value="global"><?php echo __("Global","advanced-page-visit-counter");?></option>
						<option value="individual"><?php echo __("For Specific Post/Page","advanced-page-visit-counter");?></option>
				    </select>
          		</div>

				<div class="col s12 ind_article">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">book</i>
							<input type="text" id="apvc_ind_articles" class="autocomplete">
							<label for="autocomplete-input"><?php echo __("Articles","advanced-page-visit-counter");?></label>
							<div class="warning"><?php echo __("Please select article to create shortcode.","advanced-page-visit-counter");?></div>
						</div>
					</div>
				</div>

          		<a class="waves-effect waves-light btn-large" id="genButton"><i class="material-icons right">settings</i><?php echo __("Generate Shortcode","advanced-page-visit-counter");?></a>

	      	</div>
	      </div>
	    </div>
		<?php 

	}	


	/**
	 * Advanced Page Visit Counter Save config page by using ajax
	 *
	 * @since    2.5.2
	 */
	public function save_avc_config() {
		global $wpdb;	

		$postTypes = $_REQUEST['postTypes'];

		$exclude_counts = stripslashes($_REQUEST['exclude_counts']);		
		$exclude_show_counter = stripslashes($_REQUEST['exclude_show_counter']);
		$ipAddresses = stripslashes($_REQUEST['ipAddresses']);
		$excludeUser = stripslashes($_REQUEST['excludeUser']);

		$apv_default_label = sanitize_text_field($_REQUEST['apv_default_label']);
		$spamCheck = sanitize_text_field($_REQUEST['spamCheck']);
		$showCounter = sanitize_text_field($_REQUEST['showCounter']);
		$counterColor = (sanitize_text_field($_REQUEST['counterColor']))? sanitize_text_field($_REQUEST['counterColor']) : '#000000';

		$apv_default_border_color = (sanitize_text_field($_REQUEST['apv_default_border_color'])) ? sanitize_text_field($_REQUEST['apv_default_border_color']) : '#000000';

		$apv_default_background_color = (sanitize_text_field($_REQUEST['apv_default_background_color'])) ? sanitize_text_field($_REQUEST['apv_default_background_color']) : '#FFFFFF';

		$apv_default_border_radius = (sanitize_text_field($_REQUEST['apv_default_border_radius'])) ? sanitize_text_field($_REQUEST['apv_default_border_radius']) : 0;

		$apv_default_border_width = (sanitize_text_field($_REQUEST['apv_default_border_width'])) ? sanitize_text_field($_REQUEST['apv_default_border_width']) : 2;

		$wid_alignment = (!empty($_REQUEST['wid_alignment'])) ? $_REQUEST['wid_alignment'] : 'left';
		
		$avc_config = json_decode(get_option("avc_config"));

		if( is_null($postTypes) ){
			$postTypes = array();
		}

		$postTypesArr = $postTypes;
		$ipAddressesArr = $ipAddresses;
		$excludeUserArr = $excludeUser;

		$avc_config->post_types = $postTypesArr;
		$avc_config->ip_address = $ipAddressesArr;
		$avc_config->exclude_counts = $exclude_counts;
		$avc_config->exclude_show_counter = $exclude_show_counter;
		$avc_config->exclude_users = $excludeUserArr;
		$avc_config->spam_controller = $spamCheck;
		$avc_config->show_conter_on_fron_side = $showCounter;
		$avc_config->avc_default_text_color_of_counter = $counterColor;
		$avc_config->apv_default_border_color = $apv_default_border_color;
		$avc_config->apv_default_background_color = $apv_default_background_color;
		$avc_config->apv_default_label = $apv_default_label;
		$avc_config->apv_default_border_radius = $apv_default_border_radius;
		$avc_config->apv_default_border_width = $apv_default_border_width;
		$avc_config->wid_alignment = $wid_alignment;

		update_option( "avc_config", json_encode($avc_config) );

		wp_die();
	}	

	/**
	 * Advanced Page Visit Counter Reset all settings to default settings
	 *
	 * @since    2.5.2
	 */
	public function avc_reset_settings() {
		global $wpdb;
		$avc_config = array();

		$avc_config['post_types'] = array( "post", "page" );
		$avc_config['ip_address'] = array();
		$avc_config['exclude_users'] = array(); 
		$avc_config['exclude_counts'] = array();
		$avc_config['exclude_show_counter'] = array(); 
		$avc_config['spam_controller'] = "false";
		$avc_config['show_conter_on_fron_side'] = "below_the_content";
		$avc_config['avc_default_text_color_of_counter'] = "#000000";
		$avc_config['apv_default_border_color'] = "#000000";
		$avc_config['apv_default_background_color'] = "#ffffff";
		$avc_config['apv_default_border_radius'] = 0;
		$avc_config['apv_default_label'] = "Visits: ";
		$avc_config['apv_default_border_width'] = 2;
		$avc_config['wid_alignment'] = 'left';
			
		update_option("avc_config",json_encode($avc_config));

		wp_die();
	}


	/**
	 * Advanced Page Visit Counter Reset all page, post and products counts to 0
	 *
	 * @since    2.5.2
	 */
	public function avc_reset_counters() {
		global $wpdb;
		
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$wpdb->query("TRUNCATE TABLE {$tbl_history}");

		wp_die();
	}

	/**
	 * Advanced Page Visit Counter Reports
	 *
	 * @since    2.5.2
	 */
	public function avc_reports() {
		global $wpdb;
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
	?>
	<input type="hidden" id="page_type" value="apvc_reports_page">
		
	<div class="row apvc_reports_page">
		<div class="col s12 z-depth-1">
		<h5><?php echo esc_html(__("Advanced Page Visit Counter - Reports","advanced-page-visit-counter"));?></h5>
			<?php 
            	if( isset($_GET["apvc_pt"]) && !empty($_GET["apvc_pt"]) ){
      				$current_pt = $_GET["apvc_pt"];
      			}

      			if( isset($_GET["apc"]) && !empty($_GET["apc"]) ){
      				$apc = $_GET["apc"];
      				$apc_var = "&apc=".$apc;
      			} else {
      				$apc = 20;
      				$apc_var = "";
      			}

      			if( isset($_GET['aID']) && $_GET['aID'] != '' ) {
					$aID = sanitize_text_field($_GET['aID']);
					$query = " AND article_id=$aID";
					$total_records = $wpdb->get_var("SELECT count(*) as count FROM {$tbl_history} WHERE `article_id`=$aID");
				} else {
					$query = "";
					$total_records = count($wpdb->get_results("SELECT count(*) as count FROM {$tbl_history} WHERE `article_id` != '' GROUP BY article_id"));
				}

				$aID = sanitize_text_field($_GET['aID']);
				if (isset($_GET['page_no']) && $_GET['page_no']!="") {
					$page_no = $_GET['page_no'];
				} else {
					$page_no = 1;
			    }

				$total_records_per_page = $apc;
			    $offset = ($page_no-1) * $total_records_per_page;
				$previous_page = $page_no - 1;
				$next_page = $page_no + 1;
				$adjacents = "2"; 

				$total_no_of_pages = ceil($total_records / $total_records_per_page);
				$second_last = $total_no_of_pages - 1;

				if( !empty($current_pt) ) {
					$allArticles = $wpdb->get_results("SELECT *,COUNT(*) as count FROM {$tbl_history} WHERE article_id != '' AND article_type = '$current_pt' $query GROUP BY article_id ORDER BY count DESC LIMIT $offset, $total_records_per_page");
					$groupBy = true;
				} else if( !empty($aID) ) {
					$allArticles = $wpdb->get_results("SELECT * FROM {$tbl_history} WHERE article_id != '' $query ORDER BY date desc LIMIT $offset, $total_records_per_page");
					$groupBy = false;
				} else {
					$groupBy = true;
					$allArticles = $wpdb->get_results("SELECT article_id as article_id, COUNT(*) as count FROM {$tbl_history} WHERE article_id != '' $query GROUP BY article_id ORDER BY count DESC LIMIT $offset, $total_records_per_page");
				}
				$postTypes = $wpdb->get_results("SELECT article_type FROM {$tbl_history} GROUP BY article_type");
				
			?>
			<div class="col s6"></div>
			<div class="postPerPage col s3">
      			<div class="input-field">
      				<label"><?php echo esc_html(__('Articles Per Page',"advanced-page-visit-counter"));?></label>
	          		<select id="apvc_apc_filter">
	          			<option value="" selected><?php echo esc_html(__('Articles Per Page',"advanced-page-visit-counter"));?></option>
	          			<option value="10" <?php if($apc==10) echo "selected";?>><?php echo __('10',"advanced-page-visit-counter");?></option>
	          			<option value="20" <?php if($apc==20) echo "selected";?>><?php echo __('20',"advanced-page-visit-counter");?></option>
	          			<option value="50" <?php if($apc==50) echo "selected";?>><?php echo __('50',"advanced-page-visit-counter");?></option>
	          			<option value="100" <?php if($apc==100) echo "selected";?>><?php echo __('100',"advanced-page-visit-counter");?></option>
	          		</select>
	          	</div>
          	</div>
          	<?php if( $groupBy == true ){ ?>
            <div class="postFilter col s3">
          		<div class="input-field">
					<label"><?php echo esc_html(__('Filter By Post Type',"advanced-page-visit-counter"));?></label>
					<select id="apvc_pt_filter">
						<option>All</option>
						<?php
			    			foreach( $postTypes as $avc_pt ):
		    					if( $current_pt == $avc_pt->article_type )
		    						$selected = 'selected="selected"';
		    					else 
		    						$selected = "";
			    				echo '<option value="'.esc_html($avc_pt->article_type).'" '.$selected.'>'.ucwords(esc_html($avc_pt->article_type)).'</option>';
			    			endforeach;
	          			?>
					</select>
					<?php if( !empty($current_pt) ) { ?>
          			<a title="Reset" href="javascript:void(0);" id="apvc_reset_filters">X</a>
          		<?php } ?>
				</div>
          	</div>
      		<?php  } ?>
	        <?php if( $groupBy == true ) { ?>       	
			<table class="responsive-table table-bordered">
				<thead>
				  <tr>
		            <th><?php echo esc_html(__('Article ID','advanced-page-visit-counter'));?></th>  
		            <th><?php echo esc_html(__('Article Title','advanced-page-visit-counter'));?></th>  
		            <th><?php echo esc_html(__('Total Visits Count','advanced-page-visit-counter'));?></th>  
		            <th><?php echo esc_html(__('Detailed Report','advanced-page-visit-counter'));?></th>    
				  </tr>
				</thead>
				<tbody>
				<?php 
		        	foreach( $allArticles as $page ):
		        		echo '<tr>';
							echo '<td class="center-align">'.$page->article_id.'</td>';
							echo '<td><a href="'.get_the_permalink($page->article_id).'">'.get_the_title($page->article_id).'</a></td>';
							echo '<td class="center-align">'.$page->count.'</td>';
							echo '<td class="center-align"><a href="'.get_admin_url().'admin.php?page=apvc-reports&aID='.$page->article_id.'&"'.$apc_var.'">'.__("View Report").'</a></td>';
		        		echo '</tr>';
		        	endforeach; 
		        ?>
				</tbody>
				<tfoot>
					<tr>
			            <th><?php echo esc_html(__('Article ID','advanced-page-visit-counter'));?></th>  
			            <th><?php echo esc_html(__('Article Title','advanced-page-visit-counter'));?></th>  
			            <th><?php echo esc_html(__('Total Visits Count','advanced-page-visit-counter'));?></th>  
			            <th><?php echo esc_html(__('Detailed Report','advanced-page-visit-counter'));?></th>
					</tr>
				</tfoot>
			</table>
			<ul class="pagination center-align">
				<?php if($page_no > 1){ echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1'><i class='material-icons'>fast_rewind</i></a></li>"; } ?>
			    
				<li <?php if($page_no <= 1){ echo "class='disabled waves-effect'"; } ?>>
				<a <?php if($page_no > 1){ echo "href='?page=apvc-reports".$apc_var."&page_no=$previous_page'"; } ?>><i class='material-icons'>chevron_left</i></a>
				</li>
			       
			    <?php 
				if ($total_no_of_pages <= 10){  	 
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter'>$counter</a></li>";
							}
			        }
				}
				elseif($total_no_of_pages > 10){
					
				if($page_no <= 4) {			
				 for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter'>$counter</a></li>";
							}
			        }
					echo "<li class='waves-effect'><a>...</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$second_last'>$second_last</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
					}

				 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1'>1</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=2'>2</a></li>";
			        echo "<li class='waves-effect'><a>...</a></li>";
			        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
			           if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter'>$counter</a></li>";
							}                  
			       }
			       echo "<li class='waves-effect'><a>...</a></li>";
				   echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$second_last'>$second_last</a></li>";
				   echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
			            }
					
					else {
			        echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1'>1</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=2'>2</a></li>";
			        echo "<li class='waves-effect'><a>...</a></li>";

			        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
			          if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter'>$counter</a></li>";
							}                   
			                }
			            }
				}
			?>
				<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
				<a <?php if($page_no < $total_no_of_pages) { echo "href='?page=apvc-reports".$apc_var."&page_no=$next_page'"; } ?>><i class='material-icons'>chevron_right</i></a>
				</li>
			    <?php if($page_no < $total_no_of_pages){
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages'><i class='material-icons'>fast_forward</i></a></li>";
					} ?>
			</ul>

		<?php } else { ?>
			<div class="row">
				<a class="waves-effect waves-light btn-small back_to_reporst" href="?page=apvc-reports"><i class="large material-icons right">arrow_back</i><?php echo esc_html(__("Back to Reports"));?></a>
				<table class="striped responsive-table">
					<thead>
					  <tr>
						<th class="center-align"><?php echo esc_html(__('No.',"advanced-page-visit-counter"));?></th>  
						<th class="apvc_post_title"><?php echo esc_html(__('Post Title',"advanced-page-visit-counter"));?></th>
						<th><?php echo esc_html(__('Post Type',"advanced-page-visit-counter"));?></th>  
						<th><?php echo esc_html(__('User Type',"advanced-page-visit-counter"));?></th>  
						<th><?php echo esc_html(__('Visited Date',"advanced-page-visit-counter"));?></th>  
						<th><?php echo esc_html(__('IP Address',"advanced-page-visit-counter"));?></th>
						<th><?php echo esc_html(__('Browser Info',"advanced-page-visit-counter"));?></th>  
						<th><?php echo esc_html(__('Referer URL',"advanced-page-visit-counter"));?></th>
					  </tr>
					</thead>

					<tbody>
					  <?php 
			        	$count = 1;
			        	foreach( $allArticles as $article ):
			        		$user_name_obj = get_user_by('id', $article->user_id);
			        		$country = ( !empty($article->country)) ? $article->country : "Invalid IP";
			        		echo '<tr>';
								echo '<td class="center-align">'.$count++.'</td>';
								echo '<td class="apvc_post_title"><a target="_blank" href="'.get_the_permalink($article->article_id).'">'.get_the_title($article->article_id).'</a></td>';
								echo '<td>'.ucwords($article->article_type).'</td>';
								if( $article->user_type != 'Guest' ){
									echo '<td>'.ucwords($article->user_type).'<br />'.ucwords($article->user_id).' ('.$user_name_obj->user_nicename.')</td>';	
								} else {
									echo '<td>'.__("Guest").'</td>';
								}
								
								echo '<td>'.$article->date.'</td>';
								echo '<td>'.$article->ip_address.' <br /> ('.$country.')</td>';
								echo '<td><span style="color:#007bff;">'.__("Browser: ").'</span>'.ucwords($article->browser_short_name).'<br /><span style="color:#d84545;">'.__("OS: ").'</span>'.ucwords($article->operating_system).'<br /><span style="color:#b93db5;">'.__("Device: ").'</span>'.ucwords($article->device_type).'</td>';
								if( $article->http_referer == 'Direct' ) {
									echo '<td>'.__("Direct").'</td>';
								} else {
								echo '<td style="word-wrap: break-word; white-space: -moz-pre-wrap; Firefox 1.0-2.0; white-space: pre-wrap;"><a href="'.$article->http_referer.'" target="_blank">'.parse_url($article->http_referer, PHP_URL_HOST).'</a></td>';
								}
			        		echo '</tr>';
			        	endforeach; 
			        ?> 
					  
					  
					</tbody>
				</table>
				<ul class="pagination center-align">
				<?php if($page_no > 1){ echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1&aID=$aID'><i class='material-icons'>fast_rewind</i></a></li>"; } ?>
			    
				<li <?php if($page_no <= 1){ echo "class='disabled waves-effect'"; } ?>>
				<a <?php if($page_no > 1){ echo "href='?page=apvc-reports".$apc_var."&page_no=$previous_page&aID=$aID'"; } ?>><i class='material-icons'>chevron_left</i></a>
				</li>
			       
			    <?php 
				if ($total_no_of_pages <= 10){  	 
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter&aID=$aID'>$counter</a></li>";
							}
			        }
				}
				elseif($total_no_of_pages > 10){
					
				if($page_no <= 4) {			
				 for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter&aID=$aID'>$counter</a></li>";
							}
			        }
					echo "<li class='waves-effect'><a>...</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$second_last&aID=$aID'>$second_last</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages&aID=$aID'>$total_no_of_pages</a></li>";
					}

				 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1&aID=$aID'>1</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=2&aID=$aID'>2</a></li>";
			        echo "<li class='waves-effect'><a>...</a></li>";
			        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
			           if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter&aID=$aID'>$counter</a></li>";
							}                  
			       }
			       echo "<li class='waves-effect'><a>...</a></li>";
				   echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$second_last&aID=$aID'>$second_last</a></li>";
				   echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages&aID=$aID'>$total_no_of_pages</a></li>";      
			            }
					
					else {
			        echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=1&aID=$aID'>1</a></li>";
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=2&aID=$aID'>2</a></li>";
			        echo "<li class='waves-effect'><a>...</a></li>";

			        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
			          if ($counter == $page_no) {
					   echo "<li class='active'><a>$counter</a></li>";	
							}else{
			           echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$counter&aID=$aID'>$counter</a></li>";
							}                   
			                }
			            }
				}
			?>
				<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
				<a <?php if($page_no < $total_no_of_pages) { echo "href='?page=apvc-reports".$apc_var."&page_no=$next_page&aID=$aID'"; } ?>><i class='material-icons'>chevron_right</i></a>
				</li>
			    <?php if($page_no < $total_no_of_pages){
					echo "<li class='waves-effect'><a href='?page=apvc-reports".$apc_var."&page_no=$total_no_of_pages&aID=$aID'><i class='material-icons'>fast_forward</i></a></li>";
					} ?>
			</ul>
			</div>		
		<?php } ?>
		</div>
	</div>
	<?php
	}

	public function avc_reports_page(){
		global $wpdb;
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$allCounts = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history}");

		if( $allCounts > 0 ) {
		?>
		<input type="hidden" id="apv_page_id" value="<?php echo $_GET['page'];?>">
	    <input type="hidden" id="page_type" value="apvc_charts_page">
		
		<div class="row">
	      <div class="col s12">
	      	<h5><?php echo esc_html(__("Advanced Page Visit Counter - Reports","advanced-page-visit-counter"));?></h5>
	      </div>
	    </div>

		<div class="row apvc_charts">
			
			<div class="col s12">
				<div class="card">
					<div class="card-content dark-text">
						<span class="card-title"><?php echo esc_html(__("Most Visited Pages / Posts This Week","advanced-page-visit-counter"));?> <i class="material-icons">insert_chart</i></span>
						<div id="most_visited_pages">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content dark-text">
						<span class="card-title"><?php echo esc_html(__("Weekly Chart","advanced-page-visit-counter"));?> <i class="material-icons">insert_chart</i></span>
						<div id="weekly_report_bar_chart">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content dark-text">
						<span class="card-title"><?php echo esc_html(__("Monthly Chart","advanced-page-visit-counter"));?> <i class="material-icons">insert_chart</i></span>
						<div id="monthlyBarChart">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		} else {
			echo 'No Statistics available..';
		}

	}	

	public function get_pie_chart_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$allPages = $wpdb->get_results("SELECT browser_short_name, count(*) as count FROM {$tbl_history} WHERE browser_short_name != '' GROUP BY browser_short_name ASC LIMIT 0,3");
		
		echo json_encode($allPages);

		wp_die();
	}

	public function get_pie_chart_data_for_country() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$allPages = $wpdb->get_results("SELECT country, count(*) as count FROM {$tbl_history} WHERE country != '' GROUP BY country ASC");
		
		echo json_encode($allPages);

		wp_die();
	}

	public function get_ip_address_chart_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$allPages = $wpdb->get_results("SELECT ip_address, count(*) as count FROM {$tbl_history} GROUP BY ip_address ASC LIMIT 10");
		
		echo json_encode($allPages);

		wp_die();
	}

	public function get_referrer_chart_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$allPages = $wpdb->get_results("SELECT http_referer, count(*) as count FROM {$tbl_history} WHERE http_referer != '' GROUP BY http_referer ASC LIMIT 3");
		
		echo json_encode($allPages);

		wp_die();
	}

	public function get_weekly_chart_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$previous_week2 = strtotime("-2 week +1 day");
		$start_week2 = strtotime("last sunday midnight",$previous_week2);
		$end_week2 = strtotime("next saturday",$start_week2);

		$start_week2 = date("Y-m-d H:m:s",$start_week2);
		$end_week2 = date("Y-m-d H:m:s",$end_week2);

		$previous_week1 = strtotime("-1 week +1 day");
		$start_week1 = strtotime("last sunday midnight",$previous_week1);
		$end_week1 = strtotime("next saturday",$start_week1);

		$start_week1 = date("Y-m-d H:m:s",$start_week1);
		$end_week1 = date("Y-m-d H:m:s",$end_week1);

		$previous_week0 = strtotime("0 week +1 day");
		$start_week0 = strtotime("last sunday midnight",$previous_week0);
		$end_week0 = strtotime("next saturday",$start_week0);

		$start_week0 = date("Y-m-d H:m:s",$start_week0);
		$end_week0 = date("Y-m-d H:m:s",$end_week0);

		$allPages2 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_week2' AND `date`<='$end_week2'");
		
		$Week2 = array();
		$Week2['week'] = date("M-d",strtotime($start_week2)).' - '.date("M-d",strtotime($end_week2));
		$Week2['count'] = $allPages2[0]->count; 

		$allPages1 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_week1' AND `date`<='$end_week1'");
		
		$Week1 = array();
		$Week1['week'] = date("M-d",strtotime($start_week1)).' - '.date("M-d",strtotime($end_week1));
		$Week1['count'] = $allPages1[0]->count; 

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_week0' AND `date`<='$end_week0'");
		
		$Week0 = array();
		$Week0['week'] = date("M-d",strtotime($start_week0)).' - '.date("M-d",strtotime($end_week0));
		$Week0['count'] = $allPages0[0]->count; 

		$finalArray = array();
		$finalArray[] = $Week2;
		$finalArray[] = $Week1;
		$finalArray[] = $Week0;

		echo json_encode($finalArray);

		wp_die();
	}

	public function get_monthly_chart_data(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$previous_Month5 = strtotime("-5 months +1 day");
		$start_Month5 = strtotime("first day of this month",$previous_Month5);
		$end_Month5 = strtotime("last day of this month",$start_Month5);

		$start_Month5 = date("Y-m-d",$start_Month5);
		$end_Month5 = date("Y-m-d",$end_Month5);

		$previous_Month4 = strtotime("-4 months +1 day");
		$start_Month4 = strtotime("first day of this month",$previous_Month4);
		$end_Month4 = strtotime("last day of this month",$start_Month4);

		$start_Month4 = date("Y-m-d",$start_Month4);
		$end_Month4 = date("Y-m-d",$end_Month4);

		$previous_Month3 = strtotime("-3 months +1 day");
		$start_Month3 = strtotime("first day of this month",$previous_Month3);
		$end_Month3 = strtotime("last day of this month",$start_Month3);

		$start_Month3 = date("Y-m-d",$start_Month3);
		$end_Month3 = date("Y-m-d",$end_Month3);

		$previous_Month2 = strtotime("-2 months +1 day");
		$start_Month2 = strtotime("first day of this month",$previous_Month2);
		$end_Month2 = strtotime("last day of this month",$start_Month2);

		$start_Month2 = date("Y-m-d",$start_Month2);
		$end_Month2 = date("Y-m-d",$end_Month2);

		$previous_Month1 = strtotime("-1 months +1 day");
		$start_Month1 = strtotime("first day of this month",$previous_Month1);
		$end_Month1 = strtotime("last day of this month",$start_Month1);

		$start_Month1 = date("Y-m-d",$start_Month1);
		$end_Month1 = date("Y-m-d",$end_Month1);

		$previous_Month0 = strtotime("-0 months +1 day");
		$start_Month0 = strtotime("first day of this month",$previous_Month0);
		$end_Month0 = strtotime("last day of this month",$start_Month0);

		$start_Month0 = date("Y-m-d",$start_Month0);
		$end_Month0 = date("Y-m-d",$end_Month0);

		$allPages5 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month5' AND `date`<='$end_Month5'");
		
		$Month5 = array();
		$Month5['month'] = date("F",strtotime($start_Month5));
		$Month5['count'] = $allPages5[0]->count;

		$allPages4 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month4' AND `date`<='$end_Month4'");
		
		$Month4 = array();
		$Month4['month'] = date("F",strtotime($start_Month4));
		$Month4['count'] = $allPages4[0]->count; 

		$allPages3 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month3' AND `date`<='$end_Month3'");
		
		$Month3 = array();
		$Month3['month'] = date("F",strtotime($start_Month3));
		$Month3['count'] = $allPages3[0]->count; 

		$allPages2 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month2' AND `date`<='$end_Month2'");
		
		$Month2 = array();
		$Month2['month'] = date("F",strtotime($start_Month2));
		$Month2['count'] = $allPages2[0]->count; 

		$allPages1 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month1' AND `date`<='$end_Month1'");
		
		$Month1 = array();
		$Month1['month'] = date("F",strtotime($start_Month1));
		$Month1['count'] = $allPages1[0]->count; 

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count FROM {$tbl_history} WHERE `date`>='$start_Month0' AND `date`<='$end_Month0'");
		
		$Month0 = array();
		$Month0['month'] = date("F",strtotime($start_Month0));
		$Month0['count'] = $allPages0[0]->count; 

		$finalArray = array();

		$finalArray[] = $Month5;
		$finalArray[] = $Month4;
		$finalArray[] = $Month3;
		$finalArray[] = $Month2;
		$finalArray[] = $Month1;
		$finalArray[] = $Month0;

		echo json_encode($finalArray);

		wp_die();

	}

	public function get_trending_this_week_post_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$previous_week0 = strtotime("0 week -1 day");
		$start_week0 = strtotime("last sunday midnight",$previous_week0);
		$end_week0 = strtotime(date("Y-m-d H:m:s"));

		$start_week0 = date("Y-m-d H:m:s",$start_week0);
		$end_week0 = date("Y-m-d H:m:s",$end_week0);

		$allPages = $wpdb->get_results("SELECT COUNT(*) as count, article_id FROM {$tbl_history} WHERE `date`>='$start_week0' AND `date`<='$end_week0' GROUP BY article_id ORDER BY count DESC LIMIT 0,10");

		$finalArray = array();
		$cnt = 0;
		foreach( $allPages as $pages ):
			$finalArray[$cnt]["article_title"] = get_the_title($pages->article_id);
			$finalArray[$cnt]["count"] = $pages->count;
			$cnt++;
		endforeach;
		echo json_encode($finalArray);
		wp_die();
	}

	public function get_trending_this_week_ind_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$previous_week0 = strtotime("0 week -1 day");
		$start_week0 = strtotime("last sunday midnight",$previous_week0);
		$end_week0 = strtotime("next saturday",$start_week0);

		$start_week0 = date("Y-m-d H:m:s",$start_week0);
		$end_week0 = date("Y-m-d H:m:s",$end_week0);

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count, article_id FROM {$tbl_history} WHERE `date`>='$start_week0' AND `date`<='$end_week0' GROUP BY article_id ORDER BY count DESC LIMIT 0,1");

		return json_encode($allPages0);

		wp_die();
	}

	public function get_monthly_chart_ind_data(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$previous_Month0 = strtotime("-0 months +1 day");
		$start_Month0 = strtotime("first day of this month",$previous_Month0);
		$end_Month0 = strtotime("last day of this month",$start_Month0);

		$start_Month0 = date("Y-m-d",$start_Month0);
		$end_Month0 = date("Y-m-d",$end_Month0);

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count, article_id FROM {$tbl_history} WHERE `date`>='$start_Month0' AND `date`<='$end_Month0' GROUP BY article_id ORDER BY count DESC");
		
		return json_encode($allPages0);

		wp_die();
	}

	public function get_trending_all_time_high_post_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count, article_id FROM {$tbl_history} GROUP BY article_id ORDER BY count DESC LIMIT 0,1");

		return json_encode($allPages0);

		wp_die();
	}

	public function get_trending_todays_ind_data() {
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$start_today = date("Y-m-d 00:00:00");
		$end_today = date("Y-m-d 23:59:59");

		$allPages0 = $wpdb->get_results("SELECT COUNT(*) as count, article_id FROM {$tbl_history} WHERE `date`>='$start_today' AND `date`<='$end_today' GROUP BY article_id ORDER BY count DESC LIMIT 0,1");

		return json_encode($allPages0);

		wp_die();
	}

	public function apvc_get_all_articles_sh(){
		global $wpdb;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$allArticles = $wpdb->get_results("SELECT p.post_title FROM {$tbl_history} as hst LEFT JOIN $wpdb->posts p ON p.ID = hst.article_id  WHERE p.post_title!='' GROUP BY article_id");

		$array = array();
		foreach( $allArticles as $article ):
			if (!empty($article->post_title)){
				$array[$article->post_title] = '';
			}
		endforeach;
		echo json_encode($array);
		wp_die();
	}
	/**
	 * Advanced Page Visit Counter Shortcode Generation method
	 *
	 * @since    2.5.2
	 */
	public function generate_shortcode(){
		global $wpdb;

		ob_start();
		
		$border_size = sanitize_text_field($_REQUEST['border_size']);
		$border_radius = sanitize_text_field($_REQUEST['border_radius']);
		$bg_color = sanitize_text_field($_REQUEST['bg_color']);
		$font_size = sanitize_text_field($_REQUEST['font_size']);
		$font_style = sanitize_text_field($_REQUEST['font_style']);
		$font_color = sanitize_text_field($_REQUEST['font_color']);
		$border_style = sanitize_text_field($_REQUEST['border_style']);
		$border_color = sanitize_text_field($_REQUEST['border_color']);
		$counter_label = sanitize_text_field($_REQUEST['counter_label']);
		$padding = sanitize_text_field($_REQUEST['padding']);
		$width = sanitize_text_field($_REQUEST['width']);
		$shType = sanitize_text_field($_REQUEST['shType']);
		$shArticle = trim(sanitize_text_field($_REQUEST['shArticle']));

		if( !empty($shArticle) ) {
			$shArticleID = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '$shArticle'");
		} else {
			$shArticleID = 1;
		}
		if( empty($shArticleID) ){
			$shArticleID = 1;
		}

		$shArgs = "";
		if( $shType == 'individual' && $shArticle != '' && !empty($shArticleID) ){
			$shArgs = 'type="individual" article_id="'.$shArticleID.'"';
		} else if( $shType == 'global' ){
			$shArgs = 'type="global"';
		} else {
			$shArgs = 'type="customized"';
		}

		if( empty($counter_label) )
			$counter_label = "Visits: ";

		$shortcode = '[apvc_embed '.$shArgs.' border_size="'.$border_size.'" border_radius="'.$border_radius.'" background_color="'.$bg_color.'" font_size="'.$font_size.'" font_style="'.$font_style.'" font_color="'.$font_color.'" counter_label="'.$counter_label.'" border_color="'.$border_color.'" border_style="'.$border_style.'" padding="'.$padding.'" width="'.$width.'" ]';

		?>
		<style>
			 .avc_visit_counter_front{
			 	width: <?php echo $width;?>px;
			 	max-width: <?php echo $width;?>px;
			    padding: <?php echo $padding;?>px;
			    text-align: center;	
			    margin: 15px 0px 15px 0px;
			    margin: 20px auto;
			 }
		</style>
        <div class="shortcodeBlock">
			<div class="shortcode_text" id="shortcode_text">
				<?php echo $shortcode;?>
			</div>
			<div class="shortcode_output center-align" id="shortcode_output">
				<?php echo do_shortcode($shortcode); ?>
			</div>
			<div class="shortcode_copy">
				<a class="waves-effect waves-light btn-small" id="shortcode_copy"><i class="material-icons left">content_copy</i><?php echo __("Copy Shortcode","advanced-page-visit-counter");?></a>
			</div>
		</div>

		<?php
		echo ob_get_clean();
		wp_die();
	}

	public function add_apvc_dashboard_css(){
		?>
		<style type="text/css">
			.apvc_today_top, .apvc_week_top, .apvc_month_top{ font-weight: bold; font-size: 18px; margin: 10px 0px 10px 0px; text-align: center; background: #f2f2f2; padding: 5px;} .apvc_today_top span, .apvc_week_top span, .apvc_month_top span{ color: #23282d; } .apvc_icon { text-align: center; } .apvc_icon img{ max-width: 400px; width: 100%; }
		</style>
		<?php
	}
	public function apvc_dashboard_widget( $post, $callback_args ) {
		global $wpdb;
		?>
		<div class="wrap">
			<div class="apvc_icon">
				<a href="https://pagevisitcounter.com" target="_blank">
					<img src="<?php echo plugin_dir_url( __FILE__ )."/images/apvc_logo_banner.png";?>" >	
				</a>
			</div>
			<div class="apvc_today_top">
				<span><?php echo __("Today's Most Visited: ");?></span>
				<br />
				<?php 
					$dailyData = json_decode($this->get_trending_todays_ind_data());
					if( count($dailyData) > 0 ){
						echo "<a target='_blank' href='".get_the_permalink($dailyData[0]->article_id)."'>".get_the_title($dailyData[0]->article_id)."</a> (".$dailyData[0]->count.")";	
					} else {
						echo "----";
					}
				?>
			</div>
			<div class="apvc_week_top">
				<span><?php echo __("Trending This Week: ");?></span>
				<br />
				<?php 
					$weeklyData = json_decode($this->get_trending_this_week_ind_data());
					if( count($weeklyData) > 0 ){
						echo "<a target='_blank' href='".get_the_permalink($weeklyData[0]->article_id)."'>".get_the_title($weeklyData[0]->article_id)."</a> (".$weeklyData[0]->count.")";	
					} else {
						echo "----";
					}
				?>
			</div>
			<div class="apvc_month_top">
				<span><?php echo __("Trending This Month: ");?></span>
				<br />
				<?php 
					$monthlyData = json_decode($this->get_monthly_chart_ind_data());
					if( count($monthlyData) > 0 ){
						echo "<a target='_blank' href='".get_the_permalink($monthlyData[0]->article_id)."'>".get_the_title($monthlyData[0]->article_id)."</a> (".$monthlyData[0]->count.")";	
					} else {
						echo "----";
					}
				?>
			</div>
			<div class="apvc_month_top">
				<span><?php echo __("All Time Highest Visited: ");?></span>
				<br />
				<?php 
					$allTimeHigh = json_decode($this->get_trending_all_time_high_post_data());
					if( count($allTimeHigh) > 0 ){
						echo "<a target='_blank' href='".get_the_permalink($allTimeHigh[0]->article_id)."'>".get_the_title($allTimeHigh[0]->article_id)."</a> (".$allTimeHigh[0]->count.")";	
					} else {
						echo "----";
					}
				?>
			</div>
		</div>
		<?php
	}

	public function add_apvc_dashboard_widgets() {
		wp_add_dashboard_widget('dashboard_widget', __('Advanced Page Visit Counter - Highlights'), array($this,'apvc_dashboard_widget'));
	}	

	public function apvc_advanced_save_metaboxes( $post_id ) {
		global $wpdb;
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

	    $active_count = sanitize_text_field($_POST["apvc_active_counter"]);
	    $reset_count = sanitize_text_field($_POST["apvc_reset_cnt"]);
	    $start_count = sanitize_text_field($_POST["count_start_from"]);
	    $widget_label = sanitize_text_field($_POST["widget_label"]);

	    if( empty($active_count) ){
	    	$active_count = "Yes";
	    }

	    update_post_meta( $post_id, "apvc_active_counter", $active_count );
	    update_post_meta( $post_id, "count_start_from", $start_count );
	    update_post_meta( $post_id, "widget_label", $widget_label );

	    if( $reset_count == "Yes" ){
	    	$wpdb->query("DELETE FROM $tbl_history WHERE article_id=$post_id");
	    } 
	}

	public function apvc_get_domain($url) {
	  $pieces = parse_url($url);
	  print_r($pieces);
	  $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
	  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
	     echo $regs['domain'];
	  }
	  return false;
	}


	public function apvc_upgrader_process_complete(){
		update_option("apvc_version","2.5.2");
		update_option("apvc_newsletter","show");
	}


}