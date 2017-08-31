# addon_temp_gen
Der Addon-Template-Generator soll beim Erstellen eines neuen Addons für REDAXO 5 helfen.

Mit diesem Addon kann der Entwickler die Basisstruktur für ein geplantes Addon erzeigen und im Addon-Verzeichnis ablegen. Der Aufbau bzw. Umfang des geplanten Addons wird im Backend festgelegt.
Die Dateien wie package.yml, boot.php,… wie auch die benötigten Verzeichnisse werden bereitgestellt.
Die Dateien sind allerdings nicht alle mit Inhalt gefüllt – hier bleibt also dem Entwickler noch genügend Spielraum für die eigene Kreativität.

Multilanguage vorbereitet -> Dieses Addon unterstützt die Mehrsprachigkeit des Backends. Hier habe ich sowohl die Funktionalität von rex_i18n genutzt als auch ein eigenes Verfahren getestet.
Das eigene Verfahren kommt in pages/folder.php zum Einsatz. Dabei suche ich in den Verzeichnissen nach README.ME und lese die datei über simplexml_load_file($filename) ein. Die verwendete Funktion steht in functions/functions.php.
