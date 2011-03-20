<?php
require("config.php");
require("weibo.class.php");
$w=new weibo(SWBAPPKEY);
$w->setUser(SWBUSERNAME,SWBPASSWORD);


date_default_timezone_set('Asia/Chongqing');
$h=date('H');
echo $h.' <br>';
if($h<7||$h>22)//gmt+8 23:~6:
{echo ' sleeping~';
$m=date('i');
if(($h=='23')&&($m=='00'))
{$w->update($fwstr);}//time to sleep
}
else 
{
$m=date('i');
if(($h=='07')&&($m=='00'))
{$w->update($gmstr);}//time to wakeup

$seedarray =microtime();
$seedstr =split(" ",$seedarray,5);
$seed =$seedstr[0]*10000; 
srand($seed); 

$a=file("wordlist.txt") ;
$wd= $a[rand(0, count($a)-1)];

//$wd='levy';

$xml=simplexml_load_file('http://dict.cn/ws.php?utf8=true&q='.$wd);
if (($xml->sent[0]->orig=='')&&($xml->sent[1]->orig=='')&&($xml->sent[1]->orig==''))
{
$sen=' ...';
}
else
{
$sen='';
while($sen=='')
{
$sen=$xml->sent[rand(0,2)]->orig;
}
$sen='  "'.$sen.'"';
}
if($xml->pron==''){$prn=' ';}
else{$prn=' ['.$xml->pron.'] ';}

$u=$xml->key.$prn.$xml->def.' '.$sen;
$u=strip_tags($u);
echo $wd.'  //updating: 
'.'<br>'.$u.'<br>';

$r=$w->update($u);
print('
');
echo $r;
print_r($r);

$fh=fopen("udl.txt","a");
$u=$xml->key." \n";
fwrite($fh,$u);
fclose($fh);

}
?>