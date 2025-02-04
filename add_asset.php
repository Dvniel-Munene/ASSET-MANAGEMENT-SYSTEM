<?php
$page_title = 'AMS|New Asset';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['add_asset'])) {
    // Define the required fields for a repair request
    $req_fields = array('eq_code', 'eq_name', 'eq_brand', 'eq_model', 'serial_no', 'cost', 'purchase_location', 'receipt_no', 'quantity', 'accessories', 'eq_status', 'eq_cat');
    validate_fields($req_fields);
    
    if (empty($errors)) {
        // Escape user input
        $eq_code = $db->escape($_POST['eq_code']);
        $eq_name = $db->escape($_POST['eq_name']);
        $eq_brand = $db->escape($_POST['eq_brand']);
        $eq_model = $db->escape($_POST['eq_model']);
        $serial_no = $db->escape($_POST['serial_no']);
        $cost = $db->escape($_POST['cost']);
        $purchase_location = $db->escape($_POST['purchase_location']);
        $receipt_no = $db->escape($_POST['receipt_no']);
        $quantity = $db->escape((int)$_POST['quantity']);
        $accessories = $db->escape($_POST['accessories']);
        $eq_status = $db->escape($_POST['eq_status']);
        $eq_cat = $db->escape($_POST['eq_cat']);
        $file = $db->escape($_POST['file']);
        $created = make_date();  // Current date when the form is submitted

        // Insert into the equipment table
        $sql  = "INSERT INTO equipment (";
        $sql .= "eq_code, eq_name, eq_brand, eq_model, serial_no, cost, purchase_location, receipt_no, quantity, accessories, eq_status, eq_cat, file, created";
        $sql .= ") VALUES (";
        $sql .= "'{$eq_code}','{$eq_name}','{$eq_brand}','{$eq_model}','{$serial_no}', '{$cost}', '{$purchase_location}', '{$receipt_no}', '{$quantity}','{$accessories}','{$eq_status}', '{$eq_cat}','{$file}', '{$created}'";
        $sql .= ")";

        // Execute the query and provide feedback
        if ($db->query($sql)) {
            $session->msg('s', "New Asset Record Successfully added.");
            redirect('assets.php', false);
        } else {
            $session->msg('d', 'Sorry, failed to add New Asset Record! ' . $db->error);
            redirect('add_asset.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_asset.php', false);
    }
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
          <span>NEW ASSET FORM</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_asset.php">
          <div class="form-group">
            <label for="asset_code">Equipment Code</label>
            <input type="text" class="form-control" name="eq_code" placeholder="Enter Equipment Code [AUDXXX for Audio, VISXXX for Visual, NETXXX for Network]" required>
          </div>
          <div class="form-group">
            <label for="eq_name">Equipment Name</label>
            <input type="text" class="form-control" name="eq_name" placeholder="Enter Equipment Name" required>
          </div>
          <div class="form-group">
            <label for="eq_brand">Equipment Brand</label>
            <input type="text" class="form-control" name="eq_brand" placeholder="Enter Equipment Brand" required>
          </div>
          <div class="form-group">
            <label for="eq_model">Equipment Model</label>
            <input type="text" class="form-control" name="eq_model" placeholder="Enter Equipment Model Number" required>
          </div>
          <div class="form-group">
            <label for="serial_no">Equipment Serial Number</label>
            <input type="text" class="form-control" name="serial_no" placeholder="Enter Equipment Serial Number" required>
          </div>
           <div class="form-group">
            <label for="cost">Equipment Cost</label>
            <input type="text" class="form-control" name="cost" placeholder="Enter Equipment Purchase Cost/Price [XXXX.XX]" required>
          </div>
          <div class="form-group">
            <label for="purchase_location">Equipment Purchase Location</label>
            <input type="text" class="form-control" name="purchase_location" placeholder="Enter Equipment Purchase Location [Name of Store/Shop/Suparmarket/Online Platform etc]" required>
          </div>
          <div class="form-group">
            <label for="receipt_no">Equipment Receipt Number</label>
            <input type="text" class="form-control" name="receipt_no" placeholder="Enter Equipment Receipt Number" required>
          </div>
          <div class="form-group">
            <label for="quantity">Equipment Quantity</label>
            <input type="text" class="form-control" name="quantity" placeholder="Enter Number of Purchased Equipment" required>
          </div>
          <div class="form-group">
            <label for="accessories">Equipment Accessories</label>
            <textarea class="form-control" name="accessories" placeholder="Enter All Accessories That Came With The Equipment" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="eq_status">Equipment Status</label>
            <select class="form-control" name="eq_status" required>
              <option value="Operational">Operational</option>
              <option value="Faulty">Faulty</option>
              <option value="Failed">Failed</option>
              <option value="Unknown">Unknown</option>
              <option value="Under Repair">Under Repair</option>
              <option value="Retired">Retired</option>
            </select>
          </div>
          <div class="form-group">
            <label for="eq_cat">  Equipment Category</label>
            <select class="form-control" name="eq_cat" required>
              <option value="" disabled selected>Select Equipment Category</option>
              <option value="Audio Equipment">Audio Equipment</option>
              <option value="Visual Equipment">Visual Equipment</option>
              <option value="Network Equipment">Network Equipment</option>
              </select>
          </div>
          <div class="form-group">
            <label for="file">Equipment Image File</label>
            <input type="text" class="form-control" name="file" placeholder="Enter Equipment's Image File">
          </div>
        
          <button type="submit" name="add_asset" class="btn btn-primary">Submit New Asset Record</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
