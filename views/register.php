<h1>Register</h1>
<form method="post" action="backend/register.php">
	<p>
		<label>
			Email: 
			<input type="email" name="email" required autofocus>
		</label>
	</p>
	<p>
		<label>
			Name: 
			<input type="text" name="name" required>
		</label>
	</p>
	<p>
		<label>
			Username: 
			<input type="text" name="username" required>
		</label>
	</p>
	<p>
		<label>
			Password: 
			<input type="password" name="password" required>
		</label>
	</p>
	<p>
		<button class="btn primary" type="submit">Log in</button>
	</p>
</form>