<?php
session_start();
$eventId = NULL;
$eventName = NULL;
$goal = NULL;
$description = NULL;
$servername = "localhost";
$email = "root";
$password = "";
$database = "darussalam";
// Generating a unique token for the form
$token = uniqid();
$progress = 0;
// Storing the token in the session
if (!isset($_SESSION['form_tokens'])) 
{
    $_SESSION['form_tokens'] = [];
}

$_SESSION['form_tokens'][] = $token;

$conn = mysqli_connect($servername, $email, $password, $database);
$nameError = $emailError = $regionError = $amountError = "";
$donorwall = "SELECT donators.*, event.eventName FROM donators JOIN event ON donators.eventId = event.eventId ORDER BY donators.SL DESC;";
$eventSql = "select * from event where status = 1;";

$result = mysqli_query($conn, $donorwall);
$eventResult = mysqli_query($conn, $eventSql);
$rowCount = mysqli_num_rows($eventResult);

if($rowCount > 0)
{
    while ($e = $eventResult->fetch_assoc()) 
    {
        $eventId = $e["eventId"];
        $eventName = $e["eventName"];
        $goal = $e["goal"];
        $description = $e["description"];
    }
}
else
{
    $developementOnly = 1;  
}
$amSql = "SELECT SUM(amount) AS totalAmount FROM donators WHERE eventId = $eventId;";

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $amount = $_POST['amount'];
    $message = $_POST['message'];

    // Validate the input fields
    if (empty($name)) {
        $nameError = "Name is required";
    }

    if (empty($email)) {
        $emailError = "Email is required";
    }

    if (empty($region)) {
        $regionError = "Region is required";
    }

    if (empty($amount)) {
        $amountError = "Amount is required";
    }

    if (empty($nameError) && empty($emailError) && empty($regionError) && empty($amountError)) {
        $submittedToken = $_POST['token'];

        if (in_array($submittedToken, $_SESSION['form_tokens'])) {
            // Form submission is valid; insert data into the database
            $sql = "INSERT INTO donators (Name, Email, Region, Amount, Message, eventId) VALUES ('$name', '$email', '$region', $amount, '$message','$eventId')";
            mysqli_query($conn, $sql);
            $result = mysqli_query($conn, $donorwall);
            //echo $token;
            // Remove the token from the used tokens
            $_SESSION['form_tokens'] = array_diff($_SESSION['form_tokens'], [$submittedToken]);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation-Darusslam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="media\logo-darussalam.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: purple;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b319a6;
        }

        label {
            font-size: 1rem;
        }

        .error {
            font-size: 11px;
            color: red;
        }

        legend {
            color: purple;
        }

        body {
            background color: purple;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .custom-button {
            color: purple;
            padding: 0 10px 0px 10px;
            animation: border-color-change 5s infinite;
            border-radius: 20px;
            cursor: pointer;
        }

        .custom-button:hover 
        {
            color: #b319a6; 
        }

        .donationcontent 
        {
            width: 100%;
            font-size: 18px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea 
        {
            width: 60%;
            padding: 10px;
            margin-top: 5px;
        }


        input[type="submit"] 
        {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover
        {
            text-decoration-color: white;
            background: #b319a6;
            ;
        }


        input[type="button"] 
        {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .fieldset-rgb 
        {
            border: 2px solid white;
            border-radius: 7px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: border-color-change 5s infinite;
        }

        .fieldset-none 
        {
            border: 1px solid white;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        @keyframes border-color-change 
        {
            0% { border-color: rgb(255, 0, 0);}

            25% { border-color: rgb(0, 255, 0);}

            50% { border-color: rgb(0, 0, 255);}

            75% { border-color: rgb(255, 255, 0);}

            100% { border-color: rgb(255, 0, 255);}
        }

         .text-animation span::before 
        {
            content: "Every Donation...";
            color: red;
            animation: animate infinite 3s;
            padding-left: 10px;
        }

        abbr { text-decoration: none;}

        abbr:hover {text-decoration: underline;}

        @keyframes animate 
        {
            0% 
            {
                content: "Every Donation...";
                color: red;
            }

            50% 
            {
                content: "makes a...";
                color: blue;
            }

            75% 
            {
                content: "Difference!";
                color: green;
            }
        }

        .green-text 
        {
            color: forestgreen;
            font-weight: bold;
        }

        .containerz 
        {
            background-color: white;
            width: 100%;
            padding: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        .menu-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0; /* Remove any margins */
            padding: 0; /* Remove any padding */
        }

        .menu-row, .menu-column {
            background-color: purple;
            border: 0;
            border-color: transparent;
            margin: 0; /* Remove any margins */
            padding: 0; /* Remove any padding */
        }


        .menu-button {
            text-decoration: none;
            color: white;
            padding: 9px 20px;
            background: purple;
            border: none;
            border-radius: 0px;
            cursor: pointer;
            transition: background 0.3s;
            display: inline-block;
            text-align: center;
        }

            .menu-button:hover {
                background: #b319a6;
                padding: auto;
            }

        .logo-container {
            width: 126px; /* Set the size of the circular container */
            height: 89px;
            border-radius: 0%; /* Make it round */
            background-color: purple; /* Set the background color as needed */
            position: absolute;
            top: 48%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the container */
            transition: box-shadow 0.5s ease-in-out;
            box-shadow: 0 0 20px purple;
        }

            .logo-container:hover {
                box-shadow: 0 0 20px white; /* White box shadow on hover */
            }

        /* Style for the round logo image */
        .round-logo {
            width: 124px; /* Set the size of the logo */
            height: 87px;
            border-radius: 0%; /* Make the image round */
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the image within the container */
            z-index: 2;
        }
    </style>
</head>
<body>
    <table width="100%" height="7px" border="collapse" class="menu-table">
        <tr>
            <td colspan="9" style="position: relative;">
                <video width="100%" height="90px" style="object-fit: cover;" autoplay loop muted>
                    <source src="media\landingpagevideo.mp4" type="video/mp4">
                </video>
                <div class="logo-container">
                    <a href="landing.php">
                        <img src="media\logo-darussalam.png" class="round-logo">
                    </a>
                </div>

            </td>
        </tr>
        <tr class="menu-row">
            <td width="11.1111%" align="center">
                <a href="landing.php" class="menu-button"><b><i class="fa-solid fa-house" style=" margin-right: 5px;"></i>HOME</b></a>

                <a href="donation.php" class="menu-button"><b><i class="fa-solid fa-circle-dollar-to-slot" style=" margin-right: 5px;"></i>DONATE</b></a>
                <a href="#" class="menu-button"><b><i class="fa-solid fa-book" style=" margin-right: 5px;"></i>LIBRARY</b></a>
                <a href="landbook.php" class="menu-button"><b><i class="fa-solid fa-ticket" style=" margin-right: 5px;"></i>GRAVE</b></a>
                <a href="#" class="menu-button"><b><i class="fa-solid fa-bullhorn" style=" margin-right: 5px;"></i>MAHFIL</b></a>
                <a href="#" class="menu-button"><b><i class="fa-solid fa-user-tie" style=" margin-right: 5px;"></i>TRUSTEE</b></a>
                <a href="#" class="menu-button"><b><i class="fa-solid fa-clock-rotate-left" style=" margin-right: 5px;"></i>HISTORY</b></a>
                <a href="login.php" class="menu-button"><b><i class="fa-solid fa-user" style=" margin-right: 5px;"></i>LOGIN</b></a>
                <a href="apply.php" class="menu-button"><b><i class="fa-solid fa-user-plus" style=" margin-right: 5px;"></i>Apply Now</a>
            </td>
        </tr>
    </table><br>
    <div class="containerz">
        <h2 style="text-align: center;">
            Join us in our mission to educate and inspire Muslims and make your donation a continuous source of<br>
            <span class="green-text">Sadaqa Jariyah</span>
        </h2>
    </div></div>
    <table border="0" width="100%">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td style="text-align: right;">
                <div style="display: inline-block; text-align: center;">
                    <fieldset class="fieldset-none" style="width: auto; max-width: 300px; background: white;">
                        <h2 style="text-align: center; color: #7b7805">Donors Wall</h2><hr style="border-color: transparent;">
                        <div style="overflow: auto; height: 600px;">
                            <table style="width: auto;">
                                <?php
                                
                                if ( $rowCount > 0)
                                {
                                $amountresult = mysqli_query($conn, $amSql);

                                if ($amountresult) {
                                    $row = mysqli_fetch_assoc($amountresult);
                                    $progress = $row['totalAmount'];
                                    }
                                }

                                while ($r = $result->fetch_assoc()) 
                                    {
                                       

                                ?>
                                <tr>
                                    <td>
                                        <span style="color: purple;"><b><?php echo $r["Name"]; ?></b></span> donated
                                        <span style="color: darkgoldenrod;"><b><?php echo $r["Amount"]; ?></b></span> ৳ for <b><span style="color: #392ba7;"><?php echo $r["eventName"]; ?></span>;
                                        <span style="color: darkgreen;"><?php echo $r["Message"]; ?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><hr style="border-color: burlywood;"></td>
                                </tr>
                                <?php } ?>
                        </div>
    </table>
    </b></td>
    </fieldset>
    <td style="width: auto; text-align: center;">
        <?php 
        if ( $rowCount == 0)
            {
                echo "<span style='color: #7b7805;'><b>Your Donation goes to Darussalam's development.</b></span>";

            }?>
        <fieldset class="fieldset-rgb" style="width: auto; min-width: 400px; background: white;">
            <legend style="width: auto;">
                <p class="text"><h2 class="text-animation"><span></span></h2></p>


            </legend>
            <form method="post">

                <label for="name"><b>Name</b></label>
                <input type="text" name="name" id="name" placeholder="Enter your name"><br>
                <span class="error"><?php echo $nameError; ?></span><br>
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" id="email" placeholder="Enter your email"><br>
                <span class="error"><?php echo $emailError; ?></span><br>
                <label for="region"><b>Region</b></label>
                <input type="text" name="region" id="region" placeholder="Enter your region"><br>
                <span class="error"><?php echo $regionError; ?></span><br>
                <hr width="60%">
                <label for="donation_type" style="text-align: left; font-weight: bold;">Donation Type</label><br>
                <hr width="80%">
                <input type="radio" name="donation_type" id="one_time" value="one_time" checked>
                <label for="one_time"><b>One Time Donation</b></label>
                <input type="radio" name="donation_type" id="monthly" value="monthly">
                <label for="monthly"><b>Monthly Donation</b></label>
                <br>
                <label for="amount" style="font-weight: bold;">Amount</label>
                <input type="number" name="amount" id="amount" placeholder="Enter amount">
                <span class="error"><?php echo $amountError; ?></span><br>

                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='100'"><h4>৳100</h4></button>
                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='500'"><h4>৳500</h4></button>
                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='1000'"><h4>৳1000</h4></button>
                <br>

                <label for="message"><b>Message</b></label>
                <textarea name="message" id="message" placeholder="Enter your message" ;></textarea>

                <br>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="submit" name="submit" value="Donate">

                <?php
                if(isset($_POST['donation_type']) && $_POST['donation_type'] == 'monthly' && empty($nameError) && empty($emailError) && empty($regionError) && empty($amountError))
                {
                echo "<h3 style='color: blue;'>You can log in to edit your recurring donation any time</h3>";
                }
                ?>
                </div>

                <?php

                if (isset($_POST['submit']) && isset($_POST['donation_type']) && empty($nameError) && empty($emailError) && empty($regionError) && empty($amountError))
                {
                $sqlSl = "SELECT MAX(SL) AS latest_serial FROM donators;";
                $latestSlSql = mysqli_query($conn, $sqlSl);

                if ($latestSlSql) {
                $row = $latestSlSql->fetch_assoc();
                $latestSerial = $row['latest_serial'];
                }

                $name = $_POST['name'];
                $email = $_POST['email'];
                $region = $_POST['region'];
                $amount = $_POST['amount'];
                $message = $_POST['message'];
                $donation_type = $_POST['donation_type'];
                echo '<fieldset class="fieldset-rgb">
                    ';
                    echo "<legend><b><h3>JazakAllah Khair</h3></b></legend>";
                    echo "<p><b>SL:</b> $latestSerial</p>";
                    echo "<p><b>Name:</b> $name</p>";
                    echo "<p><b>Email:</b> $email</p>";
                    echo "<p><b>Region:</b> $region</p>";
                    echo "<p><b>Amount:</b> $amount</p>";
                    echo "<p><b>Message:</b> $message</p>";
                    echo "<p><b>Donation Type:</b> $donation_type</p>";
                    echo "
                </fieldset>";
                $_SESSION['form_submitted'] = false;

                }

                ?>
            </form>


        </fieldset>
        </div>
    </td>
    <td colspan="3">
        <?php 
         if ( $rowCount > 0){
        echo '<b>Fundraising for: <span style="color: #7b7805;"><abbr title="' . $description . '">' . $eventName . '</abbr></span></b><br>';
        
        $ppbar=($progress*100)/$goal ; ?>
        <label for="progress"><b>Raised (<span style="color: purple;"><?php echo round($ppbar, 2); ?>%</span>) </b></label><b>৳<span style="color: darkgreen;"><?php echo $progress; ?></span> of <span style="color: darkred;"> <?php echo $goal; ?></span>৳</b><br>
        <progress id="file" max="100" value="<?php echo $ppbar; ?>" style="width: 100%; max-width: 300px; min-width: 225px; height: 20px; background: #f0f0f0;">
            <?php echo $progress; }
            
            ?>

        </progress>

        <style>
            #file::-webkit-progress-value {
                background: purple;
                color: white;
                border-radius: 20px;
            }

            #file::-webkit-progress-bar {
                background: white; /* Background color */
                border: 1px solid purple; /* Border color */
                border-radius: 20px;
            }
        </style>

        <br><br>
        <fieldset class="fieldset-none" style="width: auto; max-width: 300px; min-width: 220px; background: white;">

            <h2 style="text-align: center; color: #7b7805;">Questions?</h2>
            <details>
                <summary style="color: purple;  cursor: pointer;text-align:  left ;">Do you accept Zakat?</summary>

                <p>We do not accept Zakat. We only accept Sadaqah.</p>

            </details>
            <br>
            <details>
                <summary style="color: purple;  cursor: pointer; text-align:  left ;">I don’t have online Card Payment options. How do I donate?<br> </summary>

                <p>Kindly mail us at <a href="mailto:contact@ds.org">contact@ds.org</a> so that we can figure out a suitable way for you to contribute.</p>

            </details>
            <br>
            <details>
                <summary style="color: purple; cursor: pointer;text-align:  left ;">Do you accept donations via PayPal?</summary>
                <p>Yes, we do. Please visit our PayPal fundraiser page to donate via PayPal.</p>
            </details> <br>
            </div>
        </fieldset><br><br>
        <fieldset class="fieldset-none" style="width: auto; max-width: 300px; min-width: 220px;background: white;">
            <h2 style="text-align: center; color: #7b7805;">Contact Us</h2>
            <a href="https://www.facebook.com" class="fa-brands fa-facebook fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.instagram.com" class="fa-brands fa-instagram fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.linkedin.com" class="fa-brands fa-linkedin fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.twitter.com" class="fa-brands fa-twitter fa-xl" style="text-decoration: none;" target="_blank"></a><br>
            <br>

            Darussalam is registered by BD as charity, registration no. 1178251
        </fieldset>

    </td>
    </tr>
    </table>
    </div>
    <hr width="82%">


</body>
</html>
