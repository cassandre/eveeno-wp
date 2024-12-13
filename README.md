eveeno
=========

WordPress-Plugin
----------------

<b>Version 1.8</b>

Binden Sie Anmeldeformulare und Veranstaltungslisten von <a href="https://eveeno.com">eveeno.de</a> einfach per Shortcode in Ihre WordPress-Seite ein.

####Shortcode Anmeldeformular####
```
[eveeno show="form" eventid="123456789" width="95%" height="1000px"]
```
####Shortcodes Veranstaltungsliste####
In Tabellenform:
```
[eveeno show="table" userid="1234" width="95%" height="400px"]
```
Als Grid:
```
[eveeno show="grid" userid="1234" width="95%" height="400px"]
```
Als kurze Liste (z.B. in der Sidebar):
```
[eveeno show="list" userid="1234" width="95%" height="400px"]
```
Weitere Shortcode-Parameter:
```
period="" [all | past | future (default)]
term=""
notterm=""
lang="" [de (default) | en | fr]
sort="" [date (default) | name]
scope="" [all | private | public (default)]
apikey=""
```

Die benötigten IDs finden Sie im Eveeno-Backend unter Event-Einstellungen > Widgets.

### Changelog ###

#### 1.5 ####
* Kleineres Layout-Update
* bis WP 6.5 getestet

#### 1.5 ####
* Standardwerte für Shortcode-Parameter entfernt
* bis WP 5.8.2 getestet

#### 1.4 ####
* Neue Shortcode-Parameter: period, term, notter, lang, sort, scope, apikey 
* für WP 5.6 getestet

#### 1.3 ####
* kleinere Layoutverbesserung
* für WP 4.9.7 getestet

#### 1.2 ####
* Shortcode für kurze Veranstaltungslisten, z.B. in der Sidebar

#### 1.1 ####
* Shortcodes für Veranstaltungslisten (Tabelle und Grid)
* Parameter "name" ersetzt durch "id", da sich der Name ggf. ändern kann

#### 1.0 ####
* Erster Release: Shortcode für Anmeldeformulare

#### Weitere Informationen: ####
Autor: Barbara Bothe<br>
Website: <a href="https://barbara-bothe.de">https://barbara-bothe.de</a><br>
Lizenz: <a href="https://www.gnu.org/licenses/gpl">GNU General Public License, Version 2.0</a> (GNUGPLv2.0)<br>
Im WordPress Plugin Directory: <a href="https://wordpress.org/plugins/eveeno">https://wordpress.org/plugins/eveeno</a>