<?php

require("prepare.php");

date_default_timezone_set('Asia/Chongqing');
$h=date('H');
echo $h.' <br>';
if($h<7||$h>22)//gmt+8 23:~6:
{echo ' sleeping~';
}
else{

$u='Still remember?'.' [ '.file_get_contents("udl.txt").'] '.SWBHASHTAG;
echo $u;

fclose(fopen('udl.txt','w'));

$r=$w->update($u);
print_r($r);

$uid=$r['id'];

print_r($w->send_comment($uid,file_get_contents("udl_c.txt")));
fclose(fopen('udl_c.txt','w'));

}
?>