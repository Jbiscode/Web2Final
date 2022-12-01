<?php

include "dbconn.php";

$userid = $_POST["userid"];
$userpw = $_POST["userpw"];
$email0 = $_POST["email0"];
$email1 = $_POST["email1"];
$username = $_POST["username"];
$gender = $_POST["gender"];
$hobby = $_POST["hobby"];
if( count($hobby) > 0 ){
    $hobby = implode("|", $hobby );
}else{
    $hobby = "";
}
$phone0 = $_POST["phone0"];
$phone1 = $_POST["phone1"];
$phone2 = $_POST["phone2"];
$introduce = $_POST["introduce"];

//2. 쿼리 생성
$query = "UPDATE member SET 
                  userpw = '$userpw'
                , username = '$username'
                , email0 = '$email0'
                , email1 = '$email1'
                , phone0 = '$phone0'
                , phone1 = '$phone1'
                , phone2 = '$phone2'
                , gender = '$gender'
                , hobby  = '$hobby'
                , introduce = '$introduce'
            WHERE userid = '$userid'
";

//3. 쿼리 실행
$result = $connect->query( $query ) or die($connect->errorInfo());

if( !$result ){
    echo "회원정보 수정 오류입니다. 다시 시도해주세요";
    exit;
}
?>
<script>
    alert("회원정보 수정이 정상적으로 처리되었습니다.");
    location.href = "./memberList.php";
</script>
