<?php
	$warning = "dd";
	include 'topBar.php';
	include 'function/project.php';
	if(session_id() == '') {
		session_start();
}
?>	
<body>
	<section id="main">
		<div class="row">
			<div id="pagetitle" class="small-12 columns text-center"><h2>Project browser</h2></div>
			<br>
		</div>
		<div class="row hide">
			<div class="small-12 columns"><h3>Projects that fall within</h3></div>
		</div>

		<div class="row">
			<div class="small-2 columns"></div>
			<div class="small-8 columns text-center">
				<input type="text" id="searchBox" placeholder="Enter keyword(s) to narrow your search results">
				<div class="text-center">
					<a href="#" class="button" style="width: 60%">Toggle advanced search</a>
				</div>
			</div>
			<div class="small-2 columns"></div>
		</div>
			
		<div class="row">
			<div class="small-12 columns">
				<div class="panel advsearch">
					<div class="row">
						<div class="small-4 columns"></div>
						<div class="small-2 columns">Start Date:<input type="text" id="startDate" name="startDate"></div>
						<div class="small-2 columns">End Date:<input type="text" id="endDate" name="endDate"></div>
						<div class="small-4 columns"></div>
					</div>
						
					<div class="row">
						<div class="small-4 columns"><input type="text" id="searchName" placeholder="Project title"></div>
						<div class="small-4 columns"><input type="text" id="searchSupervisor" placeholder="Supervisor's name"></div>
						<div class="small-4 columns"><div class="usebootstrap"><?php include 'location.php'; ?></div></div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="small-12 columns">
				<table id="project" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Repetition</th>
							<th>No of personnel needed</th>
							<th>Start date</th>
							<th>End date</th>
							<th>Location</th>
							<th>District</th>

						</tr>
					</thead>

					<!--<tfoot>

						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Repetition</th>
							<th>No of personnel needed</th>
							<th>Start date</th>
							<th>End date</th>
							<th>Location</th>
							<th>District</th>
						</tr>

					</tfoot>-->

					<tbody>
						<?php
								include 'function/dbConnection.php';
								$query = 'SELECT * FROM project';

								$rs = pg_query($con, $query) or die (pg_last_error($con));

								while ($row = pg_fetch_array($rs)) {

									$queryLocation = pg_query($con, "SELECT * FROM project, projectLocation, location WHERE projectLocation.projectID = " . $row['projectid'] . "
									AND projectLocation.projectID = project.projectID 
									AND location.locationID = projectLocation.locationID") or die (pg_last_error($con));
									echo "<tr>
											<td><a href='#'>".$row['name']."</a></td>
											<td>".$row['description']."</td>
											<td>".$row['status']."</td>
											<td>".$row['repetition']."</td>
											<td>".$row['noofpersonnel']."</td>
											<td>". date("d/m/Y", strtotime($row['startdate']))."</td>";
											if(strtotime($row['enddate']) == NULL){
												echo "<td></td>";
											}
											else{
												echo "<td>". date("d/m/Y", strtotime($row['enddate']))."</td>";

											}

											while ($row1 = pg_fetch_array($queryLocation)) {
												echo "<td>".$row1['name']."</td>
													<td>".$row1['district']."</td>";
											}
									echo "</tr>";

								}
						?>        
					</tbody>
				</table>
			</div>
		</div>


		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.foundation.min.js"></script>
		<!--<script src="js/foundation.min.js"></script>-->

		<script>
			$(document).ready(function() {
				$('#project').DataTable();
			} );

			oTable = $('#project').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
			$('#searchBox').keyup(function(){
				oTable.search($(this).val()).draw();
			})    

			$( "#moreOption" ).click(function() {
				console.log("dsd");
			$( "#supervisor" ).fadeToggle( "slow", "linear" );
			$( "#location" ).fadeToggle( "slow", "linear" );		
			});

			/*
	$(document).ready(function() {
		// Setup - add a text input to each footer cell
		$('#project tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		} );

		// DataTable
		var table = $('#project').DataTable();

		// Apply the search
		table.columns().every( function () {
			var that = this;

			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			} );
		} );
	} );
	*/



	var table = $('#project').DataTable();

	table.columns( '.select-filter' ).every(function(){
		var that = this;

		// Create the select list and search operation
		var select = $('<select />')
			.appendTo(
				this.footer()
			)
			.on( 'change', function () {
				that
					.search( $(this).val() )
					.draw();
			} );

		// Get the search data for the first column and add to the select list
		this
			.cache( 'search' )
			.sort()
			.unique()
			.each( function ( d ) {
				select.append( $('<option value="'+d+'">'+d+'</option>') );
			} );
	});

	// #search for project name
	$('#searchName').on( 'keyup', function () {
		table
			.columns( ':contains(Name)' )
			.search( this.value )
			.draw();
	} );

	$('#startDate').change(function () {
		table.draw();
	});

	$('#endDate').change(function () {
		table.draw();
	});

		/*
	$(document).ready(function() {
		  // Add event listeners to the two range filtering inputs
		  $('#startDate').keyup( function() { table.draw(); } );
		$('#endDate').keyup( function() { table.draw(); } );
	  } );
*/
	 $.fn.dataTableExt.afnFiltering.push(
				function( oSettings, aData, iDataIndex ) {
					var iFini = document.getElementById('startDate').value;
					var iFfin = document.getElementById('endDate').value;
					var iStartDateCol = 5;
					var iEndDateCol = 6;

		iFini=iFini.substring(0,2) + iFini.substring(3,5)+ iFini.substring(6,10)
		iFfin=iFfin.substring(0,2) + iFfin.substring(3,5)+ iFfin.substring(6,10)       

		var datofini=aData[iStartDateCol].substring(0,2) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(6,10);
		var datoffin=aData[iEndDateCol].substring(0,2) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(6,10);


					if ( iFini == "" && iFfin == "" )
					{
						return true;
					}
					else if ( iFini <= datofini && iFfin == "")
					{
						return true;
					}
					else if ( iFfin >= datoffin && iFini == "")
					{
						return true;
					}
					else if (iFini <= datofini && iFfin >= datoffin)
					{
						return true;
					}
					return false;
				}
			);


		</script>

	</section>
</body>