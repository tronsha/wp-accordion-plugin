<?php
/**
 * @link              https://github.com/tronsha/wp-accordion-plugin
 * @since             1.0.0
 * @package           wp-accordion-plugin
 *
 * @wordpress-plugin
 * Plugin Name:       MPCX Accordion
 * Plugin URI:        https://github.com/tronsha/wp-accordion-plugin
 * Description:       Accordion Plugin
 * Version:           1.0.0
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-accordion-plugin/master/LICENSE
 */

defined('ABSPATH') or (@include_once explode('wp-content', __DIR__)[0] . '/wp-hide.php') or die;

add_action(
    'init',
    function () {
        if (!is_admin()) {
            wp_register_style(
                'accordion',
                plugin_dir_url(__FILE__) . 'slider/css/accordion.css',
                array(),
                '1.0.0'
            );
            wp_register_script(
                'accordion',
                plugin_dir_url(__FILE__) . 'slider/js/accordion.js',
                array('jquery'),
                '1.0.0'
            );
            wp_enqueue_style('accordion');
            wp_enqueue_script('accordion');
        }
    }
);

add_shortcode(
    'accordion',
    function ($att = array(), $content = null) {
    }
);
