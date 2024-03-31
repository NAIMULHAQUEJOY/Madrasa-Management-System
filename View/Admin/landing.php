<?php 

require_once('../../Model/Admin/alldb.php');


$noticeResults=showAllNotice();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"  href="logo-darussalam.png" type="image/x-icon">
    <title>Darussalam Multipurpose</title>

    <style>
    .notice-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 1px;
        border-bottom: 1px solid #ccc; /* Optional: for better visual separation */
    }

    .notice-board {
    width: 30%; /* Smaller width */
    margin-right: 10px; /* Adjust as needed */
    padding: 10px;
    border: 3px solid black;
    overflow: auto;
    background-color: #f8f8f8;
    float: right; /* Align to the right */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: auto;
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
<body >
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

    <h1 style="color: goldenrod;">Darussalam Islamic Complex</h1>

    <audio controls>
        <source src="landingbackgroundaudio.mp3" type="">
    </audio>
    <video width="576" height="322" controls>
        <source src="landingpagevideo.mp4" type="video/mp4">
    </video>]



      <div class="notice-board">
    <!-- Notices will be dynamically added here -->

    <center background-color="red"><h2>NOTICE BOARD</h2></center>
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
