<?php

$path    = '../videos';
$files = scandir($path);

foreach ($files as $name){
    $filetype = substr($name, -4);
    if ($filetype==".mp4"){
      echo "<a href='play.php?filename=" . $name  . "'>" . $name . "</a>";
      echo "<br>";
    }
  
}
