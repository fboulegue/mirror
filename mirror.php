<?php

$dir  = '/usr/www/users/aerosh/mirror/';

//random	  
function tep_random_name()
{
  $letters = 'abcdefghijklmnopqrstuvwxyz';
  srand((double) microtime() * 1000000);
  $string = '';
  for ($i = 1; $i <= rand(4,20); $i++) {
   $q = rand(1,24);
   $string = $string . $letters[$q];
  }
  return $string;
   
}

// Unlinks all subdirectories and files in $dir
// Works only on one subdir level, will not recurse
function tep_unlink_temp_dir($dir)
{
  $h1 = opendir($dir);
  while ($subdir = readdir($h1)) {
// Ignore non directories
    if (!is_dir($dir . $subdir)) continue;
// Ignore . and .. and CVS
    if ($subdir == '.' || $subdir == '..' || $subdir == 'CVS') continue;
// Loop and unlink files in subdirectory
    $h2 = opendir($dir . $subdir);
    while ($file = readdir($h2)) {
      if ($file == '.' || $file == '..') continue;
      @unlink($dir . $subdir . '/' . $file);
    }
    closedir($h2); 
    @rmdir($dir . $subdir);
  }
  closedir($h1);
}


// Now send the file with header() magic
  header("Expires: Mon, 26 Nov 1962 00:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-Type: Application/octet-stream");
  header("Content-disposition: attachment; filename=EDLP-XPlane9.dmg");

 // This will work only on Unix/Linux hosts
    tep_unlink_temp_dir($dir.'pub');
    $tempdir = tep_random_name();
    umask(0000);
    mkdir($dir.'pub/'.$tempdir, 0777);  
    symlink($dir.'downloads/' . 'EDLP-XPlane9.dmg', $dir.'pub/'.$tempdir .'/'.'EDLP-XPlane9.dmg');
    
    header('Location: ' . 'pub/' . $tempdir . '/' .  'EDLP-XPlane9.dmg');  
    tep_redirect($dir + 'pub/' . $tempdir . '/' .  'EDLP-XPlane9.dmg');

    exit(); 
    
?>
