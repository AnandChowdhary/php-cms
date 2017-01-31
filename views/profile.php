<?php
	if (isset($_GET["tab"])) {
		$tab = $_GET["tab"];
	} else {
		$tab = "posts";
	}
?>
<h1><a href="<?php echo getSiteUrl() . "profile/" . $profile["username"]; ?>">@<?php echo $profile["username"]; ?></a></h1>
<p><?php echo $profile["shortbio"]; ?></p>
<div style="margin-bottom: 30px">
	<?php if ($profile["username"] == $_SESSION["username"]) { ?>
	<a href="#" class="btn">Edit your profile</a>
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
<div><button class="btn btn-secondary load-more" style="display: none">Load more</button></div>
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