<?php
session_start();
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
    define('CONSUMER_SECRET', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
    define('OAUTH_CALLBACK', 'http://127.0.0.1/callback.php');
if(isset($_POST['status'])){
    $access_token = $_SESSION['access_token'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    $user = $connection->get("account/verify_credentials");
    $tweet_message = $_POST['status'];

    if(strlen($tweet_message) > 140) {
    $tweet_message = substr($tweet_message, 0, 140);
    }

    $post = $connection->post('statuses/update', array('status'=> $tweet_message));
    echo "Successfully Tweeted";
}
?>
