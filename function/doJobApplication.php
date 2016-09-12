<?php

function projectApplication($projectid, $skillid, $userid, $description) {

    include 'dbConnection.php';

    $query = "INSERT INTO volunteerApp(applicationid, projectid, skillid, userid, appstatus, appdescription, apptime) VALUES (DEFAULT," . $projectid .
            ", " . $skillid . ", " . $userid . ", 'Pending', '" . $description . "', DEFAULT);";

    $rs = pg_query($con, $query) or die(pg_last_error($con));

    if ($rs) {
        return TRUE;
    }

    return FALSE;
}

$errorArray = [];

if (count($_POST) > 0 && isset($_POST['SubmitButton'])) {

    if (isset($_POST['projectAppSkill']) && empty($_POST['projectAppSkill'])) {
        array_push($errorArray, "None of the role selected");
    }

    if (isset($_POST['applicationmsg']) && empty($_POST['applicationmsg'])) {
        array_push($errorArray, "Description box is empty");
    }

    if (!empty($errorArray)) {
        echo "<script type='text/javascript'>alert('Please check your submission details again');</script>";
        header("./single-project.php?id=" . $_POST['projectAppId']);
    } else {
        $projectId = $_POST['projectAppId'];
        $projectSkill = $_POST['projectAppSkill'];
        $userId = $_SESSION['userId'];
        $userDesc = $_POST['applicationmsg'];

        $apply = projectApplication($projectId, $projectSkill, $userId, $userDesc);

        if ($apply) {
            $applicationSuccess = TRUE;
        } else {
            $error = TRUE;
        }
    }
    ?>
    <script>location.reload(true);</script>
    <?php

}
?>

