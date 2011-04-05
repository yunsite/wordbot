<?
require("config.php");
require("weibooauth.php");
require("token.php");

$w = new WeiboClient( SWBAPPKEY, SWBAPPSECRET, $lkot,$lkots );
?>