<?php
session_start();

require_once('../../Model/db.php');

$conn=conn();
$error = "";
$message = "";
  $statusMessage = "";


if (isset($_POST['statusBtn'])) {
    $status = $_POST['statusInput'];

    // Check the status based on the email entered
    $sqlCheckStatus = "SELECT * FROM teacherRegistration WHERE email = '$status'";
    $resultStatus = mysqli_query($conn, $sqlCheckStatus);

    if ($resultStatus) {
        $statusData = mysqli_fetch_assoc($resultStatus);

        if ($statusData) {
            if ($statusData['pending'] == 1) {
                $_SESSION['statusMessage'] = '<span style="color: yellow;">&#x25CF;</span> Your request is pending';
            } elseif ($statusData['approve'] == 1) {
                $_SESSION['statusMessage'] = '<span style="color: green;">&#x25CF;</span> Your request is approved';

                // Send email notification
                $to_email = $status; // or $statusData['email'] if it exists
                $subject = "Darussalam Notifications";
                $body = "Dear Applicant,\n\nCongratulations! Your request has been approved. You can now proceed with further instructions.\n\nRegards,\nDarussalam Complex";
                $headers = "From: darussalamtest@gmail.com"; // Update with your sender email

                if (mail($to_email, $subject, $body, $headers)) {
                    echo "Email successfully sent to $to_email...";
                } else {
                    echo "Email sending failed...";
                }

            } elseif ($statusData['reject'] == 1) {
                $_SESSION['statusMessage'] = '<span style="color: red;">&#x25CF;</span> Your request is rejected';
            }
        } else {
            $_SESSION['statusMessage'] = "No application found for the entered email";
        }
    } else {
        $_SESSION['statusMessage'] = "Error checking status: " . mysqli_error($conn);
    }

    header("Location: $_SERVER[PHP_SELF]");
    exit();
}


// Check for and display the status message
if (isset($_SESSION['statusMessage'])) {
    $statusMessage = $_SESSION['statusMessage'];
    unset($_SESSION['statusMessage']); // Clear the session variable
}

if (isset($_POST['submit'])) {
    $teacherName = $_POST['teacherName'];
    $bloodgroup = $_POST['bloodgroup'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = ($_POST['pass']);
    $cvfile=$_FILES['cvFile']['name'];
    $pending=1;
    $tempfile=$_FILES['cvFile']['tmp_name'];
    $folder="cv/".$cvfile;
    //$cvFileError = $_FILES['cvFile']['error'];
    $sql20 = "INSERT INTO teacherRegistration(teacherName, bloodgroup, dob, age, email, pass, cvFilePath,pending) VALUES ('$teacherName', '$bloodgroup', '$dob', '$age', '$email', '$password', '$cvfile',$pending)";


                $result = mysqli_query($conn,$sql20);
                
                if ($result) 
                {
                    move_uploaded_file($tempfile,$folder);
                    $message = "Success!";
                    
                    header("Location:../../View/Admin/teacher_registration.php"); // Redirect to a success page
                    exit();
                } else {
                    $error = "Error inserting data into the database: " . mysqli_error($conn);
                }
            

    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BECOME A TEACHER</title>

     <style>
        /* Style for the small box */
        .small-box {
            position: absolute;
            top: 350px; /* Adjust the top position as needed */
            right: 20px; /* Adjust the right position as needed */
            width: 300px;
            height: 300px;
            background-color: #eddded; /* Change the background color */
            border: 1px solid black;
            padding: 10px;
            z-index: 9999;
        }
    </style>

    <script type="text/javascript">
        function validateForm() {
            var teacherName = document.forms["registrationForm"]["teacherName"].value;
            var bloodgroup = document.forms["registrationForm"]["bloodgroup"].value;
            var dob = document.forms["registrationForm"]["dob"].value;
            var age = document.forms["registrationForm"]["age"].value;
            var email = document.forms["registrationForm"]["email"].value;
            var password = document.forms["registrationForm"]["pass"].value;
            var cvFile = document.forms["registrationForm"]["cvFile"].value;

            if (teacherName == "" || bloodgroup == "" || dob == "" || age == "" || email == "" || password == "" || cvFile == "") {
                alert("All fields must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <table width="100%" height="7px" border="7">
        <tr>
            <td colspan="9" style="position: relative;">
                <video width="100%" height="100px" style="object-fit: cover;" autoplay loop muted>
                    <source src="landingpagevideo.mp4" type="video/mp4">
                    
                </video>
                <img height="100px" src="logo-darussalam.png" style="z-index: 2;position: absolute; left:45%;">
            </td>
        </tr>
        <tr bgcolor="purple">
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/landingController.php" style="color: goldenrod;">HOME</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/donationsController.php" style="color: white;">DONATE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">LIBRARY</a></b></td>
            <td width="11.1111%" align="center"><b><a href="landbook.php" style="color: white;">GRAVE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">MAHFIL</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">TRUSTEE</a></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: lightblue; border: none; cursor: pointer;"><a href="../../Controller/Admin/teacherRegController.php" style="color: white; text-decoration: none;font-size: 12px;">BECOME A TEACHER</a></button></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: lightblue; border: none; cursor: pointer;"><a href="../../Controller/Admin/logcontroller.php" style="color: white; text-decoration: none;">LOGIN</a></button></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: white; border: none; cursor: pointer;"><a href="apply.php" style="color: white; text-decoration: none;">APPLY NOW</a></button></b></td>
        </tr>
    </table>

     <div class="small-box">
        <!-- Content for the small box -->
        <h4>Want to know about your application status?</h4>
        <form method="post">
            Email: <input type="text" name="statusInput"></input>
            <center><button name="statusBtn">Status</button></center>
        </form>
        <?php echo isset($statusMessage) ? $statusMessage : ''; ?>
    </div>


    <center>
    <fieldset style="width: 600px;">
        <legend align="center"> <h1>Register</h1></legend>
        <form method="post" action="../../Controller/Admin/teacherRegController.php" enctype="multipart/form-data"  name="registrationForm" onsubmit="return validateForm()">
            NAME: <input type="text" name="teacherName"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            BLOODGROUP: <input type="text" name="bloodgroup"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            DOB:    <input type="date" name="dob"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            Age:    <input type="number" name="age"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            Email:  <input type="text" name="email"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            Password: <input type="password" name="pass"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>

            CV (PDF only): <input type="file" name="cvFile"> <br><br>
            <span style="color: red;"><?php echo $error; ?></span><br>
            <button type="submit" name="submit">Submit</button><br>
            <?php echo $message; ?>
        </form>
    </fieldset>
    <br><br>
</body>
</html>