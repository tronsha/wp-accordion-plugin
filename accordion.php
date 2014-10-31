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
            wp_register_script(
                'jqueryui',
                '//code.jquery.com/ui/1.11.2/jquery-ui.js',
                array('jquery'),
                '1.11.2'
            );
            wp_enqueue_style('jqueryui');
        }
    }
);

add_shortcode(
    'accordion',
    function ($att = array(), $content = null) {
    }
);
