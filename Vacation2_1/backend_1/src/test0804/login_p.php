<?php
session_start();
require_once('./db_conf.php');

try{
    // db연결
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mmb4');
    // 변수
    $username_raw = trim($_POST['username'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');
    // 내용 확인
    if($username_raw === '' || $password_raw === ''){
        throw new Exception('정보를 입력해주세요');
    }

    // 아이디 검색
    $username = $conn->real_escape_string($username_raw);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result =  $conn->query($sql);

    if($result && $row = $result->fetch_assoc()){
        // 비밀번호 일치확인
        if(password_verify($password_raw, PASSWORD_DEFAULT)){
            // session -> welcome
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            header("Location: welcome.php");
            exit;
        }else{
            throw new Exception('비밀번호 불일치');
        }
    }else{
        throw new Exception('아이디가 없습니다.');
    }

}catch (Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: login.php");
    exit;
}