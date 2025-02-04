<?php
$page_title = 'All Repairs';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);

// Fetch repair data from the database
$repairs = find_all_repairs();

function find_all_repairs() {
    global $db;
    $sql  = "SELECT * FROM repairs"; // Make sure to select all necessary fields
    return find_by_sql($sql);
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Repairs</span>
                </strong>
                <div class="pull-right">
                    <a href="add_repair.php" class="btn btn-primary">Add Repair</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;">#</th>
                            <th>Asset Code</th>
                            <th>File</th>
                            <th>Quantity</th>
                            <th>Fault Description</th>
                            <th>Repair Action</th>
                            <th>Tech_Name</th>
                            <th>Tech_Contact</th>
                            <th>Cost (Ksh) </th>
                            <th class="text-center" style="width: 15%;">Repair Date</th>
                            <th class="text-center" style="width: 15%;">Repair Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Database connection details
                    $host = 'localhost'; // Database host
                    $db = 'inventory_system'; // Database name
                    $user = 'root'; // Database username
                    $pass = ''; // Database password

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to get all repairs
                    $sql = "SELECT id, file, asset_code, qty, fault_description, repair_action, technician_name, technician_contact, cost, status, date, asset_cat FROM repairs";
                    $result = $conn->query($sql);

                    // Check if there are results
                    if ($result && $result->num_rows > 0) {
                        $count = 1; // Initialize count for numbering
                        while ($row = $result->fetch_assoc()) {
                          
                            echo "<td class='text-center'>" . $count++ . "</td>";
                            echo "<td>" . remove_junk($row['asset_code']) . "</td>";

                            // Determine the correct image path based on the asset category
                            switch ($row['asset_cat'] ?? null) { // Handle potential null case
                                case 'Audio Equipment':
                                    $imagePath = './uploads/img/audio/' . htmlspecialchars($row['file']);
                                    break;
                                case 'Visual Equipment':
                                    $imagePath = './uploads/img/visual/' . htmlspecialchars($row['file']);
                                    break;
                                case 'Network Equipment':
                                    $imagePath = './uploads/img/network/' . htmlspecialchars($row['file']);
                                    break;
                                default:
                                    $imagePath = ''; // No valid category, leave path empty
                                    break;
                            }

                            // Check if the image file exists, otherwise show "Image not available"
                            if (!empty($row['file']) && file_exists($imagePath)) {
                                echo "<td><img src='" . htmlspecialchars($imagePath) . "' alt='' class='img-responsive' style='height: 70px; width: 80px;'></td>";
                            } else {
                                echo "<td>Image not available</td>";
                            }

                            // Display the rest of the data
                            echo "<td>" . remove_junk($row['qty']) . "</td>";
                            echo "<td>" . remove_junk($row['fault_description']) . "</td>";
                            echo "<td>" . remove_junk($row['repair_action']) . "</td>";
                            echo "<td>" . remove_junk($row['technician_name']) . "</td>";
                            echo "<td>" . remove_junk($row['technician_contact']) . "</td>";
                            echo "<td>" . remove_junk($row['cost']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td class='text-center'>";
                            
                            // Display the repair status with appropriate label
                            if ($row['status'] == 'Pending') {
                                echo '<span class="label label-warning">Pending</span>';
                            } elseif ($row['status'] == 'In Progress') {
                                echo '<span class="label label-info">In Progress</span>';
                            } else {
                                echo '<span class="label label-success">Completed</span>';
                            }

                            echo "</td>";
                            echo "<td class='text-center'>";
                            echo "<div class='btn-group'>";
                            echo "<a href='edit_repair.php?id=" . (int)$row['id'] . "' class='btn btn-warning btn-xs' title='Edit' data-toggle='tooltip'>";
                            echo "<span class='glyphicon glyphicon-edit' style='font-size: 20px;'></span>";
                            echo "</a>";
                            echo "<a href='delete_repair.php?id=" . (int)$row['id'] . "' class='btn btn-danger btn-xs' title='Delete' data-toggle='tooltip' style='margin-left:8px'>";
                            echo "<span class='glyphicon glyphicon-trash' style='font-size: 20px;'></span>";
                            echo "</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13' class='text-center'>No repairs found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
