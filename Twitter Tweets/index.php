<?php
if(isset($_POST['SubmitButton'])) {
	//require_once(Yii::getPathOfAlias('webroot.protected.views.layouts')."/twitter_lib/twitteroauth.php"); 
	 require_once('twitteroauth.php');
	 
	$twitteruser = "rashminpatel89";
	$notweets = 10000;
	$consumerkey = "nhm2xR6fAjT5UhfMmOzOA";
	$consumersecret = "bkk1EK56IoJ1uDfsQtnKpAGOi3V5uHXVuSFVGu5BWE";
	$accesstoken = "1508878746-DXdErx2RPGilYeKzrTxvTEJgIqhGuXlZ78UuhD0"; 
	$accesstokensecret = "H4ffmEOJyZM7ZbOIFr5yhVP94CWtJyOmreczTDNCD4Y";



	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	  
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	$i = 1;
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$_POST['username']."&count=".$notweets);

	if(empty($tweets->errors)) {
	  $header = $contents = '';
	for($j = 1; $j <=50; $j++) {
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$_POST['username']."&count=".$notweets."&page=".$j);

	    if(!empty($tweets)) {

	     $header .="Id\t";
	     $header .="Tweets\t";
	     $header .="Date\t";

	     foreach($tweets as $t) {
	       $contents .= $i."\t"; 
	       $contents .= $t->text."\t"; 
	       $contents .= $t->created_at."\n"; 
	       $i++;
	    } 
	  }
	  $j++;
        }
	  header("Content-type: application/octet-stream");
	  header("Content-Disposition: attachment; filename=Tweets_".date('c').".xls");
	  header("Pragma: no-cache");
	  header("Expires: 0");
	  print "$header\n\n$contents"; exit;
	}
	else {
	  print 'User name doest not found'; exit;	
	}
}
?>

<html>
<body>    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="text" name="username"/>
  <input type="submit" name="SubmitButton" value="Get Tweets" />
</form>    
</body>
</html>
