<?php
  header("Content-type: image/gif");
   include("diagram.php");



diagram(

  "bar", // Diagrammtyp (bar oder line)
  5, // Abstand zum Rand und Breite der Saeule
  array("Okt 2017","Nov 2017","Dez 2017","Jan 2018"), // Bezeichnungen
  array(7,8,5,$jan), // Werte
  array("red","green","yellow","violet"), // Farben (wenn der Typ "line" ist, wird nur die erste Farbe verwendet)
  "EUR", // Einheit
  800, // Breite
  200 // Hoehe
);
?>