<?php
	namespace Elementor;

	// Elementor Classes
	use Elementor\Widget_Base;
	use Elementor\Controls_Manager;
	use Elementor\Group_Control_Image_Size;
	use Elementor\Utils;
	use MasterAddons\Inc\Helper\Master_Addons_Helper;

	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/**
	 * MA Blog Post Grid Widget
	 */
	class Master_Addons_Post_Grid extends Widget_Base {

		public function get_name() {
			return 'ma-blog-post';
		}

		public function get_title() {
			return __( 'MA Blog', MELA_TD );
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		public function get_icon() {
			return 'ma-el-icon eicon-posts-grid';
		}

		public function get_keywords() {
			return ['post','layout', 'gallery', 'images', 'videos', 'portfolio', 'visual', 'masonry'];
		}

		public function get_script_depends() {
			return [
				'isotope',
				'jquery-slick',
				'masonry',
				'imagesloaded',
				'master-addons-scripts'
			];
		}

		protected function _register_controls() {

            /*
             * Display Options
             */

			$this->start_controls_section(
				'ma_el_post_grid_section_filters',
				[
					'label' => __( 'Display Options', MELA_TD ),
				]
			);


			$this->add_control('ma_el_blog_skin',
				[
					'label'         => __('Blog Layout', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'classic'       => __('Classic', MELA_TD ),
						'cards'         => __('Cards', MELA_TD )
					],
					'default'       => 'classic',
					'label_block'   => true
				]
			);




			$this->add_control('ma_el_post_grid_layout',
				[
					'label'         => __('Blog Type', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'grid'          => __('Grid Layout', MELA_TD ),
						'list'          => __('List Layout', MELA_TD ),
						'masonry'       => __('Masonry Layout', MELA_TD ),
					],
					'default'       => 'grid',
					'label_block'   => true
				]
			);

			$this->add_control('ma_el_blog_cards_skin',
				[
					'label'         => __('Cards Layout', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'default'                => __('Default', MELA_TD ),
						'absolute_content'       => __('Content Overlap', MELA_TD ),
						'absolute_content_two'   => __('Top Left Meta', MELA_TD ),
						'cards_right'            => __('Right Align Cards', MELA_TD ),
						'cards_center'           => __('Center Align Cards', MELA_TD ),
						'gradient_bg'            => __('Center Align Gradient BG', MELA_TD ),
						'full_banner'            => __('Banner Card', MELA_TD )
					],
					'default'       => 'default',
					'label_block'   => true,
					'condition'     => [
						'ma_el_blog_skin'           =>  'cards',
						'ma_el_post_grid_layout'    =>  'grid'
					]
				]
			);

			$this->add_control('ma_el_post_list_layout',
				[
					'label'         => __('List Layout Type', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'classic'               => __('List Classic', MELA_TD ),
						'meta_bg'               => __('List Meta Background', MELA_TD ),
						'button_right'          => __('List Button Right', MELA_TD ),
						'content_overlap'       => __('List Content Overlap', MELA_TD ),
						'thumbnail_hover'       => __('List Thumbnail Hover', MELA_TD ),
						'thumbnail_hover_nav'   => __('List Blur Content', MELA_TD ),
						'thumbnail_bg'          => __('List Thumbnail Background', MELA_TD ),

					],
					'default'       => 'classic',
					'label_block'   => true,
					'condition' => [
						'ma_el_post_grid_layout' =>'list',
					],
				]
			);

			$this->add_control('ma_el_blog_order',
				[
					'label'         => __( 'Post Order', MELA_TD  ),
					'type'          => Controls_Manager::SELECT,
					'label_block'   => true,
					'options'       => [
							'asc'           => __('Ascending', MELA_TD ),
							'desc'          => __('Descending', MELA_TD )
					],
					'default'       => 'desc'
				]
			);

			$this->add_control('ma_el_blog_order_by',
				[
					'label'         => __( 'Order By', MELA_TD  ),
					'type'          => Controls_Manager::SELECT,
					'label_block'   => true,
					'options'       => [
						'none'  => __('None', MELA_TD ),
						'ID'    => __('ID', MELA_TD ),
						'author'=> __('Author', MELA_TD ),
						'title' => __('Title', MELA_TD ),
						'name'  => __('Name', MELA_TD ),
						'date'  => __('Date', MELA_TD ),
						'modified'=> __('Last Modified', MELA_TD ),
						'rand'  => __('Random', MELA_TD ),
						'comment_count'=> __('Number of Comments', MELA_TD ),
					],
					'default'       => 'date'
				]
			);


			$this->add_responsive_control('ma_el_blog_cols',
				[
					'label'         => __('Number of Columns', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
							'100%'          => __('1 Column', MELA_TD ),
							'50%'           => __('2 Columns', MELA_TD ),
							'33.33%'        => __('3 Columns', MELA_TD ),
							'25%'           => __('4 Columns', MELA_TD )
					],
					'default'       => '25%',
					'render_type'   => 'template',
					'label_block'   => true,
					'selectors'     => [
						'{{WRAPPER}} .ma-el-blog-post-outer-container'  => 'width: {{VALUE}};'
					],
				]
			);


			$this->add_control('ma_el_blog_post_meta_icon',
				[
					'label'         => __( 'Post Meta Icon', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
                    'return_value'  => 'yes'
				]
			);

			$this->add_control('ma_el_blog_post_format_icon',
				[
					'label'         => __( 'Post Format Icon', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'No',
                    'return_value'  => 'yes'
				]
			);

			$this->add_control('ma_el_blog_post_meta_separator',
				[
					'label'         => __( 'Post Meta Separator', MELA_TD ),
					'type'          => Controls_Manager::TEXT,
					'default'       => '//',
					'selectors'     => [
						"{{WRAPPER}} .ma-el-post-entry-meta span:before"  => "content:'{{VALUE}}';"
					],
				]
			);


			$this->add_control(
				'title_html_tag',
				[
					'label'   => __( 'Title HTML Tag', MELA_TD ),
					'type'    => Controls_Manager::SELECT,
					'options' => Master_Addons_Helper::ma_el_title_tags(),
					'default' => 'h2',
				]
			);

			$this->add_control(
				'ma_el_post_grid_type',
				[
					'label'         => __( 'Post Type', MELA_TD ),
					'type'          => Controls_Manager::SELECT2,
					'options'       => Master_Addons_Helper::ma_el_get_post_types(),
					'default'       => 'post',

				]
			);

			$this->add_control(
				'ma_el_post_grid_taxonomy_type',
				[
					'label' => __( 'Select Taxonomy', MELA_TD ),
					'type' => Controls_Manager::SELECT2,
					'options' => '',
					'condition' => [
						'post_type!' =>'',
					],
				]
			);

			$this->add_responsive_control('ma_el_post_grid_posts_columns_spacing',
				[
					'label'         => __('Rows Spacing', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%', "em"],
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 200,
						],
					],
					'condition'     => [
						'ma_el_post_grid_layout' =>  ['grid', 'list']
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-outer-container' => 'margin-bottom: {{SIZE}}{{UNIT}}'
					]
				]
			);

			$this->add_responsive_control('ma_el_post_grid_posts_spacing',
				[
					'label'         => __('Columns Spacing', MELA_TD),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%', "em"],
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 200,
						],
					],
					'render_type'   => 'template',
					'condition'     => [
						'ma_el_post_grid_layout' =>  ['grid', 'list']
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-outer-container' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}'
					]
				]
			);


			$this->add_responsive_control('ma_el_post_grid_flip_text_align',
				[
					'label'         => __( 'Content Alignment', MELA_TD ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'      => [
							'title'=> __( 'Left', MELA_TD ),
							'icon' => 'fa fa-align-left',
						],
						'center'    => [
							'title'=> __( 'Center', MELA_TD ),
							'icon' => 'fa fa-align-center',
						],
						'right'     => [
							'title'=> __( 'Right', MELA_TD ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default'       => 'left',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-content ' => 'text-align: {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'ma_el_blog_posts_per_page',
				[
					'label'         => __( 'Posts Per Page', MELA_TD ),
					'type'          => Controls_Manager::NUMBER,
					'min'			=> 1,
					'default'       => '4'
				]
			);


			$this->add_control('ma_el_blog_pagination',
				[
					'label'         => __('Pagination', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Pagination is the process of dividing the posts into discrete pages',MELA_TD),
				]
			);


			$this->add_control('ma_el_blog_next_text',
				[
					'label'			=> __( 'Next Page Text', MELA_TD ),
					'type'			=> Controls_Manager::TEXT,
					'default'       => __('Next Post',MELA_TD),
					'condition'     => [
						'ma_el_blog_pagination'      => 'yes',
					]
				]
			);


			$this->add_control('ma_el_blog_prev_text',
				[
					'label'			=> __( 'Previous Page Text', MELA_TD ),
					'type'			=> Controls_Manager::TEXT,
					'default'       => __('Previous Post',MELA_TD),
					'condition'     => [
						'ma_el_blog_pagination'      => 'yes',
					]
				]
			);

			$this->add_responsive_control('ma_el_blog_pagination_alignment',
				[
					'label'         => __( 'Pagination Alignment', MELA_TD ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'      => [
							'title'=> __( 'Left', MELA_TD ),
							'icon' => 'fa fa-align-left',
						],
						'center'    => [
							'title'=> __( 'Center', MELA_TD ),
							'icon' => 'fa fa-align-center',
						],
						'right'     => [
							'title'=> __( 'Right', MELA_TD ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default'       => 'center',
					'condition'     => [
						'ma_el_blog_pagination'      => 'yes',
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-blog-pagination' => 'text-align: {{VALUE}};',
					],
				]
			);


			$this->end_controls_section();


		    /*
		    * Thumbnail Settings
		    */
			$this->start_controls_section(
				'ma_el_section_post_grid_thumbnail',
				[
					'label' => __( 'Thumbnail Settings', MELA_TD ),
				]
			);

			$this->add_control('ma_el_post_grid_thumbnail',
				[
					'label'         => __('Show Thumbnail?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Show or Hide Thumbnail',MELA_TD ),
					'default'       => 'yes',
				]
			);

			// Select Thumbnail Image Size
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full'
				]
			);

			$this->add_responsive_control('ma_el_post_grid_thumbnail_fit',
				[
					'label'         => __('Thumbnail Fit', MELA_TD ),
					'description'   => __('You need to set Height for work Thumbnail Fit ', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'landscape'     => __('Landscape', MELA_TD ),
						'square'        => __('Square', MELA_TD ),
						'cover'         => __('Cover', MELA_TD ),
						'fill'          => __('Fill', MELA_TD ),
						'contain'       => __('Contain', MELA_TD ),
					],
					'default'       => 'cover',
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-thumbnail img' => 'object-fit: {{VALUE}}'
					],
					'condition'     => [
						'ma_el_post_grid_thumbnail' =>  'yes'
					]
				]
			);

			$this->add_control('ma_el_blog_thumb_height',
				[
					'label'         => __('Custom Height?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Show or Hide Thumbnail',MELA_TD ),
					'default'       => 'no',
				]
			);

			$this->add_responsive_control('ma_el_post_grid_thumb_min_height',
				[
					'label'         => __('Thumbnail Min Height', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%', "em"],
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 300,
						],
					],
					'condition'     => [
						'ma_el_post_grid_thumbnail' =>  'yes',
						'ma_el_blog_thumb_height' =>  'yes'
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-thumbnail img' => 'min-height: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control('ma_el_post_grid_thumb_max_height',
				[
					'label'         => __('Thumbnail Max Height', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%', "em"],
					'range'         => [
						'px'    => [
							'min'   => 1,
							'max'   => 1000,
						],
					],
					'condition'     => [
						'ma_el_post_grid_thumbnail' =>  'yes',
						'ma_el_blog_thumb_height' =>  'yes'
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-post-thumbnail img' => 'max-height: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_control('ma_el_blog_thumbnail_position',
				[
					'label'         => __('Thumbnail Position', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'description'   => __('Thumbnail Image Position',MELA_TD ),
					'options'       => [
                            'default'   => __('Default', MELA_TD ),
                            'left'      => __('Left', MELA_TD )
					],
					'default'       => 'default',
					'label_block'   => true,
					'condition'     => [
						'ma_el_post_grid_layout' =>  'grid',
						'ma_el_post_grid_thumbnail' =>  'yes'
					]
				]
			);

            $this->add_control(
                'hover_animation',
                [
                    'label' => __( 'Hover Animation', MELA_TD ),
                    'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                    'selectors'     => [
                            '{{WRAPPER}} .ma-el-post-thumbnail'
                        ]
                ]
            );


			$this->add_control('ma_el_blog_hover_color_effect',
				[
					'label'         => __('Color Effect', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'description'   => __('Choose an overlay color effect',MELA_TD ),
					'options'       => [
						'none'                   => __('No Effect', MELA_TD ),
						'zoom_in_one'            => __('Zoom In #1', MELA_TD ),
						'zoom_in_two'            => __('Zoom In #2', MELA_TD ),
						'zoom_out_one'           => __('Zoom Out #1', MELA_TD ),
						'zoom_out_two'           => __('Zoom Out #2', MELA_TD ),
						'rotate_zoomout'         => __('Rotate + Zoom Out', MELA_TD ),
						'slide'                  => __('Slide', MELA_TD ),
						'grayscale'              => __('Gray Scale', MELA_TD ),
						'blur'                   => __('Blur', MELA_TD ),
						'sepia'                  => __('Sepia', MELA_TD ),
						'blur_sepia'             => __('Blur + Sepia', MELA_TD ),
						'blur_grayscale'         => __('Blur + Gray Scale', MELA_TD ),
						'opacity_one'            => __('Opacity #1', MELA_TD ),
						'opacity_two'            => __('Opacity #2', MELA_TD ),
						'flushing'               => __('Flushing', MELA_TD ),
						'shine'                  => __('Shine', MELA_TD ),
						'circle'                 => __('Circle', MELA_TD ),

					],
					'default'       => 'none',
					'label_block'   => true
				]
			);

			$this->add_control('ma_el_blog_image_shapes',
				[
					'label'         => __('Thumbnail Shapes', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'description'   => __('Choose an Shapes for Thumbnails',MELA_TD ),
					'options'       => [
                        'none'              => __('None', MELA_TD ),
                        'framed'            => __('Framed', MELA_TD ),
                        'diagonal'          => __('Diagonal', MELA_TD ),
						'bordered'          => __('Bordered', MELA_TD ),
						'gradient-border'   => __('Gradient Bordered', MELA_TD ),
						'squares'           => __('Squares', MELA_TD )
					],
					'default'       => 'none',
					'label_block'   => true
				]
			);


			$this->end_controls_section();



			$this->start_controls_section('ma_el_post_grid_posts_options',
				[
					'label'         => __('Posts Settings', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_post_grid_ignore_sticky',
				[
					'label' => esc_html__( 'Ignore Sticky?', MELA_TD ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control('ma_el_blog_show_content',
				[
					'label'         => __('Show Content?', MELA_TD ),
					'description'   => __('Show/Hide Contents',MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control('ma_el_post_grid_excerpt',
				[
					'label'         => __('Show Excerpt ?', MELA_TD ),
					'description'   => __('Default Except Content Length is 55',MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'condition'     => [
						'ma_el_blog_show_content'  => 'yes',
					]
				]
			);


			$this->add_control('ma_el_post_grid_excerpt_content',
				[
					'label'         => __('Excerpt from Content?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Post content will be pulled from post content box',MELA_TD ),
					'default'       => 'true',
					'return_value'  => 'true',
					'condition'     => [
						'ma_el_post_grid_excerpt'  => 'yes',
					]
				]
			);

			$this->add_control('ma_el_blog_excerpt_length',
				[
					'label'         => __('Excerpt Length', MELA_TD ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => 55,
					'condition'     => [
						'ma_el_post_grid_excerpt'  => 'yes',
					]
				]
			);


			$this->add_control('ma_el_post_grid_excerpt_type',
				[
					'label'         => __('Excerpt Type', MELA_TD ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'three_dots'        => __('Three Dots', MELA_TD ),
						'read_more_link'    => __('Read More Link', MELA_TD ),
					],
					'default'       => 'read_more_link',
					'label_block'   => true,
					'condition'     => [
						'ma_el_post_grid_excerpt'  => 'yes',
					]
				]
			);

			$this->add_control('ma_el_post_grid_excerpt_text',
				[
					'label'			=> __( 'Read More Text', MELA_TD ),
					'type'			=> Controls_Manager::TEXT,
					'default'       => __('Read More',MELA_TD),
					'condition'     => [
						'ma_el_post_grid_excerpt'      => 'yes',
						'ma_el_post_grid_excerpt_type' => 'read_more_link'
					]
				]
			);


			$this->add_control('ma_el_post_grid_post_title',
				[
					'label'         => __('Display Post Title?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control('ma_el_blog_author_avatar',
				[
					'label'         => __('Display Author Avatar?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'no',
					'return_value'  => 'yes'
				]
			);


			$this->add_control('ma_el_post_grid_post_author_meta',
				[
					'label'         => __('Display Post Author?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control('ma_el_post_grid_post_date_meta',
				[
					'label'         => __('Display Post Date?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control('ma_el_post_grid_categories_meta',
				[
					'label'         => __('Display Categories?', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'no',
				]
			);

			$this->add_control('ma_el_post_grid_tags_meta',
				[
					'label'         => __('Display Tags?', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'no',
				]
			);

			$this->add_control('ma_el_post_grid_comments_meta',
				[
					'label'         => __('Display Comments Number?', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);



			$this->end_controls_section();


			/*
			 * Advanced Blog Settings
			 */
			$this->start_controls_section('ma_el_blog_advanced_settings',
				[
					'label'         => __('Advanced Settings', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_blog_total_posts_number',
				[
					'label'         => __( 'Total Number of Posts', MELA_TD ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => wp_count_posts()->publish,
					'condition'     => [
						'ma_el_blog_pagination'      => 'yes',
					]
				]
			);

			$this->add_control('ma_el_blog_post_offset',
				[
					'label'         => __( 'Offset Post Count', MELA_TD ),
					'description'   => __('The index of post to start with',MELA_TD),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> '0',
					'min' 			=> '0',
				]
			);

			$this->add_control('ma_el_blog_cat_tabs',
				[
					'label'         => __('Category Filter Tabs', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'ma_el_blog_carousel!'  => 'yes'
					]
				]
			);

			$this->add_control('ma_el_blog_categories',
				[
					'label'         => __( 'Filter By Category', MELA_TD ),
					'type'          => Controls_Manager::SELECT2,
					'description'   => __('Get posts for specific category(s)',MELA_TD ),
					'label_block'   => true,
					'multiple'      => true,
					'options'       => Master_Addons_Helper::ma_el_blog_post_type_categories(),
					'condition'     => [
						'ma_el_blog_cat_tabs'  => 'yes'
					]
				]
			);

			$this->add_responsive_control('ma_el_blog_filter_align',
				[
					'label'         => __( 'Alignment', MELA_TD  ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'flex-start'    => [
							'title' => __( 'Left', MELA_TD  ),
							'icon'  => 'fa fa-align-left',
						],
						'center'        => [
							'title' => __( 'Center', MELA_TD  ),
							'icon'  => 'fa fa-align-center',
						],
						'flex-end'      => [
							'title' => __( 'Right', MELA_TD  ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'       => 'center',
					'condition'     => [
						'ma_el_blog_cat_tabs'     => 'yes',
						'ma_el_blog_carousel!'    => 'yes'
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-blog-filter' => 'justify-content: {{VALUE}};',
					],
				]
			);


			$this->add_control('ma_el_blog_tags',
				[
					'label'         => __( 'Filter By Tag', MELA_TD ),
					'type'          => Controls_Manager::SELECT2,
					'description'   => __('Get posts for specific tag(s)',MELA_TD),
					'label_block'   => true,
					'multiple'      => true,
					'options'       => Master_Addons_Helper::ma_el_blog_post_type_tags(),
				]
			);


			$this->add_control('ma_el_blog_users',
				[
					'label'         => __( 'Filter By Author', MELA_TD ),
					'type'          => Controls_Manager::SELECT2,
					'description'   => __('Get posts for specific author(s)',MELA_TD),
					'label_block'   => true,
					'multiple'      => true,
					'options'       => Master_Addons_Helper::ma_el_blog_post_type_users(),
				]
			);

			$this->add_control('ma_el_blog_posts_exclude',
				[
					'label'         => __( 'Posts to Exclude', MELA_TD ),
					'type'          => Controls_Manager::SELECT2,
					'description'   => __('Add post(s) to exclude',MELA_TD),
					'label_block'   => true,
					'multiple'      => true,
					'options'       => Master_Addons_Helper::ma_el_blog_posts_list(),
				]
			);

			$this->add_control('ma_el_blog_new_tab',
				[
					'label'         => __('Links in New Tab', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Enable links to be opened in a new tab',MELA_TD ),
					'default'       => 'no',
				]
			);

			$this->end_controls_section();



			/*
			 * Carousel Settings
			 */
			$this->start_controls_section('ma_el_blog_carousel_settings',
				[
					'label'         => __('Carousel', MELA_TD),
					'condition'     => [
						'ma_el_post_grid_layout' => 'grid'
					]
				]
			);

			$this->add_control('ma_el_blog_carousel',
				[
					'label'         => __('Enable Carousel?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER
				]
			);

			$this->add_control('ma_el_blog_carousel_auto_play',
				[
					'label'         => __('Auto Play', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'ma_el_blog_carousel'  => 'yes'
					]
				]
			);

			$this->add_control('ma_el_blog_carousel_fade',
				[
					'label'         => __('Fade', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'ma_el_blog_cols' => '100%'
					]
				]
			);


			$this->add_control('ma_el_blog_carousel_autoplay_speed',
				[
					'label'			=> __( 'Autoplay Speed', MELA_TD ),
					'description'	=> __( 'Autoplay Speed means at which time the next slide should come. Set a value in milliseconds (ms)', MELA_TD ),
					'type'			=> Controls_Manager::NUMBER,
					'default'		=> 5000,
					'condition'		=> [
						'ma_el_blog_carousel'           => 'yes',
						'ma_el_blog_carousel_auto_play' => 'yes',
					],
				]
			);

			$this->add_control('ma_el_blog_carousel_dots',
				[
					'label'         => __('Navigation Dots', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'ma_el_blog_carousel'  => 'yes'
					]
				]
			);

			$this->add_control('ma_el_blog_carousel_arrows',
				[
					'label'         => __('Navigation Arrows', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
					'condition'     => [
						'ma_el_blog_carousel'  => 'yes'
					]
				]
			);

			$this->add_responsive_control('ma_el_blog_carousel_arrows_pos',
				[
					'label'         => __('Arrows Position', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', "em"],
					'range'         => [
						'px'    => [
							'min'       => -100,
							'max'       => 100,
						],
						'em'    => [
							'min'       => -10,
							'max'       => 10,
						],
					],
					'condition'		=> [
						'ma_el_blog_carousel'         => 'yes',
						'ma_el_blog_carousel_arrows'  => 'yes'
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-blog-wrap a.carousel-arrow.carousel-next' => 'right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ma-el-blog-wrap a.carousel-arrow.carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->end_controls_section();



			/*
			 * Style Settings
			 */

			$this->start_controls_section('ma_el_blog_thumbnail_style_section',
				[
					'label'         => __('Thumbnail Image', MELA_TD ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

            $this->add_control('ma_el_blog_overlay_color',
                [
                    'label'         => __('Overlay Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-thumbnail,  
                        {{WRAPPER}} .ma-el-post-thumbnail img:hover' => 'background: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_border_effect_color',
                [
                    'label'         => __('Border Color', MELA_TD),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition'     => [
                        'ma_el_blog_image_shapes'  => 'bordered',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-img-shape-bordered' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'selector' => '{{WRAPPER}} .ma-el-post-thumbnail img',
                ]
            );

			$this->end_controls_section();


			/*
			 * Title Styles
			 */

            $this->start_controls_section('ma_el_blog_title_style_section',
                [
                    'label'         => __('Title', MELA_TD),
                    'tab'           => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control('ma_el_blog_title_color',
                [
                    'label'         => __('Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-entry-title a'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'ma_el_blog_title_typo',
                    'selector'      => '{{WRAPPER}} .ma-el-entry-title',
                ]
            );

            $this->add_control('ma_el_blog_title_hover_color',
                [
                    'label'         => __('Hover Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-entry-title:hover a'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_section();


            /*
			 * Meta Styles
			 */
            $this->start_controls_section('ma_el_blog_meta_style_section',
                [
                    'label'         => __('Meta', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control('ma_el_blog_meta_color',
                [
                    'label'         => __('Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-entry-meta, {{WRAPPER}} .ma-el-post-entry-meta a, {{WRAPPER}} .ma-el-blog-post-tags-container, {{WRAPPER}} .ma-el-blog-post-tags-container a, {{WRAPPER}} .ma-el-blog-post-tags a'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'ma_el_blog_meta_typo',
                    'selector'      => '{{WRAPPER}} .ma-el-post-entry-meta, {{WRAPPER}} .ma-el-blog-post-tags-container',
                ]
            );

            $this->add_control('ma_el_blog_meta_hover_color',
                [
                    'label'         => __('Hover Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-entry-meta a:hover, {{WRAPPER}} .ma-el-blog-post-tags-container a:hover'  => 'color: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_section();


            /*
			 * Content Styles
			 */
            $this->start_controls_section('ma_el_blog_content_style_section',
                [
                    'label'         => __('Content', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control('ma_el_blog_post_content_color',
                [
                    'label'         => __('Text Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_3,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-content'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_post_content_bg_color',
                [
                    'label'         => __('Content Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-content'  => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'ma_el_blog_post_content_typo',
                    'selector'      => '{{WRAPPER}} .ma-el-post-content .ma-el-blog-post-content-wrap'
                ]
            );

            $this->add_control('ma_el_blog_post_content_box_color',
                [
                    'label'         => __('Box Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-post-outer-container'  => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'ma_el_blog_box_shadow',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-post',
                ]
            );

            $this->add_responsive_control('ma_el_blog_box_padding',
                [
                    'label'         => __('Padding', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_content_margin',
                [
                    'label'         => __('Content Margin', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
            $this->end_controls_section();


            /*
			 * Post Format Icon Styles
			 */
            $this->start_controls_section('ma_el_blog_post_format_icon_style_section',
                [
                    'label'         => __('Post Format Icon', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'ma_el_blog_post_format_icon'  => 'yes',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_format_icon_size',
                [
                    'label'         => __('Size', MELA_TD ),
                    'type'          => Controls_Manager::SLIDER,
                    'range'         => [
                        'em'    => [
                            'min'       => 1,
                            'max'       => 10,
                        ],
                    ],
                    'size_units'    => ['px', "em"],
                    'label_block'   => true,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-format-link i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_post_format_icon_color',
                [
                    'label'         => __('Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'default' => '#4b00e7',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-format-link i'  => 'color: {{VALUE}};',
                    ]
                ]
            );

			$this->add_control('ma_el_blog_p_f_trans_icon',
				[
					'label'         => __('Transparent Icon?', MELA_TD ),
					'type'          => Controls_Manager::SWITCHER,
					'description'   => __('Show or Hide Thumbnail',MELA_TD ),
					'default'       => 'yes',
				]
			);

            $this->add_control(
                'margin',
                [
                    'label' => __( 'Position', MELA_TD ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'condition'     => [
                        'ma_el_blog_p_f_trans_icon'  => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ma-el-blog-format-link i' => 'position: absolute;z-index:0;top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
                    ],
                ]
            );

			$this->add_responsive_control('ma_el_blog_pf_rotate',
				[
					'label'         => __('Rotation', MELA_TD ),
					'type'          => Controls_Manager::SLIDER,
                    'size_units' => [ 'deg' ],
                    'default' => [
                        'unit' => 'deg',
                        'size' => 360,
                    ],
                    'range' => [
                        'deg' => [
                            'step' => 5,
                        ],
                    ],
					'condition'     => [
						'ma_el_blog_p_f_trans_icon' =>  'yes'
					],
					'selectors'     => [
						'{{WRAPPER}} .ma-el-blog-format-link i' => 'transform: rotateZ({{SIZE}}{{UNIT}});'
					]


				]
			);

            $this->end_controls_section();


            /*
			 * Pagination Styles
			 */
            $this->start_controls_section('ma_el_blog_pagination_style_section',
                [
                    'label'         => __('Pagination', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'ma_el_blog_pagination_typo',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span,{{WRAPPER}} .ma-el-blog-pagination .page-numbers li a'
                ]
            );

            /* Pagination Colors Tab */
            $this->start_controls_tabs('ma_el_blog_pagination_colors');

            $this->start_controls_tab('ma_el_blog_pagination_nomral',
                [
                    'label'         => __('Normal', MELA_TD ),

                ]
            );

            $this->add_control('ma_el_blog_pagination_text_color',
                [
                    'label'         => __('Text Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li *' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control('ma_el_blog_pagination_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span,{{WRAPPER}} .ma-el-blog-pagination .page-numbers li a' => 'background: {{VALUE}};'
                    ]
                ]
            );
            $this->end_controls_tab();


            $this->start_controls_tab('ma_el_blog_pagination_hover',
                [
                    'label'         => __('Hover', MELA_TD ),

                ]
            );

            $this->add_control('ma_el_blog_pagination_text_hover_color',
                [
                    'label'         => __('Hover Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span:hover,{{WRAPPER}} .ma-el-blog-pagination .page-numbers li a:hover'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_pagination_hover_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span:hover,{{WRAPPER}} .ma-el-blog-pagination .page-numbers li a:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();



            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'          => 'ma_el_pagination_border',
                    'separator'     => 'before',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span,{{WRAPPER}} .ma-el-blog-pagination .page-numbers li a',
                ]
            );

            $this->add_control('ma_el_blog_pagination_border_radius',
                [
                    'label'         => __('Border Radius', MELA_TD ),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span, {{WRAPPER}} .ma-el-blog-pagination .page-numbers li span.current, {{WRAPPER}} .ma-el-blog-pagination .page-numbers li a' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );


            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'ma_el_blog_pagination_shadow',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span, {{WRAPPER}} .ma-el-blog-pagination .page-numbers li span.current, {{WRAPPER}} .ma-el-blog-pagination .page-numbers li a'
                ]
            );

            $this->add_responsive_control('ma_el_blog_pagination_padding',
                [
                    'label'         => __('Inner Padding', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li span,
                        {{WRAPPER}} .ma-el-blog-pagination .page-numbers li span.current,
                        {{WRAPPER}} .ma-el-blog-pagination .page-numbers li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_pagination_item_spacing',
                [
                    'label'         => __('Item Spacing', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination .page-numbers li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_pagination_margin',
                [
                    'label'         => __('Margin', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_section();



            /*
             * Category Filter Tabs
             */
            $this->start_controls_section('ma_el_blog_cat_filter_tabs_style_section',
                [
                    'label'         => __('Category Filter Tabs', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'ma_el_blog_cat_tabs'         => 'yes',
                        'ma_el_blog_carousel!'        => 'yes'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'ma_el_blog_cat_filter_typo',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-filter ul li a'
                ]
            );

            /* Category Filter Tabs */
            $this->start_controls_tabs('ma_el_blog_cat_colors_style');

            // Normal Tab
            $this->start_controls_tab('ma_el_blog_cat_nomral',
                [
                    'label'         => __('Normal', MELA_TD ),

                ]
            );
            $this->add_control('ma_el_blog_cat_filter_text_color',
                [
                    'label'         => __('Text Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_cat_filter_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a' => 'background: {{VALUE}};'
                    ]
                ]
            );
            $this->add_control('ma_el_blog_cat_filter_border_color',
                [
                    'label'         => __('Border Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#4b00e7',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a'  => 'border-color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();



            // Hover Tab
            $this->start_controls_tab('ma_el_blog_cat_hover',
                [
                    'label'         => __('Hover', MELA_TD ),

                ]
            );
            $this->add_control('ma_el_blog_cat_filter_text_hover_color',
                [
                    'label'         => __('Text Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a:hover'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_cat_filter_hover_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );
            $this->add_control('ma_el_blog_cat_filter_border_hover_color',
                [
                    'label'         => __('Border Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#4b00e7',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a:hover'  => 'border-color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Active Tab
            $this->start_controls_tab('ma_el_blog_cat_active_style',
                [
                    'label'         => __('Active', MELA_TD ),

                ]
            );
            $this->add_control('ma_el_blog_cat_filter_text_active_color',
                [
                    'label'         => __('Text Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#fff',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a.active'  => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_cat_filter_active_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#4b00e7',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a.active' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control('ma_el_blog_cat_filter_border_active_color',
                [
                    'label'         => __('Border Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#4b00e7',
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a.active'  => 'border-color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs();


            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'ma_el_blog_cat_filter_shadow',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-filter ul li a'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'          => 'ma_el_blog_cat_border',
                    'separator'     => 'before',
                    'selector'      => '{{WRAPPER}} .ma-el-blog-filter ul li a',
                ]
            );

            $this->add_control('ma_el_blog_cat_filter_border_radius',
                [
                    'label'         => __('Border Radius', MELA_TD ),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );



            $this->add_responsive_control('ma_el_blog_cat_filter_padding',
                [
                    'label'         => __('Inner Padding', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_cat_filter_item_spacing',
                [
                    'label'         => __('Item Spacing', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_cat_filter_margin',
                [
                    'label'         => __('Margin', MELA_TD),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_section();




            /*
             * Carousel Dots Styles
             */
            $this->start_controls_section('ma_el_blog_carousel_dots_style_section',
                [
                    'label'         => __('Carousel Dots', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'ma_el_blog_carousel'         => 'yes',
                        'ma_el_blog_carousel_dots'    => 'yes'
                    ]
                ]
            );

            $this->add_control('ma_el_blog_dots_color',
                [
                    'label'         => __('Dots Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} ul.slick-dots li' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control('ma_el_blog_dots_active_color',
                [
                    'label'         => __('Active Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} ul.slick-dots li.slick-active' => 'color: {{VALUE}};',
                    ]
                ]
            );


            $this->end_controls_section();



            /*
             * Carousel Arrows Styles
             */
            $this->start_controls_section('ma_el_blog_carousel_arrow_style_section',
                [
                    'label'         => __('Arrow Styles', MELA_TD ),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'ma_el_blog_carousel'         => 'yes',
                        'ma_el_blog_carousel_dots'    => 'yes'
                    ]
                ]
            );

            $this->add_responsive_control('ma_el_blog_carousel_arrow_size',
                [
                    'label'         => __('Size', MELA_TD ),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-team-carousel-prev, .ma-el-team-carousel-next' => 'font-size: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );


            $this->start_controls_tabs('ma_el_blog_carousel_arrow_style_tabs');

            // Normal Tab
            $this->start_controls_tab('ma_el_blog_carousel_arrow_style_tab',
                [
                    'label'         => __('Normal', MELA_TD ),

                ]
            );
            $this->add_control('ma_el_blog_arrow_color',
                [
                    'label'         => __('Arrow Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-wrapper .slick-arrow' => 'color: {{VALUE}};',
                    ]
                ]
            );
            $this->add_control('ma_el_blog_arrow_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-team-carousel-prev, .ma-el-team-carousel-next' => 'background: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();



            // Hover Tab
            $this->start_controls_tab('ma_el_blog_carousel_arrow_hover_style_tab',
                [
                    'label'         => __('Normal', MELA_TD ),

                ]
            );
            $this->add_control('ma_el_blog_arrow_hover_color',
                [
                    'label'         => __('Arrow Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-wrapper .slick-arrow:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );
            $this->add_control('ma_el_blog_arrow_hover_bg_color',
                [
                    'label'         => __('Background Color', MELA_TD ),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-team-carousel-prev:hover, .ma-el-team-carousel-next:hover' => 'background: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control('ma_el_blog_carousel_border_radius',
                [
                    'label'         => __('Border Radius', MELA_TD),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .ma-el-blog-wrapper .ma-el-team-carousel-prev,{{WRAPPER}} .ma-el-blog-wrapper .ma-el-team-carousel-next' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );
            $this->end_controls_section();




		}



		/*
		 * Renders Post Format Icon
		 * @since 1.1.5
		 */
		protected function ma_el_blog_post_format_icon() {

			$post_format = get_post_format();

			switch( $post_format ) {
				case 'aside':
					$post_format = 'file-text-o';
					break;
				case 'audio':
					$post_format = 'music';
					break;
				case 'gallery':
					$post_format = 'file-image-o';
					break;
				case 'image':
					$post_format = 'picture-o';
					break;
				case 'link':
					$post_format = 'link';
					break;
				case 'quote':
					$post_format = 'quote-left';
					break;
				case 'video':
					$post_format = 'video-camera';
					break;
				default:
					$post_format = 'thumb-tack';
			}
			?>
			<i class="ma-el-blog-post-format-icon fa fa-<?php echo $post_format; ?>"></i>
			<?php
		}




		/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
		protected function ma_el_get_post_title( $link_target ) {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'title', 'class', 'ma-el-entry-title');

			if( $settings['ma_el_post_grid_post_title'] == 'yes' ){ ?>

                <<?php echo $settings['title_html_tag'] . ' ' . $this->get_render_attribute_string('title'); ?>>
                    <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php the_title(); ?></a>
                </<?php echo $settings['title_html_tag']; ?>>

			<?php }

		}


		/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
		protected function ma_el_get_post_content() {

			$settings = $this->get_settings();

			$excerpt_type = $settings['ma_el_post_grid_excerpt_type'];
			$excerpt_text = $settings['ma_el_post_grid_excerpt_text'];
			$excerpt_src  = $settings['ma_el_post_grid_excerpt_content'];

			?>
			<div class="ma-el-blog-post-content-wrap" style="<?php if ( $settings['ma_el_blog_post_format_icon'] !== 'yes'
			 ) : echo 'margin-left:0px;'; endif; ?>">
				<?php if ( $settings['ma_el_post_grid_excerpt'] === 'yes' ) {
					echo Master_Addons_Helper::ma_el_get_excerpt_by_id( get_the_ID(), $settings['ma_el_blog_excerpt_length'], $excerpt_type, $excerpt_text, $excerpt_src );
				} else{
				    if( $settings['ma_el_blog_show_content'] == 'yes' ){
				        the_content();
				    }
				} ?>
			</div>
			<?php
		}



		/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
		protected function ma_el_get_post_meta( $link_target ) {

			$settings = $this->get_settings();

			$date_format = get_option('date_format');

			if(
			        $settings['ma_el_post_grid_post_author_meta'] === 'yes' ||
			        $settings['ma_el_post_grid_post_date_meta'] === 'yes' ||
			        $settings['ma_el_post_grid_categories_meta'] === 'yes' ||
			        $settings['ma_el_post_grid_comments_meta'] === 'yes'
			){
			?>

			<div class="ma-el-post-entry-meta" style="<?php if( $settings['ma_el_blog_post_format_icon'] !== 'yes' ) : echo 'margin-left:0px'; endif; ?>">

				<?php if( $settings['ma_el_post_grid_post_author_meta'] === 'yes' ) : ?>
                    <span class="ma-el-post-author">
                        <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                            <i class="fa fa-user fa-fw"></i>
                        <?php } ?>
                        <?php the_author_posts_link();?>
                    </span>
				<?php endif; ?>

				<?php if( $settings['ma_el_post_grid_post_date_meta'] === 'yes' ) : ?>
    				<span class="ma-el-post-date">
    				    <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
    				        <i class="fa fa-calendar fa-fw"></i>
					<?php } ?>

    				<?php

    				if($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout']=="thumbnail_bg"){?>
                        <time datetime="<?php echo get_the_modified_date( 'c' );?>">
                            <?php echo get_the_time('M d'); ?>
                            <span>
                                <?php echo get_the_time('Y'); ?>
                            </span>
                        </time>
    				<?php }else{?>
    				    <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_time($date_format); ?></a>
    				<?php } ?>
    				</span>
				<?php endif; ?>

				<?php if( $settings['ma_el_post_grid_categories_meta'] === 'yes' ) : ?>
					<span class="ma-el-post-categories">
			            <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                            <i class="fa fa-tags fa-fw"></i>
                        <?php } ?>
                        <?php the_category(', '); ?>
					</span>
				<?php endif; ?>

				<?php if( $settings['ma_el_post_grid_comments_meta'] === 'yes' ) : ?>
					<span class="ma-el-post-comments">
					    <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
					        <i class="fa fa-comments-o fa-fw"></i>
					    <?php } ?>
					    <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>">
					        <?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
					    </a>
					</span>
				<?php endif; ?>

			</div>

			<?php
			}
		}


		/*
         * Renders Blog Layout
         * @since 1.1.5
         */
        public function ma_el_get_post_meta_media_format($link_target){

	        $settings = $this->get_settings();
	        $date_format = get_option('date_format');

	        if( $settings['ma_el_blog_author_avatar']== "yes") { ?>

                <div class="ma-el-post-entry-meta media">
                    <div class="ma-el-author-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', get_the_author_meta( 'display_name' ), array('class' => 'rounded-circle')  ); ?>
                    </div>

                    <div class="media-body">
	                    <?php if( $settings['ma_el_post_grid_post_author_meta'] === 'yes' ) : ?>
                            <span class="ma-el-post-author">
                                <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                                    <i class="fa fa-user fa-fw"></i>
                                <?php } ?>
                                <?php the_author_posts_link();?>
                            </span>
	                    <?php endif; ?>

	                    <?php if( $settings['ma_el_post_grid_post_date_meta'] === 'yes' ) : ?>
                            <span class="ma-el-post-date">
                                <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                                    <i class="fa fa-calendar fa-fw"></i>
                                <?php } ?>
                                <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_time($date_format); ?></a></span>
	                    <?php endif; ?>

	                    <?php if( $settings['ma_el_post_grid_categories_meta'] === 'yes' ) : ?>
                            <span class="ma-el-post-categories">
                                <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                                    <i class="fa fa-tags fa-fw"></i>
                                <?php } ?>
                                <?php the_category(', '); ?>
                            </span>
	                    <?php endif; ?>

	                    <?php if( $settings['ma_el_post_grid_comments_meta'] === 'yes' ) : ?>
                            <span class="ma-el-post-comments">
                                <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                                    <i class="fa fa-comments-o fa-fw"></i>
                                <?php } ?>
                                    <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target);
			                    ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>  </a></span>
	                    <?php endif; ?>
                    </div>
                </div>


		        <?php
	        }
        }


		/*
		 * Renders Blog Layout
		 * @since 1.1.5
		 */
		protected function ma_el_blog_layout() {

			$settings = $this->get_settings();


			switch( $settings['ma_el_blog_cols'] ) {
				case '100%' :
					$col_number = 'col-sm-12';
					break;
				case '50%' :
					$col_number = 'col-sm-6';
					break;
				case '33.33%' :
					$col_number = 'col-sm-4';
					break;
				case '25%' :
					$col_number = 'col-sm-3';
					break;
			}


			$image_effect = $settings['ma_el_blog_hover_color_effect'];

			$post_effect = $settings['ma_el_blog_hover_color_effect'];

			if( $settings['ma_el_blog_new_tab'] == 'yes' ) {
				$target = '_blank';
			} else {
				$target = '_self';
			}

			$skin = $settings['ma_el_blog_skin'];

			$post_id = get_the_ID();

			$key = 'post_' . $post_id;

			$tax_key = sprintf( '%s_tax', $key );

			$wrap_key = sprintf( '%s_wrap', $key );

			$content_key = sprintf( '%s_content', $key );

			$this->add_render_attribute( $tax_key, 'class', ['ma-el-post-outer-container', $col_number ] );

			$this->add_render_attribute( $wrap_key, 'class', [
				'ma-el-blog-post',
				( $settings['ma_el_post_grid_layout'] == 'grid' ) ? 'ma-el-default-post' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic') ? 'ma-el-blog-list-default' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg') ? 'ma-el-blog-list-meta-bg' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='button_right') ? 'ma-el-blog-list-button-right' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='content_overlap') ? 'ma-el-blog-list-content-slide' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='thumbnail_hover') ? 'ma-el-blog-list-thumbnail-hover' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='thumbnail_hover_nav') ? 'ma-el-blog-list-thumbnail-nav-hover' : "",
				( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='thumbnail_bg') ? 'ma-el-blog-list-thumbnail-bg' : "",
                ( $settings['ma_el_blog_author_avatar'] === 'yes' ) ? "ma-el-post-meta-with-avatar" : "",
                ( $settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid' ) ? "ma-el-post-half-row" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'absolute_content' && $settings['ma_el_post_grid_layout'] == 'grid' ) ? "ma-el-post-absolute-bottom-content" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'cards_right' && $settings['ma_el_post_grid_layout'] == 'grid' ) ? "ma-el-post-content-right" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'cards_center' && $settings['ma_el_post_grid_layout'] == 'grid' ) ? "ma-el-post-meta-icon-with-details" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'absolute_content_two' && $settings['ma_el_post_grid_layout'] =='grid' ) ? "ma-el-post-content-gradient-bg-02" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'gradient_bg' && $settings['ma_el_post_grid_layout'] =='grid' ) ? "ma-el-post-content-gradient-bg" : "",
                ( $settings['ma_el_blog_cards_skin'] == 'full_banner' && $settings['ma_el_post_grid_layout'] =='grid' ) ? "ma-el-post-corner-content" : "",
				$skin,
			] );

			$thumb = ( ! has_post_thumbnail() ) ? 'empty-thumb' : '';

			if ( 'yes' === $settings['ma_el_blog_cat_tabs'] && 'yes' !== $settings['ma_el_blog_carousel'] ) {

				$categories = get_the_category( $post_id );

				foreach( $categories as $index => $category ) {

					$category = str_replace( ' ', '-', $category->cat_name );

					$this->add_render_attribute( $tax_key, 'class', strtolower( $category ) );
				}

			}

			$this->add_render_attribute( $content_key, 'class', [
//				'ma-el-blog-content-wrapper',
				'ma-el-post-content',
				$thumb,
			] );


        if ( $settings['hover_animation'] ) {
            $this->add_render_attribute( 'hover_animations', 'class', ['elementor-animation-' . $settings['hover_animation']] );
        }

			?>

			<?php if($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid'){ ?>
                <div class="col-lg-6">
			<?php } else{ ?>
                <div <?php echo $this->get_render_attribute_string( $tax_key ); ?>>
            <?php } ?>


				<div <?php echo $this->get_render_attribute_string( $wrap_key ); ?>>

                    <?php if(
                            ($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid')||
                            ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'button_right')||
                            ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'content_overlap')
                            ){ ?>
                        <div class="row">
                            <div class="col-md-6">
                    <?php } ?>

                    <?php if(
                            ( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic' ) ||
                            ( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg' )
                            ){ ?>
                        <div class="row">
                    <?php } ?>

                    <?php if($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic'){ ?>
                        <div class="col-md-4">
                    <?php } ?>

                    <?php if( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg' ) { ?>
                        <div class="col-md-5">
                    <?php } ?>

                    <?php if( $settings['ma_el_post_grid_thumbnail'] == 'yes' ) { ?>
                        <div <?php echo $this->get_render_attribute_string( 'hover_animations' ); ?>>
                            <div class="ma-el-post-thumbnail ma-el-img-<?php echo $image_effect;?> ma-el-img-shape-<?php echo $settings['ma_el_blog_image_shapes'];?>">
                                <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr( $target ); ?>">
                                    <?php the_post_thumbnail($settings['thumbnail_size']);?>
                                </a>
                                <?php if(  $settings['ma_el_blog_cards_skin'] === "absolute_content_two" ){ ?>
                                    <div class="ma-el-post-entry-meta">
                                        <span class="ma-el-post-date">
                                            <time datetime="<?php echo get_the_modified_date( 'c' );?>">
                                                <?php echo get_the_time('d'); ?>
                                                <span>
                                                    <?php echo get_the_time('M'); ?>
                                                </span>
                                            </time>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
					<?php } ?>


						<div class="ma-el-blog-effect-container <?php echo 'ma-el-blog-'. $post_effect .
						 '-effect'; ?>">
							<a class="ma-el-post-link" href="<?php the_permalink(); ?>" target="<?php echo esc_attr(
							        $target ); ?>"></a>
							<?php if( $settings['ma_el_blog_hover_color_effect'] === 'bordered' ) : ?>
								<div class="ma-el-blog-bordered-border-container"></div>
							<?php elseif( $settings['ma_el_blog_hover_color_effect'] === 'squares' ) : ?>
								<div class="ma-el-blog-squares-square-container"></div>
							<?php endif; ?>
						</div>



                    <?php if(
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic')||
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg')
                            ){ ?>
                        </div> <!--col-md-4-->
                    <?php } ?>

                    <?php if(
                                ($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid')||
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']== 'button_right')||
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']== 'content_overlap')
                            ){ ?>
                        </div>
                        <div class="col-md-6">
                    <?php } ?>

                    <?php if( 'cards' === $skin && $settings['ma_el_blog_author_avatar'] == "yes") : ?>
						<div class="ma-el-author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', get_the_author_meta( 'display_name' ), array('class' => 'rounded-circle')  ); ?>
						</div>
					<?php endif; ?>



                    <?php if($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic'){ ?>
                        <div class="col-md-8">
                    <?php } ?>

                    <?php if( $settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg' ) { ?>
                        <div class="col-md-7">
                    <?php } ?>

                    <?php if( $settings['ma_el_post_grid_layout'] == 'grid' && $settings['ma_el_blog_cards_skin']=='full_banner' ) { ?>
                        <div class="container">
                    <?php } ?>

                    <?php
                    //( $settings['ma_el_blog_cards_skin'] == 'full_banner' && $settings['ma_el_post_grid_layout'] =='grid' ) ? "ma-el-post-corner-content" : ""
//						    if( $settings['ma_el_blog_cards_skin'] == 'full_banner' && $settings['ma_el_post_grid_layout'] =='grid' ){ echo '<div class="container">'; }
                    ?>
					<div <?php echo $this->get_render_attribute_string( $content_key ); ?>>

						<div class="ma-el-blog-inner-container">

							<?php if( $settings['ma_el_blog_post_format_icon'] === 'yes' ) : ?>
								<div class="ma-el-blog-format-container">
									<a class="ma-el-blog-format-link" href="<?php the_permalink(); ?>" title="<?php if(
									        get_post_format() === ' ') : echo 'standard' ; else : echo get_post_format();  endif; ?>" target="<?php echo esc_attr( $target ); ?>"><?php $this->ma_el_blog_post_format_icon(); ?></a>
								</div>
							<?php endif; ?>

							<div class="ma-el-blog-entry-container">
								<?php

								    if(
								            ($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout']=="thumbnail_hover")||
								            ($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout']=="thumbnail_bg")
								    ){
									    $this->ma_el_get_post_meta( $target );
									}

									$this->ma_el_get_post_title( $target );

									if ( 'classic' === $skin ) {
										if( $settings['ma_el_blog_author_avatar'] === 'yes' ){
											$this->ma_el_get_post_meta_media_format( $target );
										} elseif(
										        ($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] !="thumbnail_hover")||
								                ($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] !="thumbnail_bg")
										    ) {
//                                            if( $settings['ma_el_post_list_layout'] !='thumbnail_hover'){
                                                $this->ma_el_get_post_meta( $target );
//                                            }
                                        }
									}

								?>
							</div>
						</div>

						<?php

							$this->ma_el_get_post_content();

							if ( 'cards' === $skin ) {
							    if(
							            ($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] !="thumbnail_hover" )||
							            ($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] !="thumbnail_hover_nav" )||
							            ($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] !="thumbnail_bg" )
							    ){
							        $this->ma_el_get_post_meta( $target );
							    }

							}
						?>

						<?php if( $settings['ma_el_post_grid_tags_meta'] === 'yes' && has_tag() ) : ?>
							<div class="ma-el-blog-post-tags-container" style="<?php if( $settings['ma_el_blog_post_format_icon'] !== 'yes' ) : echo 'margin-left:0px;'; endif; ?>">
                            <span class="ma-el-blog-post-tags">

                                <?php if( $settings['ma_el_blog_post_meta_icon'] === 'yes' ) { ?>
                                    <i class="fa fa-tags fa-fw"></i>
                                <?php } ?>

	                            <?php the_tags(' ', ', '); ?>
                            </span>
							</div>
						<?php endif; ?>
					</div>


                    <?php if( $settings['ma_el_post_grid_layout'] == 'grid' && $settings['ma_el_blog_cards_skin']=='full_banner' ) { ?>
                        </div>
                    <?php } ?>

                    <?php if(
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='classic')||
                                ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='meta_bg')
                            ){ ?>
                            </div> <!-- .col-md-8 -->
                        </div> <!--.row-->
                    <?php } ?>


                    <?php if(
                            ($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid')||
                            ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='button_right')||
                            ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout']=='content_overlap')
                            ){ ?>

                            </div> <!-- .col-md-6 -->
                        </div> <!-- .row -->
                    <?php } ?>


				</div>
			</div>

		<?php }



		protected function render() {

			// Query var for paged
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$settings = $this->get_settings_for_display();

			$offset = $settings['ma_el_blog_post_offset'];

			$post_per_page = $settings['ma_el_blog_posts_per_page'];

			$new_offset = $offset + ( ( $paged - 1 ) * $post_per_page );

			$post_args = Master_Addons_Helper::ma_el_blog_get_post_settings( $settings );

			$posts = Master_Addons_Helper::ma_el_blog_get_post_data( $post_args, $paged , $new_offset );

			$posts_number = intval ( 100 / substr( $settings['ma_el_blog_cols'], 0, strpos( $settings['ma_el_blog_cols'], '%') ) );

			$carousel = 'yes' == $settings['ma_el_blog_carousel'] ? true : false;

			$this->add_render_attribute('ma_el_blog', 'class', [
					'ma-el-blog-wrapper',
					'ma-el-blog-' . $settings['ma_el_post_grid_layout'],
                    'row'
				]
			);



			if ( $carousel ) {

				$play   = 'yes' == $settings['ma_el_blog_carousel_auto_play'] ? true : false;
				$fade   = 'yes' == $settings['ma_el_blog_carousel_fade'] ? 'true' : 'false';
				$arrows = 'yes' == $settings['ma_el_blog_carousel_arrows'] ? 'true' : 'false';
				$grid   = 'grid' == $settings['ma_el_post_grid_layout'] ? 'true' : 'false';

				$speed  = ! empty( $settings['ma_el_blog_carousel_autoplay_speed'] ) ? $settings['ma_el_blog_carousel_autoplay_speed'] : 5000;
				$dots   = 'yes' == $settings['ma_el_blog_carousel_dots'] ? 'true' : 'false';

				$this->add_render_attribute('ma_el_blog', 'data-carousel', $carousel );

				$this->add_render_attribute('ma_el_blog', 'data-grid', $grid );

				$this->add_render_attribute('ma_el_blog', 'data-fade', $fade );

				$this->add_render_attribute('ma_el_blog', 'data-play', $play );

				$this->add_render_attribute('ma_el_blog', 'data-speed', $speed );

				$this->add_render_attribute('ma_el_blog', 'data-col', $posts_number );

				$this->add_render_attribute('ma_el_blog', 'data-arrows', $arrows );

				$this->add_render_attribute('ma_el_blog', 'data-dots', $dots );

				$this->add_render_attribute( 'ma_el_blog', 'class',['elementor-slick-slider'] );

			}
			?>
			<div class="ma-el-blog">

				<?php if ( 'yes' === $settings['ma_el_blog_cat_tabs'] && 'yes' !== $settings['ma_el_blog_carousel'] ) { ?>
					<div class="ma-el-blog-filter">
						<ul class="ma-el-blog-cats-container">
							<li>
								<a href="javascript:;" class="category active" data-filter="*">
									<span><?php echo __('All', MELA_TD); ?></span>
								</a>
							</li>
							<?php foreach( $settings['ma_el_blog_categories'] as $index => $id ) {
								$cat_list_key = 'blog_category_' . $index;

								$name = get_cat_name( $id );

								$name_filter = str_replace(' ', '-', $name );
								$name_lower = strtolower( $name_filter );

								$this->add_render_attribute( $cat_list_key,
									'class', [
										'category'
									]
								);
								?>
								<li>
									<a href="javascript:;" <?php echo $this->get_render_attribute_string($cat_list_key); ?> data-filter=".<?php echo esc_attr( $name_lower ); ?>"
									><span><?php echo $name; ?></span>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>


				<div <?php echo $this->get_render_attribute_string('ma_el_blog'); ?>>

					<?php
					if( count( $posts ) ) {
						global $post;
						foreach ( $posts as $post ) {
							setup_postdata( $post );
							$this->ma_el_blog_layout();
						}
					?>
				</div>

			</div>

				<?php if ( $settings['ma_el_blog_pagination'] === 'yes' ) : ?>
					<div class="ma-el-blog-pagination">
						<?php
							$count_posts = wp_count_posts();
							$published_posts = $count_posts->publish;

							$total_posts = ! empty ( $settings['ma_el_blog_total_posts_number'] ) ? $settings['ma_el_blog_total_posts_number'] : $published_posts;

							$page_tot = ceil( ( $total_posts - $offset ) / $settings['ma_el_blog_posts_per_page'] );
							if ( $page_tot > 1 ) {
								$big        = 999999999;
								echo paginate_links(
									array(
										'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ),
										'format'    => '?paged=%#%',
										'current'   => max( 1, $paged ),
										'total'     => $page_tot,
										'prev_next' => true,
										'prev_text' => sprintf( "&lsaquo; %s", $settings['ma_el_blog_prev_text'] ),
										'next_text' => sprintf( "%s &rsaquo;", $settings['ma_el_blog_next_text'] ),
										'end_size'  => 1,
										'mid_size'  => 2,
										'type'      => 'list'
									));
							}
						?>
					</div>
				<?php endif;
				wp_reset_postdata();
			}

		}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Post_Grid() );
