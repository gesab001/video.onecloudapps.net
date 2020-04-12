<?php

$path    = '../videos';
$files = scandir($path);

foreach ($files as $name){
    $filetype = substr($name, -4);
    if ($filetype==".mp4"){
      echo "<a href='index.php?filename=" . $name  . "'>" . $name . "</a>";
      echo "<br>";
    }
  
}
