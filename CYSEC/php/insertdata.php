<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn= new mysqli("localhost","root","","cysec");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_POST["inemail"];
    $date = $_POST["indate"];
    $address = $_POST["inaddress"];
    $caseType = $_POST["incase"];
    $description = $_POST["indecrip"];
    $uid=$_SESSION['id'];

    
    $targetDirectory = "caseimg/"; 

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true); 
    }
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<script>alert("File is Not a Image");</script>';
            echo '<script>window.history.back();</script>';
            $uploadOk = 0;
        }
    }

  
    if (file_exists($targetFile)) {
        echo '<script>alert("Sorry, file already exists.");</script>';
        echo '<script>window.history.back();</script>';
        $uploadOk = 0;
    }


    if ($_FILES["image"]["size"] > 500000) {
        echo '<script>alert("Sorry,File is too large");</script>';
        echo '<script>window.history.back();</script>';
        $uploadOk = 0;
    }

    
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");</script>';
        echo '<script>window.history.back();</script>';
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo '<script>alert("Sorry,Your file is not Uploaded.");</script>';
        echo '<script>window.history.back();</script>';
    } else {
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            


            
            $imagePath = $targetFile;
            $sql = "INSERT INTO report_data (email, date, address, case_type, description, image_path,uid) VALUES (?, ?, ?, ?, ?, ?,'$uid')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $email, $date, $address, $caseType, $description, $imagePath);

            if ($stmt->execute()) {
                echo '<script>alert("Report Submitted Successfully");</script>';
                echo '<script>window.history.back();</script>';
                echo '<script>window.location.href="../user.php";</script>';
            } else {
                echo "Error: " . $stmt->error;
            }

        
            $stmt->close();
        } else {
            echo '<script>alert("Sorry,Your file is not Uploaded,ERROR.");</script>';
       
        }
    }


    $conn->close();
}
?>
