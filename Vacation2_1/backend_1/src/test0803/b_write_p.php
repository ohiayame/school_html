<?php
// db연결
require_once('./b_config.php');

// post에서 받은 값을 변수에 저장
$name = trim($_POST['name'] ?? '');
$password = trim($_POST['password'] ?? '');
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

// 문자열 유효성 검사 함수
function isVAlidInput($value, $min = 1, $max = 255){
    return (
        isset($value) &&
        mb_strlen($value) >= $min &&
        mb_strlen($value) <= $max
    );
}

// 오류 배열 초기화
$errors = [];

// 각 입력에 맞는 크기로 유효성 검사 -> 오류가 있으면 배열에 저장
if(!isVAlidInput($name, 2, 30)){
    $errors[] = '작성자 이름은 2자 이상 30자 이하로 입력해야 합니다.';
}
if (!isValidInput($password, 4, 30)) {
    $errors[] = '비밀번호는 4자 이상 30자 이하로 입력해야 합니다.';
}
if (!isValidInput($title, 1, 100)) {
    $errors[] = '제목은 1자 이상 100자 이하로 입력해야 합니다.';
}
if (!isValidInput($content, 1, 1000)) {
    $errors[] = '내용은 1자 이상 1000자 이하로 입력해야 합니다.';
}

// 오류배열에 내용이 있으면 
if(!empty($errors)){
    // session에 등록 / implode(<br>, 배열)
    $_SESSION['error'] = implode('<br>', $errors);
    // 작성페이지에 돌아가기
    header('Location: b_write.php');
    exit;
}

try{
   //db 연결
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset("utf8mb4");

   // password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // sql문
    $sql = "
        INSERT INTO posts (name, password, title, content) 
        VALUES ('$name', '$password_hash', '$title', '$contant')
    ";

    // 실행이 안되면
    if(!$conn->query($sql)){
        // 예외 발생
        throw new Exception('DB 등록 실패');
    }
    // 목록에 이동
    header("Location: b_list.php");
    exit;

}catch (Exception $e){
    // 로그 남기기
    error_log('['. date('Y-m-d H:i:s'). ']'
        .$e->getMessage() . PHP_EOL, 3, LOG_FILE_PATH
    );
    // session에도 저장
    $_SESSION['error'] = '글 작성 중 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.';
    // 작성페이지에 이동
    header("Location: b_write.php");
    exit;
}finally{
    // db연결 종료
    if(isset($conn) && $conn instanceof mysqli){
        $conn->close();
    }
}
?>