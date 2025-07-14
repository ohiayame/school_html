<?php
if (isset($_POST['username'])){
    $username = trim($_POST['username']);
    $rate = trim($_POST['rate']);
    $coffe = trim($_POST['coffe']);
    setcookie('username', $username, time()+3600, '/');
    setcookie('rate', $rate, time()+3600, '/');
    setcookie('coffe', $coffe, time()+3600, '/');
    header("Location: lab2_2_index.php");
    exit;
}
