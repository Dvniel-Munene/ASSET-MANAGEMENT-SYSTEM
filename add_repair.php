<?php
  $page_title = 'AMS|Repair Request';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(3);


  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<?php
  if(isset($_POST['add_repair'])){
    // Define the required fields for a repair request
    $req_fields = array('asset_code', 'qty', 'asset_cat', 'reported_by','fault_description','status','date','completion_date','technician_name', 'technician_contact', 'cost');
    validate_fields($req_fields);
    
    if(empty($errors)){
      // Escape user input
      $asset_code         = $db->escape($_POST['asset_code']);
      $qty                = $db->escape((int)$_POST['qty']);
      $asset_cat          = $db->escape($_POST['asset_cat']);
      $reported_by        = $db->escape($_POST['reported_by']);
      $fault_desc         = $db->escape($_POST['fault_description']);
      $repair_action      = $db->escape($_POST['repair_action']);
      $technician_name    = $db->escape($_POST['technician_name']);
      $technician_contact = $db->escape($_POST['technician_contact']);
      $cost               = $db->escape($_POST['cost']);
      $status             = $db->escape($_POST['status']);
      $date               = $db->escape($_POST['date']);
      $completion_date    = $db->escape($_POST['completion_date']);
      $submit_date        = make_date();  // Current date when the form is submitted

      // Insert into the repairs table
      $sql  = "INSERT INTO repairs (";
      $sql .= " asset_code, qty, asset_cat, reported_by, fault_description, repair_action, technician_name, technician_contact, cost, status, date, completion_date";
      $sql .= ") VALUES (";
      $sql .= "'{$asset_code}','{$qty}','{$asset_cat}','{$reported_by}','{$fault_desc}', '{$repair_action}', '{$technician_name}', '{$technician_contact}', '{$cost}','{$status}','{$date}', '{$completion_date}'";
      $sql .= ")";

      // Execute the query and provide feedback
      if($db->query($sql)){
        $session->msg('s',"Repair request added.");
        redirect('repairs.php', false);
      } else {
        $error_message = $db->error; // Get the error message from the database
        $session->msg('d',' Sorry, failed to add repair request!');
        redirect('repairs.php', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('repairs.php', false);
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
          <span>EQUIPMENT REPAIR REQUEST FORM</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_repair.php">
          <div class="form-group">
            <label for="asset_code">Asset Code</label>
            <input type="text" class="form-control" name="asset_code" placeholder="Enter Asset Code" required>
          </div>
          <div class="form-group">
            <label for="qty">Asset Quantity</label>
            <input type="text" class="form-control" name="qty" placeholder="Enter Number of Asset(s) to be repaired" required>
          </div>
          <div class="form-group">
            <label for="asset_cat">  Asset Category</label>
            <select class="form-control" name="asset_cat" required>
              <option value="" disabled selected>Select Asset Category</option>
              <option value="Audio Equipment">Audio Equipment</option>
              <option value="Visual Equipment">Visual Equipment</option>
              <option value="Network Equipment">Network Equipment</option>
              </select>
          </div>
          <div class="form-group">
            <label for="reported_by">Reported By</label>
            <input type="text" class="form-control" name="reported_by" placeholder="Enter the name of the reporter" required>
          </div>
          <div class="form-group">
            <label for="fault_description">Fault Description</label>
            <textarea class="form-control" name="fault_description" placeholder="Describe the fault" required></textarea>
          </div>
          <div class="form-group">
            <label for="repair_action">Repair Action</label>
            <textarea class="form-control" name="repair_action" placeholder="Describe the action to be taken to solve the issue" required></textarea>
          </div>
          <div class="form-group">
            <label for="technician_name">Technician's Name</label>
            <input type="text" class="form-control" name="technician_name" placeholder="Enter the name of the technician/Business to fix the equipment" required>
          </div>
          <div class="form-group">
            <label for="technician_contact">Technician's Contact</label>
            <input type="text" class="form-control" name="technician_contact" placeholder="Enter the contact of the technician/Business to fix the equipment [+2547XXXXXXXX]" required>
          </div>
          <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" class="form-control" name="cost" placeholder="The cost to be incurred to fix the equipment" required>
          </div>
          <div class="form-group">
            <label for="status">Repair Status</label>
            <select class="form-control" name="status" required>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
          <div class="form-group">
            <label for="date">Repair Date</label>
            <input type="date" class="form-control" name="date" required>
          </div>
          <div class="form-group">
            <label for="completion_date">Completion Date</label>
            <input type="date" class="form-control" name="completion_date" required>
          </div>
          <button type="submit" name="add_repair" class="btn btn-primary">Submit Repair Request</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
