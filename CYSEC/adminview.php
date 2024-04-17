<?php
session_start();
include('php/db.php');
$id = $_GET["id"];
if (!isset($_SESSION["name"])) {
   
  header("Location: log.php");
  exit();
}
$query = "SELECT id, email, date, address, case_type, description, image_path, uid  FROM report_data WHERE id=$id";
$result = $conn->query($query);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/report.css">
    <link rel="stylesheet" href="bootcss/bootstrap.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>CYSEC. | Report</title>
</head>
<body style="background: #7335b7;">
<?php
							if ($result->num_rows > 0) {
 							 $sn=1;
							while($data = $result->fetch_assoc()) {
 							?>
    <div class="container" >
        <a href="admin.php"><button class="btn btn-outline-primary hBack" type="button">X</button></a>
        <header>Apply</header>
        <form action='php/approve.php?id="<?php echo $data['id']; ?>"' method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="inemail" value="<?php echo $data['email']; ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="inputdate">Date</label>
                <input type="date" class="form-control" id="inputPassword4" name="indate" value="<?php echo $data['date']; ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" name="inaddress" value="<?php echo $data['address']; ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState" >Case type</label>
                <input type="text" class="form-control" id="inputAddress" name="inaddress" value="<?php echo $data['case_type']; ?>" disabled>

              </div>
            <div class="form-group">
              <label for="inputdesc">Description</label>
              <input type="text" class="form-control" id="inputAddress2" name="indecrip"value="<?php echo $data['description']; ?>" disabled>
            </div>
            <label for="inputss">Screenshots</label>
                
            <a href='php/dwonload.php?id="<?php echo $data['id']; ?>"'>Download</a>
              <button  type="submit" class="btn btn-primary" name="approve" value="add">Approve</button>
              <button  type="submit" class="btn btn-primary" name="approve" value="canc">Cancel</button>
          </form>
    </div>
    <?php
 									 $sn++;}} else { ?>
								    <tr>
									     <td colspan="8">No data found</td>
 									   </tr>
 								<?php } ?>
    <script>
        $(".hBack").on("click", function(e){
    e.preventDefault();
    window.history.back();
});
    </script>
</body>
</html>