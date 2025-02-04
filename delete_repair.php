<?php
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);

// Check if 'id' is present in the GET request
if (!isset($_GET['id'])) {
    $session->msg("d", "Missing repair id.");
    redirect('repairs.php');
}

// Fetch the repair record by ID
$repair = find_by_id('repairs', (int)$_GET['id']);
if (!$repair) {
    $session->msg("d", "Repair record not found.");
    redirect('repairs.php');
}

// Delete the repair record
$delete_id = delete_by_id('repairs', (int)$repair['id']);
if ($delete_id) {
    $session->msg("s", "Repair Successfully Deleted.");
    redirect('repairs.php');
} else {
    $session->msg("d", "Repair Deletion Failed.");
    redirect('repairs.php');
}
?>
