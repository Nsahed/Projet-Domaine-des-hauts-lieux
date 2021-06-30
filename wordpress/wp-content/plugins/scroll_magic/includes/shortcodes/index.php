<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

include_once('js_composer/index.php');
include_once('fusion/index.php');

add_action('et_builder_ready', function () {
    include_once('divi/index.php');
});

add_action('elementor/widgets/widgets_registered', function () {
    include_once('elementor/index.php');
});

