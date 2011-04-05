<?php

include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( SWBAPPKEY, SWBAPPSECRET );

$keys = $o->getRequestToken();

  $callback = 'http://yourdimain/oauth/cbk.php';// Please Modify this
echo 'current callback url: '.$callback.' ; <br>';
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );

//$_SESSION['keys'] = $keys;
//print_r($keys);
$ot=$keys['oauth_token'];
$ots=$keys['oauth_token_secret'];
//echo $ot.'-'.$ots;
$fh=fopen('token.php','w+');
fwrite($fh,"<?\n");
fwrite($fh,'$ot='."\"".$ot."\"".';');
fwrite($fh,'$ots='."\"".$ots."\"".';');
fwrite($fh,"\n?>\n");
fclose($fh);


?>
<a href="<?=$aurl?>">Use Oauth to login</a>