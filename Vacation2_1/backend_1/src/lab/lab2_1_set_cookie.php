<?php
if (isset($_POST['username'])){
    $username = trim($_POST['username']);
    setcookie('username', $username, time()+3600, '/');
    header("Location: lab2_1_index.php");
    exit;
}
