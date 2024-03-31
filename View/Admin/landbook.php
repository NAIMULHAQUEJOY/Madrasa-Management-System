<?php
session_start();
$resultSession = 0;
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "darussalam"; 
$conn = new mysqli($servername, $username, $password, $dbname);
$cookie_value="purple";
$savebox = "";
$numRows = 22;
$numCols = 30;
$cookie_value2="";
$cookie_name = "cookie_name";
$cookie_value3="";
$cookie_name2 = "";
$cookie_name3 = "__";
$session_name="Guest";
$nameError="";
$dateError="";
$mobileError="";
$mobileeError="";
$inserted = 0;
setcookie($cookie_name3, $cookie_value3, time() + 150000);
$approvedList = array();
for ($row = 0; $row < $numRows; $row++) {
    for ($col = 0; $col < $numCols; $col++) {
        $approvedList[$row][$col] = ""; // Initialize each element
    }
}

$pendingList = array();
for ($row = 0; $row < $numRows; $row++) {
    for ($col = 0; $col < $numCols; $col++) {
        $pendingList[$row][$col] = ""; // Initialize each element
    }
}


$rejectedList = array();
for ($row = 0; $row < $numRows; $row++) {
    for ($col = 0; $col < $numCols; $col++) {
        $rejectedList[$row][$col] = ""; // Initialize each element
    }
}

$cookieList = array();
for ($row = 0; $row < $numRows; $row++) {
    for ($col = 0; $col < $numCols; $col++) {
        $cookieList[$row][$col] = ""; // Initialize each element
    }
}


if (isset($_POST['checkup'])) {
    $mobileeE = $_POST['checkMobile'];
    if (empty($mobileeE)) {
        $mobileeError = "Mobile number is required";
    }
}

if (isset($_POST["checkup"]) && $_POST['checkMobile'] != "")
 {
     $_SESSION['on'] = $_POST['checkMobile'];
 }
 if (isset($_SESSION['on']))
 {
     $mobile = $_SESSION['on'];

    

    // Query the database to fetch the relevant data
    $sql = "SELECT C_ID, name, checkbox, booked, rejected, pending FROM grave_yard WHERE mobile = '$mobile'";
    $resultSession1 = ($conn->query($sql));

    if ($resultSession1->num_rows > 0) 
    {
        while ($rowSession = mysqli_fetch_assoc($resultSession1)) 
        {
            $_SESSION['C_ID'] = $rowSession["C_ID"];
            $_SESSION['name'] = $rowSession["name"];
            $_SESSION['booked'] = $rowSession["booked"];
            $_SESSION['rejected'] = $rowSession["rejected"];
            $_SESSION['pending'] = $rowSession["pending"];
            $buttonId = $rowSession["checkbox"];
            list($_, $row, $col) = explode('_', $buttonId);
            if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 1 && $rowSession["rejected"]==0 && $rowSession["pending"] != 1) 
            {
                $approvedList[$row][$col] = $buttonId;
                //echo $approvedList[$row][$col];
            }
            else if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["pending"] == 1) 
            {
                $pendingList[$row][$col] = $buttonId;
            }
            else if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 0 && $rowSession["rejected"]==1) 
            {
                $rejectedList[$row][$col] = $buttonId;
            }
        }  
    }
    else
    {
        $resultSession = 1;
    }
}

if (isset($_POST["session_del"]))
{
    session_unset();
    session_destroy();
    for ($row = 0; $row < $numRows; $row++) {
    for ($col = 0; $col < $numCols; $col++) {
        $approvedList[$row][$col] = "";
        $pendingList[$row][$col] = "";
        $rejectedList[$row][$col] = "";
    }
}
} 


//cookie starts here
if (isset($_POST['cookie_save']))
{
    for ($row = 0; $row < $numRows; $row++) 
    {
        for ($col = 0; $col < $numCols; $col++) 
        {
            $buttonId = "land_${row}_${col}";
            list($__, $rowc, $colc) = explode('_', $buttonId);
            if (isset($_POST[$buttonId])) 
            {
                list($_, $rowc, $colc) = explode('_', $buttonId);

                if ($rowc >= 0 && $rowc < $numRows && $colc >= 0 && $colc < $numCols) 
                {
                    $cookieList[$rowc][$colc] = $buttonId;
                }
                $cookie_name = "cookie_name";
                $savebox= $buttonId;
                //echo $buttonId;
                $cookie_value = "darkcyan";
                setcookie($cookie_name, $cookie_value, time() + 15);
            }
                
        }
                         
    }
}

/*if (isset($_COOKIE["cookie_name"])) 
{
    $username = $_COOKIE["cookie_name"];
    echo "Welcome back, $username!";
} else {
    echo "Cookie not found.";
}
if (isset($_COOKIE["cookie_name2"])) 
{
    $username = $_COOKIE["cookie_name2"];
    echo "Welcome back, $username!";
} else {
    echo "Cookie not found.";
}*/

if (isset($_POST["cookie_del"]))
{
    $cookie_value="purple";
    setcookie("cookie_name","", time() -3600);
    setcookie("cookie_name2","", time() -3600);
}
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Landmarks - Darussalam</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style >
        .hidden-checkbox {display: none;}
        .approved-checkbox {display: none;}
        .pending-checkbox {display: none;}
        .color-button 
        {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }
        .colorappv-button 
        {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }

        .colorpending-button 
        {
            width: 15px;
            height: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: lightgray;
            display: block;
            position: relative;
        }

        .red-text 
        {
            color: red;
            font-weight: bold;
        }

        .green-text 
        {
            color: darkgreen;
            font-weight: bold;
        }

        .purple-text 
        {
            color: purple;
            font-weight: bold;
        }

        .hidden-checkbox:checked + .color-button 
        {
            background-color: <?php echo $cookie_value; ?>; 
        }

        .hidden-checkbox:disabled + .color-button 
        {
            background-color: indianred; 
        }

        .approved-checkbox:checked + .colorappv-button 
        {
            background-color: darkgreen; 
        }

        .approved-checkbox:disabled + .colorappv-button 
        {
            background-color: darkgreen; 
        }

        .pending-checkbox:checked + .colorpending-button 
        {
            background-color: yellow; 
        }

        .pending-checkbox:disabled + .colorpending-button 
        {
            background-color: yellow; 
        }
               
        table 
        { 
            border-collapse: collapse;
            margin: 0 auto;
        }
        td {padding: 3px;}
        .color-box {
            display: inline-block;
            width: 15px;
            height: 20px;
            margin-right: 10px;
        }

        .lightgray { background-color: lightgray; }
        .yellow { background-color: yellow; }
        .cyan { background-color: darkcyan; }
        .darkgreen { background-color: darkgreen; }
        .purple { background-color: purple; }
        .indianred { background-color: indianred; }
        .red { background-color: red; }
        .color-container {
            text-align: center;
            margin: 20px;
        }

    </style>
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
            <td width="11.1111%" align="center"><b><a href="landing.php" style="color: white;">HOME</a></b></td>
            <td width="11.1111%" align="center"><b><a href="donation.php" style="color: white;">DONATE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">LIBRARY</a></b></td>
            <td width="11.1111%" align="center"><b><a href="landbook.php" style="color: goldenrod;">GRAVE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">MAHFIL</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">TRUSTEE</a></b></td>
            <td width="11.1111%" align="center"><b><a href="#" style="color: white;">HISTORY</a></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: lightblue; border: none; cursor: pointer;"><a href="login.php" style="color: white; text-decoration: none;">LOGIN</a></button></b></td>
            <td width="11.1111%" align="center"><b><button style="background-color: purple; color: white; border: none; cursor: pointer;"><a href="apply.php" style="color: white; text-decoration: none;">APPLY NOW</a></button></b></td>
        </tr>
    </table>
    <h1 style="color: purple; text-align: center;">Select landmarks</h1>  
    <div class="color-container">
    <div class="color-box lightgray"></div><label>Choosable</label>
    <div class="color-box indianred"></div><label>Occupied </label>
    <div class="color-box purple"></div><label>Selected </label>
    <div class="color-box cyan"></div><label>Saved choice </label>
    <div class="color-box darkgreen"></div><label>Approved </label>
    <div class="color-box yellow"></div><label>Pending </label>
    <div class="color-box red"></div><label>Rejected</label></div>
    <hr width="80%">

    <form method="post">
       
        <table border="0" style="width: auto;">
            <tr>
                <th >
                    <label for="checkMobile">To check the status of your Application enter the applicant's Mobile Number: </label><input type="text" name="checkMobile" placeholder="Enter your Mobile Number ">
                   
                    <input type="submit" name="checkup" value="Check for Update"><br>
                     <span class="error"><?php echo $mobileeError; ?></span><br>
                </th>
                <th>
                    <fieldset style="width: auto; max-width: 90%; display: inline-block; text-align: right;">
                   ٱلسَّلَامُ عَلَيْكُمْ,  
                   <?php
                    if (isset($_SESSION['on']) && $resultSession != 1 ) 
                    {
                        echo $_SESSION['name'] ;
                    }
                    else
                    {
                        echo "Ikhwan!" ;
                    } ?>
                    </fieldset>
                </th>

            </tr>
            <tr>
                <td>
        <table border="0" style="color: purple;">
            <tr>
                <?php
                    if (isset($_POST["submit"])) 
                    {
                        $selectedCheckboxes = array();
                        for ($row = 0; $row < $numRows; $row++) {
                            echo '<tr>';
                            for ($col = 0; $col < $numCols; $col++) {
                                $buttonId = "land_${row}_${col}";
                                if (isset($_POST[$buttonId])) 
                                {
                                    $selectedCheckboxes[] = $buttonId;
                                } 
                            }
                            echo '</tr>';
                        }

                        $name = $_POST['name'];
                        $name = $_POST['name'];
                        $Representative_name = "Self";
                        $expiringDate = $_POST["expiring_date"];
                        $formattedDate = date('Y-m-d', strtotime($expiringDate));
                        $mobile= $_POST['mobile'];

                        if (empty($name)) 
                        {
                            $nameError = "Name is required";
                        }

                        if (empty($mobile)) {
                            $mobileError = "Mobile Number is required";
                        }

                        if (empty($expiringDate)) {
                            $dateError = "Date is required";
                        }


                        if (empty($nameError) && empty($emailError) && empty($mobileError) && empty($amountError)) 
                        {   
                            if (is_array($selectedCheckboxes) && !empty($selectedCheckboxes)) 
                            {
                            foreach ($selectedCheckboxes as $checkbox)
                            {
                                $sql = "INSERT INTO grave_yard (Name, mobile, Representative_name, Expiring_date, checkbox, booked, rejected, pending) VALUES ('$name',  $mobile, '$Representative_name', '$formattedDate', '$checkbox', 1,0,1)";
                                $conn->query($sql);
                            }

                                echo '<p><b><span class="green-text">Apllication sent Successfully, </span></b>for the Selected Landmark: <b><span class="purple-text">';
                                echo implode(", ", $selectedCheckboxes);
                                echo "</b></span>!</p>";
                                $inserted = 1;
                            } 

                            else { echo '<span class="red-text">No Landmark selected!</span>'; }
                        } 
                    }
                        

                    for ($row = 0; $row < $numRows; $row++) 
                    {
                        echo '<tr>';

                        for ($col = 0; $col < $numCols; $col++) 
                        {
                            $buttonId = "land_${row}_${col}";
                            $sql = "SELECT booked FROM grave_yard WHERE checkbox = '$buttonId' AND booked = 1;";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {$disabled = true;} 
                            else { $disabled = false;}

                                if( $cookieList[$row][$col] == $buttonId  )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='hidden-checkbox' " . ($disabled ? 'disabled' : '') . "checked>";
                                    echo "<label for='$buttonId' class='color-button'></label>";
                                    echo "</td>";

                                }
                            
                            if( isset($_SESSION['on']) && $approvedList[$row][$col] == $buttonId )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='approved-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                    echo "<label for='$buttonId' class='colorappv-button'></label>";
                                    echo "</td>";

                                }
                            if( isset($_SESSION['on']) && $pendingList[$row][$col] == $buttonId )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='pending-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                    echo "<label for='$buttonId' class='colorpending-button'></label>";
                                  //  echo '</label>';
                                    echo "</td>";

                                }

                            else if($cookieList[$row][$col] != $buttonId && $approvedList[$row][$col] != $buttonId && $pendingList[$row][$col] != $buttonId)
                            {
                                echo "<td>";
                                echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='hidden-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                echo "<label for='$buttonId' class='color-button'></label>";
                                echo "</td>";
                            }
                        }
                        echo '</tr>'; 
                    } ?>
            </tr>
        </td>
    </tr>
        </table>
            <td>
                <fieldset>
                <?php
                if (isset($_SESSION['on']) && $resultSession != 1 ) 
                {
                    echo '<h1>User Information</h1><b><hr width="50%" color: purple>';
                    echo  "Customer ID:".$_SESSION['C_ID'] .'<br><hr width="50%">';
                    echo  "Name:".$_SESSION['name'] . '<br><hr width="50%">';
                    echo  "Applied Landmark: ";
                    for ($row = 0; $row < $numRows; $row++) {
                         for ($col = 0; $col < $numCols; $col++) 
                        {
                            if($approvedList[$row][$col] != "")
                            {
                                echo  $approvedList[$row][$col].", ";
                            } 
                            else if($pendingList[$row][$col] != "")
                            {
                                echo  $pendingList[$row][$col].", ";
                            }
                            else if($rejectedList[$row][$col] != "")
                            {
                                echo  $rejectedList[$row][$col].", ";
                            }
                        }
                    }
                    if ($_SESSION['booked'] == 1 && $_SESSION['pending'] != 1) 
                    {
                        echo '<hr width="50%"><div style="display: inline-block; width: 50%;">Status: <h4 style="color: green; display: inline;">Approved!</h4></div><hr width="50%">';
                    } 
                    else if ($_SESSION['rejected'] == 1) 
                    {
                        echo '<hr width="50%"><div style="display: inline-block;">Status: <h4 style="color: red; display: inline;">Rejected!</h4></div><hr width="50%">';
                    } 
                    else if($_SESSION['pending'] == 1)
                    {
                        echo '<hr width="50%"><div style="display: inline-block;">Status: <h4 style="color: yellow; display: inline;">Pending!</h4></div><hr width="50%">';
                    } 
                }
                else if (isset($_SESSION['on']) && $resultSession == 1 ) 
                {
                    echo '<h1 style="color: red;">No Information Found!</h1>';                
                }

                ?>
                <h1 style="color: purple;">Fill out the form below to apply for a new purchase!</h1>
                <label for="name" ><b>Name: </b></label><input type="text" name="name" style="width:auto;"><span class="error"><?php echo $nameError; ?></span><br><br>
                <label for="name" ><b>Mobile: </b></label><input type="text" name="mobile" style="width:auto;"><span class="error"><?php echo $mobileError; ?></span><br><br>
                <b>Expiring Date: </b><input type="date" name="expiring_date"><span class="error"><?php echo $dateError; ?></span><br><br> <br>
                <input type="submit" name="submit" value="Confirm Selection">
                <input type="submit" name="cookie_save" value="Save choice & Refresh">
                <input type="submit" name="cookie_del" value="Clear Cookies"><br> <br>
                
                <?php if (isset($_SESSION['on']))
                { 
                    echo '<input type="submit" name="session_del" value="Log Out">';
                } ?>
            </fieldset>
        </td>
        </table>
    </form>
    
</body>
</html>
