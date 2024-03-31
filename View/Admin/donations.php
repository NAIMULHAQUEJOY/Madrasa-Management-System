<?php

require('../../Controller/global/sessionCheck.php');
if (isset($_POST['logout'])) {
                
                header('location: ../../Controller/global/logout.php');
                }

require_once('../../Model/Admin/alldb.php');
$showALLDonationResults = showAllDonations();
$showEvents = showAllEvents();
$totalFunds=calculateTotalFunds(null);


// Handle form submission
//if (isset($_GET['del']) && isset($_GET['trx'])) {
//    deleteTransaction($_GET['trx']);
//}

$searchTransaction = null;
if (isset($_GET['ser']) && isset($_GET['trx'])) {
    $searchTransaction = searchTransaction($_GET['trx']);
}

if (isset($_POST['enterEvent'])) {
    $eventName = $_POST['eventName'];
    $status = $_POST['status'];
    $goal = $_POST['goal'];
    $description = $_POST['description'];
    insertEvent($eventName, $status, $goal, $description);
}

if (isset($_POST['launch'])) {
    launchEvent($_POST['launch']);
}

if (isset($_POST['deactivate'])) {
    deactivateEvent($_POST['deactivate']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donations</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body style="background-color: #eddded;">

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
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/adminController.php" style="color: whitesmoke;">HOME</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/donationController.php" style="color: goldenrod;">DONATONS</a></b></td>
     
            <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">TEACHER</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/graveManagementController.php" style="color: whitesmoke;">GRAVE MANAGEMENT</a></b></td>
           <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">STUDENTS</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/noticeController.php" style="color: whitesmoke;">NOTICE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/applicationController.php" name="application" style="color: whitesmoke;">APPLICATIONS</a></b></td>
            <form method="post">
            <td width="11.1111%" align="center"><button type="submit" name="logout" style="color: whitesmoke;background: none;border: none;font-size: 15px;"><b>LOGOUT</b></button></td>
        </form>
        </tr>
    </table>
    <br><br>

    <div style="color:goldenrod;font-size: 20px;"><h1><center>DONATIONS</center></h1></div>
    <div style="position: relative; width: 100px; height: 100px; border-radius: 50%; text-align: center; font-size: 20px; color: purple; background-color: lavenderblush; float: right;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
           TOTAL
        <?php echo $totalFunds; ?> /-
    </div>
</div>
<fieldset style="width: 600px;background-color: lavenderblush;">
<details>
       <summary>Create an event</summary>
       <br><br>
    <form method="post" action="donations.php">
    Enter Event Name: <input type="text" name="eventName"><br><br>
    Status:              <input type="number" name="status"><br><br>
    Goal:             <input type="number" name="goal"><br><br>
    Description:      <input type="text" name="description"><br><br>
    <button name="enterEvent">ENTER</button>

    </form>

    </details>
    </fieldset>

    <br><br>
    <fieldset style="width: 600px;background-color: lavenderblush;">
<details>
    <form id="deleteTrx" method="post" action="donations.php">
        <details>
    <summary>Delete  a transaction</summary>
    Delete a Transaction: <input type="number" name="trx" id="trxInput">
    <button type="button" id="deleteBtn">DELETE</button>

    <!--<?php echo $message;?>-->
    </details>

    <br><br>
</form>

<summary>DELETE TRANSACTION</h4></summary>
    <div  style="width: 70%; margin: 0 auto; padding: 20px; border: 3px solid purple; height: 300px;overflow: auto;">
        <table border="0" color="blue">
            <tr>
                <th>Serial Number</th>
                <th>Email</th>
                <th>Name</th>
                <th>Region</th>
                <th>Amount</th>
                <th>Message</th>

            </tr>
            <tr>
               
            </tr>
            <tr>
            <div id="donationTableContainer">
            <?php while($show = mysqli_fetch_assoc($showALLDonationResults))
             {?>


            
                <form>
            <tr>
                <td> <?php echo $show['SL'] ?></td>
                <td> <?php echo $show['Email'] ?> </td>
                <td> <?php echo $show['Name'] ?> </td>
                <td> <?php echo $show['Region'] ?> </td>
                <td> <?php echo $show['Amount'] ?> </td>
                <td> <?php echo $show["Email"]; ?> </td>
                <td> <?php echo $show['Message'] ?> </td>
            
           
            </tr>

        <?php } ?>
    </form>
            </tr>
        </table>
</details> 
</fieldset>

 <br><br>

<fieldset style="width: 600px; background-color: lavenderblush;">
<details>
    
<summary>SHOW ALL EVENTS HISTORY</h4></summary>
    <div style="width: 70%; margin: 0 auto; padding: 20px; border: 3px solid purple; height:150px;overflow: auto">

        <table border="0" color="blue">
            <tr>
                <th>EVENT ID</th>
                <th> </th>
                <th>EVENT NAME</th>
                <th> </th>
                <th>STATUS</th>
                <th> </th>
                <th>GOAL</th>
                <th> </th>
                <th>DESCRIPTION</th>
               
            </tr>
            <tr>
               
            </tr>
            <tr>
            <?php 
            while($show = mysqli_fetch_assoc($showEvents)) 
        {?>
            
                <form method="post">
             <tr style="background-color: <?php echo $show['status'] == 1  ? 'goldenrod;' : ''; ?>">
                <td> <?php echo $show['eventId'] ?></td>
                <td> </td>
                <td> <?php echo $show['eventName'] ?> </td>
                <td> </td>
                <td> <?php echo $show['status'] ?> </td>
                <td> </td>
                <td> <?php echo $show['goal'] ?> </td>
                <td> </td>
                <td> <?php echo $show['description'] ?> </td>
                <td> </td>
                <td><button type="submit" name="launch" value="<?php echo $show["eventId"]; ?>">LAUNCH</button> </td>
                <td> </td>
                <td><button type="submit" name="deactivate" value="<?php echo $show["eventId"]; ?>">DEACTIVATE</button> </td>
            </tr>

        <?php } ?>
    </form>
            </tr>
        </table>
    </div>
</details>
</fieldset>


<br><br>
<fieldset style="width: 600px; background-color: lavenderblush;">
<details>
    
<summary>Live Search</h4></summary>
    <div style="width: 70%; margin: 0 auto; padding: 20px; border: 3px solid purple; height:150px;overflow: auto">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

     <input type="text" class="form-control" id="liveSearch" autocomplete="off" placeholder="Search ...">
     <div id="searchresult"></div>
     
     
     <script type="text/javascript">
        $(document).ready(function(){
            $("#liveSearch").keyup(function(){
                var input= $(this).val();
                //alert(input);
                if (input!= ""){

                   $.ajax({

                    url:"livesearch.php",
                    method:"Post",
                    data:{input:input},
                    success: function(data){
                        $("#searchresult").html(data);

                    }


                   });
                } else if(input==""){
                    $("#searchresult").css("display","block");
                


                }

            }); 
        });

         
     </script>
     <div id="deleteresult"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#deleteBtn").click(function(){
            var input = $("#trxInput").val();
            if (input != ""){
                $.ajax({
                    url: "liveDonationDelete.php",
                    method: "POST",
                    data: {trx: input},
                    success: function(data){
                        $("#deleteresult").html(data);
                        refreshDonationTable(); // Call a function to refresh the table
                    }
                });
            }
        });
    });

    function refreshDonationTable() {
        // Fetch updated table data
        $.ajax({
            url: 'fetchDonationTable.php', // You need to create this PHP file
            method: 'GET',
            success: function(data) {
                $('#donationTableContainer').html(data); // Update the table container
            }
        });
    }
</script>

    </div>
</details>
</fieldset>

<br><br>


<fieldset style="width: 600px;background-color: lavenderblush;">
<details>
    
<summary>SHOW ALL TRANSACTION HISTORY</h4></summary>
    <div style="width: 70%; margin: 0 auto; padding: 20px; border: 3px solid purple; height: 300px;overflow: auto;">

        <table border="0" color="blue">
            <tr>
                <th>Serial Number</th>
                <th>Email</th>
                <th>Name</th>
                <th>Region</th>
                <th>Amount</th>
                <th>Message</th>

            </tr>
            <tr>
               
            </tr>
            <tr>
        <?php
              $showALLDonationResults = showAllDonations(); // Fetch results again

                 while ($show = mysqli_fetch_assoc($showALLDonationResults)) {
?>
    <tr>
        <td><?php echo $show['SL'] ?></td>
        <td><?php echo $show['Email'] ?></td>
        <td><?php echo $show['Name'] ?></td>
        <td><?php echo $show['Region'] ?></td>
        <td><?php echo $show['Amount'] ?></td>
        <td><?php echo $show["Email"]; ?></td>
        <td><?php echo $show['Message'] ?></td>
    </tr>
    <?php } ?>

    </form>
            </tr>
        </table>
</details>
</fieldset>


</body>

</html>
