<?php
	namespace Elementor;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 10/22/19
	 */

	// Elementor Classes
	use Elementor\Widget_Base;
	use Elementor\Controls_Manager;
	use Elementor\Repeater;
	use Elementor\Group_Control_Border;
	use Elementor\Group_Control_Typography;
	use Elementor\Scheme_Typography;
	use MasterAddons\Inc\Helper\Master_Addons_Helper;


	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) { exit; }


	/**
	 * Master Addons: MA Image Gallery
	 */
	class Master_Addons_Filterable_Image_Gallery extends Widget_Base {

		public function get_name() {
			return 'ma-image-filter-gallery';
		}

		public function get_title() {
			return __( 'MA Image Gallery', MELA_TD );
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		public function get_icon() {
			return 'ma-el-icon eicon-gallery-masonry';
		}

		public function get_script_depends() {
			return [
				'imagesloaded',
				'fancybox',
				'isotope',
				'master-addons-scripts'
			];
		}

		public function get_keywords() {
			return [ 'image', 'image gallery', 'filter image', 'Image Filter Gallery' ];
		}

		protected function _register_controls() {

			/*
			 * MA Image Filter Gallery
			 */
			$this->start_controls_section(
				'ma_el_image_gallery_image_section',
				[
					'label' => __( 'Image Filter Gallery', MELA_TD ),
				]
			);


			$this->add_control(
				'ma_el_image_gallery_all_cat_text',
				[
					'label'             => __( 'All Categories Text', MELA_TD ),
					'type'              => Controls_Manager::TEXT,
					'placeholder'       => __( 'All', MELA_TD ),
					'default'           => __( 'All', MELA_TD ),

				]
			);

			$this->add_control(
				'ma_el_image_gallery_column_number',
				[
					'label'     => __( 'Number of Columns', MELA_TD ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 3,
					'options'   => [
						1       => __( '1 Column', MELA_TD ),
						2       => __( '2 Columns',   MELA_TD ),
						3       => __( '3 Columns', MELA_TD ),
						4       => __( '4 Columns',  MELA_TD ),
						6       => __( '6 Columns',  MELA_TD )
					]
				]
			);

			// Image Size
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'          => 'ma_el_image_gallery_image',
					'default'       => 'medium_large',
					'seperator'         => 'after'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_filter_nav',
				[
					'label'        => __( 'Show Filter Nav?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes'
				]
			);
			$this->add_control(
				'ma_el_image_gallery_title',
				[
					'label'        => __( 'Show Title?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'return_value' => 'yes'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_subtitle',
				[
					'label'        => __( 'Show Subtitle?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'return_value' => 'yes'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_category',
				[
					'label'        => __( 'Show Category?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'return_value' => 'yes'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_tooltip',
				[
					'label'        => __( 'Filter Tooltip?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes'
				]
			);


			$this->add_control(
				'ma_el_image_gallery_items',
				[
					'label'       => __( 'Gallery Contents', MELA_TD ),
					'type'        => Controls_Manager::REPEATER,
					'seperator'         => 'before',
					'default'     => [

						[
							'title'                                 => __( 'Vestibulum purus quam', MELA_TD ),
							'subtitle'                              => __( 'workplace,technology', MELA_TD ),
							'gallery_category_name'                 => __( 'Technology', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Vestibulum ullam mauris', MELA_TD ),
							'subtitle'                              => __( 'Adventure for live', MELA_TD ),
							'gallery_category_name'                 => __( 'Adventure,Living', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Praesent egestas tristique', MELA_TD ),
							'subtitle'                              => __( 'The Perfect Workspace', MELA_TD ),
							'gallery_category_name'                 => __( 'Workplace,Technology', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Quisque malesuada', MELA_TD ),
							'subtitle'                              => __( 'Website Design', MELA_TD ),
							'gallery_category_name'                 => __( 'Design,Technology', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Charming Technology', MELA_TD ),
							'subtitle'                              => __( 'quadcopter', MELA_TD ),
							'gallery_category_name'                 => __( 'Technology,Branding', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Donec mollis hendrerit', MELA_TD ),
							'subtitle'                              => __( 'Fastest typing speed', MELA_TD ),
							'gallery_category_name'                 => __( 'Technology,Workplace', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Nam commodo suscipit', MELA_TD ),
							'subtitle'                              => __( 'Adventurus Life', MELA_TD ),
							'gallery_category_name'                 => __( 'Adventure', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Maecenas egestas arcu', MELA_TD ),
							'subtitle'                              => __( 'Cup of Tea', MELA_TD ),
							'gallery_category_name'                 => __( 'Living', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						],
						[
							'title'                                 => __( 'Cras ultricies mi', MELA_TD ),
							'subtitle'                              => __( 'Health is wealth', MELA_TD ),
							'gallery_category_name'                 => __( 'Adventure,Nature', MELA_TD ),
							'ma_el_image_gallery_ribbon'            => __( '', MELA_TD ),
							'ma_el_image_gallery_button_one_text'   => __( 'Details', MELA_TD ),
							'ma_el_image_gallery_link_one_url'      => "#",
							'ma_el_image_gallery_button_two_text'   => __( 'Demo', MELA_TD ),
							'ma_el_image_gallery_link_two_url'      => "#"
						]
					],
					'fields'          => [
						[
							'name'    => 'ma_el_image_gallery_img',
							'label'   => __( 'Image', MELA_TD ),
							'type'    => Controls_Manager::MEDIA,
						],
						[
							'type'          => Controls_Manager::TEXT,
							'name'          => 'title',
							'label_block'   => true,
							'label'         => __( 'Title', MELA_TD ),
							'default'       => __( 'Item Title', MELA_TD )
						],
						[
							'type'          => Controls_Manager::TEXT,
							'name'          => 'subtitle',
							'label'         => __( 'Subtitle', MELA_TD ),
							'label_block'   => true,
							'default'       => __( 'item sub-title', MELA_TD )
						],
						[
							'name'          => 'gallery_category_name',
							'label'         => __( 'Gallery Category', MELA_TD ),
							'label_block'   => true,
							'type'          => Controls_Manager::TEXT,
							'description'   => __( 'Comma separate gallery categories. Example - Design,Branding,Technology.', MELA_TD )
						],

						[
							'name'          => 'ma_el_image_gallery_show_ribbon',
							'label'        => __( 'Show Ribbon?', MELA_TD ),
							'type'         => Controls_Manager::SWITCHER,
							'default'      => 'no',
							'return_value' => 'yes'
						],

						[
							'name'          => 'ma_el_image_gallery_ribbon',
							'label'         => __( 'Ribbon', MELA_TD ),
							'type'          => Controls_Manager::SELECT,
							'options'   => [
								'new'           => __( 'New', MELA_TD ),
								'popular'       => __( 'Popular', MELA_TD ),
								'free'          => __( 'Free', MELA_TD ),
								'pro'           => __( 'Pro', MELA_TD ),
								'sale'          => __( 'Sale', MELA_TD ),
								'discount'      => __( 'Discount', MELA_TD ),
								'added'         => __( 'Added', MELA_TD ),
								'updated'       => __( 'Updated', MELA_TD ),
								'changed'       => __( 'Changed', MELA_TD ),
								'fixed'         => __( 'Fixed', MELA_TD ),
								'removed'       => __( 'Removed', MELA_TD ),
								'note'          => __( 'Note', MELA_TD ),
							],
							'default'   => 'new',
							'condition'     => [
								'ma_el_image_gallery_show_ribbon' => 'yes'
							]
						],

						[
							'type'          => Controls_Manager::TEXT,
							'name'          => 'ma_el_image_gallery_discount',
							'label'         => __( 'Discount', MELA_TD ),
							'default'       => __( '30% Off', MELA_TD ),
							'condition'     => [
								'ma_el_image_gallery_ribbon' => ['discount','sale']
							]
						],

						[
							'name'          => 'ma_el_image_gallery_buttons',
							'label'        => __( 'Popup or Links ?', MELA_TD ),
							'type'         => Controls_Manager::CHOOSE,
							'options' => [
								'popup' => [
									'title' => __( 'Popup', MELA_TD ),
									'icon' => 'eicon-search',
								],
								'links' => [
									'title' => __( 'External Links', MELA_TD ),
									'icon' => 'eicon-editor-external-link',
								],
							],
							'default' => 'popup',
						],


						[
							'name'          => 'ma_el_image_gallery_button_one_text',
							'label'        => __( 'Button Text', MELA_TD ),
							'type'         => Controls_Manager::TEXT,
							'default'     => __( 'Details', MELA_TD ),
							'placeholder' => __( 'Details', MELA_TD ),
							'title'       => __( 'Enter Button text here', MELA_TD ),
							'condition'     => [
								'ma_el_image_gallery_buttons' => 'links'
							]
						],

						[
							'name'          => 'ma_el_image_gallery_link_one_url',
							'label'        => __( 'Button One URL', MELA_TD ),
							'type'         => Controls_Manager::URL,
							'default'     => [
								'url' => '#',
								'is_external' => true,
								'nofollow' => true,
							],
							'show_external' => true,
							'condition'     => [
								'ma_el_image_gallery_buttons' => 'links'
							]
						],

						[
							'name'          => 'ma_el_image_gallery_button_two_text',
							'label'        => __( 'Button Two Text', MELA_TD ),
							'type'         => Controls_Manager::TEXT,
							'default'     => __( 'Demo', MELA_TD ),
							'placeholder' => __( 'Demo', MELA_TD ),
							'title'       => __( 'Enter Button text here', MELA_TD ),
							'condition'     => [
								'ma_el_image_gallery_buttons' => 'links'
							]
						],

						[
							'name'          => 'ma_el_image_gallery_link_two_url',
							'label'        => __( 'Button Two URL', MELA_TD ),
							'type'         => Controls_Manager::URL,
							'default'     => [
								'url' => '#',
								'is_external' => true,
								'nofollow' => true,
							],
							'show_external' => true,
							'condition'     => [
								'ma_el_image_gallery_buttons' => 'links'
							]
						],





					],
					'title_field' => '{{title}}'
				]
			);

			$this->end_controls_section();


			// Control Style
			$this->start_controls_section(
				'ma_el_image_gallery_filter_section_style',
				[
					'label'         => __( 'Filter Style', MELA_TD ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'ma_el_image_gallery_filter_nav!' => 'yes'
					],

				]
			);

			$this->add_control(
				'ma_el_image_gallery_filter_active_border_bottom_enabled',
				[
					'label'        => __( 'Border Bottom?', MELA_TD ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes'
				]
			);

			$this->add_responsive_control(
				'ma_el_image_gallery_filter_padding',
				[
					'label'         => __( 'Padding', MELA_TD ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);

			$this->add_responsive_control(
				'ma_el_image_gallery_filter_margin',
				[
					'label'         => __( 'Margin', MELA_TD ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'             => 'ma_el_image_gallery_filter_typography',
					'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
				]
			);


			$this->start_controls_tabs( 'ma_el_image_gallery_filter_tabs' );
				$this->start_controls_tab( 'ma_el_image_gallery_filter_btn_normal', [ 'label' => __( 'Normal', MELA_TD ) ] );

				$this->add_control(
					'ma_el_image_gallery_filter_normal_text_color',
					[
						'label'     => __( 'Text Color', MELA_TD ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#fff',
						'selectors' => [
							'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'ma_el_image_gallery_filter_normal_bg_color',
					[
						'label'     => __( 'Background Color', MELA_TD ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'      => 'ma_el_image_gallery_filter_normal_border',
						'label'     => __( 'Border', MELA_TD ),
						'selector'  => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
					]
				);

				$this->add_control(
					'ma_el_image_gallery_normal_border_radius',
					[
						'label'     => __( 'Border Radius', MELA_TD ),
						'type'      => Controls_Manager::SLIDER,
						'range'     => [
							'px'    => [
								'max'   => 30
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'border-radius: {{SIZE}}px;'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'      => 'ma_el_image_gallery_filter_shadow',
						'separator' => 'before',
						'selector'  => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
					]
				);

				$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_image_gallery_filter_btn_active', [ 'label' => __( 'Active', MELA_TD ) ] );

				$this->add_control(
					'ma_el_image_gallery_filter_active_text_color',
					[
						'label'         => __( 'Text Color', MELA_TD ),
						'type'          => Controls_Manager::COLOR,
						'default'       => '#3C4858',
						'selectors'     => [
//							'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'color: {{VALUE}};'
						]
					]
				);

				// image gallery control(active) background color
				$this->add_control(
					'ma_el_image_gallery_filter_active_bg_color',
					[
						'label'         => __( 'Background Color', MELA_TD ),
						'type'          => Controls_Manager::COLOR,
						'selectors'     => [
							'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'          => 'ma_el_image_gallery_filter_active_border',
						'label'         => __( 'Border', MELA_TD ),
						'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li.active'
					]
				);


				$this->add_control(
					'ma_el_image_gallery_filter_active_border_radius',
					[
						'label'         => __( 'Border Radius', MELA_TD ),
						'type'          => Controls_Manager::SLIDER,
						'range'         => [
							'px'        => [
								'max'   => 30
							],
						],
						'selectors'     => [
							'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'border-radius: {{SIZE}}px;'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'          => 'ma_el_image_gallery_filter_active_shadow',
						'separator'     => 'before',
						'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li.active',
					]
				);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();



			// Item Style
			$this->start_controls_section(
				'ma_el_image_gallery_item_section_style',
				[
					'label'         => __( 'Item Style', MELA_TD ),
					'tab'           => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_responsive_control(
				'ma_el_image_gallery_item_container_padding',
				[
					'label'         => __( 'Padding', MELA_TD ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control(
				'ma_el_image_gallery_item_container_margin',
				[
					'label'         => __( 'Margin', MELA_TD ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);


			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'ma_el_image_gallery_item_border',
					'label'         => __( 'Border', MELA_TD ),
					'selector'      => '{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item'
				]
			);


			$this->add_control(
				'ma_el_image_gallery_item_border_radius',
				[
					'label'         => __( 'Border Radius', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'size'      => 0
					],
					'range'         => [
						'px'        => [
							'max'   => 500
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'border-radius: {{SIZE}}px;'
					]
				]
			);

			$this->end_controls_section();


			$this->start_controls_section(
				'ma_el_image_gallery_image_typography_style',
				[
					'label'         => __('Image Style', MELA_TD ),
					'tab'           => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_image_gallery_image_style',
				[
					'label'         => __( 'Image Style', MELA_TD ),
					'type'          => Controls_Manager::HEADING
				]
			);

			$this->add_control(
				'ma_el_image_gallery_image_hover_overlay_color',
				[
					'label'         => __( 'Hover Overlay Color', MELA_TD ),
					'type'          => Controls_Manager::COLOR,
					'default'       => 'rgba(0, 0, 0, 0.5)',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-item .ma-image-hover-content' => 'background-color: {{VALUE}}'
					]

				]
			);

			// Title
			$this->add_control(
				'ma_el_image_gallery_image_title_style',
				[
					'label'         => __( 'Title Style', MELA_TD ),
					'type'          => Controls_Manager::HEADING,
					'separator'     =>  'before'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_image_caption_title_color',
				[
					'type'          => Controls_Manager::COLOR,
					'label'         => __( 'Color', MELA_TD ),
					'scheme'        => [
						'type'      => Scheme_Color::get_type(),
						'value'     => Scheme_Color::COLOR_1
					],
					'default'       => '#333',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item .ma-el-image-hover-title' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'ma_el_image_gallery_image_title_typography',
					'selector'      => '{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item .ma-el-image-hover-title',
				]
			);

			$this->add_control(
				'ma_el_image_gallery_image_sub_title_style',
				[
					'label'         => __( 'Caption Subtitle Style', MELA_TD ),
					'type'          => Controls_Manager::HEADING,
					'separator'     =>  'before'
				]
			);

			$this->add_control(
				'ma_el_image_gallery_image_caption_subtitle_color',
				[
					'type'          => Controls_Manager::COLOR,
					'label'         => __( 'Color', MELA_TD ),
					'scheme'        => [
						'type'      => Scheme_Color::get_type(),
						'value'     => Scheme_Color::COLOR_1,
					],
					'default'       => '#333',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item .ma-el-image-hover-desc' => 'color: {{VALUE}};'
					]
				]
			);



			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'ma_el_image_gallery_image_caption_subtitle_typography',
					'selector'      => '{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item .ma-el-image-hover-desc'
				]
			);


			$this->add_control(
				'ma_el_image_gallery_image_hover_icon_style',
				[
					'label'         => __( 'Icon Style', MELA_TD ),
					'type'          => Controls_Manager::HEADING,
					'separator'     =>  'before'
				]
			);


			$this->add_control(
				'ma_el_image_gallery_image_hover_icon_color',
				[
					'type'          => Controls_Manager::COLOR,
					'label'         => __( 'Color', MELA_TD ),
					'scheme'        => [
						'type'      => Scheme_Color::get_type(),
						'value'     => Scheme_Color::COLOR_1
					],
					'default'       => '#ffffff',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_section();


			if ( ma_el_fs()->is_not_paying() ) {

				$this->start_controls_section(
					'maad_el_section_pro',
					[
						'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD )
					]
				);

				$this->add_control(
					'maad_el_control_get_pro',
					[
						'label' => esc_html__( 'Unlock more possibilities', MELA_TD ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'1' => [
								'title' => esc_html__( '', MELA_TD ),
								'icon' => 'fa fa-unlock-alt',
							],
						],
						'default' => '1',
						'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with 
Customization Options.</span>'
					]
				);

				$this->end_controls_section();
			}



		}


		private function render_image( $image_id, $settings ) {
			$ma_el_image_gallery_image = $settings['ma_el_image_gallery_image_size'];
			if ( 'custom' === $ma_el_image_gallery_image ) {
				$image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'ma_el_image_gallery_image', $settings );
			} else {
				$image_src = wp_get_attachment_image_src( $image_id, $ma_el_image_gallery_image );
				$image_src = $image_src[0];
			}

			return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true) ) );
		}



		protected function render() {

			$settings       = $this->get_settings_for_display();

			if ( !Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute('ma_el_image_filter_gallery', 'class', [
						'ma-el-image-filter-gallery',
						'ma-el-image-filter-gallery-items'
					]
				);
			}

			if( function_exists('ma_el_image_filter_gallery_array_flatten') ){
				$gallery_categories = ma_el_image_filter_gallery_categories( $settings['ma_el_image_gallery_items'] );
			}

			echo '<div class="ma-el-image-filter-gallery-wrapper">';

			if( $settings['ma_el_image_gallery_filter_nav'] !== "yes") {

				if( is_array( $gallery_categories ) && !empty( $gallery_categories ) ):
				echo '<div class="ma-el-image-filter-nav'. ( $settings['ma_el_image_gallery_filter_active_border_bottom_enabled'] == 'yes' ? ' has-border-bottom' : ' no-border-bottom' ) .'">';



					if( $settings['ma_el_image_gallery_tooltip'] == "yes") {
						echo '<ul>';
					}else{
						echo '<ul class="ma-el-tooltip">';
					}

					if( $settings['ma_el_image_gallery_tooltip'] == "yes"){

						echo '<li data-filter="*" class="ma-el-tooltip-item tooltip-top active"> <div class="ma-el-tooltip-content"><span>'. esc_html(
							$settings['ma_el_image_gallery_all_cat_text']) .' </span></div><div class="ma-el-tooltip-text">' . $settings['ma_el_image_gallery_all_cat_text'] . '</div></li>';
					} else{
						echo '<li data-filter="*" class="active"> <span>'. esc_html( $settings['ma_el_image_gallery_all_cat_text']) .' </span></li>';
					}


					foreach ($gallery_categories as $gallery_category ) {

						if( $settings['ma_el_image_gallery_tooltip'] == "yes"){
							printf( '<li class="ma-el-tooltip-item tooltip-top" data-filter=".%s"><div class="ma-el-tooltip-content"><span>%s</span></div><div class="ma-el-tooltip-text">' . $gallery_category . '</div></li>',
								esc_attr( sanitize_title($gallery_category ) . '-' . $this->get_id() ) , esc_html($gallery_category ));
						} else{
							printf( '<li data-filter=".%s"><span>%s</span></li>', esc_attr( sanitize_title( $gallery_category ) . '-' . $this->get_id() ) , esc_html( $gallery_category ) );
						}

					}

				echo '</ul>';
				echo '</div>';
			endif;

				}


			$ma_el_image_filter_gallery_editor = ($this->get_render_attribute_string( 'ma_el_image_filter_gallery' ))
				?$this->get_render_attribute_string( 'ma_el_image_filter_gallery' ) :"class='row'";

			if( is_array( $settings['ma_el_image_gallery_items'] ) ):
				$column = 12/$settings['ma_el_image_gallery_column_number'];

//				echo '<div '. $this->get_render_attribute_string( 'ma_el_image_filter_gallery' ) .'>';
				echo '<div '. $ma_el_image_filter_gallery_editor .'>';

				foreach ( $settings['ma_el_image_gallery_items'] as $item ) :

					if( $item['ma_el_image_gallery_img']['id'] ):

						echo '<div class="ma-el-image-filter-item col-lg-'. esc_attr($column). ' col-md-6 '.						     ma_el_image_filter_gallery_category_classes( $item['gallery_category_name'],$this->get_id()) .'">';
						echo '<div class="ma-image-hover-thumb">';

						echo $this->render_image( $item['ma_el_image_gallery_img']['id'], $settings );

						echo '<div class="ma-image-hover-item-info">';

						if( $settings['ma_el_image_gallery_category'] == "yes"){
							echo ma_el_image_filter_gallery_categories_parts( $item['gallery_category_name'] );
						}

						if( $item['ma_el_image_gallery_show_ribbon'] == "yes"){

							$ma_el_image_gallery_discount = array( "discount", "sale");

							if (in_array($item['ma_el_image_gallery_ribbon'], $ma_el_image_gallery_discount)) {
								echo '<div class="ma-el-label ma-el-new">' . $item['ma_el_image_gallery_discount'] . '</div>';
							}else{
								echo '<div class="ma-el-label ma-el-' . $item['ma_el_image_gallery_ribbon'] . '">' . $item['ma_el_image_gallery_ribbon'] . '</div>';
							}
						}

						echo '</div>';
						echo '<div class="ma-image-hover-content">';

						if( $item['ma_el_image_gallery_buttons'] == "popup" ){
							echo '<a class="ma-el-fancybox elementor-clickable" href="'. esc_url(
									$item['ma_el_image_gallery_img']['url'] ) .'" data-fancybox="gallery"><i class="eicon-preview"></i></a>';

						} elseif( $item['ma_el_image_gallery_buttons'] == "links" ){


							// Link One
							$this->add_render_attribute( 'ma_el_image_filter_link_one', [
								'class'	=> [
									'button',
									'ma-el-creative-button',
									'ma-el-creative-button--default'
								],
								'href'	=> esc_url($item['ma_el_image_gallery_link_one_url']['url'] ),
							]);

							if( $item['ma_el_image_gallery_link_one_url']['is_external'] ) {
								$this->add_render_attribute( 'ma_el_image_filter_link_one', 'target', '_blank' );
							}

							if( $item['ma_el_image_gallery_link_one_url']['nofollow'] ) {
								$this->add_render_attribute( 'ma_el_image_filter_link_one', 'rel', 'nofollow' );
							}


							// Link Two
							$this->add_render_attribute( 'ma_el_image_filter_link_two', [
								'class'	=> [
									'button',
									'ma-el-creative-button',
									'ma-el-creative-button--default'
								],
								'href'	=> esc_url($item['ma_el_image_gallery_link_two_url']['url'] ),
							]);

							if( $item['ma_el_image_gallery_link_two_url']['is_external'] ) {
								$this->add_render_attribute( 'ma_el_image_filter_link_two', 'target', '_blank' );
							}

							if( $item['ma_el_image_gallery_link_two_url']['nofollow'] ) {
								$this->add_render_attribute( 'ma_el_image_filter_link_two', 'rel', 'nofollow' );
							}


							if( $item['ma_el_image_gallery_link_one_url']['url'] !=""){
								echo '<a ' . $this->get_render_attribute_string( 'ma_el_image_filter_link_one' ) . '>' .
								     esc_html( $item['ma_el_image_gallery_button_one_text']) . '</a>';
							}

							if( $item['ma_el_image_gallery_link_two_url']['url'] !=""){
								echo '<a ' . $this->get_render_attribute_string( 'ma_el_image_filter_link_two' ) . '>' .
								     esc_html( $item['ma_el_image_gallery_button_two_text']) . '</a>';
							}


						}

						echo '</div><!--.ma-image-hover-content-->';
						echo '</div><!--.ma-image-hover-thumb-->';
						echo '<div class="ma-image-hover-content-details">';

						if( $settings['ma_el_image_gallery_title'] == "yes"){
							echo '<h3 class="ma-el-image-hover-title">'. esc_html( $item['title'] ) .'</h3>';
						}

						if( $settings['ma_el_image_gallery_subtitle'] == "yes"){
							echo '<span class="ma-el-image-hover-desc">'. esc_html( $item['subtitle'] ) .'</span>';
						}

						echo '</div><!--.ma-image-hover-content-details-->';

						echo '</div>';

					endif;
				endforeach;

				echo '</div>';
			endif;
			echo '</div>';
		}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Filterable_Image_Gallery());
