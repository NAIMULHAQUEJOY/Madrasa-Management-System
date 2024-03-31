<?php


require_once('../../Model/db.php');

$conn = conn();

if(isset($_POST['grave'])) {
    $input = $_POST['grave'];

    $query = "DELETE FROM grave_yard WHERE C_ID='{$input}';";
    if (mysqli_query($conn, $query)) {
        echo "<h6 class='text-success text-center mt-3'>Grave Deleted Successfully</h6>";
    } else {
        echo "<h6 class='text-danger text-center mt-3'>Error Deleting Grave</h6>";
    }
}
?>
