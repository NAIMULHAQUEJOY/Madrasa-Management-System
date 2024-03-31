<?php
//require_once('../../Controller/global/sessionCheck.php');
require('../../Controller/global/sessionCheck.php');
if (isset($_POST['logout'])) {
                
                header('location: ../../Controller/global/logout.php');
                }


//require_once('../../Controller/Admin/logCheckController.php');
require_once('../../Model/Admin/alldb.php');
$totalFunds = calculateTotalFunds(null);
$noticeResults=showAllNotice();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="Admin.css"> <!-- Link to your external CSS file -->

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
    width: 30%;
    margin-right: 10px;
    padding: 10px;
    border: 3px solid black;
    background-color: #f8f8f8;
    float: right;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: auto;
    position: relative;
    top: -240px; /* Increased value to move up significantly */
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
<body>

    <table>
        <tr>
            <td colspan="9">
                <video autoplay loop muted>
                    <source src="landingpagevideo.mp4" type="video/mp4">
                </video>
                <img class="logo" src="logo-darussalam.png">
            </td>
        </tr>

        <tr class="bg-purple">
            <td class="link"><b><a href="../../Controller/Admin/adminController.php" class="home">HOME</a></b></td>
            <td class="link"><b><a href="../../Controller/Admin/donationController.php">DONATONS</a></b></td>
            <td class="link"><b><a href="#">TEACHER</a></b></td>
            <td class="link"><b><a href="../../Controller/Admin/graveManagementController.php">GRAVE MANAGEMENT</a></b></td>
            <td class="link"><b><a href="#">STUDENTS</a></b></td>
            <td class="link"><b><a href="../../Controller/Admin/noticeController.php">NOTICE</a></b></td>
            <td class="link"><b><a href="../../Controller/Admin/applicationController.php" name="application">APPLICATIONS</a></b></td>
            <form method="post">
            <td width="11.1111%" align="center"><button type="submit" name="logout" style="color: whitesmoke;background: none;border: none;font-size: 15px;"><b>LOGOUT</b></button></td>
                
        </form>
        </tr>
    </table>
    <br><br><br>

    Total Funds <br>
    <div class="funds">
        <?php echo $totalFunds; ?>
    </div>

    Total Students <br>
    <div class="students">
        <!-- Student count will be dynamically added here -->
    </div>

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
