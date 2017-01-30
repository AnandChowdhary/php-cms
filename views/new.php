<h1>New</h1>
<form method="post" action="backend/new.php">
	<p>
		<label>
			Title
			<input type="text" name="title">
		</label>
	</p>
	<p>
		<label>
			Category
			<select name="tags">
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
	<p>
		<label>
			Content
			<textarea name="content" rows="10"></textarea>
		</label>
	</p>
	<p>
		<button class="btn primary" type="submit">Save</button>
	</p>
</form>