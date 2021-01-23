<?php
/*
  Plugin Name: Eveeno
  Plugin URI: https://github.com/cassandre/eveeno-wp
  Version: 1.4
  Description: Erstellt Shortcode, der Anmeldeformulare und Veranstaltungslisten von Eveeno in die eigene Seite integriert
  Author: Barbara Bothe
  Author URI: https://barbara-bothe.de
  Network:
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

add_action('plugins_loaded', array('Eveeno', 'instance'));

register_activation_hook(__FILE__, array('Eveeno', 'activation'));
register_deactivation_hook(__FILE__, array('Eveeno', 'deactivation'));

/*
 * Eveeno-Klasse
 */

class Eveeno {
    /*
     * Name der Variable unter der die Einstellungen des Plugins gespeichert werden.
     * string
     */

    const option_name = 'eveeno';

    /*
     * Minimal erforderliche PHP-Version.
     * string
     */
    const php_version = '5.3';

    /*
     * Minimal erforderliche WordPress-Version.
     * string
     */
    const wp_version = '4.1';

    /*
     * Optionen des Pluginis
     * object
     */

    static $options;

    /*
     * "Screen ID" der Einstellungsseite
     * string
     */
    protected $admin_settings_page;

    /*
     * Bezieht sich auf eine einzige Instanz dieser Klasse.
     * mixed
     */
    protected static $instance = null;

    /*
     * Erstellt und gibt eine Instanz der Klasse zurück.
     * Es stellt sicher, dass von der Klasse genau ein Objekt existiert (Singleton Pattern).
     * @return object
     */

    public static function instance() {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private $xml_keys;

    /*
     * Initialisiert das Plugin, indem die Lokalisierung, Hooks und Verwaltungsfunktionen festgesetzt werden.
     * @return void
     */

    private function __construct() {
       
        load_plugin_textdomain('eveeno', false, sprintf('%s/languages/', dirname(plugin_basename(__FILE__))));

        self::add_shortcode();
    }

    /*
     * Wird durchgeführt wenn das Plugin aktiviert wird.
     * @return void
     */

    public static function activation() {
        // Überprüft die minimal erforderliche PHP- u. WP-Version.
        self::version_compare();
    }

    /*
     * Wird durchgeführt wenn das Plugin deaktiviert wird
     * @return void
     */

    public static function deactivation() { }

    /*
     * Überprüft die minimal erforderliche PHP- u. WP-Version.
     * @return void
     */

    public static function version_compare() {
        $error = '';

        if (version_compare(PHP_VERSION, self::php_version, '<')) {
            $error = sprintf(__('Ihre PHP-Version %s ist veraltet. Bitte aktualisieren Sie mindestens auf die PHP-Version %s.', 'eveeno'), PHP_VERSION, self::php_version);
        }

        if (version_compare($GLOBALS['wp_version'], self::wp_version, '<')) {
            $error = sprintf(__('Ihre Wordpress-Version %s ist veraltet. Bitte aktualisieren Sie mindestens auf die Wordpress-Version %s.', 'eveeno'), $GLOBALS['wp_version'], self::wp_version);
        }

        // Wenn die Überprüfung fehlschlägt, dann wird das Plugin automatisch deaktiviert.
        if (!empty($error)) {
            deactivate_plugins(plugin_basename(__FILE__), false, true);
            wp_die($error);
        }
    }

   
    /*
     *  Shortcode
     */

    private static function add_shortcode() {

        function eveeno_shortcode($atts) {
            $defaults = [
                'show' => '',
                'eventid' => '',
                'permalink' => '',
                'userid' => '',
                'width' => '98%',
                'height' => '800px',
                'period' => 'all', // all (default) | past | future
                'term' => '',
                'notterm' => '',
                'lang' => '', // de | en | fr
                'sort' => '', // date (default) | name
                'scope' => 'all', // all (default) | private | public
                'apikey' => ''
                ];
            $args = shortcode_atts($defaults, $atts);
            $show = sanitize_text_field($args['show']);
            $eventid = sanitize_text_field($args['eventid']);
            $permalink = sanitize_text_field($args['permalink']);
            $eventid = $permalink != '' ? $permalink : $eventid;
            $userid = sanitize_text_field($args['userid']);
            $width = sanitize_text_field($args['width']);
            $height = sanitize_text_field($args['height']);
            $param = '';
            if ($args['term'] != '') {
                $param .= '&term='.sanitize_text_field($args['term']);
            }
            if ($args['notterm'] != '') {
                $param .= '&notterm='.sanitize_text_field($args['notterm']);
            }
            if (in_array($args['period'], ['all', 'past', 'future'])) {
                $param .= '&period='.sanitize_text_field($args['period']);
            }
            if (in_array($args['lang'], ['de', 'en', 'fr'])) {
                $param .= '&lang='.sanitize_text_field($args['lang']);
            }
            if ($args['sort'] == 'name') {
                $param .= '&sort=name';
            }
            if ($args['apikey'] != '') {
                $param .= '&apikey='.sanitize_text_field($args['apikey']);
            }
            if (in_array($args['scope'], ['all', 'public', 'private'])) {
                $param .= '&scope='.sanitize_text_field($args['scope']);
            }
            $output = '';

            if ($show == 'form' && $eventid !='') {
                $output .=  "<iframe src=\"https://eveeno.com/$eventid?format=embedded$param\""
                            . " width=\"$width\"" 
                            . " height=\"$height\"" 
                            . " name=\"" . __('eveeno Anmeldung', 'eveeno') . "\""
                            . " style=\"border:none;\""
                        . ">"; 
                $output .= "<p>" . __('Ihr Browser kann leider keine eingebetteten Frames anzeigen. Sie können die eingebettete Seite über den folgenden Link aufrufen: ', 'eveeno')
                            . "<a href=\"https://eveeno.com/$eventid\">" . __('Anmeldung', 'eveeno') . "</a>" . "</p>";
                $output .= "</iframe>";
            } elseif ($show == 'table' && $userid !='') {
                $output .=  "<iframe src=\"https://eveeno.com/de/event-cal/$userid?style=table&format=embedded$param\""
                            . "width=\"$width\"" 
                            . "height=\"$height\"" 
                            . "name=\"" . __('Veranstaltungen', 'eveeno') . "\""
                            . " style=\"border:none;\""
                            . "\">"; 
                $output .= "<p>" . __('Ihr Browser kann leider keine eingebetteten Frames anzeigen. Sie können die eingebettete Seite über den folgenden Link aufrufen: ', 'eveeno')
                            . "<a href=\"https://eveeno.com/$userid\">" . __('Anmeldung', 'eveeno') . "</a>" . "</p>";
                $output .= "</iframe>";
            } elseif ($show == 'grid' && $userid !='') {
                $output .=  "<iframe src=\"https://eveeno.com/de/event-cal/$userid?style=grid&format=embedded$param\""
                            . "width=\"$width\"" 
                            . "height=\"$height\"" 
                            . "name=\"" . __('Veranstaltungen', 'eveeno') . "\""
                            . " style=\"border:none;\""
                            . "\">"; 
                $output .= "<p>" . __('Ihr Browser kann leider keine eingebetteten Frames anzeigen. Sie können die eingebettete Seite über den folgenden Link aufrufen: ', 'eveeno')
                            . "<a href=\"https://eveeno.com/$userid\">" . __('Anmeldung', 'eveeno') . "</a>" . "</p>";
                $output .= "</iframe>";
            } elseif ($show == 'list' && $userid !='') {
                $output .=  "<iframe src=\"https://eveeno.com/de/event-cal/$userid?style=list&format=embedded$param\""
                            . "width=\"$width\"" 
                            . "height=\"$height\"" 
                            . "name=\"" . __('Veranstaltungen', 'eveeno') . "\""
                            . " style=\"border:none;\""
                            . "\">"; 
                $output .= "<p>" . __('Ihr Browser kann leider keine eingebetteten Frames anzeigen. Sie können die eingebettete Seite über den folgenden Link aufrufen: ', 'eveeno')
                            . "<a href=\"https://eveeno.com/$userid\">" . __('Anmeldung', 'eveeno') . "</a>" . "</p>";
                $output .= "</iframe>";
            } else {
                return false;
            }
            $output .= "<p class=\"eveeno\" style=\"text-align: right; width: " . $width . "\"><small>".__('powered by', 'eveeno')." <a href=\"https://eveeno.com\" target=\"_blank\">eveeno.de</a></small></p>";
                        
            return $output;
        }

        add_shortcode('eveeno', 'eveeno_shortcode');
    }

}
