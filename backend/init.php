<?php

	// Database
	require_once "db.php";
	DB::$user = "root";
	DB::$password = "root";
	DB::$dbName = "oswalmkb_darwaaza";

	// Sessions
	session_start();
	if (isset($_SESSION["username"])) {
		$loggedIn = true;
	} else {
		$loggedIn = false;
	}

	// Site
	class siteSettings {
		function siteSettings() {
			$this -> url = "http://localhost:8888/clients/cms/";
			$this -> name = "Driffle";
			$this -> adminEmail = "anandchowdhary@gmail.com";
			$this -> adminPassword = "anand01";
			$this -> facebookUsername = "drifflecom";
			$this -> twitterHandle = "@drifflecom";
			$this -> maxPosts = 3;
		}
	}
	$site = new siteSettings();

	// Auth
	function logIn($username, $password) {
		$account = DB::queryFirstRow("SELECT password FROM user WHERE username=%s", $username);
		if ($account["password"] == md5($password)) {
			$_SESSION["username"] = $username;
		}
	}
	function register($username, $password, $email) {
		DB::query("SELECT * FROM user WHERE email=%s", $email);
		$counter = DB::count();
		if ($counter > 0) {
			header("Location: ../register?error=emailExists");
		} else {
			DB::query("SELECT * FROM user WHERE username=%s", $username);
			$counter = DB::count();
			if ($counter > 0) {
				header("Location: ../register?error=usernameExists");
			} else {
				DB::insert("user", array(
					"username" => $username,
					"password" => md5($password),
					"name" => $name,
					"email" => $email
				));
				$_SESSION["username"] = $username;
				header("Location: ../");
			}
		}
	}
	function logOut() {
		session_unset();
		session_destroy();
	}

	// Profile
	function getProfile($username) {
		return DB::queryFirstRow("SELECT followers, following, username, name, shortbio, listfollowers, listfollowing FROM user WHERE username=%s", $username);
	}
	function getNumPosts($username) {
		DB::query("SELECT id FROM posts WHERE author=%s", $username);
		return DB::count();
	}

	// Nav links
	function currUrl($url) {
		return ($url == "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	}

	// Users
	function getUsers() {
		return DB::query("SELECT username, name, shortbio FROM user");
	}
	function getProfilePicture($username) {
		$user = DB::queryFirstRow("SELECT email FROM user WHERE username=%s", $username);
		return "https://secure.gravatar.com/avatar/" . md5($user["email"]) . "?s=96&d=mm&r=g";
	}

	// Posts
	function archive($type, $a, $b) {
		if ($type == "author") {
			return DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s", $a);
		} elseif ($type == "category") {
			return DB::query("SELECT slug, postedon, content, title FROM posts WHERE tags=%s", $a);
		} elseif ($type == "both") {
			return DB::query("SELECT slug, postedon, content, title FROM posts WHERE author=%s AND category=%s", $a, $b);
		} else {
			return DB::query("SELECT slug, postedon, content, title FROM posts");
		}
	}
	function listArchive($posts) {
		foreach ($posts as $post) {
			echo "<a href='" . $site -> url . "post/" . $post["slug"] . "' style='margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc;'><div><strong>" . $post["title"] . "</strong></div><div>" . getSummary($post["content"]) . "</div></a>";
		}
	}
	function savePost($title, $tags, $content) {
		$slug = str_replace(' ', '-', $title);
		$slug = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $slug));
		$letters = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890";
		$letters = str_shuffle($letters);
		$slug .= ("-" . substr($letters, 0, 6));
		DB::insert("posts", array(
			"slug" => $slug,
			"author" => $_SESSION["username"],
			"title" => $title,
			"tags" => $tags,
			"content" => $content,
			"postedon" => date("Y-m-d h:i:sa")
		));
		header("Location: ../post/" . $slug);
	}
	function getPost($slug) {
		return DB::queryFirstRow("SELECT * FROM posts WHERE slug=%s", $slug);
	}
	function getSummary($content) {
		$content = strip_tags($content);
		$content = str_replace('"', '', $content);
		$content = substr($content, 0, 200);
		return $content . "...";
	}
	function getUserFromPost($slug) {
		$user = DB::queryFirstRow("SELECT author FROM posts WHERE slug=%s", $slug);
		return DB::queryFirstRow("SELECT * FROM user WHERE username=%s", $user["author"]);
	}
	function extract_common_words($string, $max_count = 5) {
		$string = preg_replace('/ss+/i', '', $string);
		$string = trim($string);
		$string = preg_replace('/[^a-zA-Z -]/', '', $string);
		$string = strtolower($string);
		preg_match_all('/\b.*?\b/i', $string, $match_words);
		$match_words = $match_words[0];
		foreach ($match_words as $key => $item) {
			if ($item == '' || in_array(strtolower($item), array("a", "ii", "about", "above", "according", "across", "39", "actually", "ad", "adj", "ae", "af", "after", "afterwards", "ag", "again", "against", "ai", "al", "all", "almost", "alone", "along", "already", "also", "although", "always", "am", "among", "amongst", "an", "and", "another", "any", "anyhow", "anyone", "anything", "anywhere", "ao", "aq", "ar", "are", "aren", "aren't", "around", "arpa", "as", "at", "au", "aw", "az", "b", "ba", "bb", "bd", "be", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "begin", "beginning", "behind", "being", "below", "beside", "besides", "between", "beyond", "bf", "bg", "bh", "bi", "billion", "bj", "bm", "bn", "bo", "both", "br", "bs", "bt", "but", "buy", "bv", "bw", "by", "bz", "c", "ca", "can", "can't", "cannot", "caption", "cc", "cd", "cf", "cg", "ch", "ci", "ck", "cl", "click", "cm", "cn", "co", "co.", "com", "copy", "could", "couldn", "couldn't", "cr", "cs", "cu", "cv", "cx", "cy", "cz", "d", "de", "did", "didn", "didn't", "dj", "dk", "dm", "do", "does", "doesn", "doesn't", "don", "don't", "down", "during", "dz", "e", "each", "ec", "edu", "ee", "eg", "eh", "eight", "eighty", "either", "else", "elsewhere", "en", "end", "ending", "enough", "er", "es", "et", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "f", "few", "fi", "fifty", "find", "first", "five", "fj", "fk", "fm", "fo", "for", "former", "formerly", "forty", "found", "four", "fr", "free", "from", "further", "fx", "g", "ga", "gb", "gd", "ge", "get", "gf", "gg", "gh", "gi", "gl", "gm", "gmt", "gn", "go", "gov", "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "h", "had", "has", "hasn", "hasn't", "have", "haven", "haven't", "he", "he'd", "he'll", "he's", "help", "hence", "her", "here", "here's", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "hk", "hm", "hn", "home", "homepage", "how", "however", "hr", "ht", "htm", "html", "http", "hu", "hundred", "i", "i'd", "i'll", "i'm", "i've", "i.e.", "id", "ie", "if", "il", "im", "in", "inc", "inc.", "indeed", "information", "instead", "int", "into", "io", "iq", "ir", "is", "isn", "isn't", "it", "it's", "its", "itself", "j", "je", "jm", "jo", "join", "jp", "k", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "l", "la", "last", "later", "latter", "lb", "lc", "least", "less", "let", "let's", "li", "like", "likely", "lk", "ll", "lr", "ls", "lt", "ltd", "lu", "lv", "ly", "m", "ma", "made", "make", "makes", "many", "maybe", "mc", "md", "me", "meantime", "meanwhile", "mg", "mh", "microsoft", "might", "mil", "million", "miss", "mk", "ml", "mm", "mn", "mo", "more", "moreover", "most", "mostly", "mp", "mq", "mr", "mrs", "ms", "msie", "mt", "mu", "much", "must", "mv", "mw", "mx", "my", "myself", "mz", "n", "na", "namely", "nc", "ne", "neither", "net", "netscape", "never", "nevertheless", "new", "next", "nf", "ng", "ni", "nine", "ninety", "nl", "no", "nobody", "none", "nonetheless", "noone", "nor", "not", "nothing", "now", "nowhere", "np", "nr", "nu", "nz", "o", "of", "off", "often", "om", "on", "once", "one", "one's", "only", "onto", "or", "org", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "overall", "own", "p", "pa", "page", "pe", "per", "perhaps", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pt", "pw", "py", "q", "qa", "r", "rather", "re", "recent", "recently", "reserved", "ring", "ro", "ru", "rw", "s", "sa", "same", "sb", "sc", "sd", "se", "seem", "seemed", "seeming", "seems", "seven", "seventy", "several", "sg", "sh", "she", "she'd", "she'll", "she's", "should", "shouldn", "shouldn't", "si", "since", "site", "six", "sixty", "sj", "sk", "sl", "sm", "sn", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "sr", "st", "still", "stop", "su", "such", "sv", "sy", "sz", "t", "taking", "tc", "td", "ten", "text", "tf", "tg", "test", "th", "than", "that", "that'll", "that's", "the", "their", "them", "themselves", "then", "thence", "there", "there'll", "there's", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "they'd", "they'll", "they're", "they've", "thirty", "this", "those", "though", "thousand", "three", "through", "throughout", "thru", "thus", "tj", "tk", "tm", "tn", "to", "together", "too", "toward", "towards", "tp", "tr", "trillion", "tt", "tv", "tw", "twenty", "two", "tz", "u", "ua", "ug", "uk", "um", "under", "unless", "unlike", "unlikely", "until", "up", "upon", "us", "use", "used", "using", "uy", "uz", "v", "va", "vc", "ve", "very", "vg", "vi", "via", "vn", "vu", "w", "was", "wasn", "wasn't", "we", "we'd", "we'll", "we're", "we've", "web", "webpage", "website", "welcome", "well", "were", "weren", "weren't", "wf", "what", "what'll", "what's", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "who'd", "who'll", "who's", "whoever", "NULL", "whole", "whom", "whomever", "whose", "why", "will", "with", "within", "without", "won", "won't", "would", "wouldn", "wouldn't", "ws", "www", "x", "y", "ye", "yes", "yet", "you", "you'd", "you'll", "you're", "you've", "your", "yours", "yourself", "yourselves", "yt", "yu", "z", "za", "zm", "zr", "10", "z", "org", "inc", "width", "length")) || strlen($item) <= 3 ) {
				unset($match_words[$key]);
			}
		}
		$word_count = str_word_count(implode(" ", $match_words) , 1); 
		$frequency = array_count_values($word_count);
		arsort($frequency);
		$keywords = array_slice($frequency, 0, $max_count);
		return $keywords;
	}


	// Formatting
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
		$string = array(
			"y" => "year",
			"m" => "month",
			"w" => "week",
			"d" => "day",
			"h" => "hour",
			"i" => "minute",
			"s" => "second",
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . " " . $v . ($diff->$k > 1 ? "s" : "");
			} else {
				unset($string[$k]);
			}
		}
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(", ", $string) . " ago" : "just now";
	}

?>