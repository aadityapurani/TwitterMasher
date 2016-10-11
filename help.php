<?php
session_start();
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', '7fkXaxtOghgD03WXcUylEQeqn');
define('CONSUMER_SECRET', 'xP9LSmP2LUFIfd7VvXagVCJj9DYKBDHzW2qZ0uLdzeigreofXt');
define('OAUTH_CALLBACK', 'http://127.0.0.1/callback.php');
if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
    header("Location: $url");
}
?>
