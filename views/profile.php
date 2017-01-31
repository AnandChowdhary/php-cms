<?php
	if (isset($_GET["tab"])) {
		$tab = $_GET["tab"];
	} else {
		$tab = "posts";
	}
?>
<?php if ($editProfile == 1) { $profile = getProfile($_SESSION["username"]); ?>
<h1>Edit Profile</h1>
<form method="post" action="<?php echo getSiteUrl(); ?>backend/edit.php">
	<h2>Your Information</h2>
	<p>
		<label>
			Username: 
			<input type="text" value="<?php echo $profile["username"] ?>" disabled>
		</label>
	</p>
	<p>
		<label>
			Name: 
			<input type="text" name="name" value="<?php echo $profile["name"] ?>">
		</label>
	</p>
	<p>
		<label>
			About: 
			<textarea name="hobbies"><?php echo $profile["listhobbies"] ?></textarea>
		</label>
	</p>
	<p>
		<label>
			Email: 
			<input type="email" name="email" value="<?php echo $profile["email"] ?>">
		</label>
	</p>
	<p>
		<label>
			Bio: 
			<input type="text" name="shortbio" value="<?php echo $profile["shortbio"] ?>">
		</label>
	</p>
	<p>
		<label>
			Website: 
			<input type="text" name="website" value="<?php echo $profile["website"] ?>">
		</label>
	</p>
	<p>
		<label>
			Facebook username: 
			<input type="text" name="facebook" value="<?php echo $profile["facebook"] ?>">
		</label>
	</p>
	<p>
		<label>
			Twitter username: @ 
			<input type="text" name="twitter" value="<?php echo $profile["twitter"] ?>">
		</label>
	</p>
	<p>
		<label>
			Phone: 
			<input type="tel" name="phone" value="<?php echo $profile["website"] ?>">
		</label>
	</p>
	<h2>Change Password</h2>
	<p>
		<label>
			Current Password: 
			<input type="password" name="password_current">
		</label>
	</p>
	<p>
		<label>
			New Password: 
			<input type="password" name="password_new">
		</label>
	</p>
	<p>
		<button name="edit" type="submit" class="btn primary">Save Changes</button>
	</p>
</form>
<?php } else { ?> 
<h1><a href="<?php echo getSiteUrl() . "profile/" . $profile["username"]; ?>">@<?php echo $profile["username"]; ?></a></h1>
<p><?php echo $profile["shortbio"]; ?></p>
<div style="margin-bottom: 30px">
	<?php if ($profile["username"] == $_SESSION["username"]) { ?>
	<a href="<?php echo getSiteUrl() . "profile/edit"; ?>" class="btn">Edit your profile</a>
	<?php } else if (in_array($_SESSION["username"], unserialize($profile["listfollowers"]))) { ?>
	<button class="btn unfollow-btn" data-user="<?php echo getSiteUrl() . "backend/unfollow.php?user=" . $profile["username"]; ?>">Unfollow</button>
	<?php } else { ?>
	<button class="btn primary follow-btn" data-user="<?php echo getSiteUrl() . "backend/follow.php?user=" . $profile["username"]; ?>">Follow</button>
	<?php } ?>
</div>
<nav style="margin-bottom: 30px">
	<a class="<?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"] . "/posts")) { echo "active"; } ?><?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"])) { echo "active"; } ?><?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"] . "/")) { echo "active"; } ?>" href="<?php echo getSiteUrl() . "profile/" . $profile["username"] . "/posts"; ?>">posts (<?php echo getNumPosts($profile["username"]); ?>)</a>
	<a class="<?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"] . "/about")) { echo "active"; } ?>" href="<?php echo getSiteUrl() . "profile/" . $profile["username"] . "/about"; ?>">about</a>
	<a class="<?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"] . "/followers")) { echo "active"; } ?>" href="<?php echo getSiteUrl() . "profile/" . $profile["username"] . "/followers"; ?>">followers (<?php echo $profile["followers"]; ?>)</a>
	<a class="<?php if (currUrl(getSiteUrl() . "profile/" . $profile["username"] . "/following")) { echo "active"; } ?>" href="<?php echo getSiteUrl() . "profile/" . $profile["username"] . "/following"; ?>">following (<?php echo $profile["following"]; ?>)</a>
</nav>
<?php
	switch ($tab) {
		case "about": ?>
<table style="width: 100%; line-height: 2">
	<tr>
		<td><strong>City</strong></td>
		<td><?php echo $profile["city"]; ?></td>
	</tr>
	<tr>
		<td><strong>Facebook</strong></td>
		<td><?php echo $profile["facebook"]; ?></td>
	</tr>
	<tr>
		<td><strong>Twitter</strong></td>
		<td><?php echo $profile["twitter"]; ?></td>
	</tr>
	<tr>
		<td><strong>Phone</strong></td>
		<td><?php echo $profile["phone"]; ?></td>
	</tr>
</table>
		<?php break;
		case "followers": ?>
<?php
	foreach (getFollowers($profile["username"]) as $username) {
		listUser(getProfile($username));
	}
?>
		<?php break;
		case "following": ?>
<?php
	foreach (getFollowing($profile["username"]) as $username) {
		listUser(getProfile($username));
	}
?>
		<?php break;
		default: ?>
<div id="postscontent">Loading...</div>
<div style="text-align: center; margin-top: 20px"><span class="load-more" style="display: none"><img alt="Loading" src="<?php echo getSiteUrl(); ?>assets/load.gif"></span></div>
<script>
	window.onload = function() {
		offset = -<?php echo getMaxPosts(); ?>;
		$(".load-more").click(function() {
			offset += <?php echo getMaxPosts(); ?>;
			console.log(offset);
			loadPosts("<?php echo getSiteUrl(); ?>backend/archive.php?offset=" + offset + "&type=author&a=<?php echo $profile["username"]; ?>");
		});
		$(".load-more").click();
	}
</script>
		<?php break;
	}
?>
<?php } ?>