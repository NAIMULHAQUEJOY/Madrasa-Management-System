<?php 
    require_once('../../Model/db.php');

    $message="";

    function loginReq($id,$pass){
        $conn = conn();
        $sql1 = "select * from login where id = '$id' AND pass = '$pass';";
        $r = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($r) == 1){
            return array(true, mysqli_fetch_assoc($r)['class']);    
        }
        else{return array(false, '');}
    }

     function showAllDonations(){
        $conn = conn();
        $sql2 = "select * from donators;";
        $showDonationResults = mysqli_query($conn, $sql2);
       
        
            return $showDonationResults;
        
    }

     function showAllEvents(){
        $conn = conn();
        $sql3 = "select * from event;";
        $showEvents = mysqli_query($conn, $sql3);
        if(mysqli_num_rows($showEvents))
        {
            return $showEvents;
        }
        return null;
        
    }

    function deleteTransaction($SL) {
    $conn = conn(); // Make sure conn() function is available

    $sql4 = "DELETE FROM donators WHERE SL='$SL';";
    $deleteTransaction = mysqli_query($conn, $sql4);

    if ($deleteTransaction) {
        showAllDonations();
        header("Location: ../../Controller/Admin/donationController.php");
        exit();
    }
}



    function searchTransaction($SL) {
        $conn = conn(); // Make sure conn() function is available

    $SL = mysqli_real_escape_string($conn, $SL);
    $sql5 = "SELECT * FROM donators WHERE SL='$SL'";
    $searchTransaction = mysqli_query($conn, $sql5);

    if ($searchTransaction) {
        return $searchTransaction;
    } else {
        return false;
    }
}

function insertEvent($eventName, $status, $goal, $description){
    $conn = conn(); 
    if ($status == 1) {
        $sql6 = "UPDATE event SET status = 0";
        $result = mysqli_query($conn, $sql6);
        if (!$result) {
            die('Error updating status: ' . mysqli_error($conn));
        }
    }
    
    $sql7 = "INSERT INTO event(eventName,status,goal,description)VALUES ('$eventName', '$status', '$goal', '$description')";
    $result = mysqli_query($conn, $sql7);

    
    if (!$result) {
        die('Error inserting event: ' . mysqli_error($conn));
    }

    return $result;
    $eventName="";
    $status="";
    $goal="";
    $description="";
    header("Location: ../../View/Admin/donations.php");
    exit();
}

    function launchEvent($eventId)
    {
        $conn = conn();
    $sql8 = "UPDATE event SET status = 0";
    mysqli_query($conn, $sql8); 
    $sql9 = "UPDATE event SET status = 1 WHERE eventId = '$eventId'";
    mysqli_query($conn, $sql9); 
    
    header("Location: donations.php");
    exit();

    }

     function deactivateEvent($eventId)
    {
        $conn = conn();
        $sql10 = "UPDATE event SET status = 1 WHERE eventId = 0";
    mysqli_query($conn, $sql10); 
    $sql11 = "UPDATE event SET status = 0 WHERE eventId = '$eventId'";
    mysqli_query($conn, $sql11); 
    
    header("Location: donations.php");
    exit();

    }

    function calculateTotalFunds() {
    $conn = conn();
    $sql12 = "SELECT SUM(Amount) as total_funds FROM donators";
    $result = mysqli_query($conn, $sql12);

    if ($result) {
        $totalFunds = mysqli_fetch_assoc($result)['total_funds'];
        return $totalFunds;
    } else {
        return 0; // Return 0 if there's an error fetching the total funds
    }
}

function showAllGrave(){
        $conn = conn();
        $sql13 ="SELECT * FROM grave_yard order by pending desc;";
       $showAllGrave = mysqli_query($conn, $sql13);
       
        
            return $showAllGrave;
        
    }
 
    function approveGrave($C_ID)
{
    $conn = conn();
    $sql14 = "UPDATE grave_yard SET pending = 0, rejected = 0, booked = 1 WHERE C_ID = '$C_ID'";
    mysqli_query($conn, $sql14);

    header("Location:../../Controller/Admin/graveManagementController.php");
    exit();
}


    function rejectGrave($C_ID)
    {
        $conn = conn();
        $C_ID = $_GET['rejected'];
     $sql15 = "UPDATE grave_yard SET rejected = 1,booked = 0,pending=0 WHERE C_ID = '$C_ID'";
    mysqli_query($conn, $sql15); 
    
    header("Location:../../Controller/Admin/graveManagementController.php");
    exit();

    }

    function deleteGrave($C_ID) {
    $conn = conn(); // Make sure conn() function is available

    $C_ID = $_GET['grave'];
    $sql16 = "DELETE FROM grave_yard WHERE C_ID='$C_ID'";
    $deleteGrave = mysqli_query($conn, $sql16);

    if ($deleteGrave) {
        showAllGrave();
        header("Location:../../Controller/Admin/graveManagementController.php");
        exit();
    }
}


function totalBurried() {
    $conn = conn();
    $sql17 = "SELECT COUNT(*) as total_buried FROM grave_yard WHERE booked = 1";
    $totalBurried = mysqli_query($conn, $sql17);

    if ($totalBurried) {
        $totalBurried = mysqli_fetch_assoc($totalBurried)['total_buried'];
        return $totalBurried;
    } else {
        return 0; // Return 0 if there's an error fetching the total funds
    }
}

function showAllNotice(){
        $conn = conn();
        $sql18 = "SELECT notice,date FROM notice";
        $showAllNotice = mysqli_query($conn, $sql18);
        return  $showAllNotice;
        header("Location:../../Controller/Admin/noticeController.php");
        exit();
    }

function postNotice($notice)
{
    $conn = conn();
    $sql19 = "INSERT INTO notice (notice) VALUES ('$notice')";

    $result=mysqli_query($conn,$sql19);

    if($result)
    {
        showAllNotice();
        header("Location: ../../Controller/Admin/noticeController.php");

        exit();

    }


}

function inputTeacherReg($teacherName, $bloodgroup, $dob, $age, $email, $pass, $cvFile) {
    $conn = conn(); 

    if (isset($_POST['submit'])) 
    {
        if (empty($teacherName) || empty($bloodgroup) || empty($dob) || empty($age) || empty($email) || empty($pass) || empty($cvFile)) 
        {
            $error = "Fields are missing. Please fill in all the fields.";
        } 
        else 
        {
            // Use prepared statements to prevent SQL injection
            $sql20 = "INSERT INTO teacherRegistration(teacherName, bloodgroup, dob, age, email, pass, cvFilePath) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql20);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssss", $teacherName, $bloodgroup, $dob, $age, $email, $pass, $cvFile);
                $result = mysqli_stmt_execute($stmt);
                
                if ($result) 
                {
                    $message = "Success!";
                    
                    header("Location:../../View/Admin/teacher_registration.php"); // Redirect to a success page
                    exit();
                } else {
                    $error = "Error inserting data into the database: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                $error = "Error preparing the SQL statement: " . mysqli_error($conn);
            }
        }
    }
}
function showAllApplications(){
        $conn = conn();
        $sql22 = "SELECT * FROM teacherregistration";
        $showAllApplications = mysqli_query($conn, $sql22);
        return  $showAllApplications;
       // header("Location:'../../Controller/Admin/logCheckController.php'");
        exit();
    }

    function approveApplication($teacherId)
{
    $conn = conn();
    $teacherId = $_GET['approve'];
    $sql23 = "UPDATE teacherregistration SET pending = 0, reject = 0, approve = 1 WHERE teacherId = '$teacherId'";
    mysqli_query($conn, $sql23);

    
    $emailQuery = "SELECT email FROM teacherRegistration WHERE teacherId = '$teacherId'";
    $emailResult = mysqli_query($conn, $emailQuery);
    if ($emailRow = mysqli_fetch_assoc($emailResult)) {
        $to_email = $emailRow['email'];
        $subject = "Darussalam Notifications";
        $body = "Hi, Your application has been approved.";
        $headers = "From: darussalamtest@gmail.com";

        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...\n";
        } else {
            echo "Email sending failed...\n";
        }
    }

    header("Location:../../Controller/Admin/applicationController.php");
    exit();
}


    function rejectApplication($teacherId)
    {
        $conn = conn();
        $teacherId = $_GET['rejected'];
     $sql24 = "UPDATE teacherregistration SET pending = 0, reject= 1,approve=0 WHERE teacherId = '$teacherId'";
    mysqli_query($conn, $sql24); 
    
       header("Location:../../Controller/Admin/applicationController.php");
    exit();

    }

    function deployMail($email) {
        $conn=conn();
        //$email=$_GET['email'];
   // $sql25 = "SELECT email FROM teacherRegistration WHERE approve = 1";
   // $result = mysqli_query($conn, $sql25);

    //if ($result) {
       // while ($row = mysqli_fetch_assoc($result)) {
            $to_email = $email;
            $subject = "Darussalam Notifications";
            $body = "Hi, Your application has been approved.";
            $headers = "From: darussalamtest@gmail.com";

            if (mail($to_email, $subject, $body, $headers)) {
                echo "Email successfully sent to $to_email...\n";
            } else {
                echo "Email sending failed...\n";
            }
        }
    //} else {
       // echo "Error: " . mysqli_error($conn);
   // }
//}








        
?>
