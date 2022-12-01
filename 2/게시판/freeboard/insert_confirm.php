<?php

include "../inc/dbconn.php";

$title = $_POST["title"];
$writer_name = $_POST["writer_name"];
$content = $_POST["content"];


//$len = 100;
//$originValue1 = $title;
//$originValue2 = $writer_name;
//for( $i=0; $i<$len; $i++ ){

//    $title = $originValue1 . $i;
//    $writer_name = $originValue2 . $i;
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

        location.href = "./list.php";
    }, 1000 );
</script>

정상적으로 등록 되었습니다.