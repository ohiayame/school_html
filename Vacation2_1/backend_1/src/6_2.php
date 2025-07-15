<?php
// session_start();

// print_r($_SESSION);

// read
$name = $_SESSION['std_info']['name'];
echo $name;

// delete
unset($_SESSION['std_info']['name']);
print_r($_SESSION);

session_destroy();
?>