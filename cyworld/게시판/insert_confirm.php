<?php

include "../inc/dbconn.php";
include "../inc/session.php";
if( !isset($_SESSION["userid"]) ){
    echo "로그인 후 이용해주세요";
    ?>
    <script>
        setTimeout(function (){
            location.href = "/member/login/login.php";
        }, 1000 );
    </script>
    <?php
    exit;
}
$title = $_POST["title"];
$writer_name = $_POST["writer_name"];
$content = $_POST["content"];


//2. 쿼리 생성
    $query = "INSERT INTO freeboard (
                    title
                    , writer_name
                    , content
                    )
    VALUES (
            '$title'
            , '$writer_name'
            , '$content'
    )
    ";
        //3. 쿼리 실행
        $result = $connect->query( $query ) or die($connect->errorInfo());
//}

if( !$result ){
    echo "게시글 등록 오류입니다. 다시 시도해주세요";
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

        location.href = "/게시판/freeboard.php";
    }, 1000 );
</script>

정상적으로 등록 되었습니다.