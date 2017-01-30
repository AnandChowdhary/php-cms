<h1>Users</h1>
<?php
	foreach (getUsers() as $user) {
		echo "<a href='" . $site -> url . "profile/" . $user["username"] . "' style='margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc;'>
			<img style='height: 3em; float: left; margin-right: 15px; border-radius: 100%' alt='" . $user["name"] . "' src='" . getProfilePicture($user["username"]) . "'>
			<strong>" . $user["name"] . "</strong><br>
			" . $user["shortbio"] . "
		</a>";
	}
?>