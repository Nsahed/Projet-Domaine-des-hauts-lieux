<?php
class ScrollMagic_Image_Divi extends ET_Builder_Module
{
    public $slug = 'et_pb_scrollmagic_image';
    public $vb_support = 'on';
    public function init()
    {
        $this->name = esc_html__('ScrollMagic Image', 'bestbug');

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
            'image' => array(
                'label' => esc_html__('Image', 'bestbug'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'bestbug'),
                'choose_text' => esc_attr__('Choose an Image', 'bestbug'),
                'update_text' => esc_attr__('Set As Image', 'bestbug'),
                'hide_metadata' => true,
                'affects' => array(
                    'alt',
                    'title_text',
                ),
                'description' => esc_html__('Upload your desired image, or type in the URL to the image you would like to display.', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'image',
            ),
            'scenes' => array(
                'label' => esc_html__('Scenes', 'bestbug'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('The Scene Ids split by commas', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
        );
    }
    public function render($unprocessed_props, $content = null, $render_slug)
    {
        return do_shortcode('[' . BESTBUG_SCROLLMAGIC_SINGLE_IMAGE_SHORTCODE . ' scenes="' . str_replace(",", " ", trim($this->props['scenes'])) . '" image_url="' . $this->props['image'] . '"][/' . BESTBUG_SCROLLMAGIC_SINGLE_IMAGE_SHORTCODE . ']');
    }
}
new ScrollMagic_Image_Divi;