<?php

//session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );

include_once( 'token.php' );

$o = new WeiboOAuth( SWBAPPKEY, SWBAPPSECRET , $ot,$ots  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;

$lkot=$last_key['oauth_token'];
$lkots=$last_key['oauth_token_secret'];
$lkid=$last_key['user_id'];

$fh=fopen('token.php','a');
fwrite($fh,"<?\n");
fwrite($fh,'$lkot='."\"".$lkot."\"".';');
fwrite($fh,'$lkots='."\"".$lkots."\"".';');
fwrite($fh,'$lkid='."\"".$lkid."\"".';');
fwrite($fh,"\n?>");
fclose($fh);
?>
seems okay.
topen.php generated.