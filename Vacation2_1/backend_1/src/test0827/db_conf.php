<?php

class db_info{
    const DB_HOST = "db";
    const DB_USER = "root";
    const DB_PW = "root";
    const DB_NAME = "gsc";
}

$conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
$conn->set_charset("utf8mb4");

if($conn->connect_error){
    die("DB연결 실패: " . $coon->connect_error);
}

?>