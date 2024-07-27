<?php
require_once 'conn.php';

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "ar") {
        $_SESSION['lang'] = "ar";
    }else{
        $_SESSION['lang'] = "en";
    }
    header("location:".$_SERVER['HTTP_REFERER']);
}