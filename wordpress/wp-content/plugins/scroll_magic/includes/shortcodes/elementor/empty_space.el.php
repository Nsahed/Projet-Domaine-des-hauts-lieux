<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class ScrollMagic_Elementor_Empty_Space extends Widget_Base
{

    public function get_name()
    {
        return 'el_scroll_magic_empty_space';
    }

    public function get_title()
    {
        return esc_html__('ScrollMagic Empty Space', 'bestbug');
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
            'height',
            [
                'label' => esc_html__('Height', 'bestbug'),
                'placeholder' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'bestbug'),
                'dynamic' => ['active' => true]
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => esc_html__('Width', 'bestbug'),
                'placeholder' => esc_html__('Enter empty space height (Note: CSS measurement units allowed).', 'bestbug'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'bestbug'),
                'dynamic' => ['active' => true]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (isset($settings['height']) && !empty($settings['height'])) {
            echo do_shortcode('[' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ' height="' . $settings['height'] . '" width="' . $settings['width'] . '"][/' . BESTBUG_SCROLLMAGIC_EMPTY_SPACE_SHORTCODE . ']');
        }
    }

    protected function content_template()
    {
        ?>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new ScrollMagic_Elementor_Empty_Space());