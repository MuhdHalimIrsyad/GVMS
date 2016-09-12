<?php    
    if (count($_POST) > 0 && isset($_POST['CancelButton'])) {
        
        include 'dbConnection.php';
        
        $projectID = $_POST['projectAppId'];
        $userID = $_SESSION['userId'];
        
        $cancelQuery = "UPDATE volunteerapp SET appstatus = 'Cancelled' WHERE projectid = ".$projectID." AND userid = ".$userID.";";
        
        $cancelRS = pg_query($con, $cancelQuery) or die(pg_last_error($con));
        
        if (pg_affected_rows($cancelRS) > 0) {
            $cancelSuccess = TRUE;
        } else {
            $error = TRUE;
        }
        
         ?>
        <script>location.reload(true);</script>
        <?php
    }
?>
