<?php
	$warning = "dd";
	include 'topBar.php';
	include 'project.php';
	if(session_id() == '') {
		session_start();
}
?>	
<head>
		<script src="js/jquery-1.12.3.js"></script>
		<link rel="stylesheet" href="css/bootstrap-3.3.2.min.css" type="text/css">
		<link rel="stylesheet" href="css/foundation.min.css">
		<link rel="stylesheet" href="css/dataTables.foundation.min.css">
		
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/jquery.dataTables.min.css">
		<script src="js/datepicker/jquery-ui.js"></script>
		<script>
			$( function() {
				 $("#startDate").datepicker({ dateFormat: "dd/mm/yy" })
				 $("#endDate").datepicker({ dateFormat: "dd/mm/yy" })
			} );
		</script>

</head>
<body>
	
	<div class="row">
		<div class="small-4 small-centered columns"><h2>Project browser</h2></div>
	</div>
	<br>
	<div class="row">
		<div class="small-4 columns"><h3>Projects that fall within</h3></div>
	</div>
	
	<div class="row">
	
		<div class="small-4 columns"><input type="text" id="searchBox" placeholder="Enter keyword"></div>
		<div class="small-4 columns"><?php include 'location.php'; ?></div>
	</div>
	
	<div class="row">
	
		<div class="small-4 columns"><input type="text" id="searchName" placeholder="Project title"></div>
		<div class="small-4 columns"><input type="text" id="searchSupervisor" placeholder="Supervisor's name"></div>
	</div>
	
	<div class="row">
		<div class="small-2 columns">Start Date:<input type="text" id="startDate" name="startDate"></div>
		<div class="small-2 columns">End Date:<input type="text" id="endDate" name="endDate"></div>
		<div class="small-8 columns"></div>
	</div>
	
	<br>
	<div class="row" style="border: 2px solid #466d98;">
				
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
					$host = "localhost"; 
					$user = "postgres"; 
					$pass = "hometown"; 
					$db = "gamified"; 

					$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
					or die ("Could not connect to server\n" . pg_last_error()); 
	
					$query = 'SELECT * FROM project';
	
					$rs = pg_query($con, $query) or die (pg_last_error($con));
					
					while ($row = pg_fetch_array($rs)) {
					
						$queryLocation = pg_query($con, "SELECT * FROM project, projectLocation, location WHERE projectLocation.projectID = " . $row['projectid'] . "
						AND projectLocation.projectID = project.projectID 
						AND location.locationID = projectLocation.locationID") or die (pg_last_error($con));
						echo "<tr>
								<td>".$row['name']."</td>
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
										<td>".$row1['district']."</td>
										</tr>";
								}
								
					}
			?>        
        </tbody>
    </table>
			
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
		oTable.search($(this).val()).draw() ;
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
 
table.columns( '.select-filter' ).every( function () {
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
} );

// #search for project name
$('#searchName').on( 'keyup', function () {
    table
        .columns( ':contains(Name)' )
        .search( this.value )
        .draw();
} );



$(document).ready(function() {
      // Add event listeners to the two range filtering inputs
      $('#startDate').keyup( function() { table.draw(); } );
$('#endDate').keyup( function() { table.draw(); } );
  } );
  
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
	
	
</body>