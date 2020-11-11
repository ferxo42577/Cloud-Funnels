<?php
	require_once("includes/ActiveCampaign.class.php");
	$ac = new ActiveCampaign("https://poojalimbhore3030.api-us1.com", "e39d7094da74489d07a00b2165d5a06ba85cdfc41bbcbfaa1a1935c9959311f95cd091cc");
	// TEST API CREDENTIALS.
	if (!(int)$ac->credentials_test()) {
		echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";
		exit();
	}
	
        echo "<p>Credentials valid! Proceeding...</p>";
	
	// VIEW ACCOUNT DETAILS.
	$account = $ac->api("account/view");
	echo "<pre>";
	print_r($account);
	echo "</pre>";

	/*
	 * ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	 */
	$contact = array(
		"email"              => "poojalimbhore1238@gmail.com",
		"first_name"         => "POOJA",
		"last_name"          => "LIMBHORE",
		"p[2]"      => 2,
		"status[2]" => 1, // "Active" status and 2 for "Unsubscribed" Status
		"phone" => "8177885566",
		"orgname" => "business",
		"tags" => "marketing,blog,finance",
	);
	$contact_sync = $ac->api("contact/sync", $contact);
	if (!(int)$contact_sync->success) {
		// request failed
		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
		exit();
	}
        
        // successful request
		echo "<pre>";
		print_r($contact_sync);
		echo "</pre>";
        $contact_id = (int)$contact_sync->subscriber_id;
        echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
	

?>

