<?php
function random($name_laenge) {
$zeichen = "abcedfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRTSUVW XYZ0123456789";
$name_neu = "";
mt_srand ((double) microtime() * 1000000);
for ($i = 0; $i < $name_laenge; $i++ ) {
$name_neu .= $zeichen{mt_rand (0,strlen($zeichen))};
}
return $dirname;
}
$dirname = random("20");

echo $dirname;
?>