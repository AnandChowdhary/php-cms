<?php
	$profile = getProfile($_GET["username"]);
	if (isset($_GET["tab"])) {
		$tab = $_GET["tab"];
	} else {
		$tab = "posts";
	}
?>
<h1><a href="<?php echo $site -> url . "profile/" . $profile["username"]; ?>">@<?php echo $profile["username"]; ?></a></h1>
<p><?php echo $profile["shortbio"]; ?></p>
<nav style="margin-bottom: 30px">
	<a class="<?php if (currUrl($site -> url . "profile/" . $profile["username"] . "/posts")) { echo "active"; } ?><?php if (currUrl($site -> url . "profile/" . $profile["username"])) { echo "active"; } ?><?php if (currUrl($site -> url . "profile/" . $profile["username"] . "/")) { echo "active"; } ?>" href="<?php echo $site -> url . "profile/" . $profile["username"] . "/posts"; ?>">posts (<?php echo getNumPosts($profile["username"]); ?>)</a>
	<a class="<?php if (currUrl($site -> url . "profile/" . $profile["username"] . "/about")) { echo "active"; } ?>" href="<?php echo $site -> url . "profile/" . $profile["username"] . "/about"; ?>">about</a>
	<a class="<?php if (currUrl($site -> url . "profile/" . $profile["username"] . "/followers")) { echo "active"; } ?>" href="<?php echo $site -> url . "profile/" . $profile["username"] . "/followers"; ?>">followers (<?php echo $profile["followers"]; ?>)</a>
	<a class="<?php if (currUrl($site -> url . "profile/" . $profile["username"] . "/following")) { echo "active"; } ?>" href="<?php echo $site -> url . "profile/" . $profile["username"] . "/following"; ?>">following (<?php echo $profile["following"]; ?>)</a>
</nav>
<?php
	switch ($tab) {
		case "about":
			# code...
			break;
		
		default:
			listArchive(archive("author", $profile["username"]));
			break;
	}
?>