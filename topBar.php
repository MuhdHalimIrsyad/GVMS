<?php
if(session_id() == '') {
    session_start();
}
?>
<head>
	<title>Volunteer Management System</title>
	<link rel="stylesheet" href="css/normalize.css">
<!--	<link rel="stylesheet" href="css/foundation.css">-->
<!--	<script src="js/vendor/modernizr.js"></script>-->

<!--	<link rel="stylesheet" href="css/bootstrap-3.3.2.css" type="text/css">-->
	<link rel="stylesheet" href="css/foundation.min.css">
	<link rel="stylesheet" href="css/dataTables.foundation.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="css/custombootstrap.css">
	
	<?php /* redha: Ensure the main.css gets loaded LAST to ensure precedence above all other css */ ?>
	<link rel="stylesheet" href="css/main.css">
	
<!--		<script src="js/jquery-1.12.3.js"></script>-->
	<!-- redha: seems like this is the latest 1.12.4 -->
	<script type="text/javascript" src="js/vendor/jquery.js"></script>
	<script type="text/javascript" src="js/foundation.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="js/datepicker/jquery-ui.js"></script>
	<script type="text/javascript" src="main.js"></script>
	

		
	
</head>
<header id="navbar" class="row collapse">

<?php 
	// Redha: note no need to use echos to print html, you can weave in/out of php like this
	if(!isset($_SESSION['logged']) || !$_SESSION['logged']=='yes')
	{
	?>
	<div class="small-8 columns">
		<h1><a href="#">Volunteer Management System</a></h1>
	</div>
	<div class="small-4 columns">
	<?php
	} 
	else 
	{
	?>
	<div class="small-6 columns">
			<nav>
				<ul>
					<li><a href="#">Dashboard</a></li>
					<li class="current-page"><a href="search.php">Search</a></li>
					<li><a href="#">Applications</a></li>
					<li><a href="#">Invitation</a></li>
					<li><a href="#">People</a></li>
					<li><a href="#">Reviews</a></li>
				</ul>
			</nav>
	</div>
	<div class="small-6 columns">
	<?php
	}
	if(isset($_SESSION['logged']) && $_SESSION['logged']=='yes')
	{
		?>
		<img src="images/placeholders/playerlevel.PNG" alt="playerlevel.png">
		<?php
	}
?>
		<nav class="inlineb right">
			<ul>
				<?php
					if(isset($_SESSION['logged']) && $_SESSION['logged']=='yes') {
						echo "<li><a href=''>pls halp " . $_SESSION['lastName'] . " " .  $_SESSION['firstName'] . "</a></li>";
						echo "<li><a href='' class='bluebg'>Welcome " . $_SESSION['lastName'] . " " .  $_SESSION['firstName'] . "</a></li>";
						echo "<li><a href='logout.php'>Logout</a></li>";
					}else{
						echo '<li><a class="bluebg" href="login.php">Login</a></li>
							<li><a href="register.php">Register</a></li>
							<li><a href="#">About Us</a></li>';
					}
				?>				
			</ul>
		</nav>
	</div>
	<div class="clearfix"></div>
</header>