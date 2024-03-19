<?php
echo 'dies ist ein einfacher String' . PHP_EOL;

echo 'Sie können auch Zeilenumbrüche
in dieser Art angeben,
dies ist okay so' . PHP_EOL;

// Gibt aus: Arnold sagte einst: "I'll be back"
echo 'Arnold sagte einst: "I\'ll be back"' . PHP_EOL;

// Ausgabe: Sie löschten C:\*.*?
echo 'Sie löschten C:\\*.*?' . PHP_EOL;

// Ausgabe: Sie löschten C:\*.*?
echo 'Sie löschten C:\*.*?' . PHP_EOL;

// \n ist hier ein Steuerzeichen und steht für einen Zeilenumbruch
// Ausgabe: Dies erzeugt keinen: \n Zeilenumbruch
echo 'Dies erzeugt keinen: \n Zeilenumbruch' . PHP_EOL;

// Ausgabe: Variablen werden $ebenfalls $nicht ersetzt
echo 'Variablen werden $ebenfalls $nicht ersetzt' . PHP_EOL;

// Ausgabe: ich bin ein String, ich bin auch ein string
echo 'ich bin ein String, ' . 'ich bin auch ein string' . PHP_EOL;

// Ausgabe:
