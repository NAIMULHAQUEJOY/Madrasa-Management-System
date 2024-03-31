<?php
require('../../Controller/global/sessionCheck.php');
if (isset($_POST['logout'])) {
                
                header('location: ../../Controller/global/logout.php');
                }

require_once('../../Model/Admin/alldb.php');

$noticeResults=showAllNotice();
$message = '';

if (isset($_GET['submitNotice'])) {
    $postNotice=postNotice($_GET['notice']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>

    <style>
    .notice-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 5px;
        border-bottom: 1px solid #ccc; /* Optional: for better visual separation */
    }

    .notice-date {
        font-weight: bold;
        margin-right: 20px; /* Adjust as needed */
    }

    .notice-text {
        flex-grow: 1; /* Allows the notice text to take up remaining space */
    }
</style>

</head>
<body style="background-color: #eddded;">

    <table width="100%" height="7px" border="7">
        <tr>
            <td colspan="9" style="position: relative;">
                <video width="100%" height="100px" style="object-fit: cover;" autoplay loop muted>
                   <source src="../../View/Admin/landingpagevideo.mp4" type="video/mp4">
                </video>
                <img height="100px" src="../../View/Admin/logo-darussalam.png" style="z-index: 2;position: absolute; left:45%;">
            </td>
        </tr>

        <tr bgcolor="purple">
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/adminController.php" style="color: goldenrod;">HOME</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/donationController.php" style="color: whitesmoke;">DONATONS</a></b></td>
     
            <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">TEACHER</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/graveManagementController.php" style="color: whitesmoke;">GRAVE MANAGEMENT</a></b></td>
           <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">STUDENTS</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/noticeController.php" style="color: goldenrod;">NOTICE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/applicationController.php" name="logout" style="color: whitesmoke;">APPLICATIONS</a></b></td>
            <form method="post">
            <td width="11.1111%" align="center"><button type="submit" name="logout" style="color: whitesmoke;background: none;border: none;font-size: 15px;"><b>LOGOUT</b></button></td>
                <?php

                if (isset($_POST['logout'])) {
                header('location: ../../View/Admin/login.php');
                }
                ?>
        </form>
        </tr>
    </table>
    <br><br><br>

    <div style="width: 40%; margin: 70px auto 0; text-align: center;">
    <form method="get" action="../../View/Admin/notice.php">
        Post a notice: <input type="text" name="notice">
        <button type="submit" name="submitNotice">Submit</button>
        <?php echo $message;?>
    </form>
</div>

  <div style="width: 40%;margin: 70px auto 0; padding: 40px; border: 3px solid black;height: 300px;overflow: auto;">
    <!-- Notices will be dynamically added here -->
    <?php
        // Fetch and display notices from the database
        while($notice = mysqli_fetch_assoc($noticeResults)) {
           echo '<div class="notice-item">';
           echo '<div class="notice-date">' . $notice['date'] . '</div>';
           echo '<div class="notice-text">' . $notice['notice'] . '</div>';
         echo '</div>';
        }
    ?>

    <br><br>
</div>


</body>
</html>
 