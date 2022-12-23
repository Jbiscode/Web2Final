<?php 
session_start();

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    $login_username = $_SESSION['username'];
    $login_seq = $_SESSION['seq'];
    $login_pic = $_SESSION['profilepic'];
    $now_url = isset($_SESSION['now_url']) ? $_SESSION['now_url'] : "";
}

