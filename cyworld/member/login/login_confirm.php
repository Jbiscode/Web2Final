<?php
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";
session_start();

$userid = $_POST['user_id'];
$userpw = $_POST['user_pw'];

$query = "SELECT * FROM member WHERE userid = '$userid'";
$result = $connect->query($query) or die($connect->errorInfo());
$memberObj = $result->fetch();
if( $userpw == $memberObj["userpw"]){
        $_SESSION['userid'] = $userid;
    ?>
    <script>
    setTimeout(function(){
        location.href = "/index.php";
    },2000);
    </script>
    <link rel="stylesheet" href="/styles/loader.css">
    <span class="loader"></span>
<?php
}else{
    ?>
    <script>
        alert( "아이디 또는 비밀번호가 틀렸습니다." );
        history.back();
    </script>
<?php
}
?>