<?php
if (isset($_COOKIE['username'])){
    setcookie('username', '', time()-3600, '/');
    setcookie('rate', '', time()-3600, '/');
    setcookie('coffe', '', time()-3600, '/');

    header("Location: lab2_2_index.php");
    exit;
}else{
    header("Location: lab2_2_index.php");
    exit; 
}
