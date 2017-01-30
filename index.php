<?php

	include "backend/init.php";

	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	} elseif (isset($_GET["username"])) {
		$page = $_GET["username"];
	} else {
		$page = "home";
	}

	include "views/header.php";
	include "views/" . $page . ".php";
	include "views/footer.php";

?>