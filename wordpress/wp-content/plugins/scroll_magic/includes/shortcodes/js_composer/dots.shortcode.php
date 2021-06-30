<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('Bestbug_Scrollmagic_Dots_Shortcode')) {
    /**
     * Bestbug_Scrollmagic_Dots_Shortcode Class
     *
     * @since	1.0
     */
    class Bestbug_Scrollmagic_Dots_Shortcode
    {

        /**
         * Constructor
         *
         * @return	void
         * @since	1.0
         */
        function __construct()
        {
            add_action('init', array($this, 'init'));
        }

        public function init()
        {

            add_shortcode(BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE, array($this, 'shortcode'));
            if (defined('WPB_VC_VERSION') && function_exists('vc_add_param')) {
                $this->vc_shortcode();
            }

        }

        public function vc_shortcode()
        {
            vc_map(array(
                "name" => esc_html__("Dots Navigation", 'bestbug'),
                "base" => BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE,
                "content_element" => true,
                "icon" => "icon-wpb-ui-empty_space",
                "description" => esc_html__("Dots Navigation for the anchors", 'bestbug'),
                'category' => esc_html(sprintf(esc_html__('by %s', 'bestbug'), BESTBUG_SM_CATEGORY)),
                "params" => array(
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Anchors', 'bestbug'),
                        'description' => esc_html__('Type your anchors list split by commas', 'bestbug'),
                        'param_name' => 'anchors',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Skin', 'bestbug'),
                        'param_name' => 'skin',
                        'value' => array(
                            'Default' => 'default',
                            'Light' => 'light',
                            'Dark' => 'dark',
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Extra class name', 'bestbug'),
                        'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'bestbug'),
                        'param_name' => 'el_class',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => 'CSS box',
                        'param_name' => 'css',
                        'group' => 'Design Options',
                    ),
                ),
            ));
        }
        public function settings($attr = BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE)
        {
            return BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE;
        }

        public function shortcode($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'anchors' => '',
                'skin' => '',
                'css' => '',
                'el_class' => '',
            ), $atts));

            $list_anchors = array();
            if(isset($anchors) && !empty($anchors)) {
                $list_anchors = explode(',', $anchors);
            }

            $html_dots = '';
            foreach ($list_anchors as $key => $anchor) {
                $html_dots .= '<a class="wpsm-dots" href="'.esc_attr(trim($anchor)). '">' . esc_attr(trim($anchor)) . '</a>';
            }
            $html_dots .= '';

            $css_class = apply_filters(BestBug_Helper::$VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, BestBug_Helper::vc_shortcode_custom_css_class($css, ' '), BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE, $atts);
            $css_class .= ' ' . $el_class . ' skin-' . $skin;

            return '<div class="wpsm-dots-navigation ' . esc_attr($css_class) . '">'. $html_dots .'</div>';
        }

    }

    new Bestbug_Scrollmagic_Dots_Shortcode();
}

