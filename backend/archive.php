<?php
	include "init.php";
	if (isset($_GET["type"])) {
		$type = $_GET["type"];	
	} else {
		$type = "all";
	}
	if (isset($_GET["offset"])) {
		$offset = $_GET["offset"];
	} else {
		$offset = 0;
	}
	if ($type == "author") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s LIMIT 3 OFFSET %d", $_GET["a"], $offset);
	} elseif ($type == "category") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE tags=%s LIMIT 3 OFFSET %d", $_GET["a"], $offset);
	} elseif ($type == "both") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s AND category=%s LIMIT 3 OFFSET %d", $_GET["a"], $_GET["b"], $offset);
	} else {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts LIMIT 3 OFFSET %d", $offset);
	}
	foreach ($posts as $post) {
		echo "<a href='" . $site -> url . "post/" . $post["slug"] . "' style='margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc;'><div><strong>" . $post["title"] . "</strong></div><div>" . getSummary($post["content"]) . "</div></a>";
	}
?>