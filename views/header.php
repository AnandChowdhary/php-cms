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
	}
?>
<!doctype html>
<html>
	<head>
		<title><?php echo $page_title; ?></title>
		<?php if ($page == "post") { ?><meta property="og:type" content="article">
		<meta property="og:url" content="<?php echo $site -> url . "post/" . $_GET["slug"]; ?>">
		<meta property="og:title" content="<?php echo $post["title"]; ?>">
		<meta property="og:description" content="<?php echo getSummary($post["content"]); ?>">
		<meta property="og:updated_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:modified_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:published_time" content="<?php echo $post["postedon"]; ?>">
		<meta property="article:section" content="<?php echo $post["tags"]; ?>">
		<meta property="article:tag" content="<?php echo $keywords; ?>">
		<meta property="article:author" content="<?php echo $user["name"]; ?>">
		<meta property="article:publisher" content="<?php echo $site -> facebookUsername; ?>">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="<?php echo $site -> twitterHandle; ?>">
		<meta name="twitter:title" content="<?php echo $post["title"]; ?>">
		<meta name="twitter:description" content="<?php echo getSummary($post["content"]); ?>">
		<meta name="title" content="<?php echo $page_title; ?>">
		<meta name="description" content="<?php echo getSummary($post["content"]); ?>">
		<meta name="keywords" content="<?php echo $keywords; ?>">
		<meta name="author" content="<?php echo $user["name"]; ?>">
		<?php } ?><meta property="og:site_name" content="<?php echo $site -> name; ?>">
		<style>
			body { max-width: 600px; margin: 50px auto; font: menu; font-size: 100% }
			nav { background: whitesmoke; padding: 20px }
			a { color: inherit }
			nav a { margin-right: 20px }
			label { display: block }
			input, textarea, select { background: #fff; height: 40px; display: block; width: 100%; font: inherit; margin: 10px 0; padding: 7px 10px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
			textarea { height: auto }
			.btn { display: inline-block; background: whitesmoke; font: inherit; color: inherit; text-decoration: none; border: 1px solid #ddd; padding: 7px 10px; border-radius: 4px; }
			.btn.primary { background: #69e; color: #fff; border-color: rgba(0, 0, 0, 0.03); }
			.active { font-weight: bold; }
		</style>
	</head>
	<body>
		<nav>
			<a href="<?php echo $site -> url; ?>">home</a>
		<?php if ($loggedIn) { ?>
			<a href="<?php echo $site -> url . "profile/" . $_SESSION["username"]; ?>">profile</a>
			<a href="<?php echo $site -> url; ?>new">new</a>
			<a href="<?php echo $site -> url; ?>logout">logout</a>
		<?php } else { ?>
			<a href="<?php echo $site -> url; ?>login">login</a>
			<a href="<?php echo $site -> url; ?>register">register</a>
		<?php } ?>
			<a href="<?php echo $site -> url; ?>users">users</a>
		</nav>
