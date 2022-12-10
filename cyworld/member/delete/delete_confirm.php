<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";

$userid = $_POST['user_id'];
$userpw = $_POST['user_pw0'];

$query = "SELECT * FROM member WHERE userid = '$userid'";
$result = $connect->query($query) or die($connect->errorInfo());
$memberObj = $result->fetch();

$user_id = $memberObj['userid'];
$user_name = $memberObj['username'];
$user_email0 = $memberObj['email0'];
$user_email1 = $memberObj['email1'];
$user_phone0 = $memberObj['phone0'];
$user_phone1 = $memberObj['phone1'];
$user_phone2 = $memberObj['phone2'];

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/register.css">
    <title>회원 삭제 확인</title>
</head>

<body>

    <div id="confirm_form">
        <div>
            <?php echo $user_name; ?>님 정보를 삭제하면 되돌릴수 없습니다, 그래도 삭제하시겠습니까?
        </div>
        <ul>
            <li>아이디 :
                <?php echo $user_id; ?>
            </li>
            <li>이름 :
                <?php echo $user_name; ?>
            </li>
            <li>이메일 :
                <?php echo $user_email0 . '@' . $user_email1; ?>
            </li>
            <li>휴대폰 :
                <?php echo $user_phone0 . '-' . $user_phone1 . '-' . $user_phone2; ?>
            </li>
        </ul>
        <span>
            <a id='go_back' href="/member_list.php"> 뒤로가기</a>
            <a id='del_btn' href="delete_form.php?seq=<?php echo $memberObj['seq']; ?>"> 삭제하겠습니다.</a>
        </span>
    </div>
</body>

</html>