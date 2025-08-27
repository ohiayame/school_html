<?php
session_start();
require_once("./db_conf.php");

try{
    $user_id_raw = trim($_POST["user_id"] ?? "");
    $grade = (int)trim($_POST["grade"] ?? "");
    $email_raw = trim($_POST["email"] ?? "");
    $password_raw = trim($_POST["password"] ?? "");
    $name_raw = trim($_POST["name"] ?? "");

    if($user_id_raw === "" || $grade === "" || $email_raw === "" ||
        $password_raw === "" || $name_raw === ""){
            throw new Exception("정보를 모두 입력해주세요.");
    }
    $user_id = $conn->real_escape_string($user_id_raw);
    $email = $conn->real_escape_string($email_raw);
    $name = $conn->real_escape_string($name_raw);
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $check_sql = "
        SELECT * FROM users WHERE user_id = '$user_id'
    ";
    $check = $conn->query($check_sql);
    if($check && $check->num_rows > 0){
        throw new Exception("이미 존재하는 아이디입니다.");
    }

    $sql = "
        INSERT INTO users (user_id, grade, email, password, name) 
        VALUES ('$user_id', $grade, '$email', '$password', '$name')
    ";
    $conn->query($sql);

    $_SESSION['success'] = "회원가입 완료";
    header("Location: login.php");
    exit;

}catch (Exception $e){
    $_SESSION["error"] = $e->getMessage();
    header("Location: register.php");
    exit;
}