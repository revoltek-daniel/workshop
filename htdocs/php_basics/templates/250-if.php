<?php
$number1 = 123;
$number2 = 345;

if ($number1 > $number2) { // bedingung wird zu erst geprüft
    echo 'number1 is größer als number2';
} elseif ($number1 == $number2) { // erste bedingung unwahr dann wird diese bedingung geprüft
    echo 'number1 und number2 sind glech gross';
} else { // trifft keine bedingung zu wird der folgende Block ausgeführt
    echo 'number1 ist kleiner als number2';
}

//Aufgabe: Was bzw. muss etwas angepasst werden um "number1 und number2 sind gleich groß" auszugeben?
$number1 = 123;
$number2 = '123';

if ($number1 === $number2) {
    echo 'number1 und number2 sind gleich groß';
}

// Aufgabe: Passe die Bedingung an, sodass trotzdem eine Ausgabe erscheint auch wenn die Bedingung nicht wahr ist.
