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
<div id="content">Loading...</div>
<div><button class="btn btn-secondary load-more" style="display: none">Load more</button></div>
<script>
	offset = 0;
	document.querySelector(".load-more").addEventListener("click", function() {
		offset+=3;
		sendRequest(offset);
	});
	document.addEventListener("DOMContentLoaded", function() {
		setTimeout(function() {
			sendRequest(offset);
		}, 1000);
	});
	function sendRequest(offset) {
		var request = new XMLHttpRequest();
		request.open("GET", "<?php echo $site -> url; ?>backend/archive.php?offset=" + offset + "&type=author&a=<?php echo $profile["username"]; ?>", true);
		request.onload = function() {
			if (request.status >= 200 && request.status < 400) {
				if (request.responseText == "") {
					document.querySelector(".load-more").parentNode.innerHTML = "That's all, folks!";
				} else {
					if (document.querySelector("#content").innerHTML == "Loading...") {
						document.querySelector("#content").innerHTML = "";
					}
					document.querySelector("#content").innerHTML += request.responseText;
					document.querySelector(".load-more").style.display = "block";
				}
			}
		};
		request.send();
	}
</script>
		<?php break;
	}
?>