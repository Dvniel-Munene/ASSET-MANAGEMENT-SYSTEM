<?php
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(3);

// Check if 'id' is present in the GET request
if (!isset($_GET['id'])) {
    $session->msg("d", "Missing equipment id.");
    redirect('assets.php');
}

// Fetch the repair record by ID
$repair = find_by_id('equipment', (int)$_GET['id']);
if (!$repair) {
    $session->msg("d", "Equipment record not found.");
    redirect('assets.php');
}

// Delete the repair record
$delete_id = delete_by_id('equipment', (int)$repair['id']);
if ($delete_id) {
    $session->msg("s", "Equipment Record Successfully Deleted.");
    redirect('assets.php');
} else {
    $session->msg("d", "Equipment Record Deletion Failed.");
    redirect('assets.php');
}
?>
