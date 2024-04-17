<?php 

session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content=" Today in this blog you will learn how to create a responsive Login & Registration Form in HTML CSS & JavaScript. The blog will cover everything from the basics of creating a Login & Registration in HTML, to styling it with CSS and adding with JavaScript." />
    <meta name="keywords" content="Animated Login & Registration Form,Form Design,HTML and CSS,HTML CSS JavaScript,login & registration form,login & signup form,Login Form Design,registration form,Signup Form,HTML,CSS,JavaScript,"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>CYSEC. | AdminLoGin/SignUp</title>
    <link rel="stylesheet" href="css/logstyles.css" />
    <script src="../custom-scripts.js" defer></script>
  </head>
  <body>
    <section class="wrapper">
      <div class="form signup">
      <header>Investigator<sub>Login</sub> </header>
      
        <form action="php/process.signup.php" method="POST">
          <input type="text" placeholder="Email address" id="email" name="aemail" required />
          <input type="password" placeholder="Password" id="password" name="apassword" required />
          <a href="log.php">User Login</a>
          <input type="submit" name="action" value="adminLogin" />
        </form>
        <center><a href="index.php" style="text-decoration:none;color:white;">Home</a></center>
      </div>


    </section>
  </body>
</html>
