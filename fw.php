<? header("Content- Type:text/html; charset=utf-8"); ?>
<meta content="text/html; charset=utf-8">
<html>
<head><title>My followers @ SinaWB</title></head>
<body>
<?
require("config.php");
echo 'My latest followers:

';

require("prepare.php");
$d=$w->followers();


foreach($d as $follower){ 
//print_r($follower);
echo ' <br> <br>';
print "<a href=\"http://t.sina.cn/{$follower['id']}\">".$follower['name'];

if($follower['domain']!='') print " / ".$follower['domain'];
print "</a>";

echo "<br>";

if($follower['description']!='') print '( '.$follower['description'].' )';
else print "--";

echo "<br>";

print '  fi '.$follower['friends_count'].' / fr '.$follower['followers_count'];

echo '<br>'.$follower['status']['text'].' <br>'; 

}



?>
<br>
<br><a href="http://t.sina.com.cn/wordbot">Go follow me.</a><br>
</body>

<script language="javascript"
type="text/javascript" src="http://
js.users.51.la/4517641.js"></script>
<noscript><img src="http://img.users.51.la/4517641.asp" width="0" height="0"></noscript>
</html>