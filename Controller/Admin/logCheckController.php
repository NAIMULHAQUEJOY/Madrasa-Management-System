<?php
    require_once('../../Model/Admin/alldb.php');
    
    session_start();

    $u_wrong = $p_wrong = '';

    if(isset($_POST['LogIn'])){
        if($_POST['id'] == '') {
            $u_wrong = 'Please enter username';
        }
        if($_POST['pass'] == '') {
            $p_wrong = 'Please enter password';
        } else {
            $access = loginReq($_POST['id'], $_POST['pass']);
            if($access[0]){
                $_SESSION['id'] = $_POST['id'];
                $_SESSION['userClass'] = $access[1];
                switch($access[1]){
                    case 's': header("location: ../../View/Student/home.php"); break;
                    case 't': header("location: ../../View/Teacher/home.php"); break;
                    case 'a': header("location: ../../Controller/Admin/adminController.php"); break;
                    default: echo 'error'; break;
                }
            } else {
                $p_wrong = 'Incorrect Password';
            }
        }
    } 
?>
