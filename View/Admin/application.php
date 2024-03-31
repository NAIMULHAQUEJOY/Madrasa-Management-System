<?php

require('../../Controller/global/sessionCheck.php');
if (isset($_POST['logout'])) {
                
                header('location: ../../Controller/global/logout.php');
                }

require_once('../../Model/Admin/alldb.php');



// ... (previous code)

if (isset($_GET['approve'])) {

    approveApplication($_GET['approve']);
}

// ... (remaining code)



if (isset($_GET['rejected'])) {
    rejectApplication($_GET['rejected']);
}

 $showAllApplications=showAllApplications();



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>APPLICATION</title>

   

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
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/graveManagementController.php" style="color: whitesmoke;">GRAVE MANAGEMENT</a></b></td>
           <td width="11.1111%" align="center"><b><a href="#" style="color: whitesmoke;">STUDENTS</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/noticeController.php" style="color: whitesmoke;">NOTICE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="../../Controller/Admin/applicationController.php" name="application" style="color: goldenrod;">APPLICATIONS</a></b></td>
            <form method="post">
            <td width="11.1111%" align="center"><button type="submit" name="logout" style="color: whitesmoke;background: none;border: none;font-size: 15px;"><b>LOGOUT</b></button></td>
        </form>
        </tr>
    </table>
    <br><br><br>


</form>

           <summary style="border: 2px solid purple; padding: 2px; background-color: #eddded;"><h4 style="color:darkblue; margin: 0;"><center>Appications</center></h4></summary>
           <br>


    <div style="width: 90%; margin: 0 auto; padding: 10px; border: 3px solid purple; height: 300px;overflow: auto;">
        <table border="1" color="blue">
            <tr>
                <th>APPLICANT_ID</th>
                <th>NAME</th>
                <th>BLOOD GROUP</th>
                <th>DATE OF BIRTH</th>
                <th>AGE</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>CV</th>
                <th>PENDING</th>
                <th>APPROVE</th>
                <th>REJECT</th>

            </tr>
            <tr>
               
            </tr>
            <tr>
                <div id="applicationTableContainer">
            <?php while($show=mysqli_fetch_assoc($showAllApplications)) 
        {?>
            

             <form method="get">
            <tr style="background-color: <?php echo $show['pending'] == 1 ? 'goldenrod;' : ''; ?>">
                <td> <?php echo $show['teacherId'] ?></td>
                <td> <?php echo $show['teacherName'] ?> </td>
                <td> <?php echo $show['bloodgroup'] ?> </td>
                <td> <?php echo $show['dob'] ?> </td>
                <td> <?php echo $show['age'] ?> </td>
                <td> <?php echo $show['email']; ?> </td>
                <td> <?php echo $show['pass'] ?> </td>
                 <td> <a href="../../Controller/Admin/cv/<?php echo $show['cvFilePath']?>"> <?php echo $show['cvFilePath'] ?> </a></td>
                  <td> <?php echo $show['pending'] ?> </td>
                  <td> <?php echo $show['approve'] ?> </td>
                    <td> <?php echo $show['reject'] ?> </td>
                  <td><button type="submit" name="approve" value="<?php echo $show["teacherId"]; ?>">APPOVE</button> </td>
                 <td><button type="submit" name="rejected" value="<?php echo $show["teacherId"]; ?>">REJECT</button> </td>
            
           
            </tr>

        <?php } ?>
    </form>
            </tr>
          </form>

        </table>
    </div>


</body>
</html>