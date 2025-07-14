<?php

// setcookie("my_path", "pos", time()-50);

setcookie("my_path", "pos", [
    'expires' => time() + 3600,
    'path' => '/',
    // 'domain' => 'example.com',
    // 'secure' => true,
    'httponly' => true
]);