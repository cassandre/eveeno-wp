# eveeno WordPress Plugin

[![Aktuelle Version](https://img.shields.io/github/package-json/v/cassandre/eveeno-wp/master?label=Version)](https://github.com/cassandre/eveeno-wp)
[![Release Version](https://img.shields.io/github/v/release/cassandre/eveeno-wp?label=Release+Version)](https://github.com/cassandre/eveeno-wp/releases/)
[![GitHub License](https://img.shields.io/github/license/cassandre/eveeno-wp)](https://github.com/cassandre/eveeno-wp)
[![GitHub issues](https://img.shields.io/github/issues/cassandre/eveeno-wp)](https://github.com/cassandre/eveeno-wp/issues)

WordPress plugin for embedding <a href="https://eveeno.com">eveeno.de</a> registration forms and upcoming events lists.

## Shortcode Registration Form
```
[eveeno style="form" event="123456789"]
```
## Shortcodes Events List
### Table Style:
```
[eveeno style="table" user="1234"]
```
### Grid Style:
```
[eveeno style="grid" user="1234"]
```
### Short List (e.g. in Sidebar):
```
[eveeno style="list" user="1234"]
```
## Other Shortcode Attributes:
```
period="" [all | past | future (default)]
term=""
notterm=""
lang="" [de (default) | en | fr]
sort="" [date (default) | name]
scope="" [all | private | public (default)]
apikey=""
```

You'll find the IDs in your Eveeno backend:  Event-Einstellungen > Widgets.

#### General Information: ####
Author: Barbara Bothe<br>
Website: <a href="https://barbara-bothe.de">https://barbara-bothe.de</a><br>
Licence: <a href="https://www.gnu.org/licenses/gpl">GNU General Public License, Version 3.0</a> (GNUGPLv3.0)<br>
WordPress Plugin Directory: <a href="https://wordpress.org/plugins/eveeno">https://wordpress.org/plugins/eveeno</a>