<?php
// session_start();

// echo session_id();
// $_SESSION['username'] = 'aaa';

if(session_id() !== '') {
    echo 'start';
}
if(session_status() == PHP_SESSION_ACTIVE){
    echo 'active';
}
// create
$_SESSION['std_info'] = [
    "id" => 2423019,
    "name" => "ayame"
];
if (isset($_SESSION['std_info'])){
    // print_r($_SESSION['std_info']);
    // update
    $_SESSION['std_info'] = [
        "id" => 2423019,
        "name" => "aaaa"
    ];
}else{
    echo "오류";
}

print_r($_SESSION['std_info']);




?>