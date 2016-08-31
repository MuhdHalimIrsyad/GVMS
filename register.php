<html>
	<?php
	$warning = "";
	include 'doRegister.php';
	include_once('topBar.php')
	?>
	
	<head>
		<link rel="stylesheet" href="css/bootstrap-3.3.2.min.css" type="text/css">

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/foundation.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
		<script src="js/vendor/jquery.js"></script>
		<script src="js/datepicker/jquery-ui.js"></script>
		<script>
			$( function() {
				 $("#datepicker").datepicker({ dateFormat: "dd/mm/yy" })
			} );
		</script>
		<script src="js/vendor/modernizr.js"></script>
	</head>
	<body>
	

	<div class="row">
		<center><div class="large-12 columns"><h3>Volunteer Registration</h3></div></center>
	</div>
	
	<form action='' method='POST' enctype="multipart/form-data">	
		
		
		<center><div class="large-12 columns" style="border: 0px solid #466d98;">
		
			<div class="row" id="error"><?php echo $warning; ?></div>
			
			<div class=row>
				<div class="large-3 columns required" >First Name:</div>
				<div class="large-5 columns"><input type="text" name="firstName"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns required" >Last Name:</div>
				<div class="large-5 columns"><input type="text" name="lastName"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Date Of Birth:</div>
				<div class="large-5 columns"><input type="text" id="datepicker" name="dob"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns required" >Email Address:</div>
				<div class="large-5 columns"><input type="text" name="email"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns required" >Password:</div>
				<div class="large-5 columns"><input type="password" name="password"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns required" >Retype Password:</div>
				<div class="large-5 columns"><input type="password" name="cfmPassword"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Photo:</div>
				<div class="large-5 columns"><input type="file" name="photo"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Occupation:</div>
				<div class="large-5 columns"><input type="text" name="occupation"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Biography:</div>
				<div class="large-5 columns"><textarea name="biography" rows="5" cols="40"></textarea></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Abilities / Area Of Interest:</div>
				<div class="large-1 columns"><?php include_once('areaOfInterest/areaOfInterest.php') ?></div>	
				<div class="large-4 columns"></div>
			</div>
			<br>
			
			<div class=row>
				<div class="large-3 columns" >Contact No:</div>
				<div class="large-5 columns"><input type="text" name="contactNo"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >Resume:</div>
				<div class="large-5 columns"><input type="file" name="resume"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class=row>
				<div class="large-3 columns" >LinkedIn URL:</div>
				<div class="large-5 columns"><input type="text" name="linkedInUrl"></div>	
				<div class="large-4 columns"></div>
			</div>			
			
			<div class=row>
				<div class="large-3 columns" >Referral ID:</div>
				<div class="large-5 columns"><input type="text" name="referal"></div>	
				<div class="large-4 columns"></div>
			</div>
			
			<div class="row">
					
				<div class="large-12 columns"><input class="button radius" type="submit" value="Register"></div>
			</div>
		</div>
	</form>

		<script src="js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
		</body>
</html>
