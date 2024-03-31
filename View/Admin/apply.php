

<!DOCTYPE html>
<html>
<head>
    <title>Registration!</title>
    <style>
        form {
            margin: auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        table {
            width: 100%;
            max-width: 400px;
        }
        td {
            padding: 1px; /* Adjusted padding here */
        }
    </style>
</head>
<body style="background-color:#EDDDED;">
    <center>
        <fieldset style="width: 55%; border: 4px #800080 solid; position:relative; top:60px; background-color: #FFFFFF;">
            <form method="post" action="applied.php" enctype="multipart/form-data">
                <img height="80px" src="logo-darussalam.png" style="z-index: 2;position: center; left:45%;">
                <table border="0">
                    <tr>
                        <td><span><label for="name"><h4>Name:</h4></label></span></td>
                        <td><input type="text" id="name" name="name" required></td>
                        <span id="name_error" style="color: red"></span>
                    </tr>
                
                    <tr>
                        <td><span><label for="fathername"><h4>Father's Name: </h4></label></span></td>
                        <td><input type="text" id="fathername" name="fathername" required></td>
                        <span id="fathername_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="mathername"><h4>Mother's Name:</h4></label></span></td>
                        <td><input type="text" id="mathername" name="mathername"required></td>
                        <span id="mathername_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="gender"><h4>Gender:</h4></label></span></td>
                        <td>
                            <input type="radio" id="male" name="gender" value="male"> <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female"> <label for="female">Female</label>
                        </td>
                        <span id="gender_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="guardianname"><h4>Guardian Name:</h4></label></span></td>
                        <td><input type="text" id="guardianname" name="guardianname" required></td>
                        <span id="guardianname_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="relationwithguardian"><h4>Relation with Guardian:</h4></label></span></td>
                        <td><input type="text" id="relationwithguardian" name="relationwithguardian" required></td>
                        <span id="relationwithguardian_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="guardiannidno"><h4>Guardian's NID number:</h4></label></span></td>
                        <td><input type="text" id="guardiannidno" name="guardiannidno" required></td>
                        <span id="guardiannidno_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="email"><h4>Email:</h4></label></span></td>
                        <td><input type="text" id="email" name="email" required></td>
                        <span id="email_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="phone"><h4>Phone:</h4></label></span></td>
                        <td><input type="number" id="phone" name="phone" required></td>
                        <span id="phone_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="praddress"><h4>Present Address:</h4></label></span></td>
                        <td><input type="text" id="praddress" name="praddress" required></td>
                        <span id="praddress_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="peaddress"><h4>Permanent Address:</h4></label></span></td>
                        <td><input type="text" id="peaddress" name="peaddress" required></td>
                        <span id="peaddress_error" style="color: red"></span>
                    </tr>
                    <tr>
                        <td><span><label for="student_picture"><h4>Student's Picture:</h4></label></span></td>
                        <td><input type="file" id="student_picture" name="student_picture" required accept="image/*"></td>
                        <span id="student_picture_error" style="color: red" ></span>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="submit" name="save" value="Apply" style="font-size: 20px;">
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>
</body>
</html>
