<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class ScrollMagic_Elementor_Sequence_Image extends Widget_Base
{

    public function get_name()
    {
        return 'el_scroll_magic_sequence_image';
    }

    public function get_title()
    {
        return esc_html__('ScrollMagic Sequence Image', 'bestbug');
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
            'images',
            [
                'label' => esc_html__('Images', 'bestbug'),
                'placeholder' => esc_html__('Choose Images', 'bestbug'),
                'type' => Controls_Manager::GALLERY,
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

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'bestbug'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'bestbug'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bestbug'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bestbug'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'dynamic' => ['active' => true]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (isset($settings['images'][0]['id']) && !empty($settings['images'][0]['id'])) {
            $ids = array();
            foreach ($settings['images'] as $key => $value) {
                $ids[] = $value['id'];
            }
            echo do_shortcode('[' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ' scenes="' . str_replace(",", " ", trim($settings['scenes'])) . '" images="' . implode(',', $ids) . '"  align="' . $settings['align'] . '"][/' . BESTBUG_SCROLLMAGIC_SEQUENCE_IMAGE_SHORTCODE . ']');
        }
    }

    protected function content_template()
    {
        ?>
        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new ScrollMagic_Elementor_Sequence_Image());