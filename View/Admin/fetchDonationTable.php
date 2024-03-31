<?php
require_once('../../Model/db.php');

$conn = conn();
$query = "SELECT * FROM donators;";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {?>
     <table class="table table-bordered table-striped mt-4">  
        <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Amount</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($show = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($show['SL']) . '</td>';
                    echo '<td>' . htmlspecialchars($show['Email']) . '</td>';
                    echo '<td>' . htmlspecialchars($show['Name']) . '</td>';
                    echo '<td>' . htmlspecialchars($show['Region']) . '</td>';
                    echo '<td>' . htmlspecialchars($show['Amount']) . '</td>';
                    echo '<td>' . htmlspecialchars($show['Message']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>


<?php
} else {
    echo "<h6 class='text-danger text-center mt-3'>NO DATA FOUND</h6>";
}
?>
