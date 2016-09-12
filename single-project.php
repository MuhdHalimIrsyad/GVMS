<?php
$warning = "";
include 'header.php';
include 'function/dbConnection.php';
include 'function/project.php';

if (isset($applicationSuccess) && $applicationSuccess == TRUE) {
    echo "<script type='text/javascript'>alert('Project successfully applied!');";
    $applicationSuccess = FALSE;
}

if (isset($cancelSuccess) && $cancelSuccess == TRUE) {
    echo "<script type='text/javascript'>alert('Project successfully cancelled!');";
    $cancelSuccess = FALSE;
}

if (isset($error) && $error == TRUE) {
    echo "<script type='text/javascript'>alert('There is an error. Please try again!');";
    $error = FALSE;
}

if (!isset($applicationSuccess)) {
    $applicationSuccess = FALSE;
}

if (!isset($cancelSuccess)) {
    $cancelSuccess = FALSE;
}

if (!isset($error)) {
    $error = FALSE;
}

if (session_id() == '') {
    session_start();
}

$projectID = $_GET['id'];
$project = displayProject($projectID);

if (strcmp($project['detail']['visibility'], 'private')) {
    $credentialQuery = "SELECT * FROM volunteerapp WHERE projectid = " . $projectID . " AND userid = " . $_SESSION['userId'].";";
    $credentialRS = pg_query($con, $credentialQuery) or die(pg_last_error($con));

    if (pg_num_rows($credentialRS) == 0) {
        header("search.php");
    }
}

$applicationQuery = "SELECT userid FROM volunteerapp WHERE projectid = ".$projectID." AND appstatus NOT LIKE 'Cancelled';";
$applicationRS = pg_query($con, $applicationQuery) or die(pg_last_error($con));

$applicationNum = pg_num_rows($applicationRS);
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
                        <p><span class="textunderline textbold"><?php echo $applicationNum ?></span> people applied for this event</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <p>
                        <span>" </span><span class="required">" Denotes mandatory field</span>
                    </p>
                    <div class="clearfix"></div>
                </div>
                <div class="small-8 columns"></div>
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
                            $skillName = $skillName . $project['skillRequired'][$i] . ", ";
                        } else {
                            $skillName = $skillName . $project['skillRequired'][$i];
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
        
            <?php
            if (!isset($project['status'])) {
                include 'function/doJobApplication.php'; ?>
                <div class='panel'>
                    <form action='' method='post'>
                    <h3>Application Form</h3>
                    <p><label>Desired role/position in project:</label></p>
                    <div class='usebootstrap'>
                        <input type='hidden' name='projectAppId' value="<?php echo $projectID ?>">
                        <select id='projectApp' name='projectAppSkill' class='areaOfInterest'>
                            <option value=''>None Selected</option>
                
                <?php for ($i = 0; $i < count($project['skillId']); $i++) { ?>
                    <option value="<?php echo $project['skillId'][$i] ?>"><?php echo $project['skillRequired'][$i] ?></option>;
                <?php } ?>
                    
                        </select>
                    </div>
                    <label>
                        <textarea name='applicationmsg' placeholder='In a few sentences, let the VWO know why you are right for this job.'></textarea>
                    </label>
                    <input name="SubmitButton" class='button radius' type='submit' value='Submit' style='width:50%'>
                   </form>  
                </div>
            <?php } else { 
                include 'function/cancelApplication.php';?>
                <div class='panel'>
                    <h3>Application Form</h3>
                    <p><label>Desired role/position in project: <?php echo $project['status'][0]['skillname'] ?></label></p>
                    <p><label>Application Status: <?php echo $project['status'][0]['appstatus'] ?></label></p>
                    <textarea name='applicationmsg' disabled><?php echo $project['status'][0]['description'] ?></textarea>
                    <form action='' method='post'>
                        <input type='hidden' name='projectAppId' value='<?php echo $projectID ?>'>
                        <input name="CancelButton" class='button radius' type='submit' value='Cancel' style='width:50%'>
                    </form>
                </div>
            <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>