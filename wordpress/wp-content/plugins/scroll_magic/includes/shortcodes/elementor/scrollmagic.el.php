<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class ScrollMagic_Elementor extends Widget_Base
{

    public function get_name()
    {
        return 'el_scroll_magic';
    }

    public function get_title()
    {
        return esc_html__('ScrollMagic', 'bestbug');
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
            'content',
            [
                'label' => esc_html__('Content', 'bestbug'),
                'placeholder' => esc_html__('Place your content', 'bestbug'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('This is the Content', 'bestbug'),
                'dynamic' => ['active' => true]
            ]
        );

        $this->add_control(
            'scenes',
            [
                'label' => esc_html__('The ScrollMagic Scene Ids split by commas', 'bestbug'),
                'placeholder' => esc_html__('Sample: scene-1, scene-2', 'bestbug'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'bestbug'),
                'dynamic' => ['active' => true]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        echo do_shortcode('[scrollmagic  scenes="' . str_replace(",", " ", trim($settings['scenes'])) . '"]' . $settings['content'] . '[/scrollmagic]');
    }

    protected function content_template()
    {
        ?>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new ScrollMagic_Elementor());