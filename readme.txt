=== Eveeno ===
Contributors:       babo2015
Tags:               event, registration, form, conference,
Requires at least:  4.1
Tested up to:       6.7
Stable tag:         1.7
License:            GPLv3 or later
License URI:        https://www.gnu.org/licenses/gpl-3.0.html

WordPress plugin for embedding eveeno registration forms and upcoming events lists.

== Description ==

Embed registration forms and event lists from [eveeno.de](https://eveeno.com) in your WordPress site simply by adding a shortcode.
All you need is your event id (for embedding a registration form), your user id (for embedding an event list) and eventually the width and height. 
You will find the event id and the user id in your eveeno backend in Event-Einstellungen > Widgets.

= Examples =
Embedding a registration form:
`
[eveeno show="form" eventid="123456789" width="95%" height="1000px"]
`
Embedding an event list as a table:
`
[eveeno show="table" userid="1234" width="95%" height="400px"]
`
Embedding an event list in grid view:
`
[eveeno show="grid" userid="1234" width="95%" height="400px"]
`
Embedding a short event list:
`
[eveeno show="list" userid="1234" width="95%" height="400px"]
`
= Additional Shortcode Parameters =
`
period="" [all | past | future (default)]
term=""
notterm=""
lang="" [de (default) | en | fr]
sort="" [date (default) | name]
scope="" [all | private | public (default)]
apikey=""
`

== Installation ==

1. Upload `eveeno.php` and eventually the `languages` folder to the `/wp-content/plugins/eveeno` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Place a shortcode in your page or post.

== Changelog ==

= 1.8 =
* Bugfixes

= 1.7 =
* Plugin Check
* tested with WordPress 6.7

= 1.6 =
* Minor layout update
* tested with WordPress 6.5

= 1.5 =
* Removed shortcode parameter defaults
* tested with WordPress 5.8.2

= 1.4 =
* New Shortcode parameters: period, term, notterm, lang, sort, scope, apikey
* tested with WordPress 5.6

= 1.3 =
* layout optimization
* tested with WordPress 4.9.7

= 1.2 =
* Added shortcodes for event shortlist (list)

= 1.1 =
* Added shortcodes for event lists (table and grid view)
* Changed name parameter to id as event names may change

= 1.0 =
* First release: shortcode for registration forms
