<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_equipment     = count_by_id('equipment');
 $c_repairs       = count_by_id('repairs');
 $c_user          = count_by_id('users');

?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <a href="users.php" style="color:black;">
		<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Users</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="categorie.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="assets.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_equipment['total']; ?> </h2>
          <p class="text-muted">Assets</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-wrench"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_repairs['total']; ?></h2>
          <p class="text-muted">Repairs</p>
        </div>
       </div>
    </div>
	</a>
</div>
  
<div class="row">
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span><a href="audio_assets.php" style="color:black">AUDIO EQUIPMENT</a></span>
                <span class="glyphicon glyphicon-volume-up"></span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $host = 'localhost'; // Your database host
                    $db = 'inventory_system'; // Your database name
                    $user = 'root'; // Your database username
                    $pass = ''; // Your database password

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                       // Query to get assets where asset_cat is Audio Equipment
                       $sql = "SELECT id, eq_name, eq_brand, quantity, eq_status FROM equipment WHERE eq_cat = 'Audio Equipment'";
                       $result = $conn->query($sql);
   

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        $count = 1; // Initialize count for numbering
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_brand']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['quantity']) . "</td>";

                              // Display asset status with corresponding badge color
                              if ($row['eq_status'] == 'Operational') {
                                echo "<td><span class='badge badge-success' style='background-color: green;'>Operational</span></td>";
                            } elseif ($row['eq_status'] == 'Faulty') {
                                echo "<td><span class='badge badge-warning' style='background-color: orange;'>Faulty</span></td>";
                            } elseif ($row['eq_status'] == 'Failed') {
                                echo "<td><span class='badge badge-danger' style='background-color: red;'>Failed</span></td>";
                            } elseif ($row['eq_status'] == 'Under Repair') {
                                echo "<td><span class='badge badge-info' style='background-color:  #0369A3;'>Under Repair</span></td>";
                            } elseif ($row['eq_status'] == 'Retired') {
                                echo "<td><span class='badge badge-dark' style='background-color: darkgray;'>Retired</span></td>";
                            } else {
                                echo "<td><span class='badge badge-secondary' style='background-color: gray;'>Unknown</span></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        // If no data is returned, show this row
                        echo "<tr><td colspan='5' class='text-center'>No Audio Equipment found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

   
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span><a href="visual_assets.php" style="color:black">VISUAL EQUIPMENT</a></span>
                <span class="glyphicon glyphicon-film"></span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $host = 'localhost'; // Your database host
                    $db = 'inventory_system'; // Your database name
                    $user = 'root'; // Your database username
                    $pass = ''; // Your database password

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                       // Query to get assets where asset_cat is Audio Equipment
                       $sql = "SELECT id, eq_name, eq_brand, quantity, eq_status FROM equipment WHERE eq_cat = 'Visual Equipment'";
                       $result = $conn->query($sql);
   

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        $count = 1; // Initialize count for numbering
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_brand']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['quantity']) . "</td>";

                              // Display asset status with corresponding badge color
                              if ($row['eq_status'] == 'Operational') {
                                echo "<td><span class='badge badge-success' style='background-color: green;'>Operational</span></td>";
                            } elseif ($row['eq_status'] == 'Faulty') {
                                echo "<td><span class='badge badge-warning' style='background-color: orange;'>Faulty</span></td>";
                            } elseif ($row['eq_status'] == 'Failed') {
                                echo "<td><span class='badge badge-danger' style='background-color: red;'>Failed</span></td>";
                            } elseif ($row['eq_status'] == 'Under Repair') {
                                echo "<td><span class='badge badge-info' style='background-color:  #0369A3;'>Under Repair</span></td>";
                            } elseif ($row['eq_status'] == 'Retired') {
                                echo "<td><span class='badge badge-dark' style='background-color: darkgray;'>Retired</span></td>";
                            } else {
                                echo "<td><span class='badge badge-secondary' style='background-color: gray;'>Unknown</span></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        // If no data is returned, show this row
                        echo "<tr><td colspan='5' class='text-center'>No Visual Equipment found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span><a href="network_assets.php" style="color:black">NETWORK EQUIPMENT</a></span>
                <span class="glyphicon glyphicon-globe"></span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $host = 'localhost'; // Your database host
                    $db = 'inventory_system'; // Your database name
                    $user = 'root'; // Your database username
                    $pass = ''; // Your database password

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to get assets where asset_cat is Audio Equipment
                    $sql = "SELECT id, eq_name, eq_brand, quantity, eq_status FROM equipment WHERE eq_cat = 'Network Equipment'";
                    $result = $conn->query($sql);

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        $count = 1; // Initialize count for numbering
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['eq_brand']) . "</td>";
                            echo "<td class='text-center'>" . htmlspecialchars($row['quantity']) . "</td>";

                               // Display asset status with corresponding badge color
                            if ($row['eq_status'] == 'Operational') {
                                echo "<td><span class='badge badge-success' style='background-color: green;'>Operational</span></td>";
                            } elseif ($row['eq_status'] == 'Faulty') {
                                echo "<td><span class='badge badge-warning' style='background-color: orange;'>Faulty</span></td>";
                            } elseif ($row['eq_status'] == 'Failed') {
                                echo "<td><span class='badge badge-danger' style='background-color: red;'>Failed</span></td>";
                            } elseif ($row['eq_status'] == 'Under Repair') {
                                echo "<td><span class='badge badge-info' style='background-color:  #0369A3;'>Under Repair</span></td>";
                            } elseif ($row['eq_status'] == 'Retired') {
                                echo "<td><span class='badge badge-dark' style='background-color: darkgray;'>Retired</span></td>";
                            } else {
                                echo "<td><span class='badge badge-secondary' style='background-color: gray;'>Unknown</span></td>";
                            }
  
                            echo "</tr>";
                        }
                    } else {
                        // If no data is returned, show this row
                        echo "<tr><td colspan='5' class='text-center'>No Network Equipment found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span><a href="repairs.php" style="color:black">EQUIPMENT REPAIRS</a></span>
                <span class="glyphicon glyphicon-wrench"></span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Asset Code</th>
                        <th>Reported By</th>
                        <th>Fault Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection details
                    $host = 'localhost'; // Your database host
                    $db = 'inventory_system'; // Your database name
                    $user = 'root'; // Your database username
                    $pass = ''; // Your database password

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to get repair data
                    $sql = "SELECT id, asset_code, reported_by, fault_description, status FROM repairs";
                    $result = $conn->query($sql);

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        $count = 1; // Initialize count for numbering
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['asset_code']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['reported_by']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fault_description']) . "</td>";

                            // Display status with appropriate label
                            echo "<td class='text-center'>";
                            if ($row['status'] == 'Pending') {
                                echo '<span class="badge badge-warning">Pending</span>';
                            } elseif ($row['status'] == 'In Progress') {
                                echo '<span class="badge badge-info" style="background-color: #0369A3;" >In Progress</span>';
                            } elseif ($row['status'] == 'Cancelled') {
                                echo '<span class="badge badge-danger">Cancelled</span>';
                            } else {
                                echo '<span class="badge badge-success">Completed</span>';
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No repairs found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>
