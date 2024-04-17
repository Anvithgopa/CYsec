<?php
$ad="admin";
$pass=password_hash($ad,PASSWORD_DEFAULT);
echo $pass;
?>