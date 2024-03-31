<?php 
   require_once('../../Controller/Admin/logCheckController.php')
    
?>



<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="icon"  href="logo-darussalam.png" type="image/x-icon">
    </head>
    <body style="background-color:#EDDDED;">
        <center>
            <fieldset style="width: 30%; border: 5px #800080 solid; position:relative; background-color: #FFFFFF;">
                <img src="..\Media\logo-darussalam.png">
                <form method="post">
                    <input style="font-size: 20px; width: 300px;" align="center" type="text" name = "id"  placeholder="Username">
                    <br><span style="color:#FF0000;"><?php echo $u_wrong?></span>
                    <br><input style="font-size: 20px; width: 300px;" align="center" type="password" name = "pass" placeholder="Password">
                    <br><span style="color:#FF0000;"><?php echo $p_wrong?></span>
                    <br><button style="font-size: 20px; width: 310px; background-color: #800080; color:#FFFFFF;" type="submit" name="LogIn">Log In</button><br><br>
                </form>
                
                <?php
                    
                ?>
            </fieldset>
        </center>
    </body>
</html>