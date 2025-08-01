<?php
require_once("./db_conf.php");

// 1. 연결 설정
$db_conn = new mysqli(DB_INFO::DB_HOST, DB_INFO::DB_USER, DB_INFO::DB_PW, DB_INFO::DB_NAME);

// var_dump($db_conn);

if ($db_conn->connect_errno) {
    echo "DB Error: " . $db_conn->connect_errno;
    exit;
}

// 2. SQL 전송
$sql = "select * from student";
$result = $db_conn->query($sql);
// var_dump($result);
// echo $result->num_rows;

// mysqli_result -> fetch_filed(), fetch_fields();
$field_info = $result->fetch_field();
foreach ($field_info as $key => $field) {
    echo $key.":".$field."<br>";
}

echo "<hr>";


if (!$result) {
    echo "Query Error" . $db_conn->error;
    exit;
}

// 3. 반환 값 처리

while ($row = $result->fetch_assoc()) {
  foreach ($row as $key => $value) {
    echo $key . ": " . $value . "<br>";
  }
  echo "<hr>";
}

// $result->fetch_array();
// $result->fetch_row();
// $result->fetch_assoc();
// $result->fetch_object();

// 2차원 배열
$result->fetch_all();

// 4. 연결 종료QD
$db_conn->close();