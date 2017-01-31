<h1>Users</h1>
<?php
	foreach (getUsers() as $user) {
		listUser($user);
	}
?>