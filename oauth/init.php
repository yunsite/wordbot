<?php

include_once( 'config.php' );
include_once( 'weibooauth.php' );


if($_GET['iscallback']==1)
{
$keys=unserialize(file_get_contents("token"));

$o = new WeiboOAuth( SWBAPPKEY, SWBAPPSECRET , $keys['oauth_token'],$keys['oauth_token_secret'] );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;

$fh=fopen('token.php','w+');
fwrite($fh,"<?\n");
fwrite($fh,'define("SWBTOKEN","'.$last_key['oauth_token'].'");'."\n");
fwrite($fh,'define("SWBTOKENSECRET","'.$last_key['oauth_token_secret'].'");'."\n");
fwrite($fh,"\n?>");
fclose($fh);


echo 'token.php generated.';
}
else
{
$o = new WeiboOAuth( SWBAPPKEY, SWBAPPSECRET );

$keys = $o->getRequestToken();

$callback = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?iscallback=1';
echo 'current callback url: '.$callback.' ; <br>';
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );

$fh=fopen('token','w+');
fwrite($fh,serialize($keys));
fclose($fh);

echo '<a href="'.$aurl.'">Use Oauth to login</a>';
}

?>