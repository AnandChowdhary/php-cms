<h1>Login</h1>
<form method="post" action="backend/login.php">
	<p>
		<label>
			Username: 
			<input type="text" name="username" placeholder="Enter your username" autofocus>
		</label>
	</p>
	<p>
		<label>
			Password: 
			<input type="password" name="password" placeholder="Enter your password">
		</label>
	</p>
	<p>
		<button class="btn primary" type="submit">Log in</button>
		<a class="btn" href="./register">Register</a>
	</p>
</form>