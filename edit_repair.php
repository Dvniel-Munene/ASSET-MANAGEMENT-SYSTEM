<?php
$page_title = 'Edit Repair';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);


//Displaying Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Fetch the repair record by ID
$repair = find_by_id('repairs', (int)$_GET['id']);
if (!$repair) {
    $session->msg("d", "Missing repair id.");
    redirect('repairs.php');
}

// If the form is submitted
if (isset($_POST['update_repair'])) {
    // Define required fields based on the repairs table
    $req_fields = array('asset_code', 'asset_cat', 'quantity', 'cost', 'fault_description', 'repair_action', 'technician_name', 'technician_contact', 'date', 'status');
    validate_fields($req_fields);
    
    if (empty($errors)) {
        // Escaping input values
        $asset_code = $db->escape($_POST['asset_code']);
        $asset_cat = $db->escape($_POST['asset_cat']);
        $quantity = $db->escape((int)$_POST['quantity']);
        $cost = $db->escape($_POST['cost']);
        $fault_description = $db->escape($_POST['fault_description']);
        $repair_action = $db->escape($_POST['repair_action']);
        $technician_name = $db->escape($_POST['technician_name']);
        $technician_contact = $db->escape($_POST['technician_contact']);
        $date = $db->escape($_POST['date']);
        $status = $db->escape($_POST['status']);
        $s_date = date("Y-m-d", strtotime($date));

        // Update SQL statement
        $sql  = "UPDATE repairs SET ";
        $sql .= "asset_code='{$asset_code}', asset_cat='{$asset_cat}', qty={$quantity}, cost='{$cost}', ";
        $sql .= "fault_description='{$fault_description}', repair_action='{$repair_action}', ";
        $sql .= "technician_name='{$technician_name}', technician_contact='{$technician_contact}', ";
        $sql .= "date='{$s_date}', status='{$status}' ";
        $sql .= "WHERE id='{$repair['id']}'";
        
        // Execute the query
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('s', "Repair updated.");
            redirect('repairs.php?id=' . (int)$repair['id'], false);
        } else {
            $session->msg('d', 'Sorry, failed to update!' . $db->error);
            redirect('repairs.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_repair.php?id=' . (int)$repair['id'], false);
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
        <div class="panel">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-wrench"></span>
                    <span>Edit Repair</span>
                </strong>
                <div class="pull-right">
                    <a href="repairs.php" class="btn btn-primary">Show all repairs</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <th>Asset Code</th>
                        <th>Asset Category</th>
                        <th>Quantity</th>
                        <th>Fault Description</th>
                        <th>Repair Action</th>
                        <th>Tech_Name</th>
                        <th>Tech_Contact</th>
                        <th>Cost (Ksh) </th>
                        <th>Repair Date</th>
                        <th>Repair Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="repair_info">
                        <tr>
                            <form method="post" action="edit_repair.php?id=<?php echo (int)$repair['id']; ?>">
                                <td>
                                    <input type="text" class="form-control" name="asset_code" value="<?php echo remove_junk($repair['asset_code']); ?>">
                                </td>
                                <td>
                                    <select class="form-control" name="asset_cat">
                                        <option value="Audio Equipment" <?php if($repair['asset_cat'] === 'Audio Equipment') echo 'selected'; ?>>Audio Equipment</option>
                                        <option value="Visual Equipment" <?php if($repair['asset_cat'] === 'Visual Equipment') echo 'selected'; ?>>Visual Equipment</option>
                                        <option value="Network Equipment" <?php if($repair['asset_cat'] === 'Network Equipment') echo 'selected'; ?>>Network Equipment</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="quantity" value="<?php echo (int)$repair['qty']; ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fault_description" value="<?php echo remove_junk($repair['fault_description']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="repair_action" value="<?php echo remove_junk($repair['repair_action']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="technician_name" value="<?php echo remove_junk($repair['technician_name']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="technician_contact" value="<?php echo remove_junk($repair['technician_contact']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cost" value="<?php echo remove_junk($repair['cost']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control datepicker" name="date" value="<?php echo remove_junk($repair['date']); ?>">
                                </td>
                                <td>
                                    <select class="form-control" name="status">
                                        <option value="Pending" <?php if($repair['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                                        <option value="In Progress" <?php if($repair['status'] === 'In Progress') echo 'selected'; ?>>In Progress</option>
                                        <option value="Completed" <?php if($repair['status'] === 'Completed') echo 'selected'; ?>>Completed</option>
                                    </select>
                                </td>

                                <td>
                                    <button type="submit" name="update_repair" class="btn btn-primary">Update Repair</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>
