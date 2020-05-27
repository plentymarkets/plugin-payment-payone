# Release Notes für PAYONE

## 1.0.13 (2020-27-05)

### Geändert
- Icon für das Backend hinzugefügt

## 1.1.12 (2020-03-09)

### Geändert
- Logging des Datenaustausches zur Payone Schnittstelle optimiert.

## 1.1.11 (2020-03-03)

### Geändert
- Logos und Bilder getauscht
- Funktionalitäten hinzugefügt für Backend-Sichtbarkeiten und Backend-Name

## 1.1.10 (2019-12-09)

### Behoben
- Auftragsnotizen bei Rückerstattungen werden nun wieder korrekt geschrieben.

## 1.1.9 (2019-11-07)

### Behoben
- Teilrückerstattungen können nun auch mehrfach ausgeführt werden, dies führte unter bestimmten Konstelationen zu einem Fehler.

## 1.1.8 (2019-10-25)

### Behoben
- Teilrückerstattungen werden nun über den korrekten Betrag ausgeführt.

### Geändert
- Rückerstattungen werden nun dem Auftrag zugeordnet von dem diese ausgeführt wurden.
- Ladezeiten des Plugins wurden verbessert.

## 1.1.7 (2019-09-26)

### Hinzugefügt
- Rückzahlungen werden nun per Notiz am Auftrag hinterlegt. Dazu muss in der Konfiguration eine UserID hinterlegt werden.

## 1.1.6 (2019-08-23)

### Behoben
- Fehlerhafte Auftragsanlage behoben

## 1.1.5 (2019-08-23)

### Behoben
- Aufträge die von externe Importiert werden und eine Zahlungsart von Payone nutzen werden nun korrekt angelegt und nicht durch das Plugin abgefangen.

## 1.1.4 (2019-08-15)

### Geändert
- Das Payone SDK wurde umgezogen.

### Hinzugefügt
- Die Zahlungsart Amazon Pay wurde für das Backend hinzugefügt.

### Behoben
- Einige Medlungen im Log

## 1.1.3 (2019-06-13)

### Geändert
- Optimierungen für die Eingabe des Geburtsdatums im Bestellprozess.
- User Guide aktualisiert.

## 1.1.2 (2019-05-10)

### Geändert
- Die Eingabe des Geburtsdatums ist nun im Bestellprozess ein Pflichtfeld. Dieses Feld muss in den Einstellungen von Ceres für den Bestellprozess aktiviert werden. 

### Hinzugefügt
- Netto Bestellungen können nun durchgeführt werden.

## 1.1.1 (2019-04-02)

### Behoben
- Ein Fehler, der während der Zahlungsabwicklung zur Anlage von Auftragsduplikaten geführt hatte, wurde behoben
- Ein Fehler bei der Kreditkartentypauswahl wurde behoben

## 1.1.0 (2019-03-27)

### Geändert
- Supportübernahme durch plentysystems
- Icons getauscht und Beschreibungen aktualisiert
- Updates an den User Guides in deutscher und englischer Sprache

## 1.0.9 (2018-04-10)

### Geändert
- Hinweistext im User Guide ergänzt

## 1.0.8 (2018-25-09)

### Geändert
- Informationen im Support-Tab aktualisiert
- Changelog aktualisiert

## 1.0.7 (2018-20-09)

### Geändert
- Aktualisierung der config.json Datei zur Bereitstellung des neuen Plugin-Formats

### Hinzugefügt
- Übersetzungen hinzugefügt

### Geändert
- User Guide aktualisiert
- guzzle/httpguzzle Version hinzugefügt, um Kompatibilität mit PayPal zu erreichen

## 1.0.6 (2018-05-15)

### Hinzugefügt
- Die Zahlungsart Sofort wird jetzt im Frontend angezeigt
- Die Zahlungsart Paydirekt wird jetzt im Frontend angezeigt
- Die Zahlungsart Gesicherte Rechnung wird jetzt im Frontend angezeigt
- Die Zahlungsart PayPal wird jetzt im Frontend angezeigt

### Geändert
- Verbesserte Darstellung der Popup-Meldung bei fehlerhaften Zahlungen

## 1.0.5 (2018-04-06)

### Geändert
- Logos und Name des Plugins aktualisiert

## 1.0.4 (2018-03-27)

### Geändert
- Dokumentation aktualisiert

## 1.0.3 (2018-03-26)

### Hinzugefügt
- Dokumentation in englischer Sprache hinzugefügt

### Geändert
- Die aktuelle Payone PHP API wird nun genutzt

## 1.0.2 (2018-03-21)

### Geändert
- Scriptloader wird nun genutzt, um Payone Skripte in Templates einzubinden

## 1.0.1 (2018-03-01)

### Geändert
- Plugin-Dokumentation aktualisiert

## 1.0.1 (2018-03-01)
Veröffentlichung des Plugins inklusive Unterstützung der folgenden Zahlungsarten:

- Rechnung
- Vorkasse
- Nachnahme
- Lastschrift
- Kreditkarte
- Kreditkarte 3DS
