<?php
class ScrollMagic_SequenceImage_Divi extends ET_Builder_Module
{
    public $slug = 'et_pb_scrollmagic_sequenceImage';
    public $vb_support = 'on';
    public function init()
    {
        $this->name = esc_html__('ScrollMagic Sequence Image', 'bestbug');
        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Image', 'bestbug'),
                    'link' => esc_html__('Link', 'bestbug'),
                    'transform' => esc_html__('Transform & Rotation', 'bestbug'),
                ),
            ),
        );
    }
    public function get_fields()
    {
        return array(
            'images' => array(
                'label' => esc_html__('Senquence Images', 'bestbug'),
                'type' => 'upload-gallery',
                'option_category' => 'basic_option',
                'toggle_slug' => 'main_content',
            ),
            'align' => array(
                'label' => esc_html__('Align', 'bestbug'),
                'type' => 'select',
                'options' => array(
                    'left' => esc_html__('Left', 'bestbug'),
                    'center' => esc_html__('Center', 'bestbug'),
                    'right' => esc_html__('Right', 'bestbug'),
                ),
                'default' => 'left',
                'toggle_slug' => 'main_content',
            ),
            'scenes' => array(
                'label' => esc_html__('Scenes', 'bestbug'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('The Scene Ids split by commas', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
            'gallery_orderby' => array(
                'label' => esc_html__('Order By', 'bestbug'),
                'type' =>  'hidden',
                'options' => array(
                    '' => esc_html__('Default', 'bestbug'),
                    'rand' => esc_html__('Random', 'bestbug'),
                ),
                'default' => 'off',
                'class' => array('et-pb-gallery-ids-field'),
                'toggle_slug' => 'main_content',
            ),
        );
    }
    public function render($unprocessed_props, $content = null, $render_slug)
    {
        return do_shortcode('[' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ' scenes="' . str_replace(",", " ", trim($this->props['scenes'])) . '" images="' . $this->props['images'] . '"  align="' . $this->props['align'] . '"][/' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ']');
    }
}
new ScrollMagic_SequenceImage_Divi;