<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dpName = "blog";

$conn = mysqli_connect($host,$user,$pass,$dpName);

if (!$conn) {
    echo "Connection faild";
}