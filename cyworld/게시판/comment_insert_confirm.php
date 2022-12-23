<?php

include "../assets/inc/dbconn.php";

$userpw=$_POST['comment_pw'];
// $userpw=$_POST['userpw']
$userid = $_POST['comment_userid'];

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


$originSeq = $_POST["origin_seq"];
$writer_name = $man["username"];
$content = $_POST["comment_content"];
$profilepic = $man["profilepic"];



//2. 쿼리 생성
    $query = "INSERT INTO comment (
                    writer_name
                    , content
                    , origin_seq
                    , profilepic
                    )
    VALUES (
            '$writer_name'
            , '$content'
            , $originSeq
            , '$profilepic'
    )
    ";
        //3. 쿼리 실행
        $result = $connect->query( $query ) or die($connect->errorInfo());
//}

if( !$result ){
    echo "덧글 등록 오류입니다. 다시 시도해주세요";
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

        location.href = "view.php?seq=<?php echo $originSeq; ?>";
    }, 1000 );
</script>

정상적으로 등록 되었습니다.