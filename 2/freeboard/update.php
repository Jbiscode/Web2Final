<?php
include "dbconn.php";

$seq = $_GET["seq"];

$query = "SELECT * FROM member WHERE seq = '$seq'";
$result = $connect->query($query ) or die($connect->errorInfo());
$man = $result->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script>
        function test(){
            var userpwValue = document.myform.userpw.value;
            var userpwConfirmValue = document.myform.userpw_confirm.value;

            if( document.myform.username.value == "" ){
                alert( "사용자 이름은 필수입니다.");
                return false;
            }
            if( userpwValue == "" ){
                alert( "패스워드를 입력해주세요");
                return false;
            }

            if( userpwValue != userpwConfirmValue ){
                alert( "패스워드를 다시 입력해주세요");
                return false;
            }

            return true;
        }

    </script>
</head>
<body>

<form name="myform" action="update_confirm.php" method="post" enctype="multipart/form-data"
      onsubmit="return test();">
    <input type="hidden" name="userid" value="<?php echo $man["userid"]; ?>">
  아이디 : <?php echo $man["userid"]; ?><br>
  패스워드 : <input type="password" id="userpw" name="userpw"><br>
  패스워드 확인 : <input type="password" id="userpw_confirm" name="userpw_confirm"><br>
  이메일 : <input type="text" name="email0" value="<?php echo $man["email0"]; ?>">@<input type="text" name="email1" value="<?php echo $man["email1"]; ?>"><br>
  이름 : <input type="text" name="username" value="<?php echo $man["username"]; ?>"><br>
    첨부파일 : <input type="file" name="userfile"><br>
    이력서 : <input type="file" name="profile"><br>
    성별 : <input type="radio" name="gender" value="1" <?php echo $man["gender"] == 1 ? "checked" : ""; ?>>남자
            <input type="radio" name="gender" value="2" <?php echo $man["gender"] == 2 ? "checked" : ""; ?>>여자<br>
    취미 : <input type="checkbox" name="hobby[]" value="1" <?php echo strpos($man["hobby"] , "1")!==false ? "checked" : ""; ?>>쇼핑
            <input type="checkbox" name="hobby[]" value="2" <?php echo strpos($man["hobby"] , "2")!==false ? "checked" : ""; ?>>음악감상
            <input type="checkbox" name="hobby[]" value="3" <?php echo strpos($man["hobby"] , "3")!==false ? "checked" : ""; ?>>운동
            <input type="checkbox" name="hobby[]" value="4" <?php echo strpos($man["hobby"] , "4")!==false ? "checked" : ""; ?>>게임
    <br>
    휴대폰 : <input type="text" name="phone0" style="width: 50px;" maxlength="4" value="<?php echo $man["phone0"]; ?>">-<input type="text" name="phone1" value="<?php echo $man["phone1"]; ?>">-<input type="text" name="phone2" value="<?php echo $man["phone2"]; ?>"><br>
    자기소개 : <textarea name="introduce" cols="30" rows="10"><?php echo $man["introduce"]; ?></textarea>
    <button>전송</button>
</form>

</body>
</html>