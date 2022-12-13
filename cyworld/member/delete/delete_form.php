<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";

$seq = $_GET['seq'];

$query = "DELETE FROM member WHERE seq = '$seq'";

$result = $connect->query($query) or die($connect->errorInfo());
?>

<script>
    alert('회원정보가 삭제되었습니다.');
    location.href = '/member_list.php';
</script>