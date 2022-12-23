<?php 
include "../assets/inc/session.php";
if( !isset($_SESSION["userid"]) ){
    echo "로그인 후 이용해주세요";
    ?>
    <script>
        setTimeout(function (){
            history.back();
        }, 1000 );
    </script>
    <?php
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script>
        function test(){

            if( document.myform.title.value == "" ){
                alert( "제목은 필수 항목입니다.");
                document.myform.title.focus();
                return false;
            }

            if( document.myform.writer_name.value == "" ){
                alert( "작성자명은 필수 항목입니다.");
                document.myform.writer_name.focus();
                return false;
            }
            if( document.myform.content.value == "" ){
                alert( "내용은 필수 항목입니다.");
                document.myform.content.focus();
                return false;
            }
            return true;
        }

    </script>
</head>
<body>

<form name="myform" action="/게시판/insert_confirm.php" method="post" onsubmit="return test();">
    작성자 : <?php echo $login_username ?><input type="hidden" name="writer_name"><br>
    제목 : <input type="text" name="title"><br>
    내용 : <textarea name="content" cols="40" rows="20"></textarea>
    <button>전송</button>
</form>
</body>
</html>