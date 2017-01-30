<?php

	header("Content-type: text/xml; charset: UTF-8");

	include "backend/init.php";

	echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>' . $site -> url . '</loc>
	</url>' . "\n";
foreach (archive() as $key => $value) {
	echo "	<url>\n";
	echo "		<loc>" . $site -> url . "post/" . $value["slug"] . "</loc>\n";
	echo "	</url>\n";
}
foreach (getUsers() as $key => $value) {
	echo "	<url>\n";
	echo "		<loc>" . $site -> url . "profile/" . $value["username"] . "</loc>\n";
	echo "	</url>\n";
	echo "	<url>\n";
	echo "		<loc>" . $site -> url . "profile/" . $value["username"] . "/about</loc>\n";
	echo "	</url>\n";
	echo "	<url>\n";
	echo "		<loc>" . $site -> url . "profile/" . $value["username"] . "/followers</loc>\n";
	echo "	</url>\n";
	echo "	<url>\n";
	echo "		<loc>" . $site -> url . "profile/" . $value["username"] . "/following</loc>\n";
	echo "	</url>\n";
}
echo "</urlset>";
?>