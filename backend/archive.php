<?php
	include "init.php";
	if (isset($_GET["type"])) {
		$type = $_GET["type"];	
	} else {
		$type = "all";
	}
	if (isset($_GET["status"])) {
		$status = $_GET["status"];	
	} else {
		$status = "published";
	}
	if (isset($_GET["offset"])) {
		$offset = $_GET["offset"];
	} else {
		$offset = 0;
	}
	if ($type == "author") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s AND status=%s ORDER BY id DESC LIMIT %d OFFSET %d", $_GET["a"], $status, getMaxPosts(), $offset);
	} elseif ($type == "category") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE tags=%s AND status=%s ORDER BY id DESC LIMIT %d OFFSET %d", $_GET["a"], $status, getMaxPosts(), $offset);
	} elseif ($type == "both") {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s AND category=%s AND status=%s ORDER BY id DESC LIMIT %d OFFSET %d", $_GET["a"], $_GET["b"], $status, getMaxPosts(), $offset);
	} else {
		$posts = DB::query("SELECT slug, postedon, content, title FROM posts WHERE status=%s ORDER BY id DESC LIMIT %d OFFSET %d", $status, getMaxPosts(), $offset);
	}
	foreach ($posts as $post) {
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post["content"], $image);
		if ($image["src"] != NULL) {
			$img = "<img style='margin-top: 10px; width: 100%' src='" . $image["src"] . "'>";
		} else {
			$img = "";
		}
		echo "<a href='" . getSiteUrl() . "post/" . $post["slug"] . "' style='margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc;'><div><strong>" . $post["title"] . "</strong></div>" . $img . "<div>" . getSummary($post["content"]) . "</div></a>";
	}
?>