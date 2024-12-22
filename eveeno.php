<?php
/*
  Plugin Name:  Eveeno
  Plugin URI:   https://github.com/cassandre/eveeno-wp
  Version:      2.0
  Description:  WordPress plugin for embedding eveeno registration forms and upcoming events lists
  Author:       Barbara Bothe
  Author URI:   https://barbara-bothe.de
  License:      GPLv3 or later
  License URI:    https://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Eveeno;

include "includes/Shortcode.php";

// Load the plugin's text domain for localization.
add_action('init', fn() => load_plugin_textdomain('eveeno', false, dirname(plugin_basename(__FILE__)) . '/languages'));

register_activation_hook(__FILE__, __NAMESPACE__ . '\activation');
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\deactivation');

add_action('plugins_loaded', __NAMESPACE__ . '\loaded');


const EVEENO_PHP_VERSION = '8.0';
const EVEENO_WP_VERSION = '6.2';
const EVEENO_PLUGIN_VERSION = '2.0';

function systemRequirements(): string {
    global $wp_version;
    // Strip off any -alpha, -RC, -beta, -src suffixes.
    [$wpVersion] = explode('-', $wp_version);
    $phpVersion = phpversion();
    $error = '';
    if (!is_php_version_compatible(EVEENO_PHP_VERSION)) {
        $error = sprintf(
        /* translators: 1: Server PHP version number, 2: Required PHP version number. */
            __('The server is running PHP version %1$s. The Plugin requires at least PHP version %2$s.', 'eveeno'),
            $phpVersion,
            EVEENO_PHP_VERSION
        );
    } elseif (!is_wp_version_compatible(EVEENO_WP_VERSION)) {
        $error = sprintf(
        /* translators: 1: Server WordPress version number, 2: Required WordPress version number. */
            __('The server is running WordPress version %1$s. The Plugin requires at least WordPress version %2$s.', 'eveeno'),
            $wpVersion,
            EVEENO_PHP_VERSION
        );
    }
    return $error;
}
/*
 * Wird durchgeführt, wenn das Plugin aktiviert wird.
 * @return void
 */

function activation() {

    if ($error = systemRequirements()) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            sprintf(
            /* translators: 1: The plugin name, 2: The error string. */
                esc_html__('Plugins: %1$s: %2$s', 'eveeno'),
                esc_html(plugin_basename(__FILE__)),
                esc_html($error)
            )
        );
    }
}

/*
 * Wird durchgeführt, wenn das Plugin deaktiviert wird
 * @return void
 */

function deactivation() { }

function loaded() {

    if ($error = systemRequirements()) {
        add_action('admin_init', function () use ($error) {
            if (current_user_can('activate_plugins')) {
                $pluginData = get_plugin_data(__FILE__);
                $pluginName = $pluginData['Name'];
                $tag = is_plugin_active_for_network('eveeno') ? 'network_admin_notices' : 'admin_notices';
                add_action($tag, function () use ($pluginName, $error) {
                    printf(
                        '<div class="notice notice-error"><p>' .
                        /* translators: 1: The plugin name, 2: The error string. */
                        esc_html__('Plugins: %1$s: %2$s', 'eveeno') .
                        '</p></div>',
                        esc_html($pluginName),
                        esc_html($error)
                    );
                });
            }
        });
        return;
    }

    new Shortcode();
}

