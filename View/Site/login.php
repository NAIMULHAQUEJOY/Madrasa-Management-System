<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="icon"  href="..\Media\logo-darussalam.png" type="image/x-icon">
    </head>
    <body style="background-color:#EDDDED;">
        <center>
            <fieldset style="width: 30%; border: 5px #800080 solid; position:relative; top:150px; background-color: #FFFFFF;">
                <a href="landing.php"><img src="..\Media\logo-darussalam.png" width="400px"></a>
                <form method="post" action="../../Controller/Site/loginController.php">
                    <input style="font-size: 20px; width: 300px;" align="center" type="text" name = "id"  placeholder="Username">
                    <br><span style="color:#FF0000;"></span>
                    <br><input style="font-size: 20px; width: 300px;" align="center" type="password" name = "pass" placeholder="Password">
                    <br><span style="color:#FF0000;"></span>
                    <br><button style="font-size: 20px; width: 310px; background-color: #800080; color:#FFFFFF;" type="submit" name="LogIn">Log In</button><br><br>
                </form>
            </fieldset>
        </center>
    </body>
</html>