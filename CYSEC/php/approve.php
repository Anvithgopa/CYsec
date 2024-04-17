<?php
include 'db.php';
$appr=$_POST['approve'];
$report_id = $_GET['id'];
if($appr==="add"){

$check_sql = "SELECT COUNT(*) as count FROM invas_data WHERE id = $report_id";
$cresult = $conn->query($check_sql);

if ($cresult->num_rows > 0) {
    $row = $cresult->fetch_assoc();
    if ($row['count'] > 0) {
        echo '<script>alert("Already Exists");</script>';
        echo '<script>window.location.href="../admin.php";</script>';
    } else {


$sql = "SELECT * FROM report_data WHERE id = $report_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $insert_sql = "INSERT INTO invas_data (id, email, date, address, case_type, description, image_path, uid,status) VALUES ('$row[id]', '$row[email]','$row[date]','$row[address]','$row[case_type]','$row[description]','$row[image_path]','$row[uid]','Approve')";
  if ($conn->query($insert_sql) === TRUE) {
    echo '<script>alert("Approved");</script>';
            echo '<script>window.location.href="../admin.php";</script>';
  } else {
    echo '<script>alert("Error");</script>';
    echo '<script>window.history.back();</script>';
  }
} else {
    echo '<script>alert("Empty");</script>';
    echo '<script>window.history.back();</script>';
}}}}else if($appr==="canc"){

$check_sql = "SELECT COUNT(*) as count FROM invas_data WHERE id = $report_id";
$cresult = $conn->query($check_sql);

if ($cresult->num_rows > 0) {
    $row = $cresult->fetch_assoc();
    if ($row['count'] > 0) {
        echo '<script>alert("Already Exists");</script>';
        echo '<script>window.location.href="../admin.php";</script>';
    } else {




$sql = "SELECT * FROM report_data WHERE id = $report_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $insert_sql = "INSERT INTO invas_data (id, email, date, address, case_type, description, image_path, uid,status) VALUES ('$row[id]', '$row[email]','$row[date]','$row[address]','$row[case_type]','$row[description]','$row[image_path]','$row[uid]','Canceled')";
  if ($conn->query($insert_sql) === TRUE) {
    echo '<script>alert("Canceled");</script>';
    echo '<script>window.location.href="../admin.php";</script>';
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
    echo "Error checking for existing record: ";
}


}else{
    echo '<script>alert("button");</script>';
    echo '<script>window.history.back();</script>';
}

$conn->close();
?>
