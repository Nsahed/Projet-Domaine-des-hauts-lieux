<?php
if (!class_exists('Bestbug_Scrollmagic_Single_Image_Fusion')) {
    /**
     * Bestbug_Scrollmagic_Single_Image_Fusion Class
     *
     * @since	1.0
     */
    class Bestbug_Scrollmagic_Single_Image_Fusion
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
            add_shortcode('scrollmagic_single_image_fusion', array($this, 'shortcode'));
        }

        public function map_shortcode()
        {
            // Map settings for parent shortcode.
            fusion_builder_map(
                array(
                    'name' => esc_attr__('ScrollMagic Single Image', 'bestbug'),
                    'shortcode' => 'scrollmagic_single_image_fusion',
                    'icon' => 'fusiona-code',
                    'params' => array(
                        array(
                            'type' => 'upload',
                            'heading' => esc_attr__('Image', 'bestbug'),
                            'description' => esc_attr__('Choose Image or SVG file.', 'bestbug'),
                            'param_name' => 'image',
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
                'image' => '',
            ), $atts);
            $attr = $atts;

            if (!isset($attr['scenes'])) {
                $attr['scenes'] = '';
            }

            return do_shortcode('[' . BESTBUG_SCROLLMAGIC_SINGLE_IMAGE_SHORTCODE . ' scenes="' . str_replace(",", " ", trim($attr['scenes'])) . '"  image_url="' . $attr['image'] . '"][/' . BESTBUG_SCROLLMAGIC_SINGLE_IMAGE_SHORTCODE . ']');
        }

    }

    new Bestbug_Scrollmagic_Single_Image_Fusion();
}
