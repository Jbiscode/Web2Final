<?php

include "dbconn.php";

$seq = $_GET["seq"];

//2. 쿼리 생성
$query = "DELETE FROM member WHERE seq = '$seq'";

//3. 쿼리 실행
$result = $connect->query( $query ) or die($connect->errorInfo());
?>
<script>
    alert("회원정보가 삭제되었습니다.");
    location.href = "./memberList.php";
</script>
