<?php
/*Aufgabe: Definiere eine Funktion errorMessage die einen Parameter für die Meldung und einen optionalen Parameter für einen Error Code hat,
 * Standardmaessig soll der Parameter den Wert 404 enthalten.
 * Die Methode soll "ErrorCode - Message" zurückgeben.
 */


echo errorMessage('Fehler');
echo errorMessage('Schwerer Fehler', 500);
