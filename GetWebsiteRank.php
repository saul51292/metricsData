<?php
// Depending on how you installed SEOstats
#require_once __DIR__ . DIRECTORY_SEPARATOR . 'SEOstats' . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use \SEOstats\Services as SEOstats;

try {

	echo "\nPlease Enter the URL (example: google.com).\n\nEnter Q to Quit \n\nWebsite: ";

$stdin = fopen('php://stdin', 'r');
$response = fgets($stdin);
$message = preg_replace("/[^a-zA-Z0-9,.]+/", "", $response);
if ($message == 'Q') {

   echo "Aborted.\n";
   exit;
}

	define('testURL',"http://www.".$message);
  	$url = testURL;

  // Create a new SEOstats instance.
  $seostats = new \SEOstats\SEOstats;

  // Bind the URL to the current SEOstats instance.
  if ($seostats->setUrl($url)) {

	echo "\n\n\n";
  	include 'get-alexa-metrics.php';
  	echo "\n\n\n";
  	include 'get-google-pagerank.php';
  	echo "\n\n\n";
	include 'get-social-metrics.php';
	echo "\n\n\n";
	insta();
  }
}
catch (SEOstatsException $e) {
  die($e->getMessage());
}

function insta() {
	echo "\nEnter Instagram Username.\n\nEnter Q to Quit \nInsta Username: ";

		$stdin = fopen('php://stdin', 'r');
		$response = fgets($stdin);
		$message = preg_replace("/[^a-zA-Z0-9,.]+/", "", $response);
		if ($message == 'Q') {
		   echo "Aborted.\n";
		   exit;
		}
		define('instaUsername',$message);
		include 'getInstagramData.php';

}