CONTENIDO CMS Modul mpTagCanvas zum Generieren einer Tag-Cloud

################################################################################
TOC (Table of contents)

- BESCHREIBUNG
- INSTALLATION/VERWENDUNG
- CHANGELOG
- MPTAGCANVAS MODUL LINKS
- SCHLUSSBEMERKUNG


################################################################################
BESCHREIBUNG

TagCanvas ist eine JavaScript-Klasse die eine animierte auf HTML5 canvas
basierende Tag-Cloud zeichnen kann.

Als CONTENIDO-Modul mpTagCanvas lassen sich die Inhalte der Tag-Cloud entweder
manuell angeben, oder über Auswahl von Kategorien und Artikeln.

Die im CONTENIDO-Modul verwendete Version des TagCanvas ist das jQuery-Plugin in
der Version 2.2, es benötigt also jQuery.

Mehr zu TagCanvas:
http://www.goat1000.com/tagcanvas.php

################################################################################
INSTALLATION/VERWENDUNG

Die im Modulpackage enthaltenen Dateien/Sourcen sind wie im Folgenden beschrieben 
zu installieren.
Die Pfade zu den Sourcen (CSS, JS und Templates) können von Projekt zu Projekt 
unterschiedlich sein und sind bei Bedarf anzupassen. 
Bei der Installationsbeschreibung wird davon ausgegangen, dass CONTENIDO in das 
DocumentRoot-Verzeichnis eines Webservers installiert wurde und das 
Mandantenverzeichnis "cms/" ist.

1.) Modulinstallation:
----------------------
Den Modulordner "mp_tag_canvas_input" samt aller Inhalte in das Modulverzeichnis
des Mandanten "cms/data/modules" kopieren.
Danach sollte man im Backend die Funktion "Module synchronisieren" unter
"Style -> Module" ausführen.


2.) Einbinden von jQuery im Layout:
-----------------------------------
jQuery ist im head-Bereich des Layouts einzubinden, sofern es nicht schon vorhanden ist.

Beispiel:
[code]
...
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>
</head>
...
[/code]

Hinweis:
Weitere mpTagCanvas JavaScript-Dateien sind schon im Modul-Template eingebunden,
nicht im head-Bereich. Da muss man nichts machen, aber bei Bedarf kann man das auch
in den head-Bereich auslagern.
[code]
...
<!--[if lt IE 9]><script type="text/javascript" src="data/modules/mp_tag_canvas/vendor/excanvas/excanvas.js"></script><![endif]-->
<script src="data/modules/mp_tag_canvas/vendor/tagcanvas/jquery.tagcanvas.min.js" type="text/javascript"></script>
...
[/code]


3.) Einrichten des Moduls:
--------------------------
Dieses Modul in einer Artikelvorlage einrichten.

Einen Artikel erstellen, welches auf die Vorlage basiert.

In der Artikelkonfiguration die gewünschten Optionen setzen.


################################################################################
CHANGELOG

2013-11-27 mpTagCanvas 0.1 (für CONTENIDO 4.9.x)
    * Erste Veröffentlichung des mpTagCanvas Moduls


################################################################################
MPTAGCANVAS MODUL LINKS

mpTagCanvas Modul für CONTENIDO CMS 4.9.x:
http://www.purc.de/playground-cms_contenido_4.9-modul_mptagcanvas_-_tagcanvas_html5_canvas_tag-cloud-a.132.html

mpTagCanvas im CONTENIDO Forum unter Module 4.9.x:
http://forum.contenido.org/viewtopic.php?t=34746


################################################################################
SCHLUSSBEMERKUNG

Benutzung des Moduls auf eigene Gefahr!

Murat Purc, murat@purc.de
