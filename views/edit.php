<?php $post = getPost($_GET["slug"]); ?><h1>Edit</h1>
<form class="new-edit-form" method="post" action="../backend/update.php">
	<input type="hidden" name="slug" value="<?php echo $_GET["slug"]; ?>">
	<p>
		<label>
			Title
			<input type="text" name="title" placeholder="Add title for your post" value="<?php echo $post["title"]; ?>" autofocus required>
		</label>
	</p>
	<p>
		<label>
			Category
			<select name="tags" required>
				<option selected>Change category</option>
<?php
	$results = DB::query("SELECT title, slug FROM categories");
	foreach ($results as $row) {
?>
	<option value="<?php echo $row["slug"] ?>"><?php echo $row["title"] ?></option>
<?php
	}
?>
			</select>
		</label>
	</p>
	<label>Write</label>
	<div style="margin: 10px 0; padding: 0 15px; box-sizing: border-box; min-height: 300px; border: 1px solid #ddd; border-radius: 4px" id="writecontent" contenteditable="true"><?php echo $post["content"]; ?></div>
	<p>
		<label>Publish?</label>
		<select name="status">
			<option value="published" selected>Publish this post right now</option>
			<option value="draft">Save as draft</option>
		</select>
	</p>
	<p>
		<button class="btn primary" type="submit">Save this post</button>
		<a href="<?php echo getSiteUrl(); ?>backend/delete.php?slug=<?php echo $_GET["slug"]; ?>" class="btn danger">Delete this post</a>
	</p>
	<textarea name="content" rows="10" style="display: none"></textarea>
</form>