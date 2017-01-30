<?php
	include "init.php";
	logIn($_POST["username"], $_POST["password"]);
	header("Location: ../");
?>