<?php
	include "init.php";
	savePost($_POST["title"], $_POST["tags"], $_POST["content"], $_POST["status"], $_POST["extratag1"], $_POST["extratag2"], $_POST["extratag3"], $_POST["extratag4"], $_POST["extratag5"]);
?>