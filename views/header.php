<?php
	switch ($page) {
		case "home":
			$page_title = $site -> name;
			break;
		default:
			$page_title = ucfirst($page) . " | " . $site -> name;
			break;
	}
	if ($page == "post") {
		$post = getPost($_GET["slug"]);
		$user = getUserFromPost($_GET["slug"]);
		$page_title = $post["title"] . " by " . $user["name"] . " | " . $site -> name;
		$keywords = "";
		foreach (extract_common_words($post["content"], 10) as $key => $value) {
			$keywords .= $key . ", ";
		}
		$keywords = substr($keywords, 0, -2);
	} elseif ($page == "category") {
		$category = $_GET["slug"];
		$category_name = fCategory($category);
		$page_title = $category_name . " | " . $site -> name;
	} elseif ($page == "profile") {
		if ($_GET["username"] == "edit") {
			$page_title = "Edit Profile | " . $site -> name;
			$editProfile = 1;
		} else {
			$editProfile = 0;
			$profile = getProfile($_GET["username"]);
			$page_title = $profile["name"] . " (@" . $profile["username"] . ") | " . $site -> name;
		}
	}
?>
<!doctype html>
<html lang="en" prefix="op: http://media.facebook.com/op#">
	<head>
		<meta charset="utf-8">
		<title><?php echo $page_title; ?></title>
		<?php if ($page == "post") { ?><meta property="og:type" content="article">
		<meta property="og:url" content="<?php echo getSiteUrl() . "post/" . $_GET["slug"]; ?>">
		<meta property="og:title" content="<?php echo $post["title"]; ?>">
		<meta property="og:description" content="<?php echo getSummary($post["content"]); ?>">
		<meta property="og:updated_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:modified_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:published_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:section" content="<?php echo $post["tags"]; ?>">
		<meta property="article:tag" content="<?php echo $keywords; ?>">
		<meta property="article:author" content="<?php echo $user["name"]; ?>">
		<meta property="article:publisher" content="<?php echo $site -> facebookUsername; ?>">
		<meta name="twitter:title" content="<?php echo $post["title"]; ?>">
		<meta name="twitter:description" content="<?php echo getSummary($post["content"]); ?>">
		<meta name="title" content="<?php echo $page_title; ?>">
		<meta name="description" content="<?php echo getSummary($post["content"]); ?>">
		<meta name="keywords" content="<?php echo $keywords; ?>">
		<meta name="author" content="<?php echo $user["name"]; ?>">
		<link rel="canonical" href="<?php echo getSiteUrl() . "post/" . $_GET["slug"]; ?>">
		<meta property="op:markup_version" content="v1.0">
		<?php } elseif ($page == "profile") { ?><link rel="canonical" href="<?php echo getSiteUrl() . "profile/" . $_GET["slug"]; ?>">
		<meta property="og:url" content="<?php echo getSiteUrl() . "profile/" . $_GET["slug"]; ?>">
		<meta property="og:title" content="<?php echo $page_title; ?>">
		<meta name="twitter:title" content="<?php echo $page_title; ?>">
		<?php } elseif ($page == "category") { ?><link rel="canonical" href="<?php echo getSiteUrl() . "category/" . $_GET["slug"]; ?>">
		<meta property="og:url" content="<?php echo getSiteUrl() . "category/" . $_GET["slug"]; ?>">
		<meta property="og:title" content="<?php echo $page_title; ?>">
		<meta name="twitter:title" content="<?php echo $page_title; ?>">
		<?php } ?><meta property="og:site_name" content="<?php echo $site -> name; ?>">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="<?php echo $site -> twitterHandle; ?>">
		<link rel="stylesheet" href="<?php echo getSiteUrl(); ?>assets/alloy.css">
		<!-- Custom code -->
		<style>
			body { max-width: 600px; margin: 50px auto; font: menu; font-size: 100% }
			nav { background: whitesmoke; padding: 20px }
			a { color: inherit }
			nav a { margin-right: 20px }
			label { display: block }
			input, textarea, select { background: #fff; height: 40px; display: block; width: 100%; font: inherit; margin: 10px 0; padding: 7px 10px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
			textarea { height: auto }
			.btn { display: inline-block; background: whitesmoke; font: inherit; color: inherit; text-decoration: none; border: 1px solid #ddd; padding: 7px 10px; border-radius: 4px; margin-right: 5px; }
			.btn.primary { background: #46f; color: #fff; border-color: rgba(0, 0, 0, 0.03); }
			.btn.danger { background: #f33; color: #fff; border-color: rgba(0, 0, 0, 0.03) }
			.active { font-weight: bold; }
		</style>
	</head>
	<body>
		<nav>
			<a href="<?php echo getSiteUrl(); ?>">home</a>
		<?php if ($loggedIn) { ?>
			<a href="<?php echo getSiteUrl() . "profile/" . $_SESSION["username"]; ?>">profile</a>
			<a href="<?php echo getSiteUrl(); ?>new">new</a>
			<a href="<?php echo getSiteUrl(); ?>drafts">drafts</a>
			<a href="<?php echo getSiteUrl(); ?>logout">logout</a>
		<?php } else { ?>
			<a href="<?php echo getSiteUrl(); ?>login">login</a>
			<a href="<?php echo getSiteUrl(); ?>register">register</a>
		<?php } ?>
			<a href="<?php echo getSiteUrl(); ?>users">users</a>
		</nav>
