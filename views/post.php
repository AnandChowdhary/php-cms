<h1><?php echo $post["title"]; ?></h1>
<p>Posted <?php echo time_elapsed_string($post["postedon"]); ?> under <a href="<?php echo getSiteUrl() . "category/" . $post["tags"]; ?>"><?php echo fCategory($post["tags"]); ?></a></p>
<div style="margin-bottom: 30px"><?php echo $post["content"]; ?></div>

<?php if ($post["author"] == $_SESSION["username"]) { ?>
<p><a href="<?php echo getSiteUrl() . "edit/" . $post["slug"]; ?>">Edit this post</a></p>
<?php } ?>

<address style="font-style: normal; margin-bottom: 10px; display: block; text-decoration: none; line-height: 1.5; border-radius: 4px; padding: 15px; border: 1px solid #ccc">
	<a href="<?php echo getSiteUrl() . "profile/" . $user["username"]; ?>"><img alt="<?php echo $user["name"]; ?>" src="<?php echo getProfilePicture($user["username"]); ?>" style="height: 3em; float: left; margin-right: 15px; border-radius: 100%"></a>
	<a href="<?php echo getSiteUrl() . "profile/" . $user["username"]; ?>" style="font-weight: bold; display: block"><?php echo $user["name"]; ?></a>
	<?php echo $user["shortbio"]; ?>
</address>