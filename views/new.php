<h1>New</h1>
<form class="new-edit-form" method="post" action="backend/new.php">
	<p>
		<label>
			Title
			<input type="text" name="title" placeholder="Add title for your post" autofocus required>
		</label>
	</p>
	<p>
		<label>
			Category
			<select name="tags" required>
<?php
	$results = DB::query("SELECT title, slug FROM categories ORDER BY title ASC");
	foreach ($results as $row) {
?>
	<option value="<?php echo $row["slug"] ?>"><?php echo $row["title"] ?></option>
<?php
	}
?>
			</select>
		</label>
	</p>
	<div class="only-events" style="display: none">
		<p>
			<label>
				Date
				<input type="date" name="extratag1">
			</label>
		</p>
		<p>
			<label>
				Venue
				<input type="text" name="extratag2" placeholder="Enter the venue, eg. Main Auditorium">
			</label>
		</p>
		<p>
			<label>
				Society
				<input type="text" name="extratag3" placeholder="Enter the name of the society organizing this event">
			</label>
		</p>
		<p>
			<label>
				Institution
				<input type="text" name="extratag4" value="<?php echo getShortBio($_SESSION["username"]); ?>">
			</label>
		</p>
	</div>
	<label>Write</label>
	<div style="margin: 10px 0; padding: 0 15px; box-sizing: border-box; min-height: 300px; border: 1px solid #ddd; border-radius: 4px" id="writecontent" contenteditable="true">
		Write something here...
	</div>
	<p>
		<label>Publish?</label>
		<select name="status">
			<option value="published" selected>Publish this post right now</option>
			<option value="draft">Save as draft</option>
		</select>
	</p>
	<p>
		<button class="btn primary" type="submit">Save</button>
	</p>
	<textarea name="content" rows="10" style="display: none"></textarea>
</form>