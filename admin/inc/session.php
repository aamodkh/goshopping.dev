<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/admin/inc/config.php';

if(!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != 1 || !isset($_SESSION['user_id']) || $_SESSION['user_id'] == "" || !isset($_SESSION['role_id']) || $_SESSION['role_id'] >=3){
    session_destroy();
    @header('location: ./');
    exit;
}
