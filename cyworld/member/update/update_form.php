<?php
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";
$userpw=$_POST['user_pw0'];
// $userpw=$_POST['userpw']

$userid = $_POST['user_id'];

//3. 쿼리 실행
$query = "SELECT * FROM member WHERE userid = '$userid'";
$result = $connect->query($query) or die($connect->errorInfo());
$man = $result->fetch();

if( $userpw !== $man["userpw"] ){
    ?>
    <script>
        alert( "비밀번호가 틀렸습니다." );
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
    <title>회원정보 수정</title>

    <script src="/assets/js/index.js"></script>
    <link rel="stylesheet" href="/assets/css/register.css">
    
</head>
<body>
    <form class='formStyle' name='myform' action="update_confirm.php" method="post" enctype="multipart/form-data"  onsubmit="return test()" >
        <h3>🁢 로그인 정보 수정</h3>
        <div class="log_info"><span>아이디 : </span><input type="hidden" id="user_id" class="reg_box" name="user_id" value="<?php echo $man['userid'] ?>" ><span id='reg_id'><?php echo $man['userid'] ?></span></div>
        <span id="id_error" class="error_msg"></span>
        <div class="log_info"><span>비밀번호 : </span><input type="password" id="user_pw0" class="reg_box" name="user_pw0" placeholder="변경할 비밀번호를 입력해주세요."></div>
        <span id="pw_error" class="error_msg"></span>
        <div class="log_info"><span>비밀번호 확인 : </span><input type="password" id="user_pw1" class="reg_box" name="user_pw1" placeholder="비밀번호를 한번 더 입력해주세요."></div>
        <span id="pw2_error" class="error_msg"></span>

        <h3>🁢 개인 정보 수정</h3>
        <div>이름 : <input id="name_input" type="text" name="user_name" value="<?php echo $man['username'] ?>"></div>
        <span id="name_error" class="error_msg"></span>
        <div>이메일 : <input type="text" class="email_box" name="email0" value="<?php echo $man['email0'] ?>"> @ <input type="text" class="email_box" name="email1" value="<?php echo $man['email1'] ?>"> </div>
        <span id="email_error" class="error_msg"></span>
        <div>
                성별 : <input type="radio" id='gender1' name="gender" value="1" <?php echo $man['gender'] ==1 ? "checked" : ''; ?>> 남자
                    <input type="radio" id='gender2' name="gender" value="2" <?php echo $man['gender'] ==2 ? "checked" : ''; ?>> 여자
        </div>
        <span id="gender_error" class="error_msg"></span>
        <div>
            취미 :  <input type="checkbox" id='hobby1' name="hobby[]" value="1" <?php echo strpos($man['hobby'], "1") !== false ? "checked" : ''; ?> /> 쇼핑
                    <input type="checkbox" id='hobby2' name="hobby[]" value="2" <?php echo strpos($man['hobby'], "2") !== false ? "checked" : ''; ?> /> 음악감상
                    <input type="checkbox" id='hobby3' name="hobby[]" value="3" <?php echo strpos($man['hobby'], "3") !== false ? "checked" : ''; ?> /> 운동
                    <input type="checkbox" id='hobby4' name="hobby[]" value="4" <?php echo strpos($man['hobby'], "4") !== false ? "checked" : ''; ?> /> 게임
        </div>
        <span id="hobby_error" class="error_msg"></span>
        <div>
            휴대폰 : <input type="text" class="phone_box" id='phone0' name="phone0" maxlength="3" value="<?php echo $man['phone0'] ?>" oninput="changeFocus()">
            - <input type="text" class="phone_box" id='phone1' name="phone1" maxlength="4" value="<?php echo $man['phone1'] ?>" oninput="changeFocus()" />
            - <input type="text" class="phone_box" id='phone2' name="phone2" maxlength="4" value="<?php echo $man['phone2'] ?>" />
        </div>
        <span id="phone_error" class="error_msg"></span>
        <br>
        <div>
            자기소개 : <textarea id="introduce" name="introduce" cols="30" rows="10"><?php echo $man['introduce']; ?></textarea>
        </div>
        <div id="btn_wrap"><button id="reg_btn">수정하겠습니다</button></div>
    </form>
</body>
</html>