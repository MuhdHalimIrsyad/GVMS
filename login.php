<html>
	<?php
		session_start();
		$warning = "";
		include 'doLogin.php';
		include_once('topBar.php')
	?>
	<body>
	
	<div class="row">
		<center><div class="large-12 columns"><h3>Volunteer Login</h3></div></center>
	</div>
	
	<form action='' method='POST'>	
		</div>
		
		<div class="large-11 columns" style="border: 2px solid #466d98;">
			<div class=row>
			<center><div class="row" id="error"><?php echo $warning; ?></div></center>
				<div class="large-3 columns required" >Email:</div>
				<div class="large-5 columns"><input type="text" name="email"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class="row">
				<div class="large-3 columns required">Password:</div>
				<div class="large-5 columns"><input type="password" name="password"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class="row">
				<div class="large-4 columns"></div>	
				<div class="large-8 columns"><input class="button radius" type="submit" value="Log in"></div>
			</div>
			
			<div class="row">
				<div class="large-4 columns"></div>	
				<div class="large-8 columns"><a href="#">Forget your password?</a></div>
			</div>
		</div>
	</form>

		<script src="js/vendor/jquery.js"></script>
		<script src="js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
		</body>
</html>
	