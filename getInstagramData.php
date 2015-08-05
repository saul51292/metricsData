<?php
//returns a big old hunk of JSON from a non-private IG account page.
function scrape_insta($username) {
	$insta_source = file_get_contents('http://instagram.com/'.$username);
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	$insta_array = json_decode($insta_json[0], TRUE);
	return $insta_array;
}
//Supply a username
$my_account = instaUsername; 
//Do the deed
$results_array = scrape_insta($my_account);


//An example of where to go from there
$latest_array = $results_array['entry_data']['ProfilePage'][0]['user'];
echo "\n";
echo $my_account."'s Instagram Post Count is: " .$latest_array['media']['count'];
echo "\n";
echo $my_account."'s Instagram Followed By Count: " .$latest_array['followed_by']['count'];
echo "\n";
echo $my_account."'s Instagram Following Count: " .$latest_array['follows']['count'];
echo "\n";
echo "\n";
/* BAH! An Instagram site redesign in June 2015 broke quick retrieval of captions, locations and some other stuff.
echo 'Taken at '.$latest_array['location']['name'].'<br/>';
//Heck, lets compare it to a useful API, just for kicks.
echo '<img src="http://maps.googleapis.com/maps/api/staticmap?markers=color:red%7Clabel:X%7C'.$latest_array['location']['latitude'].','.$latest_array['location']['longitude'].'&zoom=13&size=300x150&sensor=false">';
?>
*/