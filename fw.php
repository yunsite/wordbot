<html>
<head><title>My followers</title></head>
<body>
<?
require("config.php");

$curl = curl_init(); 
//221.179.190.48 api.t.sina.com.cn
curl_setopt($curl, CURLOPT_URL,"http://221.179.190.48/account/verify_credentials.xml?source=".SWBAPPKEY);        
 curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);     
curl_setopt($curl,CURLOPT_USERPWD, SWBUSERNAME.":".SWBPASSWORD); 
$data = curl_exec($curl);        
echo curl_error($curl);
curl_close($curl); 
//echo $data;
$d=simplexml_load_string($data);
//print_r($d);
$n=$d->followers_count;
echo 'Currently I got  '.$n.' followers:
';
//if ($n==''){echo 'err';}

$u_id = $d["id"];

$curl = curl_init(); 
//221.179.190.48 api.t.sina.com.cn
curl_setopt($curl, CURLOPT_URL,"api.t.sina.com.cn/statuses/followers.xml?source=".SWBAPPKEY."&user_id=".$u_id."&count=205");  
 curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);     
curl_setopt($curl,CURLOPT_USERPWD, SWBUSERNAME.":".SWBPASSWORD); 
$data2 = curl_exec($curl);        
echo curl_error($curl);
curl_close($curl); 
//print($data);
$d2=simplexml_load_string($data2);
//print_r($d2);
foreach($d2 as $follower){ 

echo ' <br> <br>';
print "<a href=\"http://t.sina.cn/{$follower->id}\">".$follower->name;

if($follower->domain!='') print " / ".$follower->domain;
print "</a>";

echo "<br>";

if($follower->description!='') print '( '.$follower->description.' )';
else print "--";
echo '<br>'.$follower->status->text.' <br>'; 

if($follower->followed==false){
//echo 'not following';
/*
$curl3 = curl_init(); 
curl_setopt($curl3, CURLOPT_URL,"http:// api.t.sina.com.cn/friendships/create/".$follower->name.".xml?source=".SWBAPPKEY);     
//curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);     
//curl_setopt($curl,CURLOPT_POST, true);  
//curl_setopt($curl,CURLOPT_POSTFIELDS, 'user_id='.);  
curl_setopt($curl3,CURLOPT_USERPWD,SWBUSERNAME.":".SWBPASSWORD); 
$data3 = curl_exec($curl3);     
curl_error($curl3); 
curl_close($curl3); 
echo $data3;
print_r(simplexml_load_string($data3));*/
}
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