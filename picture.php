<?php
session_start();
require 'vendor/autoload.php';
require 'vendor/abraham/twitteroauth/src/TwitterOAuth.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
define('CONSUMER_SECRET', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
define('OAUTH_CALLBACK', 'http://127.0.0.1/callback.php');

if(isset($_POST['image']) && ($_POST['status1'])){
$access_token = $_SESSION['access_token'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$image = htmlspecialchars($_POST['image']);
$status1 = $_POST['status1'];
if(strlen($status1) > 140) {
    $status1 = substr($status1, 0, 140);
}


$media1 = $connection->upload('media/upload', ['media' => $image]);
$parameters = [
    'status' => $status1,
    'media_ids' => implode(',', [$media1->media_id_string]),
];
$result = $connection->post('statuses/update', $parameters);
}
?>
