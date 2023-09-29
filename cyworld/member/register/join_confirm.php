<?php
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";

$user_id = $_POST['user_id'];
$query = "SELECT * FROM member WHERE userid = '$user_id'";
$result = $connect->query($query) or die($connect->errorInfo());
$memberObj = $result->fetch();
if( $memberObj && $memberObj["seq"] ){
    ?>
    <script>
        alert( "중복된 아이디입니다." );
        history.back();
    </script>
<?php
    exit;
}
// 프로필사진 업로드 처리
$tempFile = $_FILES['imgFile']['tmp_name'];
$fileTypeExt = explode("/", $_FILES['imgFile']['type']);
$fileType = $fileTypeExt[0];
$resFile = "assets/imgs/profile_pic/{$_FILES['imgFile']['name']}";
$imageUpload = move_uploaded_file($tempFile, $resFile);
$profile_pic = $_FILES['imgFile']['name'];
if ($profile_pic == "") {
    $profile_pic = "basic_pic.png";
}

$user_pw0 = $_POST['user_pw0'];
$user_pw1 = $_POST['user_pw1'];
$user_name = $_POST['user_name'];

$user_email0 = $_POST['email0'];
$user_email1 = $_POST['email1'];
$user_email2 = $user_email0."@".$user_email1;

$user_gender = $_POST['gender'];


$hobby = $_POST['hobby'];

if( count($hobby) > 0 ){
    $hobby = implode("|", $hobby );
}else{
    $hobby = '';
}

$user_phone0 = $_POST['phone0'];
$user_phone1 = $_POST['phone1'];
$user_phone2 = $_POST['phone2'];

$introduce = $_POST['introduce'];

$query = "INSERT INTO member (
    userid
    , userpw
    , username
    , email0
    , email1
    , phone0
    , phone1
    , phone2
    , gender
    , hobby 
    , introduce
    , profilepic
    )
VALUES (
'$user_id'
, '$user_pw0'
, '$user_name'
, '$user_email0'
, '$user_email1'
, '$user_phone0'
, '$user_phone1'
, '$user_phone2'
, $user_gender
, '$hobby'
, '$introduce' 
, '$profile_pic'
)
";

$result = $connect->query( $query ) or die($connect->errorInfo());

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/register.css">
    <title>가입 완료!</title>
</head>
<body>
    <div id='confirm_form'>
        <div><?php echo $user_name; ?> 님 아래의 정보로 회원가입이 완료되었습니다.</div>
        <ul>
            <li>아이디 : <?php echo $user_id; ?></li>
            <li>이름 : <?php echo $user_name; ?></li>
            <li>이메일 : <?php echo $user_email2; ?></li>
            <li>성별 : <?php echo $user_gender == 1 ? "남자" : "여자"; ?></li>
            <li>취미 : <?php
        $hobby = $_POST["hobby"];
        if( count($hobby) > 0 ){
            foreach ($hobby as $value ){
                if( $value == 1) echo " |쇼핑|";
                else if( $value == 2 ) echo " |음악감상|";
                else if( $value == 3 ) echo " |운동|";
                else if( $value == 4 ) echo " |게임|";
            }
        }else{
            echo "선택하지 않았습니다";
        }
        ?></li>
            <li>휴대폰 : <?php echo $user_phone0.'-'.$user_phone1.'-'.$user_phone2; ?></li>
        </ul>
        <a id='go_back' href="/index.php"> 돌아가기</a>
    </div>
</body>
</html>