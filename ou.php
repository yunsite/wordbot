<?
require("config.php");
$t=$_GET["text"];
echo "updating: {$t}\n";
if($_GET["key"]==OWNERKEY)
{
if($t=='')
{
echo "Text Empty.";
}
else
{

require("weibo.class.php");
$w=new weibo(SWBAPPKEY);
$w->setUser(SWBUSERNAME,SWBPASSWORD);
$r=$w->update($t);

print_r($r);
}
}
else
{
echo "KEY INCORRECT";
}
?>		