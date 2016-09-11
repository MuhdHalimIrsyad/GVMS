<?php

function createAreaOfInterest($type){
	?>
	<select name="areaOfInterest[]" id="areaOfInterest" multiple="multiple">
	<?php
	include '/function/dbConnection.php';

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n" . pg_last_error());

	$queryDistinctCategory = 'SELECT DISTINCT category FROM skillDefinition ORDER BY category';
	$distinctRs = pg_query($con, $queryDistinctCategory) or die (pg_last_error($con));

	while ($distinctName = pg_fetch_array($distinctRs)) {
		echo "<optgroup label='$distinctName[category]'>";
		$query = 'SELECT * FROM skillDefinition WHERE category = '. "'" . $distinctName['category'] . "'";
		$rs = pg_query($con, $query) or die (pg_last_error($con));
		while ($row = pg_fetch_array($rs)) {
			if ($type == "register") {
				echo "<option value='$row[skillid]'>$row[name]</option>";
			}else {
				echo "<option value='$row[name]'>$row[name]</option>";
			}
		}
		echo "</optgroup>";
	}
	pg_close($con);
	?>
	</select>
	<?php
	}
?>
