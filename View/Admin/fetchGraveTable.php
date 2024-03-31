<?php
require_once('../../Model/db.php');

$conn = conn();
$query = "SELECT * FROM grave_yard ORDER BY pending DESC;";
$result = mysqli_query($conn, $query);
?>
<table class="table table-bordered table-striped mt-4">  
    <thead>
        <tr>
            <th>C_ID</th>
            <th>NAME</th>
            <th>MOBILE</th>
            <th>REPRESENTATIVE NAME</th>
            <th>EXPIRING DATE</th>
            <th>CHECK BOX</th>
            <th>BOOKED</th>
            <th>REJECTED</th>
            <th>PENDING</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(mysqli_num_rows($result) > 0) {
            while($show = mysqli_fetch_assoc($result)) { ?>
                <tr id="graveRow_<?php echo htmlspecialchars($show['C_ID']); ?>" style="background-color: <?php echo $show['pending'] == 1 ? 'goldenrod;' : ''; ?>">
                    <td> <?php echo htmlspecialchars($show['C_ID']); ?></td>
                    <td> <?php echo htmlspecialchars($show['Name']); ?> </td>
                    <td> <?php echo htmlspecialchars($show['mobile']); ?> </td>
                    <td> <?php echo htmlspecialchars($show['Representative_name']); ?> </td>
                    <td> <?php echo htmlspecialchars($show['Expiring_date']); ?> </td>
                    <td> <?php echo htmlspecialchars($show["checkbox"]); ?> </td>
                    <td> <?php echo htmlspecialchars($show['booked']); ?> </td>
                    <td> <?php echo htmlspecialchars($show['rejected']); ?> </td>
                    <td> <?php echo htmlspecialchars($show['pending']); ?> </td>
                    <td><button type="submit" name="approve" value="<?php echo htmlspecialchars($show["C_ID"]); ?>">APPROVE</button></td>
                    <td><button type="submit" name="rejected" value="<?php echo htmlspecialchars($show["C_ID"]); ?>">REJECT</button></td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='9' class='text-center'>NO DATA FOUND</td></tr>";
        }
        ?>
    </tbody>
</table>
