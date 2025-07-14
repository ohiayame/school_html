<?php
    setcookie('username', '', time()-3600, '/');
    header("Location: lab2_1_index.php");
    exit;
