<html>
	
	<head>
		
        <script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">		
	</head>
	
	<body>
		<select id="searchDistrict" multiple="multiple" name="select[]">
		<?php
		
		include 'dbConnection.php';
		
		$queryDistinctDistrict = 'SELECT DISTINCT district FROM location ORDER BY district';
		
		$distinctRs = pg_query($con, $queryDistinctDistrict) or die (pg_last_error($con));
		
		while ($distinctDistrict = pg_fetch_array($distinctRs)) {
			echo "<option value='$distinctDistrict[district]'>$distinctDistrict[district]</option>";		
		/*
			echo "<optgroup label='$distinctDistrict[district]'>";	
			
			$query = 'SELECT name FROM "location" WHERE district = '. "'" . $distinctDistrict['district'] . "'"; 
			$rs = pg_query($con, $query) or die (pg_last_error($con)); 
			while ($row = pg_fetch_array($rs)) {
				echo "<option value='$row[name]'>$row[name]</option>";		
			}
			echo "</optgroup>";
			*/
		}	
		pg_close($con); 
?>
	</select>

<script type="text/javascript">

    $('#searchDistrict').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableClickableOptGroups: true,
		enableCollapsibleOptGroups: true,
		includeDeselectAllOption: true,
		enableCaseInsensitiveFiltering: true,
		nonSelectedText: "Select district",
		onChange: function(option, checked) {
                var brands = $('#searchDistrict option:selected');
        var selected = [];
        $(brands).each(function(index, brand){
            selected.push([$(this).val()]);
        });
		
		if (selected.length > 0) {
			var mergedSelected = selected.join('|');
			table
			.columns( 8 )
			.search(mergedSelected,true)
			.draw();
			console.log(selected);
		}else {
			table
			.columns( '' )
			.search( '' )
			.draw();
		}	
		}
		});
</script>

	</body>
	
</html>