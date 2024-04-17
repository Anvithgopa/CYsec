<?php
include 'db.php';


$report_id = $_GET['id'];
$check_sql = "SELECT COUNT(*) as count FROM invs_data WHERE id = $report_id";
$cresult = $conn->query($check_sql);

if ($cresult->num_rows > 0) {
    $row = $cresult->fetch_assoc();
    if ($row['count'] > 0) {
        echo "Record already exists. User notified.";
    } else {




$sql = "SELECT * FROM report_data WHERE id = $report_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $insert_sql = "INSERT INTO invas_data (id, email, date, address, case_type, description, image_path, uid,status) VALUES ('$row[id]', '$row[email]','$row[date]','$row[address]','$row[case_type]','$row[description]','$row[image_path]','$row[uid]','Canceled')";
  if ($conn->query($insert_sql) === TRUE) {
    echo '<script>alert("Approved");</script>';
            echo '<script>window.history.back();</script>';
  } else {
    echo '<script>alert("Error");</script>';
    echo '<script>window.history.back();</script>';
  }
} else {
    echo '<script>alert("Empty");</script>';
    echo '<script>window.history.back();</script>';
}
    }
}
else {
    echo "Error checking for existing record: " . $conn->error;
}
$conn->close();
?>
