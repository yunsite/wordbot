<?
require("prepare.php");

$tmf=file('rept.txt');
$tm=$tmf[0];
$tm+=RINTERVAL;
$tn=time();
if($tn<$tm)
{
echo 'time not enough '."\n";
print($tn.'<'.$tm);
}
else
{
$ft=fopen('rept.txt','w');
fwrite($ft,$tn);
fclose($ft);

$a=$w->mentions();

//$f=fopen('repl.txt','w');
//fwrite($f,'7286693847');
//fclose($f);

//print_r($a);

$f=fopen('repl.txt','r');
$mi=fgets($f);
fclose($f);
print("mi: $mi");
$mmi='0';

foreach ($a as $data)
{ 
$id = $data['id'];
if($id>$mi){
$text =strtolower($data['text']);
if($id>$mmi){$mmi=$id;}

$b= "lookup";
$c=explode($b,$text); 
if(count($c)> 1){
//print('@'.$name." :".$text."&   ");
print($id);
//echo  $c[1];

$xml=simplexml_load_file('http://dict.cn/ws.php?utf8=true&q='.$c[1]);
if($xml->key=='')
{
$u='Sorry, not recognized. ';

$sg=$xml->sugg;
$ct=count($sg);
if($ct>0){
//echo print_r($sg);
$sgt='Spelling suggestion:';
for($i=0;$i<$ct;$i+=1)
$sgt=$sgt.' '.$sg[$i];
print $sgt;}
else{$sgt='No spelling suggestionavailable.';}
$u=$u.$sgt;
}
else
{
$u=$xml->key.' ['.$xml->pron.'] '.$xml->def;
}
/*$un=$data['user'];
$na=$un['name'];
$u='@'.$na.' '.$u;*/
echo 'ud:'.$u;
print_r($w->send_comment($id,$u,0));
}

}
}

print(' mmi:'.$mmi);
print(' time:'.time());
if($mmi>$mi)
{
$f=fopen('repl.txt','w');
fwrite($f,$mmi);
fclose($f);
}
}
?>