<?php include "backend/init.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<style> .card:not(:last-child) { margin-bottom: 30px } </style>
	</head>
	<body>
		<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">Darwaaza</a>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">All <span class="sr-only">(current)</span></a>
					</li>
				<?php foreach (listCategories() as $key => $value) { ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo getSiteUrl() . "category/" . $value["slug"]; ?>"><?php echo $value["title"]; ?></a>
					</li>
				<?php } ?>
				</ul>
				<ul class="navbar-nav">
					<?php if ($loggedIn) { ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="http://example.com" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo getName($_SESSION["username"]); ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="userMenu">
							<a class="dropdown-item" href="<?php echo getSiteUrl() . "profile/" . $_SESSION["username"]; ?>">Profile</a>
							<a class="dropdown-item" href="<?php echo getSiteUrl(); ?>drafts">Drafts</a>
							<a class="dropdown-item" href="<?php echo getSiteUrl() . "profile/edit"; ?>">Settings</a>
							<a class="dropdown-item" href="<?php echo getSiteUrl(); ?>logout">Logout</a>
						</div>
					</li>
					<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo getSiteUrl(); ?>login">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo getSiteUrl(); ?>register">Register</a>
					</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="#">Upload</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container" style="margin-top: 85px; max-width: 1000px">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-block">Hello</div>
				</div>
				<div class="col-md-4">
					<div class="card card-block">
						<p><strong>Welcome to Darwaaza</strong></p>
						<p>Darwaaza is your doorway into the college experience. Find events, societies, and make friends.</p>
						<div><a href="#">Follow us on Facebook</a></div>
					</div>
					<div class="card card-block">
						<p><strong>Advertise Here</strong></p>
						<p>If you have a product or service that is relevant to today's college students, advertise on Darwaaza.</p>
						<div><a href="#">Contact us</a></div>
					</div>
					<h5 class="mb-3">Features Posts</h5>
				<?php
					foreach (sidebarPosts() as $key => $value) {
						preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $value["content"], $image);
						if ($image["src"] != NULL) {
							$img = "<img style='width: 100%; width: calc(100% + 2.5rem); margin: 0 -1.25rem; margin-bottom: 10px' src='" . $image["src"] . "'>";
						} else {
							$img = "";
						}
				?>
					<div class="card card-block">
						<p><strong><?php echo $value["title"]; ?></strong></p>
						<?php echo $img; ?>
						<p><?php echo getSummary($value["content"]); ?></p>
						<div><a href="#">Continue reading</a></div>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="row mt-5 mb-5 text-center">
				<div class="col">&copy; <?php echo date("Y"); ?> Darwaaza</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</body>
</html>