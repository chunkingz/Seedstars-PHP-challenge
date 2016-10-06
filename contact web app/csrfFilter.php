<?php
#script written by kingston fortune
#using sublime text

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['token'])) {
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
} else {
    $token = $_SESSION['token'];
}