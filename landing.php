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
            <td width="11.1111%" align="center"><b><a href="landing.php" style="color: goldenrod;">HOME</a></b></td>
            <td width="11.1111%" align="center"><b><a href="Controller/Admin/donationControler.php" style="color: white;">DONATE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">LIBRARY</a></b></td>
            <td width="11.1111%" align="center"><b><a href="landbook.php" style="color: white;">GRAVE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">MAHFIL</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">TRUSTEE</a></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: lightblue; border: none; cursor: pointer;"><a href="teacher_registration.php" style="color: white; text-decoration: none;font-size: 12px;">BECOME A TEACHER</a></button></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: lightblue; border: none; cursor: pointer;"><a href="Controller/Admin/logcontroller.php" style="color: white; text-decoration: none;">LOGIN</a></button></b></td>
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



    <div style="width: 20%;margin: -50px auto 0; padding: 10px; border: 3px solid black; float: right;height: 300px">
    <!-- Notices will be dynamically added here -->
    <legend align="center"> <h2 style="color: orangered;">NOTICE</h2></legend>
    <?php
        // Fetch and display notices from the database
        while($notice = mysqli_fetch_assoc($noticeResults)) {
            echo '<div style="margin-bottom: 10px;">' . $notice['notice'] . '</div>';
        }
    ?>
</div>

</body>
</html>
