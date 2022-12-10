<?php

include "../inc/dbconn.php";

$userpw=$_POST['visit_pw'];
// $userpw=$_POST['userpw']
$userid = $_POST['visit_userid'];
$content = $_POST["visit_content"];

//3. 쿼리 실행
$query = "SELECT * FROM member WHERE userid = '$userid'";
$result = $connect->query($query) or die($connect->errorInfo());
$man = $result->fetch();
if( !$man ){
    ?>
    <script>
        alert( "존재하지 않는 아이디입니다." );
        history.back();
    </script>
<?php
    exit;
}

if( $userpw !== $man["userpw"] ){
    ?>
    <script>
        alert( "비밀번호가 틀렸습니다." );
        history.back();
    </script>
<?php
    exit;
}
if( $content == "" ){
    ?>
    <script>
        alert( "내용을 입력해주세요." );
        history.back();
    </script>
<?php
    exit;
}


$userSeq = $_POST["user_seq"];
$visitor_name = $man["username"];
$profilepic = $man["profilepic"];



//2. 쿼리 생성
    $query = "INSERT INTO visit (
                    visitor_name
                    , content
                    , user_seq
                    , profilepic
                    )
    VALUES (
            '$visitor_name'
            , '$content'
            , $userSeq
            , '$profilepic'
    )
    ";
        //3. 쿼리 실행
        $result = $connect->query( $query ) or die($connect->errorInfo());
//}

if( !$result ){
    echo "방명록 등록 오류입니다. 다시 시도해주세요";
    ?>
    <script>
        history.back();
    </script>
    <?php
    exit;
}
?>

<script>
    setTimeout(function (){

        location.href = "visit.php?seq=<?php echo $userSeq; ?>";
    }, 1000 );
</script>

정상적으로 등록 되었습니다.