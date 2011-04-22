<?php
require("prepare.php");


date_default_timezone_set('Asia/Chongqing');
$h=date('H');
if($h<7||$h>22)//gmt+8 23:~6:
{echo ' sleeping~';
$m=date('i');
if(($h=='23')&&($m=='00'))
{$w->update($fwstr);}//time to sleep
$wkd=date('N');
if(($m=='00')&&(($h=='5'&&$wkd<6)||($h=='6'&&$wkd>5)))
{$tmp=file_get_contents('timed.txt');
$w->update($tmp);}//huanghl

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

do{
$a=file("wordlist.txt") ;
$wd=$a[rand(0, count($a)-1)];

$xml=simplexml_load_file('http://dict.cn/ws.php?utf8=true&q='.$wd);
}while($xml->key=='');

$ct='';
if(($xml->sent[0]->orig=='')&&($xml->sent[1]->orig=='')&&($xml->sent[1]->orig==''))
{
}
else
{
do 
{
$i=rand(0,3);
$ct=$xml->sent[$i]->orig;
}
while($ct=='');
$ct=strip_tags($ct.' '.$xml->sent[$i]->trans);
}

if($xml->pron==''){$prn=' ';}
else{$prn=' ['.$xml->pron.'] ';}

$u=strip_tags($xml->key.$prn.$xml->def);
echo $wd.'  //updating: 
'.'<br>'.$u.'<br>';

$r=$w->update($u);
print('
');
$uid=$r['id'];
echo $uid;
print_r($r);
print_r($w->send_comment($uid,$ct));

$fh=fopen("udl.txt","a");
$u=$xml->key." \n";
fwrite($fh,$u);
fclose($fh);

$fh2=fopen("udl_c.txt","a");
$u='['.$xml->key.' '.$xml->def.']'." \n";
fwrite($fh2,$u);
fclose($fh2);

}
?>