
<select id="searchDistrict" multiple="multiple" name="select[]">
		<?php
		
		include 'function/dbConnection.php';
		
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