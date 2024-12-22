# eveeno WordPress Plugin

[![Aktuelle Version](https://img.shields.io/badge/Version-2.0-brightgreen)](https://github.com/cassandre/eveeno-wp)
[![Release Version](https://img.shields.io/github/v/release/cassandre/eveeno-wp?label=Release+Version)](https://github.com/cassandre/eveeno-wp/releases/)
[![GitHub License](https://img.shields.io/github/license/cassandre/eveeno-wp)](https://github.com/cassandre/eveeno-wp)
[![GitHub issues](https://img.shields.io/github/issues/cassandre/eveeno-wp)](https://github.com/cassandre/eveeno-wp/issues)

WordPress plugin for embedding <a href="https://eveeno.com">eveeno.de</a> registration forms and upcoming events lists.

> [!TIP]
> You'll find the event and user numbers in your Eveeno backend: Event-Einstellungen > Widgets.    

## Shortcode Registration Form
```
[eveeno type="booking" event="123456789"]   
```
## Shortcodes Events List
### Table Style:
```
[eveeno type="calendar" style="table" user="1234"]
```
### Grid Style:
```
[eveeno type="calendar" style="grid" user="1234"]
```
### Short List (e.g. in Sidebar):
```
[eveeno type="calendar" style="list" user="1234"]
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