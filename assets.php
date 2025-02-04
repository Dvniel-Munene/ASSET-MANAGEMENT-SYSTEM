<?php
  $page_title = 'AMS | All Assets';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(2);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>ALL EQUIPMENT ASSETS</span>
          </strong>
        </div>
        <div class="pull-right">
          <a href="add_asset.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Photo</th>
              <th>Asset Code</th>
              <th>Asset Name</th>
              <th>Asset Brand</th>
              <th>Asset Model No</th>
              <th>Asset Serial No</th>
              <th>Asset Price (Ksh)</th>
              <th>Purchase Location</th>
              <th>Asset Receipt No</th>
              <th>Quantity</th>
              <th>Asset Accessories</th>
              <th>Asset Status</th>
              <th>Asset Category</th>
              <th>Created</th>
              <th>Action</th>
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

            // Query to get all assets
            $sql = "SELECT id, file, eq_code, eq_name, eq_brand, eq_model, serial_no, cost, purchase_location, receipt_no, quantity, accessories, eq_status, eq_cat, created FROM equipment";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result && $result->num_rows > 0) {
              $count = 1; // Initialize count for numbering
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='text-center'>" . $count++ . "</td>";
                
              // Determine the correct image path based on the asset category
              switch ($row['eq_cat']) {
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
                    echo "<td><img src='" . htmlspecialchars($imagePath) . "' alt='' class='img-responsive' style='height: 60px; width: 80px;'></td>";
                  } else {
                    echo "<td>Image not available</td>";
                  }


                echo "<td>" . htmlspecialchars($row['eq_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['eq_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['eq_brand']) . "</td>";
                echo "<td>" . htmlspecialchars($row['eq_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['serial_no']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cost']) . "</td>";
                echo "<td>" . htmlspecialchars($row['purchase_location']) . "</td>";
                echo "<td>" . htmlspecialchars($row['receipt_no']) . "</td>";
                echo "<td class='text-center'>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['accessories']) . "</td>";

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

                echo "<td>" . htmlspecialchars($row['eq_cat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                echo "</td>";
                      echo "<td class='text-center'>";
                      echo "<div class='btn-group'>";
                      echo "<a href='edit_asset.php?id=" . (int)$row['id'] . "' class='btn btn-warning btn-xs' title='Edit' data-toggle='tooltip'>";
                      echo "<span class='glyphicon glyphicon-edit' style='font-size: 20px;'></span>";
                      echo "</a>";
                      echo "<a href='delete_asset.php?id=" . (int)$row['id'] . "' class='btn btn-danger btn-xs' title='Delete' data-toggle='tooltip' style='margin-top:8px'>";
                      echo "<span class='glyphicon glyphicon-trash' style='font-size: 20px;'></span>";
                      echo "</a>";
                      echo "</div>";
                      echo "</td>";
                      echo "</tr>";
              }
            } else {
              // If no data is returned, show this row
              echo "<tr><td colspan='14' class='text-center'>No Equipment found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
