<?php 

// folgende Funktion erstellt ein Diagramm und gibt dieses als GIF-Bild aus
function diagram($type,$padding,$labels,$values,$colors,$unit,$width,$height) {
  header("Content-type: image/gif");
  $fontsize = 3;
  $legend_padding = 10;
  
  // ggf. Bezeichnungen nach Komma "exploden":
  if(is_string($labels)) {
    $labels = explode(";",$labels);
  }
  // ggf. Werte nach Komma "exploden":
  if(is_string($values)) {
    $values = explode(";",$values);
  }
  // ggf. Farben nach Komma "exploden":
  if(is_string($colors)) {
    $colors = explode(";",$colors);
  }
  
  // wenn falsche Daten gegeben wurde, rausschmeissen
  if(!is_array($labels) || !is_array($values) || !is_array($colors)) {
    return false;
  }
  
  // Beite der Legende anhand des laengsten Textes festlegen
  foreach($labels as $label) {
    if($text_padding < imagefontwidth($fontsize) * strlen($label)) {
      $text_padding = imagefontwidth($fontsize) * strlen($label);
    }
  }
  // Hoehe des Textes
  $text_height = imagefontheight($fontsize);
  
  // Leeres Bild erstellen
  $image = imagecreatetruecolor($width,$height);
  
  // Hintergrundfarbe (zartes grau, fuer weiss "255,255,255" angeben
  $background_color = imagecolorexact($image,255,255,255);
  
  // Schriftfarbe (schwarz)
  $text_color = imagecolorexact($image,0,0,0);
  
  // Hintergrundfarbe fuer Balken, "zwischen-Farbe"
  $between_color = imagecolorexact($image,220,220,220);
  
  // weitere Farben definieren
  $color_red = imagecolorexact($image, 255, 0, 0);
  $color_green = imagecolorexact($image, 0, 255, 0);
  $color_black = imagecolorexact($image, 0, 0, 0);
  $color_yellow = imagecolorexact($image, 255, 255, 0);
  $color_violet = imagecolorexact($image, 255, 0, 255);
  $color_white = imagecolorexact($image, 255, 255, 255);
  $color_lightgrey = imagecolorexact($image, 220, 220, 220);
  // verschiedene Blautoene
  $color_blue1 = imagecolorexact($image, 4, 10, 40);
  $color_blue2 = imagecolorexact($image, 4, 10, 60);
  $color_blue3 = imagecolorexact($image, 4, 10, 80);
  $color_blue4 = imagecolorexact($image, 4, 10, 100);
  $color_blue5 = imagecolorexact($image, 4, 10, 120);
  $color_blue6 = imagecolorexact($image, 4, 10, 140);
  $color_blue7 = imagecolorexact($image, 4, 10, 160);
  $color_blue8 = imagecolorexact($image, 4, 10, 180);
  $color_blue9 = imagecolorexact($image, 4, 10, 200);
  $color_blue10 = imagecolorexact($image, 4, 10, 220);
  $color_blue11 = imagecolorexact($image, 4, 10, 240);
  $color_blue12 = imagecolorexact($image, 4, 10, 255);
  
  // Bild fuellen
  imagefill($image,0,0,$background_color);
  
  // verschiedene Arten von Diagrammen
  switch($type) {
    default:
      return false;
    break;
    
    // Kurvendiagramm
    case "line":
      $line_x = $padding;
      $line_b = ($width - 2 * $padding) / (count($values) - 1);
      $line_h = $height - 2 * $padding;
      $line_remove = 0;
      
      $points = array();
      
      for($i=0; $i < count($values); $i++) {
        $maxvalue = $values;
        rsort($maxvalue, SORT_NUMERIC);
        $maxvalue = $maxvalue[0];
        
        $percent = 100 / $maxvalue * $values[$i];
        $line_y = $line_h / 100 * $percent;
        $color = "color_" . $colors[$i];
        
        $points[] = $line_x + $line_remove;
        $points[] = $line_h - $line_y + $padding;
        
        $line_remove = $line_remove + $line_b;
      }
      
      $points[] = $width - $padding;
      $points[] = $height - $padding;
      $points[] = $padding;
      $points[] = $height - $padding;
      
      $color = "color_" . $colors[0];
      
      imagefilledpolygon($image, $points, count($points) / 2, ${$color});
      
      imageline($image, $padding, $padding, $padding, $height - $padding, $text_color);
      imageline($image, $padding, $height-$padding, $width - $padding, $height - $padding, $text_color);
      imagestring($image, $fontsize, $padding + 4, $padding, $unit, $text_color);
      
      for($i = 100; $i >= 0; $i = $i - 10) {
        $percent = 100 / $maxvalue * $i;
        $y = $line_h - round($line_h / 100 * $percent);
        imageline($image, $padding, $padding + $y, $padding + 10, $padding + $y, $text_color);
      }
      
      $line_remove = 0;
      
      for($i = 0; $i < count($values); $i++) {
        imageline($image, $line_x + $line_remove, $height - $padding - 10, $line_x + $line_remove, $height - $padding, $text_color);
        if($i < count($values) - 1) {
          imagestring($image, $fontsize, $line_x + $line_remove + 2, $height - $padding - 10 - 2, $labels[$i], $text_color);
        }
        $line_remove = $line_remove + $line_b;
      }
    break;
   
    // Saeulendiagramm
    case "bar":
      $bar_x = $padding;
      $bar_y = $height - $padding;
      $bar_b = 2 * $padding;
      $diagram_h = $height - 2 * $padding;
      $bar_remove = 0;
      
      $legend_x = $bar_x + count($values) * $bar_b + (count($values) - 1) * $padding + 2 * $padding;
      $legend_y = $height - $padding - $legend_padding;
      $legend_b = $legend_x + $legend_padding;
      $legend_h = $legend_y + $legend_padding;
      $legend_remove = 0;
      
      for($i = 0; $i < count($values); $i++) {
        $percent = 100 / array_sum($values) * $values[$i];
        $bar_h = $diagram_h / 100 * $percent;
        
        $value = $values[$i] . " " . $unit;
        
        $color = "color_" . $colors[$i];
        
        // SAEULE ZEICHNEN
        // leeren Teil der Saeule zeichnen
        imagefilledrectangle($image, $bar_x + $bar_remove, $padding, $bar_x + $bar_remove + $bar_b, $height - $padding, $between_color);
        // gefuellten Teil der Saeule zeichnen
        imagefilledrectangle($image, $bar_x + $bar_remove, $bar_y - $bar_h, $bar_x + $bar_remove + $bar_b, $bar_y, ${$color});
        // Wert ueber jeder Saeule anzeigen (optional):
        // imagestring($image, $fontsize, $bar_x + $bar_remove + 2, $bar_y - $bar_h - $text_height, $values[$i], $text_color);
        
        // LEGENDE ZEICHNEN
        // kleines Viereck mit er Farbe der zugehoerigen Saeule zeichnen
        imagefilledrectangle($image, $legend_x, $legend_y - $legend_remove, $legend_b, $legend_h - $legend_remove, ${$color});
        // Bezeichnung schreiben
        imagestring($image, $fontsize, $legend_x + 2 * $legend_padding, $legend_y - $legend_remove, $labels[$i] . ":", $text_color);
        // Wert schreiben
        imagestring($image, $fontsize, $legend_x + 3 * $legend_padding + $text_padding, $legend_y - $legend_remove, $value, $text_color);
        
        $bar_remove = $bar_remove + 3 * $padding;
        $legend_remove = $legend_remove + 2 * $legend_padding;

      }
    break;
  }
  
  // BILD AUSGEBEN
 // imagegif($image);
return ($image);
} 