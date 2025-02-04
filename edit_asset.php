<?php
$page_title = 'Edit Asset';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);

// Displaying Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch the asset record by ID
$asset = find_by_id('equipment', (int)$_GET['id']);
if (!$asset) {
    $session->msg("d", "Missing asset id.");
    redirect('equipment.php');
}

// If the form is submitted
if (isset($_POST['update_asset'])) {
    // Define required fields based on the equipment table
    $req_fields = array('eq_code', 'eq_name', 'eq_brand', 'eq_model', 'serial_no', 'cost', 'purchase_location', 'receipt_no', 'quantity', 'accessories', 'eq_status', 'eq_cat');
    validate_fields($req_fields);
    
    if (empty($errors)) {
        // Escaping input values
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

        // Update SQL statement
        $sql  = "UPDATE equipment SET ";
        $sql .= "eq_code='{$eq_code}', eq_name='{$eq_name}', eq_brand='{$eq_brand}', eq_model='{$eq_model}', ";
        $sql .= "serial_no='{$serial_no}', cost='{$cost}', purchase_location='{$purchase_location}', ";
        $sql .= "receipt_no='{$receipt_no}', quantity={$quantity}, accessories='{$accessories}', ";
        $sql .= "eq_status='{$eq_status}', eq_cat='{$eq_cat}' ";
        $sql .= "WHERE id='{$asset['id']}'";

        // Execute the query
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('s', "Asset updated.");
            redirect('assets.php', false);
        } else {
            $session->msg('d', 'Sorry, failed to update! ' . $db->error);
            redirect('edit_asset.php?id=' . (int)$asset['id'], false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_asset.php?id=' . (int)$asset['id'], false);
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
                    <span>Edit Asset</span>
                </strong>
                <div class="pull-right">
                    <a href="equipment.php" class="btn btn-primary">Show all assets</a>
                </div>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_asset.php?id=<?php echo (int)$asset['id']; ?>" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        <thead>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Serial No</th>
                            <th>Cost</th>
                            <th>Purchase Location</th>
                            <th>Receipt No</th>
                            <th>Quantity</th>
                            <th>Accessories</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="eq_code" value="<?php echo remove_junk($asset['eq_code']); ?>"></td>
                                <td><input type="text" class="form-control" name="eq_name" value="<?php echo remove_junk($asset['eq_name']); ?>"></td>
                                <td><input type="text" class="form-control" name="eq_brand" value="<?php echo remove_junk($asset['eq_brand']); ?>"></td>
                                <td><input type="text" class="form-control" name="eq_model" value="<?php echo remove_junk($asset['eq_model']); ?>"></td>
                                <td><input type="text" class="form-control" name="serial_no" value="<?php echo remove_junk($asset['serial_no']); ?>"></td>
                                <td><input type="text" class="form-control" name="cost" value="<?php echo remove_junk($asset['cost']); ?>"></td>
                                <td><input type="text" class="form-control" name="purchase_location" value="<?php echo remove_junk($asset['purchase_location']); ?>"></td>
                                <td><input type="text" class="form-control" name="receipt_no" value="<?php echo remove_junk($asset['receipt_no']); ?>"></td>
                                <td><input type="text" class="form-control" name="quantity" value="<?php echo (int)$asset['quantity']; ?>"></td>
                                <td><input type="text" class="form-control" name="accessories" value="<?php echo remove_junk($asset['accessories']); ?>"></td>
                                <td>
                                    <select class="form-control" name="eq_status">
                                        <option value="Operational" <?php if($asset['eq_status'] === 'Operational') echo 'selected'; ?>>Operational</option>
                                        <option value="Faulty" <?php if($asset['eq_status'] === 'Faulty') echo 'selected'; ?>>Faulty</option>
                                        <option value="Failed" <?php if($asset['eq_status'] === 'Failed') echo 'selected'; ?>>Failed</option>
                                        <option value="Unknown" <?php if($asset['eq_status'] === 'Unknown') echo 'selected'; ?>>Unknown</option>
                                        <option value="Under Repair" <?php if($asset['eq_status'] === 'Under Repair') echo 'selected'; ?>>Under Repair</option>
                                        <option value="Retired" <?php if($asset['eq_status'] === 'Retired') echo 'selected'; ?>>Retired</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="eq_cat">
                                        <option value="Audio Equipment" <?php if($asset['eq_cat'] === 'Audio Equipment') echo 'selected'; ?>>Audio Equipment</option>
                                        <option value="Visual Equipment" <?php if($asset['eq_cat'] === 'Visual Equipment') echo 'selected'; ?>>Visual Equipment</option>
                                        <option value="Network Equipment" <?php if($asset['eq_cat'] === 'Network Equipment') echo 'selected'; ?>>Network Equipment</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" name="update_asset" class="btn btn-primary">Update Asset</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>
