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

    <title>CYSEC. | LoGin/SignUp</title>
    <link rel="stylesheet" href="css/logstyles.css" />
    <script src="../custom-scripts.js" defer></script>
  </head>
  <body>
    <section class="wrapper">
      <div class="form signup">
      <a href="index.php" style="text-decoration:none;color:white;">Home</a>
        <header>Signup</header>
        
        <form action="php/process.signup.php" method="POST"> 
          <input type="text" id="name" name="name" placeholder="Full name" required />
          <input type="text" id="email" name="email" placeholder="Email address" required />
          <input type="password" id="password" name="password" placeholder="Password" required />
          <input type="password" id="passwordm" name="passm" placeholder="Confirm Password" required />
          <div class="checkbox">
            <input type="checkbox" id="signupCheck" name="signchck" required/>
            <label for="signupCheck">I accept all terms & conditions</label>
          </div>
          <input type="submit" name="action" id="signup" value="Signup" />
          
        </form>
      </div>

      <div class="form login" id="login">
        <header>Login</header>
        <form action="php/process.signup.php" method="POST">
          <input type="text" placeholder="Email address" id="email" name="email" required />
          <input type="password" placeholder="Password" id="password" name="password" required />
          <a href="adminlog.php">Investigator Login</a>
          <input type="submit" name="action" value="Login" />
        </form>
      </div>

      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
  </body>
</html>
