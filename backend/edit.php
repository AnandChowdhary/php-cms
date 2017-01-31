<?php
	include "init.php";
	updateUser($_POST["name"], $_POST["hobbies"], $_POST["email"], $_POST["shortbio"], $_POST["website"], $_POST["facebook"], $_POST["twitter"], $_POST["phone"], $_POST["password_current"], $_POST["password_new"]);
	header("Location: " . getSiteUrl() . "profile/" . $_SESSION["username"] . "/about");
?>