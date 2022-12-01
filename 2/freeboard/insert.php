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
            
            if( document.myform.write_name.value == "" ){
                alert( "제목은 필수 항목입니다.");
                document.myform.write_name.focus();
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
<form name="myform" action="insert_confirm.php" method="post" onsubmit="return test();">
    제목 : <input type="text" name="title"><br>
    작성자 : <input type="text" name="writer_name"><br>
    내용 : <textarea name="content" cols="30" rows="50"></textarea>
    <button>전송</button>
</form>        
</body>
</html>