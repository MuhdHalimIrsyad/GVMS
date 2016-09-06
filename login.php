	<?php
		session_start();
		$warning = "";
		include 'function/doLogin.php';
		include_once('header.php')
	?>
	
	<div class="row">
		<div class="small-12 columns text-center">
			<h2>Volunteer Login</h2>
			<br>
		</div>
	</div>
	
	<div class="row">
		<div class="small-2 columns"></div>
		<div class="small-8 columns">
			<div class="panel">
				<form action="" method="POST">
					<div class="row">
						<div class="small-4 columns">
							<span>Email: </span>
						</div>
						<div class="small-8 columns">
							<input type="text" name="email">
						</div>
						
						<div class="small-4 columns">
							<span>Password: </span>
						</div>
						<div class="small-8 columns">
							<input type="password" name="password">
						</div>
						
						<div class="small-12 columns text-center">
							<input class="button radius" type="submit" value="Log in" style="width:50%">
						</div>
						
						<div class="small-4 columns"></div>
						<div class="small-8 columns text-right">
							<a href="#">Forget your password?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="small-2 columns"></div>
	</div>