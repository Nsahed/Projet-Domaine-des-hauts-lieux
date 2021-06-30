<?php
class ScrollMagic_EmptySpace_Divi extends ET_Builder_Module
{
    public $slug = 'et_pb_scrollmagic_emptyspace';
    public $vb_support = 'on';
    public function init()
    {
        $this->name = esc_html__('ScrollMagic Empty Space', 'bestbug');
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
            'width' => array(
                'label' => esc_html__('Width', 'bestbug'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
            'height' => array(
                'label' => esc_html__('Height', 'bestbug'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
        );
    }
    public function render($unprocessed_props, $content = null, $render_slug)
    {
        return do_shortcode('[' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ' height="' . $this->props['height'] . '" width="' . $this->props['width'] . '"][/' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ']');
    }
}
new ScrollMagic_EmptySpace_Divi;