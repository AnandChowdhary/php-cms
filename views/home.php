<h1>Welcome to <?php echo $site -> name; ?></h1>
<div id="postscontent">Loading...</div>
<div><button class="btn btn-secondary load-more" style="display: none">Load more</button></div>
<script>
	window.onload = function() {
		offset = -<?php echo getMaxPosts(); ?>;
		$(".load-more").click(function() {
			offset += <?php echo getMaxPosts(); ?>;
			console.log(offset);
			loadPosts("<?php echo getSiteUrl(); ?>backend/archive.php?offset=" + offset);
		});
		$(".load-more").click();
	}
</script>