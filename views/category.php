<h1><?php echo $category_name; ?></h1>
<div id="postscontent">Loading...</div>
<div><button class="btn btn-secondary load-more" style="display: none">Load more</button></div>
<script>
	window.onload = function() {
		offset = -<?php echo getMaxPosts(); ?>;
		$(".load-more").click(function() {
			offset += <?php echo getMaxPosts(); ?>;
			console.log(offset);
			loadPosts("<?php echo getSiteUrl(); ?>backend/archive.php?offset=" + offset + "&type=category&a=<?php echo $_GET["slug"]; ?>");
		});
		$(".load-more").click();
	}
</script>