<?php
	//var_dump($post);
?>
<h1><?php echo $post["title"]; ?></h1>
<p>Posted <?php echo time_elapsed_string($post["postedon"]); ?> under <?php echo $post["tags"]; ?></p>
<div style="margin-bottom: 30px"><?php echo $post["content"]; ?></div>
<?php
	echo "<a href='" . $site -> url . "profile/" . $user["username"] . "' style='margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc;'>
			<img style='height: 3em; float: left; margin-right: 15px; border-radius: 100%' alt='" . $user["name"] . "' src='" . getProfilePicture($user["username"]) . "'>
			<strong>" . $user["name"] . "</strong><br>
			" . $user["shortbio"] . "
		</a>";
?>