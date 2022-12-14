<?php 
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";
session_start();

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    $query = "SELECT * FROM member WHERE userid = '$userid'";
    $result = $connect->query($query) or die($connect->errorInfo());
    $memberObj = $result->fetch();

    $login_username = $memberObj['username'];
    $login_seq = $memberObj['seq'];
}

