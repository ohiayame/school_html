<?php
session_start();
require_once("./db_conf.php");

try{
    $user_id_raw = trim($_POST["user_id"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $user_id = $conn->real_escape_string($user_id_raw);
    
    $sql = "
        SELECT password, name FROM users WHERE user_id = '$user_id'
    ";
    $result = $conn->query($sql);
    if(!$result || $result->num_rows === 0){
        throw new Exception("해당 정보는 없습니다.");
    }
    $row = $result->fetch_assoc();
    if(!password_verify($password, $row["password"])){
        throw new Exception("비밀번호가 일치하지 않습니다.");
    }

    $_SESSION["success"] = "로그인 성공!";
    $_SESSION["user_id"] = $user_id;
    $_SESSION["name"] = $row["name"];
    header("Location: welcome.php");
    exit;

}catch (Exception $e){
    $_SESSION["error"] = $e->getMessage();
    header("Location: login.php");
    exit;
}