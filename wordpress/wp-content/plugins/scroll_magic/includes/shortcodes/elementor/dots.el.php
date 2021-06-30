<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class ScrollMagic_Elementor_Dots extends Widget_Base
{

    public function get_name()
    {
        return 'el_scroll_magic_dots';
    }

    public function get_title()
    {
        return esc_html__('ScrollMagic Dots', 'bestbug');
    }

    public function get_icon()
    {
        return 'eicon-shortcode';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected $allowed_html = array(
        'strong' => array(
            'style' => array()
        ),
        'span' => array(
            'style' => array()
        ),
        'em' => array(
            'style' => array()
        ),
        'a' => array(
            'href' => array(),
            'style' => array()
        ),
    );

    protected function _register_controls()
    {

		// Content Controls
        $this->start_controls_section(
            'ScrollMagic',
            [
                'label' => esc_html__('General', 'bestbug')
            ]
        );

        $this->add_control(
            'anchors',
            [
                'label' => esc_html__('Anchors', 'bestbug'),
                'placeholder' => esc_html__('Type your anchors list split by commas, Sample: #id-anchor-1, #id-anchor-2', 'bestbug'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'bestbug'),
                'dynamic' => ['active' => true]
            ]
        );

        $this->add_control(
            'skin',
            [
                'label' => esc_html__('Skin', 'bestbug'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'bestbug'),
                    'light' => esc_html__('Light', 'bestbug'),
                    'dark' => esc_html__('Dark', 'bestbug'),
                ],
                'dynamic' => ['active' => true]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (isset($settings['anchors']) && !empty($settings['anchors'])) {
            echo do_shortcode('[' . BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE . ' anchors="' . $settings['anchors'] . '" skin="' . $settings['skin'] . '"][/' . BESTBUG_SCROLLMAGIC_DOTS_SHORTCODE . ']');
        }
    }

    protected function content_template()
    {
        ?>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new ScrollMagic_Elementor_Dots());