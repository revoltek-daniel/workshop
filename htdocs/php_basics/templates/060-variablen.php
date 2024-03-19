<?php
$var = 'du';
$Var = 'ich';
echo "$var, $Var"; // gibt "du, ich" aus

// $4site  = 'nicht jetzt';     // ungültig, da Anfang eine Zahl
$_4site = 'nicht jetzt';     // gültig, da Unterstrich am Anfang
$täbyte = 'irgendwas';       // gültig, da 'ä' dem (Erweiterten) ASCII-Wert 228 entspricht sollte man aber am besten nicht benutzen

$a = '20:15 Uhr'; // nicht sprechend
$primeTime = '20:15 Uhr'; // sprechend

$first_name = 'Daniel'; // kein camelCase
$firstName = 'Daniel'; // camelCase

// Aufgabe: Deinen Namen einer Variablen zuweisen und diesen ausgeben.
// Beispiel ausgabe: Mein Name ist Daniel
