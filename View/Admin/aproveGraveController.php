<?php


    require_once('../../Model/Admin/alldb.php');
    require_once "../../View/Admin/grave_management.php";
    $empty='';
    
    session_start();
    if (isset($_POST['approve'])) 
{

         $C_ID = $_GET['approve'];
         approveGrave($C_ID);   
}


?>