<?php
// code made by Fayçal

/////////////////////////// CONFIGURATION /////////////////////////////

// add your Twitter Developer credits
$APIkey="KWYXJVyFFAu8qFI12xkZJrF13";
$APIsecretKey="nHXZ0o3S8rRVXNjF3TLUt0Cph5B6EN5ssDKMpxHmlZWy0kEyoh";
$AccesToken="1525924924812148736-72hHrtWFs8PiP58asZkpDcI6IN7J8W";
$AccesTokenSecret="6b2t1mcHYjktDPH8KxSwtV3YWAwsks9M5WawyIaTkoIPb";

// add Twitter name (@) of the account you want to copy tweets
$victim="@mGbaum1204";

// add your Twitter name (@)
$me="@burry_bot";

///////////////////////////////////////////////////////////////////


require "autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


function getVictimsLastTweet(){
  global $APIkey;
  global $APIsecretKey;
  global $AccesToken;
  global $AccesTokenSecret;
  global $victim;
  global $me;
  $twitter = new TwitterOAuth($APIkey, $APIsecretKey, $AccesToken, $AccesTokenSecret);
  $tweets = $twitter->get("search/tweets", ["count" => 1, "q" => "from:".$victim." -RT", "result_type" => "recent", "exclude_replies" => true]);
  foreach ($tweets as $tweet) {
    foreach ($tweet as $text) {
      return $text->text;
    }
  }
}


function main(){
  global $APIkey;
  global $APIsecretKey;
  global $AccesToken;
  global $AccesTokenSecret;
  $twitter = new TwitterOAuth($APIkey,$APIsecretKey,$AccesToken,$AccesTokenSecret);
  $victimsLastTweet=getVictimsLastTweet();
  $twitter->post("statuses/update", ["status" => $victimsLastTweet]);
}

main();
?>
