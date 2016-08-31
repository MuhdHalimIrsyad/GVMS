<?php
if(session_id() == '') {
    session_start();
}
?>
<head>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/foundation.css">
		<link rel="stylesheet" href="css/main.css">
		
		
		<script src="js/vendor/modernizr.js"></script>
</head>
<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<?php
				if(!isset($_SESSION['logged']) || !$_SESSION['logged']=='yes') {
					echo '<h1><a href="#">Volunteer Management System</a></h1>';
				}else{
					echo '<section class="top-bar-section">
							<ul class="left">
								<li><a href="#">Dashboard</a></li>
								<li><a href="search.php">Search</a></li>
								<li><a href="#">Applications</a></li>
								<li><a href="#">Invitation</a></li>
								<li><a href="#">People</a></li>
								<li><a href="#">Reviews</a></li>
							</ul>
						</section>';
				}
				 ?>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu </span></a></li>
		</ul>
		<section class="top-bar-section">
			<ul class="right">
				<?php
					if(isset($_SESSION['logged']) && $_SESSION['logged']=='yes') {
						
						echo "<li><a href=''>Welcome " . $_SESSION['lastName'] . " " .  $_SESSION['firstName'] . "</a></li>";
						echo "<li><a href='logout.php'>Logout</a></li>";
					}else {
						echo '<li><a href="login.php">Login</a></li>
							<li><a href="register.php">Register</a></li>
							<li><a href="#">About Us</a></li>';
					}
				?>				
			<ul>
		</section>
	</nav>