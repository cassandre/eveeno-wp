=== Eveeno ===
Contributors:       babo2015
Tags:               event, registration, form, conference,
Requires at least:  6.2
Tested up to:       6.7
Stable tag:         2.0
License:            GPLv3 or later
License URI:        https://www.gnu.org/licenses/gpl-3.0.html

WordPress plugin for embedding eveeno registration forms and upcoming events lists.

== Description ==

Embed registration forms and event lists from [eveeno.de](https://eveeno.com) in your WordPress site simply by adding a shortcode.
All you need is your event id (for embedding a registration form), your user id (for embedding an event list) and eventually the width and height.

You'll find the event and user numbers in your Eveeno backend: Event-Einstellungen > Widgets.

= Examples =
Embedding a registration form:
`
[eveeno type="booking" event="123456789"]
`
Embedding an event list as a table:
`
[eveeno type="calendar" style="table" user="1234"]
`
Embedding an event list in grid view:
`
[eveeno type="calendar" style="grid" user="1234"]
`
Embedding a short event list:
`
[eveeno type="calendar" style="list" user="1234"]
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
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place a shortcode in your page or post.
