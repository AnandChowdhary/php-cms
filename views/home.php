<h1>Welcome to <?php echo $site -> name; ?></h1>
<div id="postscontent">Loading...</div>
<div style="text-align: center; margin-top: 20px"><span class="load-more" style="display: none"><img alt="Loading" src="<?php echo getSiteUrl(); ?>assets/load.gif"></span></div>
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