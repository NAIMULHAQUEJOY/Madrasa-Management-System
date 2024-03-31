<?php

require('../../Controller/global/sessionCheck.php');
if (isset($_POST['logout'])) {
                
                header('location: ../../Controller/global/logout.php');
                }

require_once('../../Model/Admin/alldb.php');

$showAllGrave=showAllGrave();
//$approveGrave=approveGrave();
//$rejectGrave=rejectGrave();

if (isset($_GET['approve'])) {
    approveGrave($_GET['approve']);
}


if (isset($_GET['rejected'])) {
    rejectGrave($_GET['rejected']);
}

if (isset($_GET['del']) && isset($_GET['grave'])) {
    deleteGrave($_GET['grave']);
}

$totalBurried=totalBurried();


  
 //mysqli_query($conn, $sql1);
//$sql3 = "SELECT COUNT(*) as total_buried FROM grave_yard WHERE booked = 1";
//$showTotalBuried = mysqli_query($conn, $sql3);
//$totalBuried = mysqli_fetch_assoc($showTotalBuried)['total_buried'];

 

 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Grave_Management</title>
</head>
<body>
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
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/donationController.php" style="color: whitesmoke;">DONATONS</a></b></td>
     
            <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">TEACHER</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/graveManagementController.php" style="color: goldenrod;">GRAVE MANAGEMENT</a></b></td>
           <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">STUDENTS</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/noticeController.php" style="color: whitesmoke;">NOTICE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/applicationController.php" name="application" style="color: whitesmoke;">APPLICATIONS</a></b></td>
            <form method="post">
            <td width="11.1111%" align="center"><button type="submit" name="logout" style="color: whitesmoke;background: none;border: none;font-size: 15px;"><b>LOGOUT</b></button></td>
        </form>
        </tr>
    </table>
    <br><br><br>


  <div style="position: relative; width: 100px; height: 100px; border-radius: 50%; text-align: center; font-size: 15px; color: purple; background-color: goldenrod; float: right; top: 100px;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        TOTAL Burried:
        <?php echo $totalBurried; ?>
    </div>
</div>

   

    <form method="get" action="grave_management.php">
        Delete a Grave Request: <input type="number" name="grave" id="graveInput">
    <button type="button" id="delGraveBtn">Delete</button>

    <?php echo $message;?>

    <br><br>
</form>

           <summary style="border: 2px solid purple; padding: 2px; background-color: #eddded;"><h4 style="color:darkblue; margin: 0;"><center>Grave Request Grant Permission</center></h4></summary>
    <div style="width: 52%; margin: 0 auto; padding: 10px; border: 3px solid purple; height: 300px;overflow: auto;">
        <table border="0" color="blue">
            <tr>
                <th>C_ID</th>
                <th>NAME</th>
                <th>MOBILE</th>
                <th>REPRESENTATIVE NAME</th>
                <th>EXPIRING DATE</th>
                <th>CHECK BOX</th>
                <th>BOOKED</th>
                <th>REJECTED</th>
                <th>PENDING</th>

            </tr>
            <tr>
               
            </tr>
            <tr>
                <div id="graveTableContainer">
            <?php while($show=mysqli_fetch_assoc($showAllGrave)) 
        {?>
            
             <form>
            <tr style="background-color: <?php echo $show['pending'] == 1 ? 'goldenrod;' : ''; ?>">
                <td> <?php echo $show['C_ID'] ?></td>
                <td> <?php echo $show['Name'] ?> </td>
                <td> <?php echo $show['mobile'] ?> </td>
                <td> <?php echo $show['Representative_name'] ?> </td>
                <td> <?php echo $show['Expiring_date'] ?> </td>
                <td> <?php echo $show["checkbox"]; ?> </td>
                <td> <?php echo $show['booked'] ?> </td>
                 <td> <?php echo $show['rejected'] ?> </td>
                  <td> <?php echo $show['pending'] ?> </td>
                  <td><button type="submit" name="approve" value="<?php echo $show["C_ID"]; ?>">APPOVE</button> </td>
                 <td><button type="submit" name="rejected" value="<?php echo $show["C_ID"]; ?>">REJECT</button> </td>
            
           
            </tr>

        <?php } ?>
    </form>
            </tr>
          </form>

        </table>
    </div>

    <div id="deleteGraveResult"></div>

<script type="text/javascript">
$(document).ready(function(){
    $("#delGraveBtn").click(function(){
        var input = $("#graveInput").val();
        if (input != ""){
            $.ajax({
                url: "liveGravedelete.php",
                method: "POST",
                data: {grave: input},
                success: function(data){
                    $("#deleteGraveResult").html(data);
                    refreshGraveTable(); 
                    updateTotalBuried(); // Update total buried count
                    
                }
            });
        }
    });
});

function refreshGraveTable() {
    $.ajax({
        url: 'fetchGraveTable.php',
        method: 'GET',
        success: function(data) {
            $('#graveTableContainer').html(data); // Replace the content completely
        }
    });
}


</script>





</body>
</html>