<?php
if (!class_exists('Bestbug_Scrollmagic_Fusion')) {
    /**
     * Bestbug_Scrollmagic_Fusion Class
     *
     * @since	1.0
     */
    class Bestbug_Scrollmagic_Fusion
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
            add_shortcode('scrollmagic_fusion', array($this, 'shortcode'));
        }
        
        public function map_shortcode()
        {
            // Map settings for parent shortcode.
            fusion_builder_map(
                array(
                    'name' => esc_attr__('ScrollMagic', 'bestbug'),
                    'shortcode' => 'scrollmagic_fusion',
                    'icon' => 'fusiona-code',
                    'params' => array(
                        array(
                            'type' => 'tinymce',
                            'heading' => esc_attr__('Content', 'bestbug'),
                            'description' => esc_attr__('Enter some content for this.', 'bestbug'),
                            'param_name' => 'element_content',
                            'value' => esc_attr__('Enter some content for this.', 'bestbug'),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_attr__('Scenes', 'bestbug'),
                            'description' => esc_attr__('The ScrollMagic Scene Ids split by commas', 'bestbug'),
                            'param_name' => 'scenes',
                            'value' => '',
                        ),
                    ),
                )
            );
        }

        public function shortcode($atts, $content = '')
        {
			// Fix PHP 7.1 Warnings : Illegal String Offset
            $atts = shortcode_atts(array(
                'scenes' => '',
            ), $atts);
            $attr = $atts;

            if (!isset($attr['scenes'])) {
                $attr['scenes'] = '';
            }

            $scenes = str_replace(",", " ", trim($attr['scenes']));
            return do_shortcode('[scrollmagic  scenes="' . str_replace(",", " ", trim($attr['scenes'])) . '"]' . $content . '[/scrollmagic]');
        }

    }

    new Bestbug_Scrollmagic_Fusion();
}
