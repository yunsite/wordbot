<?
require("prepare.php");

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

$r=$w->update($t);

print_r($r);
}
}
else
{
echo "KEY INCORRECT";
}
?>