<?php 
require_once('./db_conf.php');

// try
try{
    // db연결
    $conn = new mysqli(
        db_info::DB_HOST, 
        db_info::DB_USER, 
        db_info::DB_PW, 
        db_info::DB_NAME
    );
    $conn->set_charset('utf8mb4');

    // 변수 대입
    $username_raw = trim($_POST['username'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');
    
    // 내용이 있는지 확인
    if($username_raw === '' || $password_raw === ''){
        throw new Exception('정보를 입력해주세요,');
    }

    // 아이디 중복 확인
    $username = $conn-> real_escape_string($username_raw);

    //  pw해쉬
    $password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

    // db저장
    $sql = "SELECT * FROM users WERER username = '$username'";
    $result = $conn->query($sql);

    if($result && $row = $result->fetch_assoc()){
        // password확인
        if(password_verify($password_hash, $row['password'])){
            // session저장 후 welcome.php
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];

            header("Location: welcome.php");
            exit;
        }else{
            // 비밀번호 불일치
            throw new Exception('비밀번호가 틀렸습니다');
        }
    }else{
        // username 없음 
        throw new Exception('아이디가 없습니다.');
    }

} catch (Exception $e){
// catch 
    // session error 저장
    $_SESSION['error'] = $e->getMessage();
    // login 이동
    header("Location: login.php");
    exit;
}