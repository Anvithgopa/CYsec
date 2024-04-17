<?php
session_start();

$conn= new mysqli("localhost","root","","cysec");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $action=$_POST['action'];

if($action === "Signup"){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $passwordm=$_POST['passm'];

    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if($yess=!preg_match($password_regex,$password)){
        echo '<script>alert("Use Strong Password");</script>';
        echo '<script>window.history.back();</script>';
    }else{
    if($ok=($password!=$passwordm)){
        echo '<script>alert("Add Same Password");</script>';
        echo '<script>window.history.back();</script>';
    }else{
        $sql="SELECT email FROM usersign WHERE email='$email'";
        $res=mysqli_query($conn,$sql);
        if($res->num_rows>=1){
            echo '<script>alert("Email Already Exist");</script>';
        echo '<script>window.location.href="../log.php";</script>';
        }
        else{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO usersign (name,email,password) VALUES('$name','$email','$hashedPassword')";
    if($conn->query($query)===TRUE){
        echo '<script>alert("Registration Sucessfull");</script>';
    echo '<script>window.location.href="../log.php";</script>';
    }
    else{

        echo "Error:" . $query . "<br>" . $conn->error;
    }}}
    }
}elseif($action === "Login")
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    
    $query = "SELECT * FROM usersign WHERE email='$email'";
    $result = $conn->query($query);

    $row=mysqli_fetch_assoc($result);

    if($result->num_rows==1){
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['name'];
        $storedHashedPassword = $row["password"];
        if (password_verify($password, $storedHashedPassword)) {
           
            header("Location:../user.php");
           
        } else {
            
            echo '<script>alert("Invalid Password");</script>';
            echo '<script>window.history.back();</script>';
        }
        
    }
    else{
        echo '<script>alert("Invalid");</script>';
        echo '<script>window.history.back();</script>';
    }
}elseif($action === "adminLogin")
{
    $email=$_POST['aemail'];
    $password=$_POST['apassword'];

    
    $query = "SELECT * FROM investigators WHERE email='$email'";
    $result = $conn->query($query);

    $row=mysqli_fetch_assoc($result);

    if($result->num_rows==1){
        
        $_SESSION['name']=$row['name'];
        $storedHashedPassword = $row["password"];
        if (password_verify($password, $storedHashedPassword)) {
           
            header("Location:../admin.php");
           
        } else {
            
            echo '<script>alert("Invali Password");</script>';
            echo '<script>window.history.back();</script>';
        }
        
    }
    else{
        echo '<script>alert("Invalid");</script>';
        echo '<script>window.history.back();</script>';
    }
}


$conn->close();

?>