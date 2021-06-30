<?php
if (!class_exists('Bestbug_Scrollmagic_Sequence_Image_Fusion')) {
    /**
     * Bestbug_Scrollmagic_Sequence_Image_Fusion Class
     *
     * @since	1.0
     */
    class Bestbug_Scrollmagic_Sequence_Image_Fusion
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
            add_shortcode('scrollmagic_sequence_image_fusion', array($this, 'shortcode'));
        }

        public function map_shortcode()
        {
            // Map settings for parent shortcode.
            fusion_builder_map(
                array(
                    'name' => esc_attr__('ScrollMagic Sequence Image', 'bestbug'),
                    'shortcode' => 'scrollmagic_sequence_image_fusion',
                    'icon' => 'fusiona-code',
                    'params' => array(
                        array(
                            'type' => 'upload_images',
                            'heading' => esc_attr__('Images', 'bestbug'),
                            'description' => esc_attr__('Upload or select images.', 'bestbug'),
                            'param_name' => 'image_ids',
                            'value' => '',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_attr__('Scenes', 'bestbug'),
                            'description' => esc_attr__('The ScrollMagic Scene Ids split by commas', 'bestbug'),
                            'param_name' => 'scenes',
                            'value' => '',
                        ),
                        array(
                            'type' => 'select',
                            'heading' => esc_attr__('Align', 'bestbug'),
                            'param_name' => 'align',
                            'default' => 'left',
                            'value' => array(
                                'left' => esc_attr__('Left', 'bestbug'),
                                'center' => esc_attr__('Center', 'bestbug'),
                                'right' => esc_attr__('Right', 'bestbug'),
                            ),
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
                'image_ids' => '',
                'align' => '',
            ), $atts);
            $attr = $atts;

            if (!isset($attr['scenes'])) {
                $attr['scenes'] = '';
            }
            if (!isset($attr['align'])) {
                $attr['align'] = '';
            }

            if(!empty($attr['image_ids'])) {
                return do_shortcode('[' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ' scenes="' . str_replace(",", " ", trim($attr['scenes'])) . '"  images="' . $attr['image_ids'] . '" align="'. $attr['align'] .'"][/' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ']');
            }

            return '';
        }

    }

    new Bestbug_Scrollmagic_Sequence_Image_Fusion();
}
