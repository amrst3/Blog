<?php
require_once '../inc/conn.php';

session_start();
unset($_SESSION['user_id']);

header("location:../index.php");