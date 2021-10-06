(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	var page_type = jQuery("#page_type").val();
	jQuery('select').formSelect();
	jQuery('.color').minicolors();



	if( page_type == "apvc_shortcode_gen_page" ){

		jQuery("#shortcode_type").change(function(e){
			e.preventDefault();
			var val = jQuery(this).val();
			if( val == 'individual' ){
				jQuery(".ind_article").show();
			} else {
				jQuery(".ind_article").hide();
			}
		});

		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_all_articles_sh"},
		       success: function(response) {
		       	console.log(response);
		       	jQuery('#apvc_ind_articles').autocomplete({
			      data: JSON.parse(response),
			    });	
		       }
		    });
		},100);
		
	}

	if( page_type == "apvc_settings_page" ){

		jQuery('.apv_ip_addresses').chips({
			placeholder: 'Enter IP addresses',
			secondaryPlaceholder: '+ip address',
		});

		var RowIP = jQuery("#apvc_ip_data").val();
		if( RowIP != '' ) {
			var dataIP = JSON.parse(RowIP);
			if( dataIP.length > 0 ) {
				jQuery('.apv_ip_addresses').chips({
					data: dataIP
				});
			}
		}

		jQuery('.apv_exclude_counts').chips({
			placeholder: 'Enter Post/Page IDs',
			secondaryPlaceholder: '+id',
		});
		var RowEX = jQuery("#apvc_ex_data").val();
		if( RowEX != '' ) {
			var dataEX = JSON.parse(RowEX);
			if( dataEX.length > 0 ) {
				jQuery('.apv_exclude_counts').chips({
					data: dataEX
				});
			}
		}

		jQuery('.apv_exclude_show_counter').chips({
			placeholder: 'Enter Post/Page IDs',
			secondaryPlaceholder: '+id',
		});
		var RowEXCnt = jQuery("#apvc_wd_data").val();
		if( RowEXCnt != '' ) {
			var dataEXCnt = JSON.parse(RowEXCnt);
			if( dataEXCnt.length > 0 ) {
				jQuery('.apv_exclude_show_counter').chips({
					data: dataEXCnt
				});
			}
		}

		jQuery('.apv_exclude_users').chips({
			placeholder: 'Enter User IDs',
			secondaryPlaceholder: '+id',
		});
		var RowUsr = jQuery("#apvc_usr_data").val();
		if( RowUsr != '' ) {
			var dataUsr = JSON.parse(RowUsr);
			if(  dataUsr.length > 0 ) {
				jQuery('.apv_exclude_users').chips({
					data: dataUsr
				});
			}
		}
	}
	
	if( page_type == 'apvc_dashboard_page' ){
		
		jQuery(document).on("click",".apvc_subscribe_now",function( e ){
			e.preventDefault();
			var refData = jQuery(this).attr("ref");

			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_update_subscriber_option", refData:refData },
		       success: function(response) {
		       		window.open(apv_ajax.apvc_url);
		       }
		    });
			
		});

		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_top_10_page_data" },
		       success: function(response) {
		       	jQuery("#top10Pages").html(response);
		       }
		    });	
		}, 500);

		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_top_10_ipaddress_data" },
		       success: function(response) {
		       	if( response != 0 ){
	       			jQuery("#top10IP").html(response);
	       		}
		       }
		    });	
		}, 1000);

		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_top_10_referer_data" },
		       success: function(response) {
		       	if( response != 0 ){
	       			jQuery("#top10REF").html(response);
	       		}
		       }
		    });	
		}, 1500);

		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_top_10_browsers_data" },
		       success: function(response) {
		       	if( response != 0 ){
	       			jQuery("#top10Browsers").html(response);
	       		}
		       }
		    });	
		}, 2000);
		
		setTimeout(function(){
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "apvc_get_top_10_os_data" },
		       success: function(response) {
		       	if( response != 0 ){
	       			jQuery("#top10OS").html(response);
	       		}
		       }
		    });	
		}, 2500);

	}

	jQuery(document).on('click',"#shortcode_copy",function( e ){
		e.preventDefault();
		var el = document.getElementById("shortcode_text");
		var range = document.createRange();
		range.selectNodeContents(el);
		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
		document.execCommand('copy');
		jQuery("#copiedToClipboard").modal();
		setTimeout(function(){jQuery("#copiedToClipboard").modal('hide');}, 1000);
	});

	jQuery(document).on('click',".submit_config",function(e){
		e.preventDefault();

		jQuery("body").css("cursor", "progress");
		var postTypes = jQuery("#apv_post_types").val();
		var ipAddresses = JSON.stringify(M.Chips.getInstance(jQuery('.apv_ip_addresses')).chipsData);
		var exclude_counts = JSON.stringify(M.Chips.getInstance(jQuery('.apv_exclude_counts')).chipsData);
		var exclude_show_counter = JSON.stringify(M.Chips.getInstance(jQuery('.apv_exclude_show_counter')).chipsData);
		var spamCheck = jQuery("#apv_spam_controller").prop('checked');
		var excludeUser = JSON.stringify(M.Chips.getInstance(jQuery('.apv_exclude_users')).chipsData);
		var showCounter = jQuery("#show_conter_on_fron_side").val();
		var counterColor = jQuery("#apv_default_text_color").val();
		var apv_default_border_color = jQuery("#apv_default_border_color").val();
		var apv_default_background_color = jQuery("#apv_default_background_color").val();
		var apv_default_label = jQuery("#apv_default_label").val();
		var apv_default_border_radius = jQuery("#apv_default_border_radius").val();
		var apv_default_border_width = jQuery("#apv_default_border_width").val();
		var wid_alignment = jQuery("#wid_alignment").val();

		jQuery.ajax({
	       type : "post",
	       url : apv_ajax.ajax_url,
	       data : { action: "save_avc_config", wid_alignment:wid_alignment,exclude_show_counter:exclude_show_counter,exclude_counts:exclude_counts,apv_default_border_width:apv_default_border_width,apv_default_border_radius:apv_default_border_radius,apv_default_background_color:apv_default_background_color,apv_default_label:apv_default_label,apv_default_border_color:apv_default_border_color,postTypes:postTypes,ipAddresses:ipAddresses,spamCheck:spamCheck,excludeUser:excludeUser,showCounter:showCounter,counterColor:counterColor },
	       success: function(response) {

       		jQuery(".notification-block").fadeIn(1000);
       		jQuery("body").css("cursor", "default");
       		jQuery(".notification-block").fadeOut(1000);
       		setTimeout(function(){ window.location.reload(); }, 500);
	       }
	    });	

	});

	jQuery(document).on("click",".reset_all",function(e){
		e.preventDefault();
		jQuery.ajax({
	       type : "post",
	       url : apv_ajax.ajax_url,
	       data : { action: "avc_reset_settings"},
	       success: function(response) {
				window.location.reload();
	       }
	    });

	});
	
	jQuery(document).on("click",".reset_counts",function(e){
		e.preventDefault();
		jQuery.ajax({
	       type : "post",
	       url : apv_ajax.ajax_url,
	       data : { action: "avc_reset_counters"},
	       success: function(response) {
				window.location.reload();
	       }
	    });

	});


	jQuery(document).on("click","#genButton",function( e ){
		e.preventDefault();

		var border_size = jQuery("#border_size").val();
		var border_radius = jQuery("#border_radius").val();
		var bg_color = jQuery("#bg_color").val();
		var font_size = jQuery("#font_size").val();
		var font_style = jQuery("#font_style").val();
		var font_color = jQuery("#font_color").val();
		var border_style = jQuery("#border_style").val();
		var border_color = jQuery("#border_color").val();
		var counter_label = jQuery("#counter_label").val();
		var padding = jQuery("#padding").val();
		var width = jQuery("#width").val();
		var shType = jQuery("#shortcode_type").val();

		jQuery(".progress").show();
		jQuery(".shortcodeBlock").hide();

		var shType = jQuery("#shortcode_type").val();
		var shArticle = jQuery("#apvc_ind_articles").val();

		if( shType == 'individual' && shArticle == '' ){
			jQuery(".progress").hide();
			jQuery(".ind_article .warning").show();
			jQuery("#genOutput").html("<h6 style='color: red;'>Please select article to generate shortcode.</h6>");
			jQuery(".ind_article").addClass("warningBlock");
		} else {
			jQuery(".ind_article").removeClass("warningBlock");
			jQuery("#genOutput h6").remove();
			jQuery(".ind_article .warning").hide();
			jQuery.ajax({
		       type : "post",
		       url : apv_ajax.ajax_url,
		       data : { action: "generate_shortcode", shType:shType,shArticle:shArticle,width:width,padding:padding,counter_label:counter_label,border_color:border_color,border_style:border_style,border_size:border_size,border_radius:border_radius,bg_color:bg_color,font_size:font_size,font_style:font_style,font_color:font_color },
		       success: function(response) {
					jQuery(".progress").hide();
					jQuery(".shortcodeBlock").show();
					jQuery("#genOutput").html(response);
		       }
		    });	
		}
		

	});

 	jQuery(document).on("change","#apvc_pt_filter",function(){
 		var filter = jQuery(this).val();
 		if( filter != "" ){
 			var url = window.location.href+"&apvc_pt="+filter;
 			window.location.href = url;	
 		} 
 	});

 	jQuery(document).on("change","#apvc_apc_filter",function(){
 		var post_per_page = jQuery(this).val();
 		if( post_per_page != "" ){
 			var url = window.location.href+"&apc="+post_per_page;
 			window.location.href = url;	
 		} 
 	});

 	jQuery(document).on("click","#apvc_reset_filters",function(){
 		var url = window.location.href;
 		var new_url = url.substring(0, url.indexOf('?'));
		window.location.href = new_url+"?page=apvc-reports";	
 	});

	function extractHostname(url) {
	  var hostname;
	  //find & remove protocol (http, ftp, etc.) and get hostname
	  if (url.indexOf("//") > -1) {
	      hostname = url.split('/')[2];
	  }
	  else {
	      hostname = url.split('/')[0];
	  }

	  //find & remove port number
	  hostname = hostname.split(':')[0];
	  //find & remove "?"
	  hostname = hostname.split('?')[0];

	  return hostname;
	}


	var page_id = jQuery("#apv_page_id").val();

	if( page_id == 'apvc-reports-visual' ){
		var monthly = [];
		var monthlyCount = [];
		jQuery.ajax({
		  type : "post",
		  url : apv_ajax.ajax_url,
		  data : { action: "get_monthly_chart_data" },
		  success: function( responsemonthly ) {
		  	
		    var stringmonthly = JSON.parse( responsemonthly );
		    jQuery.each( stringmonthly, function( key, value ) {
		      monthly.push( value.month );
		      monthlyCount.push(value.count);
		    });
		    if (jQuery("#monthlyBarChart").length) {
		    	var options = {
		            chart: {
		                height: 380,
		                type: 'bar'
		            },
		            plotOptions: {
		                bar: {
		                    barHeight: '100%',
		                    distributed: true,
		                    horizontal: false,
		                    dataLabels: {
		                        position: 'bottom'
		                    },
		                }
		            },
		            colors: ['#0d47a1', '#880e4f', '#1de9b6', '#2e7d32', '#ff6f00', '#263238', '#64dd17', '#311b92', '#d50000', '#e65100'],
		            dataLabels: {
		                enabled: true,
		                textAnchor: 'start',
		                style: {
		                    colors: ['#fff']
		                },
		                formatter: function(val, opt) {
		                    return "";
		                },
		                offsetX: 0,
		                dropShadow: {
		                  enabled: true
		                }
		            },
		            series: [{
		                data: monthlyCount
		            }],
		            xaxis: {
		                categories: monthly,
		            },
		            yaxis: {
		                labels: {
		                    show: false
		                }
		            },
		            tooltip: {
		                theme: 'light',
		                x: {
		                    show: false
		                },
		                y: {
		                    title: {
		                        formatter: function() {
		                            return ''
		                        }
		                    }
		                }
		            }
		        }

		       var chart = new ApexCharts(
		            document.querySelector("#monthlyBarChart"),
		            options
		        );
		        
		        chart.render();
		       }
		  		jQuery("#monthlyBarChart .progress").hide();
		  	}
		});
		

		var weekly = [];
		var weeklyCount = [];
		jQuery.ajax({
		  type : "post",
		  url : apv_ajax.ajax_url,
		  data : { action: "get_weekly_chart_data" },
		  success: function( responseWeekly ) {
			    var stringWeekly = JSON.parse( responseWeekly );
			    jQuery.each( stringWeekly, function( key, value ) {
			      weekly.push( value.week );
			      weeklyCount.push(value.count);
			    });
		    
			    if (jQuery("#weekly_report_bar_chart").length) {
			    	var options = {
			            chart: {
			                height: 380,
			                type: 'bar'
			            },
			            plotOptions: {
			                bar: {
			                    barHeight: '100%',
			                    distributed: true,
			                    horizontal: false,
			                    dataLabels: {
			                        position: 'bottom'
			                    },
			                }
			            },
			            colors: ['#0d47a1', '#880e4f', '#1de9b6', '#2e7d32', '#ff6f00', '#263238', '#64dd17', '#311b92', '#d50000', '#e65100'],
			            dataLabels: {
			                enabled: true,
			                textAnchor: 'start',
			                style: {
			                    colors: ['#fff']
			                },
			                formatter: function(val, opt) {
			                    return "";
			                },
			                offsetX: 0,
			                dropShadow: {
			                  enabled: true
			                }
			            },
			            series: [{
			                data: weeklyCount
			            }],
			            xaxis: {
			                categories: weekly,
			            },
			            yaxis: {
			                labels: {
			                    show: false
			                }
			            },
			            tooltip: {
			                theme: 'light',
			                x: {
			                    show: false
			                },
			                y: {
			                    title: {
			                        formatter: function() {
			                            return ''
			                        }
			                    }
			                }
			            }
			        }

			       var chart = new ApexCharts(
			            document.querySelector("#weekly_report_bar_chart"),
			            options
			        );
			        
			        chart.render();
			        jQuery("#weekly_report_bar_chart .progress").hide();
			    }

			}
		});
		      
		var topVisited = [];
		var topVisitedCount = [];
		jQuery.ajax({
			type : "post",
			url : apv_ajax.ajax_url,
			data : { action: "get_trending_this_week_post_data" },
			success: function( responsetopVisited ) {

				var stringtopVisited = JSON.parse( responsetopVisited );
				jQuery.each( stringtopVisited, function( key, value ) {
					topVisited.push( value.article_title );
					topVisitedCount.push(value.count);
				});
				if (jQuery("#most_visited_pages").length) {

					var options = {
			            chart: {
			                height: 380,
			                type: 'bar'
			            },
			            plotOptions: {
			                bar: {
			                    barHeight: '100%',
			                    distributed: true,
			                    horizontal: true,
			                    dataLabels: {
			                        position: 'bottom'
			                    },
			                }
			            },
			            colors: ['#0d47a1', '#880e4f', '#1de9b6', '#2e7d32', '#ff6f00', '#263238', '#64dd17', '#311b92', '#d50000', '#e65100'],
			            dataLabels: {
			                enabled: true,
			                textAnchor: 'start',
			                style: {
			                    colors: ['#fff']
			                },
			                formatter: function(val, opt) {
			                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
			                },
			                offsetX: 0,
			                dropShadow: {
			                  enabled: true
			                }
			            },
			            series: [{
			                data: topVisitedCount
			            }],
			            xaxis: {
			                categories: topVisited,
			            },
			            yaxis: {
			                labels: {
			                    show: false
			                }
			            },
			            tooltip: {
			                theme: 'light',
			                x: {
			                    show: false
			                },
			                y: {
			                    title: {
			                        formatter: function() {
			                            return ''
			                        }
			                    }
			                }
			            }
			        }

			       var chart = new ApexCharts(
			            document.querySelector("#most_visited_pages"),
			            options
			        );
			        
			        chart.render();
			        jQuery("#most_visited_pages .progress").hide();
				}
			}

		});
	      
	}

})( jQuery );