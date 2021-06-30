<?php
class ScrollMagic_Divi extends ET_Builder_Module
{
    public $slug = 'et_pb_scrollmagic';
    public $vb_support = 'on';
    public function init()
    {
        $this->name = esc_html__('ScrollMagic', 'bestbug');
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
        $scenestmp = get_posts(array(
            'numberposts' => -1,
            'post_type' => BESTBUG_SCROLLMAGIC_POSTTYPE,
            'orderby' => 'title',
            'order' => 'ASC',
        ));

        $scenes = array();
        foreach ($scenestmp as $key => $scene) {
            $scenes[$scene->post_name] = $scene->post_title;
        }
        return array(
            'content' => array(
                'label' => esc_html__('Content', 'bestbug'),
                'type' => 'tiny_mce',
                'option_category' => 'basic_option',
                'description' => esc_html__('Content affected by ScrollMagic', 'bestbug'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
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
        return do_shortcode('[scrollmagic bbsm_scene="' . $this->props['scenes'] . '"]' . $this->props['content'] . '[/scrollmagic]');
    }
}
new ScrollMagic_Divi;