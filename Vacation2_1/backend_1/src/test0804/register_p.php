<?php 
require_once('./db_conf.php');

// try
try{
    // db연결
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    // 변수 대입
    $username_raw = trim($_POST['username'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');
    $name_raw     = trim($_POST['name'] ?? '');
    
    // 내용이 있는지 확인
    if($username_raw === '' || $password_raw === '' || $name_raw  === ''){
        throw new Exception('정보를 모두 입력해주세요,');
    }

    // 아이디 중복 확인
    $username = $conn-> real_escape_string($username_raw);
    $check = "SELECT id FROM users WHERE username='$username'";
    $check_result = $conn->query($check);

    if($check_result && $check_result->num_rows > 0){
        throw new Exception('이미 존재하는 아이디입니다.');
    }

    //  pw해쉬
    $password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

    $name = $conn->real_escape_string($name_raw);

    // db저장
    $sql = "
        INSERT INTO users (username, password, name)
        VALUES ('$username', '$password_hash', '$name')
    ";
    $conn->query($sql);

    // session success 저장
    $_SESSION['success'] = '회원가입 완료';

    // login으로 이동
    header("Location: login.php");
    exit;

} catch (Exception $e){
// catch 
    // session error 저장
    $_SESSION['error'] = $e->getMessage();
    // 회원가입으로 이동
    header("Location: register.php");
    exit;
}