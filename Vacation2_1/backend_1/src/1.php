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

    function foo(){
        $count = 0; // -> static $count = 0;
        $count++;
        echo $count."<br>";
    }
    foo(); // 1  -> 1
    foo(); // 1  -> 2
    foo(); // 1  -> 3
?>