<?php
	$warning = "dd";
	include 'header.php';
	include 'function/project.php';
	if (session_id() == '') {
            session_start();
        }
        
        $project = displayProject(1);
?>
<div class="row">
	<div class="small-12 columns text-center">
		<h2><?php echo $project['detail']['name']; ?></h2>
		<br>
	</div>
</div>
<div class="row">
	<div class="small-2 columns">
		<a href="#" class="button">Project Details</a>
		<a href="#" class="button">Volunteers</a>
		<a href="#" class="button">VWOs</a>
	</div>
	<div class="small-10 columns">
		<div class="panel">
			<div class="row">
				<div class="small-12 columns">
					<div class="text-right">
						<p><span class="textunderline textbold">20</span> people applied for this event</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="small-3 columns">
					<p>
						<span>" </span><span class="required">" Denotes mandatory field</span>
					</p>
					<div class="clearfix"></div>
				</div>
				<div class="small-9 columns"></div>
				<div class="clearfix"></div>
				<div class="small-3 columns"><p>Event Name: </p></div>
				<div class="small-9 columns"><?php echo $project['detail']['name']; ?></div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Start Date: </p></div>
				<div class="small-9 columns"><?php echo $project['detail']['startdate']; ?></div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>End Date: </p></div>
				<div class="small-9 columns"><?php echo $project['detail']['enddate']; ?></div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Project Detail: </p></div>
				<div class="small-9 columns">
					<p>
						<?php echo $project['detail']['description']; ?>
					</p>
				</div>
				<div class="clearfix"></div>
				
                                <?php
                                    
                                    $skillName = "";
                                    
                                    if (count($project['skillRequired']) > 1) {
                                        for ($i = 0; $i < count($project['skillRequired']); $i++) {
                                            if ($i != (count($project['skillRequired']) - 1)) {
                                                $skillName = $skillName.$project['skillRequired'][$i].", ";
                                            } else {
                                                $skillName = $skillName.$project['skillRequired'][$i];
                                            }
                                        }
                                    } else {
                                       $skillName = $project['skillRequired'][0]; 
                                    }
                                
                                ?>
                                
				<div class="small-3 columns"><p>Roles/Skills needed: </p></div>
				<div class="small-9 columns"><?php echo $skillName ?></div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Manpower needed: </p></div>
				<div class="small-9 columns"><?php echo $project['detail']['noofpersonnel']; ?></div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Estimated VXP Gain: </p></div>
				<div class="small-9 columns">100</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p># of CP Awarded: </p></div>
				<div class="small-9 columns">35</div>
			</div>
		</div>
		
		<div class="panel">
			<h3>Application Form</h3>
                                    <p><label>Desired role/position in project:</label></p>
                                    <div class="usebootstrap">
                                        <select id="projectApp" name="projectApp[]" class="areaOfInterest" multiple="multiple">
                                            <?php
                                                
                                                for ($i = 0; $i < count($project['skillId']); $i++) {
                                                    echo "<option value=".$project['skillId'][$i].">".$project['skillRequired'][$i]."</option>";
                                                }
                                                
                                            ?>
                                        </select>
                                        </div>
			<label>
				<textarea name="applicationmsg" placeholder="In a few sentences, let the VWO know why you are right for this job."></textarea>
			</label>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>