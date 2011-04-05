<?php

require("prepare.php");

date_default_timezone_set('Asia/Chongqing');
$h=date('H');
echo $h.' <br>';
if($h<7||$h>22)//gmt+8 23:~6:
{echo ' sleeping~';
}
else{
$us=file("udl.txt");
$u='Still remember?'.' [ '.implode($us).'] '.SWBHASHTAG;
echo $u;

fclose(fopen('udl.txt','w'));

$r=$w->update($u);
print_r($r);
}
?>