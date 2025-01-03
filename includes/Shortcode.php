<?php

namespace Eveeno;

defined('ABSPATH') || exit;
class Shortcode {

    public function __construct() {
        add_shortcode('eveeno', [$this, 'shortcodeOutput']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }
    function shortcodeOutput($atts) {

        $aParam = ['data-wp-plugin-version="' . EVEENO_PLUGIN_VERSION . '"'];
        $output = '';

        foreach ($atts as $k => $v) {
            if ($v == '')
                continue;
            if ($k == 'show') {
                switch ($v) {
                    case 'form':
                        $aParam[] = 'data-type="booking"';
                        break;
                    case 'table':
                    case 'grid':
                    case 'list':
                        $aParam[] = 'data-type="calendar"';
                        $aParam[] = 'data-style="' . esc_attr($v) . '"';
                        break;
                    default:
                        $aParam[] = 'data-' . esc_attr($k) . '="' . esc_attr($v) . '"';
                }
            } else {
                $aParam[] = 'data-' . esc_attr($k) . '="' . esc_attr($v) . '"';
            }
        }
        $sParam = implode(' ', $aParam);

        $output .= ' <div class="eveenoWidget" ' . $sParam . '></div>';

        wp_enqueue_script('eveeno');

        return $output;
    }

    function enqueueScripts() {
        wp_register_script(
            'eveeno',
            plugins_url('eveeno/assets/js/embed.min.js'),
            [],
            EVEENO_PLUGIN_VERSION,
            ['in_footer' => false]
        );
    }
}
