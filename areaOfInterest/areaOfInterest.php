<html>
	
	<head>
		
        <script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
		

		
	</head>
	
	<body>
		<select id="example-multiple-optgroups" multiple="multiple" name="select[]">
		<?php
		
		$host = "localhost"; 
		$user = "postgres"; 
		$pass = "hometown"; 
		$db = "gamified"; 

		$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
			or die ("Could not connect to server\n" . pg_last_error()); 
		
		$queryDistinctCategory = 'SELECT DISTINCT category FROM "skillDefinition" ORDER BY category';
		$distinctRs = pg_query($con, $queryDistinctCategory) or die (pg_last_error($con));
		
		while ($distinctName = pg_fetch_array($distinctRs)) {
			echo "<optgroup label='$distinctName[category]'>";
			$query = 'SELECT name FROM "skillDefinition" WHERE category = '. "'" . $distinctName['category'] . "'"; 
			$rs = pg_query($con, $query) or die (pg_last_error($con)); 
			while ($row = pg_fetch_array($rs)) {
				echo "<option value='$row[name]'>$row[name]</option>";		
			}
			echo "</optgroup>";
		}	
		pg_close($con); 
?>
	</select>

<script type="text/javascript">
    $('#example-multiple-optgroups').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableClickableOptGroups: true,
		enableCollapsibleOptGroups: true,
		includeSelectAllOption: true,
		enableCaseInsensitiveFiltering: true
		});
</script>

	</body>
	
</html>