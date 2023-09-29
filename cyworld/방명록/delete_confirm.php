<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";

$userid = $_POST['user_id'];
$userpw = $_POST['user_pw0'];
$visitor_name = $_POST['visitor_name'];
$visit_seq = $_POST['visit_seq'];

$query = "SELECT * FROM member WHERE userid = '$userid'";
$result = $connect->query($query) or die($connect->errorInfo());
$memberObj = $result->fetch();

$user_name = $memberObj['username'];


if ($userpw !== $memberObj["userpw"]) {
?>
<script>
    alert("비밀번호가 틀렸습니다.");
    history.back();
</script>
<?php
    exit;
}
?>
<?php 
$query = "SELECT * FROM visit WHERE visitor_name = '$visitor_name' AND seq = '$visit_seq'";
$result = $connect->query($query) or die($connect->errorInfo());
$visitObj = $result->fetch();

$content = $visitObj['content'];
$reg_date = $visitObj['reg_date'];
$seq = $memberObj['seq'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/register.css">
    <title>회원 삭제 확인</title>
</head>

<body>

    <div id="confirm_form">
        <div>
            <?php echo $user_name; ?>님 방명록을 삭제하면 되돌릴수 없습니다, 그래도 삭제하시겠습니까?
        </div>
        <ul>
            <li>작성자 :
                <?php echo $visitor_name; ?>
            </li>
            <li>작성 일시 :
                <?php echo $reg_date; ?>
            </li>
            <li>내용 :
                <?php echo $content ?>
            </li>
        </ul>
        <span>
            <a id='go_back' href="/방명록/visit.php?seq=<?php echo $memberObj['seq'] ?>"> 뒤로가기</a>
            <a id='del_btn' href="delete_form.php?visitor_name=<?php echo $visitor_name; ?>&&visit_seq=<?php echo $visit_seq ?>&&seq=<?php echo $seq ?>"> 삭제하겠습니다.</a>
        </span>
    </div>
</body>

</html>