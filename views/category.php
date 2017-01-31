<h1><?php echo $category_name; ?></h1>
<div id="content">Loading...</div>
<div><button class="btn btn-secondary load-more" style="display: none">Load more</button></div>
<script>
	offset = 0;
	document.querySelector(".load-more").addEventListener("click", function() {
		offset+=3;
		sendRequest(offset);
	});
	document.addEventListener("DOMContentLoaded", function() {
		setTimeout(function() {
			sendRequest(offset);
		}, 1000);
	});
	function sendRequest(offset) {
		var request = new XMLHttpRequest();
		request.open("GET", "<?php echo $site -> url; ?>backend/archive.php?offset=" + offset + "&type=category&a=<?php echo $_GET["slug"]; ?>", true);
		request.onload = function() {
			if (request.status >= 200 && request.status < 400) {
				if (request.responseText == "") {
					document.querySelector(".load-more").parentNode.innerHTML = "That's all, folks!";
				} else {
					if (document.querySelector("#content").innerHTML == "Loading...") {
						document.querySelector("#content").innerHTML = "";
					}
					document.querySelector("#content").innerHTML += request.responseText;
					document.querySelector(".load-more").style.display = "block";
				}
			}
		};
		request.send();
	}
</script>