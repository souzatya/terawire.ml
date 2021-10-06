<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pagevisitcounter.com
 * @since      2.5.2
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/public
 * @author     Ankit Panchal <ankitmaru@live.in>
 */
class Advanced_Visit_Counter_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/advanced-page-visit-counter-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/advanced-page-visit-counter-public.js', array( 'jquery' ), $this->version, false );

	}

	public function avp_get_Browser() {

	    $user_agent = $_SERVER['HTTP_USER_AGENT'];
	    $browser_name = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";

	    //First get the platform?
	    if (preg_match('/linux/i', $user_agent)) {
	        $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
	        $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $user_agent)) {
	        $platform = 'windows';
	    }

	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent)) {
	        $browser_name = 'Internet Explorer';
	        $browser_short_name = "MSIE";
	    }
	    elseif(preg_match('/Firefox/i',$user_agent)) {
	        $browser_name = 'Mozilla Firefox';
	        $browser_short_name = "Firefox";
	    }
	    elseif(preg_match('/Chrome/i',$user_agent)) {
	        $browser_name = 'Google Chrome';
	        $browser_short_name = "Chrome";
	    }
	    elseif(preg_match('/Safari/i',$user_agent)) {
	        $browser_name = 'Apple Safari';
	        $browser_short_name = "Safari";
	    }
	    elseif(preg_match('/Opera/i',$user_agent)) {
	        $browser_name = 'Opera';
	        $browser_short_name = "Opera";
	    }
	    elseif(preg_match('/Netscape/i',$user_agent)) {
	        $browser_name = 'Netscape';
	        $browser_short_name = "Netscape";
	    }

	    // finally get the correct version number
	    $known = array('Version', $browser_short_name, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) .
	    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    if (!preg_match_all($pattern, $user_agent, $matches)) {
	        // we have no matching number just continue
	    }

	    // see how many we have
	    $i = count($matches['browser']);
	    if ($i != 1) {
	        //we will have two since we are not using 'other' argument yet
	        //see if version is before or after the name
	        if (strripos($user_agent,"Version") < strripos($user_agent,$browser_short_name)){
	            $version= $matches['version'][0];
	        }
	        else {
	            $version= $matches['version'][1];
	        }
	    }
	    else {
	        $version= $matches['version'][0];
	    }

	    // check if we have a number
	    if ($version==null || $version=="") {$version="?";}

	    return array(
	        'userAgent' => $user_agent,
	        'full_name'      => $browser_name,
	        'short_name'      => $browser_short_name,
	        'version'   => $version,
	        'operation_system'  => $platform,
	        'pattern'    => $pattern
	    );
	}

	/**
	 * Advanced Page Visit Counter Get referer url of the page
	 *
	 * @since    2.5.2
	 */
	public function avp_get_HttpReferer() {
		$http_referer = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] :'';
		return $http_referer;
	}

	/**
	 * Advanced Page Visit Counter Checks current page is woocommerce template page or not.
	 *
	 * @since    2.5.2
	 */
	public function AVP_isWooCommercePage () {
        // if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        //     return true;
        // }
        $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
                                    "woocommerce_terms_page_id" ,
                                    "woocommerce_cart_page_id" ,
                                    "woocommerce_checkout_page_id" ,
                                    "woocommerce_pay_page_id" ,
                                    "woocommerce_thanks_page_id" ,
                                    "woocommerce_myaccount_page_id" ,
                                    "woocommerce_edit_address_page_id" ,
                                    "woocommerce_view_order_page_id" ,
                                    "woocommerce_change_password_page_id" ,
                                    "woocommerce_logout_page_id" ,
                                    "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
            if ( get_the_ID() == get_option ( $wc_page_id , 0 ) ) {
                    return true ;
            }
        }
        return false;
	}

	public function apvc_get_user_ip_address(){

	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}


	/**
	 * Advanced Page Visit Counter Count Update
	 *
	 * @since    2.5.2
	 */
	public function update_page_visit_stats() {
		global $wpdb;
		$article_id = get_the_ID();

		if ( is_admin() ) {
		   return false;
		}

		$active = get_post_meta( $article_id, "apvc_active_counter", true );
		
		if( $active == "No" )
			return false;
		
		$date = current_time('mysql');
		$last_date = current_time('mysql');
		$ip_address = $this->apvc_get_user_ip_address();
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip_address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$details = curl_exec($ch);
		curl_close($ch);
    	$details = json_decode($details);
    	
    	$country = $details->geoplugin_countryName;
		$browser = $this->avp_get_Browser();
		$br_fullname = $browser['full_name'];
		$br_shortname = $browser['short_name'];
		$version = $browser['version'];
		$os = $browser['operation_system'];
		$site_id = get_current_blog_id();

		$HttpReferer = $this->avp_get_HttpReferer();
		$HttpReferer = (empty($HttpReferer)) ? "Direct" : $HttpReferer;
		$article_type = get_post_type();
		$user_id = get_current_user_id();
		$device_type = $this->avp_isCheckMobile();

		if( is_user_logged_in() )
			$user_type = "Registered";
		else
			$user_type = "Guest";

		$currentUserID = get_current_user_id();

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";

		$avc_config = json_decode((get_option("avc_config")));
		$SpamControll = trim($avc_config->spam_controller);
		if( $SpamControll == 'true' ) {
			$sPamtime = $wpdb->get_var("SELECT last_date FROM {$tbl_history} WHERE ip_address='$ip_address' AND article_id=$article_id ORDER BY last_date DESC");
			$differenceTime = round(abs(strtotime($date) - strtotime($sPamtime)) / 60,2);
		} else {
			$differenceTime = 10;			
		}
		
		$currentPostType = get_post_type();
		
		if( in_array($currentPostType, $avc_config->post_types) )
			$ptExist = true;
		else
			$ptExist = false;
		
		$allIPs = array();
		
		if( !empty($avc_config->ip_address) && $avc_config->ip_address != "[]" ) {

			$tempIP = json_decode($avc_config->ip_address);
			if( is_array($tempIP) && count($tempIP) > 0 ){
				foreach( $tempIP as $ip ):
					$allIPs[] = $ip->tag;
				endforeach;
			}
		}
		$allExUsers = array();
		if( !empty($avc_config->exclude_users) && $avc_config->exclude_users != "[]" ) {
			$tempUsrCnt = json_decode($avc_config->exclude_users);
			if( is_array($tempUsrCnt) && count($tempUsrCnt) > 0 ){
				foreach( $tempUsrCnt as $exUsrCnt ):
					$allExUsers[] = $exUsrCnt->tag;
				endforeach;
			}
		}

		if( $currentUserID != 0 ) {
			if( in_array($currentUserID, $allExUsers) )
				$userExist = true;
			else
				$userExist = false;
		} else {
			$userExist = false;
		}

		if( in_array($ip_address, $allIPs) )
			$ipExist = true;
		else
			$ipExist = false;
		
		$allEXCounts = array();
		if( !empty($avc_config->exclude_counts) && $avc_config->exclude_counts != "[]" ) {
			$tempCount = json_decode($avc_config->exclude_counts);
			if( is_array($tempCount) && count($tempCount) > 0 ){
				foreach( $tempCount as $exCnt ):
					$allEXCounts[] = $exCnt->tag;
				endforeach;
			}
		}
		$excludeArticles = $allEXCounts;
		
		if( $differenceTime > 5 && $ipExist == false && $userExist == false && $ptExist == true && !in_array($article_id,$excludeArticles) ) { 

			if( !empty($article_id) || $article_id != 0 )
				$pageCnt = $wpdb->get_var("SELECT id FROM {$tbl_history} WHERE article_id=$article_id");
			
			$flag = 0;	

			if( $pageCnt == 0 || empty($pageCnt) ) {

				$wpdb->insert($tbl_history, array(
	                            'article_id' => $article_id,
	                            'date' => $date,
	                            'last_date' => $last_date,
	                            'article_type' => $article_type,
	                            'user_type' => $user_type,
	                            'ip_address' => $ip_address,
	                            'user_id' => $user_id,
	                            'country' => $country
	            ), array( '%d','%s','%s','%s','%s','%s','%d','%s') );
	            $flag=1;
			} else {	

				// $exist_count = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history} WHERE article_id=$article_id");

				// $exist_count = $exist_count + 1;
				// $wpdb->update($tbl_history, array('article_visit_count'=>$exist_count, 'date'=>$date, 'last_date'=>$last_date,'ip_address'=>$ip_address), array('article_id'=>$article_id));
				$flag=1;
			}

			if( $flag == 1 ){
				if(  $this->AVP_isWooCommercePage() == false && class_exists( 'WooCommerce' ) ){
					if( !empty($article_id) ) {
						
						if( is_singular('product') ) {
							$last_id = $wpdb->insert($tbl_history, array(
			                    'article_id' => $article_id,
			                    'date' => $date,
			                    'last_date' => $last_date,
			                    'article_type' => 'product',
			                    'user_type' => $user_type,
			                    'device_type' => $device_type,
			                    'ip_address' => $ip_address,
			                    'user_id' => $user_id,
			                    'browser_full_name' => $br_fullname,
			                    'browser_short_name' => $br_shortname,
			                    'browser_version' => $version,
			                    'operating_system' => $os,
			                    'http_referer' => $HttpReferer,
			                    'site_id' => $site_id,
			                    'flag' => 1,
			                    'country' => $country
			            	), array( '%d','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%d','%d','%s') );
						} else {
							$last_id = $wpdb->insert($tbl_history, array(
				                    'article_id' => $article_id,
				                    'date' => $date,
				                    'last_date' => $last_date,
				                    'article_type' => 'cart',
				                    'user_type' => $user_type,
				                    'device_type' => $device_type,
				                    'ip_address' => $ip_address,
				                    'user_id' => $user_id,
				                    'browser_full_name' => $br_fullname,
				                    'browser_short_name' => $br_shortname,
				                    'browser_version' => $version,
				                    'operating_system' => $os,
				                    'http_referer' => $HttpReferer,
				                    'site_id' => $site_id,
				                    'flag' => 1,
				                    'country' => $country
				            	), array( '%d','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%d','%d','%s') );	
						}
					}
				} else {
					if( !empty($article_id) ) {
						$wpdb->insert($tbl_history, array(
			                    'article_id' => $article_id,
			                    'date' => $date,
			                    'last_date' => $last_date,
			                    'article_type' => $article_type,
			                    'user_type' => $user_type,
			                    'device_type' => $device_type,
			                    'ip_address' => $ip_address,
			                    'user_id' => $user_id,
			                    'browser_full_name' => $br_fullname,
			                    'browser_short_name' => $br_shortname,
			                    'browser_version' => $version,
			                    'operating_system' => $os,
			                    'http_referer' => $HttpReferer,
			                    'site_id' => $site_id,
			                    'country' => $country
			            ), array( '%d','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%s','%s','%d','%s') );	
		            }
				}
			}
		}
		$differenceTime = 0;
	}	

	public function avp_isCheckMobile() {
	    if( preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) ){
	    	return 'Mobile';
	    } else {
	    	return 'Desktop';
	    }
	}

	public function public_avc_visit_counter( $atts = [], $content = null, $tag = '' ) {
		global $wpdb;

		ob_start();
		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		$type = $atts['type'];
		$article_id = $atts['article_id'];
		
		if( is_admin() ) {
			$articleID = 1;	
		}

		if( $type == 'individual' && !empty($article_id) ){
			$articleID = $article_id;
			$pageCnt = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history} WHERE article_id=$articleID");
		} else if( $type == 'global' ){
			$pageCnt = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history} WHERE `article_id` != '';");
		} else {
			$articleID = get_the_ID();
			$pageCnt = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history} WHERE article_id=$articleID");
		}

		$active = get_post_meta( $article_id, "apvc_active_counter", true );
		if( $active == "No" )
			return false;

		$borderSize = ( !empty($atts['border_size']) ) ? $atts['border_size'] : 0;
		$borderRadius = ( !empty($atts['border_radius']) ) ? 'border-radius:'.$atts['border_radius'].'px;' : '';
		$borderStyle = ( !empty($atts['border_style']) ) ? $atts['border_style'] : 'solid';
		$borderColor = ( !empty($atts['border_color']) ) ? $atts['border_color'] : '#000000';
		
		if( $borderSize != 0 ){
			$borderCSS = "border: ".$borderSize."px ".$borderStyle." ".$borderColor.";";
		} else {
			$borderCSS = '';
		}

		$bgColor = ( !empty($atts['background_color']) ) ? 'background-color: '.$atts['background_color'].';' : '';
		$font_size = ( !empty($atts['font_size']) ) ? 'font-size: '.$atts['font_size'].'px;' : '';
		$font_style = ( !empty($atts['font_style']) ) ? 'font-weight: '.$atts['font_style'].';' : '';
		$font_color = ( !empty($atts['font_color']) ) ? 'color:'.$atts['font_color'].';' : '';
		$counter_label = $atts['counter_label'];

		$widget_label = get_post_meta( $_GET['post'], "widget_label", true );
		if( !empty($widget_label) ) {
			$counter_label = $widget_label;
		}

		$base_count = get_post_meta( $articleID, "count_start_from", true );
		if( !empty($base_count) && $base_count > 0 ) {
			$pageCnt = $pageCnt + $base_count;
		}

		echo $html = "<div class='avc_visit_counter_front' style='".$borderCSS.$bgColor.$borderRadius.$font_size.$font_style.$font_color."'>".__($counter_label)." ".$pageCnt."</div>";

		return ob_get_clean();

	}

	public function public_add_counter_to_content( $content ){
		global $wpdb;
		global $post;

		$tbl_history = $wpdb->prefix . "avc_page_visit_history";
		$currentPostType = get_post_type();
		$article_id = get_the_ID();
		$avcConfig = json_decode( get_option( 'avc_config' ) );

		$active = get_post_meta( $article_id, "apvc_active_counter", true );

		if( $active == "No" )
			return $content;

		$exShowCnt = array();
		if( !empty($avcConfig->exclude_show_counter) && $avcConfig->exclude_show_counter != "[]" ) {
			$tempCntShow = json_decode($avcConfig->exclude_show_counter);
			if( is_array($tempCntShow) && count($tempCntShow) > 0 ){
				foreach( $tempCntShow as $exShow ):
					$exShowCnt[] = $exShow->tag;
				endforeach;
			}
		}

		if( is_array($avcConfig->post_types) && in_array($currentPostType, $avcConfig->post_types) && ! is_feed() && ! is_home() && !in_array($article_id,$exShowCnt) && $this->AVP_isWooCommercePage() != 1 ){

			$widget_label = get_post_meta( $article_id, "widget_label", true );
			if( !empty($widget_label) ) {
				$label = $widget_label;
			} else {
				$label = ($avcConfig->apv_default_label) ? $avcConfig->apv_default_label : "Visits: ";	
			}

			$bgColorBox = ($avcConfig->apv_default_background_color) ? $avcConfig->apv_default_background_color : "#FFF";

			$articleID = $post->ID;
			$pageCnt = $wpdb->get_var("SELECT COUNT(*) FROM {$tbl_history} WHERE article_id=$articleID");
			$avc_config = json_decode(get_option("avc_config"));
			
			$widAlignment = (isset($avcConfig->wid_alignment)) ? $avcConfig->wid_alignment : "";
			if( $widAlignment == "center" ) {
				$widAlignmentCss = "margin: 0 auto;";
			} else if( $widAlignment == "right" ) {
				$widAlignmentCss = "float: right";
			} else {
				$widAlignmentCss = "float: left";
			}

			$style = 'style="border: '.$avc_config->apv_default_border_width.'px solid '.$avc_config->apv_default_border_color.'; color:'.$avc_config->avc_default_text_color_of_counter.'; background-color:'.$bgColorBox.'; border-radius: '.$avc_config->apv_default_border_radius.'px; '.$widAlignmentCss.'"';

			$base_count = get_post_meta( $articleID, "count_start_from", true );
			if( !empty($base_count) && $base_count > 0 ) {
				$pageCnt = $pageCnt + $base_count;
			}

			$ShortcodeHtml = "<div class='avc_visit_counter_front_simple' ".$style.">".__("".$label." ").$pageCnt."</div>";
			$pType = get_post_type();

			if( $avcConfig->show_conter_on_fron_side == "disable" ) {
				return $content;
			} else {
				if( strpos($content, '[avc_visit_counter',0) === false && strpos($content, '[apvc_embed',0) === false ) { 

					if( $avcConfig->show_conter_on_fron_side == 'below_the_content' ){
						return $content.$ShortcodeHtml;
					} else if( $avcConfig->show_conter_on_fron_side == 'above_the_content' ) {
						return $ShortcodeHtml.$content;
					}
				} else {
					return $content;
				}
			}
		} else {
			return $content;
		}
	}

}
