<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'BestBug_ScrollMagic_Options' ) ) {
	/**
	 * BestBug_ScrollMagic_Options Class
	 *
	 * @since	1.0
	 */
	class BestBug_ScrollMagic_Options {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
		}

		public function init() {
			
			add_filter('bb_register_options', array( $this, 'options'), 10, 1 );
			add_action( 'bb_before_save_options', array( $this, 'update_all_shortcode' ), 10 , 1 );

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
        }

		public function adminEnqueueScripts() {
			if(isset($_GET['page']) && ($_GET['page'] == BESTBUG_SM_SLUG || $_GET['page'] == BESTBUG_SCENE_ADD || $_GET['page'] == BESTBUG_SM_SLUG_SETTINGS)) {
				BestBug_Core_Options::adminEnqueueScripts();
			}
		}

		public function enqueueScripts() {
		
        }
		
        public function options($options) {
			if( empty($options) ) {
				$options = array();
			}
			
			$prefix = BESTBUG_SCROLMAGIC_PREFIX;
			$options[] = array(
				'type' => 'options_fields',
				'menu' => array(
					// add_submenu_page || add_menu_page
					'type' => 'add_submenu_page',
					'parent_slug' => BESTBUG_SM_SLUG,
					'page_title' => esc_html('Settings', 'bestbug'),
					'menu_title' => esc_html('Settings', 'bestbug'),
					'capability' => 'manage_options',
					'menu_slug' => BESTBUG_SM_SLUG_SETTINGS,
				),
				'fields' => array(
					array(
						'type' => 'toggle',
						'heading' => esc_html__('Mobile Mode', 'bestbug'),
						'param_name' => $prefix . 'mobile_mode',
						'value' => 'no',
						'description' => esc_html__('Enable/Disable Scrollmagic on Mobiles', 'bestbug'),
					),
					array(
						'type' => 'toggle',
						'heading' => esc_html__('Desktop Mode', 'bestbug'),
						'param_name' => $prefix . 'desktop_mode',
						'value' => 'yes',
						'description' => esc_html__('Enable/Disable Scrollmagic on Desktop', 'bestbug'),
					),
					array(
						'type'       => 'toggle',
						'heading'    => esc_html__( 'Add Option to Shortcodes', 'bestbug' ),
						'param_name' => $prefix . 'add_option',
						'value'      => 'yes',
						'description' => esc_html('Add ScrollMagic Option to the Shortcodes (support WPBakery Builder)', 'bestbug'),
					),
					array(
						'type'       => 'toggle',
						'heading'    => esc_html__( 'Use for all Shortcodes', 'bestbug' ),
						'param_name' => $prefix . 'all_shortcodes',
						'value'      => 'no',
						'description' => esc_html('Use ScrollMagic Option for all Shortcodes (support WPBakery Builder)', 'bestbug'),
						'dependency' => array('element' => $prefix . 'add_option', 'value' => array('yes')),
					),
					array(
						'type'       => 'tags',
						'heading'    => esc_html__( 'Shortcodes', 'bestbug' ),
						'param_name' => $prefix . 'shortcodes',
						'value'      => 'vc_row,vc_column,vc_custom_heading',
						'description' => esc_html('Use ScrollMagic Option for the Shortcodes you want (support WPBakery Builder)', 'bestbug'),
						'dependency'  => array( 'element' => $prefix . 'all_shortcodes', 'value' => array( 'no' ) ),
					),
					array(
						'type'       => 'toggle',
						'heading'    => esc_html__( 'Smooth scrolling', 'bestbug' ),
						'param_name' => $prefix . 'smooth_scrolling',
						'value'      => 'no',
					),
				),
			);
			
			return $options;
        }
		
		function update_all_shortcode($data){
			if(!isset($data[BESTBUG_SCROLMAGIC_PREFIX.'all_shortcodes']) || $data[BESTBUG_SCROLMAGIC_PREFIX.'all_shortcodes'] != 'yes') {
				return;
			}
			if( !class_exists('WPBMap') ) {
				return;
			}
			
			$allShortcodes = WPBMap::getAllShortCodes();
			$shortcodes = array();
			foreach ( $allShortcodes as $tag => $shortcode ) {
				if( !isset($shortcode['params']) ) {
					continue;
				}
				array_push( $shortcodes, $tag);
			}
			BestBug_Helper::update_option('bbsm_cache_all_vcshortcodes', implode(",", $shortcodes));
		}
        
    }
	
	new BestBug_ScrollMagic_Options();
}

