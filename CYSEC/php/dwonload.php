<?php
session_start();
include('db.php');
$id = $_GET["id"];
$query = "SELECT image_path FROM report_data WHERE id=$id";
$result = $conn->query($query);

							if ($result->num_rows > 0) {
 							 $sn=1;
							while($data = $result->fetch_assoc()) {
 							

$imagePath = $data['image_path'];

if (file_exists($imagePath)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($imagePath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($imagePath));
    readfile($imagePath);
    exit;
} else {
    echo 'Image file not found.';
}

$sn++;}} 
?>
