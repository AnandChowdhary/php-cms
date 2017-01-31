<?php
	include "init.php";
	updatePost($_POST["title"], $_POST["tags"], $_POST["content"], $_POST["status"], $_POST["slug"]);
?>