<?php
    

    // 주석

    //변수 
    // $bar = 1;
    // $foo = 2.0;
    // $kin = true;
    // $pos = "hello";

    // var_dump($bar, $foo, $kin, $pos);

    // 자료형


    // 함수
    // function bar($arg)
    // {
    //     foreach($arg as $key => $val){
    //         echo "{$key}: {$val}<br>";
    //     }
    // }
    // $foo = [1,2,3];
    // bar($foo)

    // 변수에 할당
    // $bar = function ($x){ echo $x; };
    // // 매개변수로 전달
    // function foo($arg){
    //     // 반환
    //     return $arg;
    // }

    // $kin = foo($bar);
    // $kin("msg");

    // var_dump($bar);


    // 접근범위
    // $value_1 = 1;
    // {$value_2 = 2;}
    // for($i = 0; $i <3; $i++){
    //     echo $i;
    // }
    // echo $i;

    // $value = "전역 변수";
    // function foo(){
    //     echo $value;  // error

    //     global $value;// keyword
    //     echo $value;

    //     echo $GLOBALS["vlaue"]; // Super Global Variable
    // }
    // 생명주기
    //  - 출생(선언될 때)  - 소멸(?)

    // 자바 -> {}기반
    // 파이선 -> 함수 기반
    // php -> 함수 기반

    // function foo(){
    //     $bar = "hello";
    //     print $bar;
    // }
    // foo();
    // print $bar;

    // function foo(){
    //     $count = 0; // -> static $count = 0;
    //     $count++;
    //     echo $count."<br>";
    // }
    // foo(); // 1  -> 1
    // foo(); // 1  -> 2
    // foo(); // 1  -> 3

    // function test_1(){
    //     $value = 0;
    //     for($i = 0; $i <3; $i++)
    //         $value++;
    //     echo $value;
    // }

    // function test_2(){
    //     static $value = 0;
    //     for($i = 0; $i <3; $i++)
    //         $value++;
    //     echo $value;
    // }

    // test_2(); // 3
    // test_2(); // 6
    // test_2(); // 9

    // $varName = "myName";
    // $$varName = "Name";
    // echo $myName

    define("SITE_NAME","My Website");
    echo SITE_NAME; // 출력: My Website

    define("CONFIG", ["host" => "localhost", "post" => 3306]);
    echo CONFIG["host"]; // 출력: localhost

    const PI = 3.1415;
    echo PI; // 출력: 3.1415
?>