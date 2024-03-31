<?php
require_once('../../Model/db.php');

$conn = conn();

if(isset($_POST['trx'])) {
    $input = $_POST['trx'];
    $query = "DELETE FROM donators WHERE SL='{$input}';";
    if (mysqli_query($conn, $query)) {
        echo "<h6 class='text-success text-center mt-3'>Transaction Deleted Successfully</h6>";
    } else {
        echo "<h6 class='text-danger text-center mt-3'>Error Deleting Transaction</h6>";
    }
}
?>
