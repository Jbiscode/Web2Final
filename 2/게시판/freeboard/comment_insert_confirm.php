<?php

include "../inc/dbconn.php";

$originSeq = $_POST["origin_seq"];
$writer_name = $_POST["comment_writer_name"];
$content = $_POST["comment_content"];


//2. 쿼리 생성
    $query = "INSERT INTO comment (
                     writer_name
                    , content
                    , origin_seq
                    )
    VALUES (
             '$writer_name'
            , '$content'
            , $originSeq
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