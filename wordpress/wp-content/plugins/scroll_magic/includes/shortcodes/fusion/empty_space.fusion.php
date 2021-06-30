<?php
if (!class_exists('Bestbug_Scrollmagic_Empty_Space_Fusion')) {
    /**
     * Bestbug_Scrollmagic_Empty_Space_Fusion Class
     *
     * @since	1.0
     */
    class Bestbug_Scrollmagic_Empty_Space_Fusion
    {
        /**
         * Constructor
         *
         * @return	void
         * @since	1.0
         */
        function __construct()
        {
            add_action('fusion_builder_before_init', array($this, 'map_shortcode'));
            add_shortcode('scrollmagic_empty_space_fusion', array($this, 'shortcode'));
        }

        public function map_shortcode()
        {
            // Map settings for parent shortcode.
            fusion_builder_map(
                array(
                    'name' => esc_attr__('ScrollMagic Empty Space', 'bestbug'),
                    'shortcode' => 'scrollmagic_empty_space_fusion',
                    'icon' => 'fusiona-code',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_attr__('Height', 'bestbug'),
                            'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                            'param_name' => 'height',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_attr__('Width', 'bestbug'),
                            'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                            'param_name' => 'width',
                            'value' => '',
                        ),
                    ),
                )
            );
        }

        public function shortcode($atts, $content = null)
        {
			// Fix PHP 7.1 Warnings : Illegal String Offset
            $atts = shortcode_atts(array(
                'height' => '',
                'width' => '',
            ), $atts);
            $attr = $atts;

            if (!isset($attr['height'])) {
                $attr['height'] = '';
            }
            if (!isset($attr['width'])) {
                $attr['width'] = '';
            }

            return do_shortcode('[' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ' height="' . $attr['height'] . '" width="' . $attr['width'] . '"][/' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ']');
        }

    }

    new Bestbug_Scrollmagic_Empty_Space_Fusion();
}
