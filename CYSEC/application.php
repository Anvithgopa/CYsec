<?php
session_start();
include('php/db.php');
$uid=$_SESSION['id'];
if(!(isset($uid))){
	header("Location: log.php");	
}
if (!isset($_SESSION["name"])) {
   
  header("Location: log.php");
  exit();
}

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
    <div class="container" >
        <a href="user.php"><button class="btn btn-outline-primary hBack" type="button">X</button></a>
        <header>Apply</header>
        <form action="php/insertdata.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="inemail" placeholder="email@gmail.com" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputdate">Date</label>
                <input type="date" class="form-control" id="inputPassword4" name="indate" placeholder="Case date" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" name="inaddress" placeholder="1234 Main St" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState" >Case type</label>
                <select id="inputState" name="incase" class="form-control">
                  <option selected >Choose...</option>
                  <option name="incase" value="Fraud">Fraud</option>
                  <option name="incase" value="Instagram Hack">Instagram Hack</option>
                  <option name="incase" value="Spam">Spam</option>
                  <option name="incase" value="Phishing">Phishing</option>
                  <option name="incase" value="Treat">Treat</option>
                  <option name="incase" value="Other">Other</option>
                </select>
              </div>
            <div class="form-group">
              <label for="inputdesc">Description</label>
              <input type="text" class="form-control" id="inputAddress2" name="indecrip" placeholder="Write about issue or case" required>
            </div>
            <label for="inputss">Provide Screenshots</label>
            <div class="input-group mb-3">
                
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01" >Upload</span>
                </div> -->
                <div class="custom-file">
                    
                  <!-- <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" required>
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                  <div class="mb-3">
                       <!-- <label for="formFileSm" class="form-label">Small file input example</label> -->
                        <input class="form-control form-control-sm" id="formFileSm" id="image" name="image" type="file">
                        </div>
                </div>
              </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck">
                  The above details are Real and I aggree.
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    <script>
        $(".hBack").on("click", function(e){
    e.preventDefault();
    window.history.back();
});
    </script>
</body>
</html>