<?php
/**
 * 필수 변수 목록
 * $pageNum : 현재 페이지 번호
 * $viewCnt : 한 화면에 보이는 게시글의 수
 * $pageCnt : 전체 페이지의 수
 */
if( !$pageNum || !$viewCnt || !$pageCnt ){
    echo "페이징 처리를 위한 기본 변수 정의가 필요합니다.";
    exit;
}
?>
<style>
    .paging_wrap{ width: 473px; }
    .paging_wrap ul { width: 473px; margin: 20px auto 0 auto;}
    .paging_wrap ul li{ float: left; list-style-type: none; padding: 0 10px; }
    .page_arrow{ color:blue ;text-decoration: none; font-weight: bold;}
    .page_num{ color: #000;text-decoration: none;}
    .Selected{ font-weight: bold; color: red; text-decoration: none; font-size: 19px;}
</style>
<div class="paging_wrap">
    <ul>
        <?php
        $startPageBlockNum = /* floor = 내림 */ floor( ($pageNum-1)/$viewCnt )+1;
        $startPageBlockNum =($startPageBlockNum-1)*10 + 1;

        $lastPageBlockNum = ($startPageBlockNum-1) + $viewCnt;
        $lastPageBlockNum = min( $lastPageBlockNum, ceil( $pageCnt ) );
        $loopCnt = $lastPageBlockNum-$startPageBlockNum+1;
        ?>

        <?php
        if( $startPageBlockNum > 1 ){
            ?>
            <li><a class="page_arrow" href="./freeboard.php?page_num=1"><<</a></li>
            <li><a class="page_arrow" href="./freeboard.php?page_num=<?php echo $startPageBlockNum-10; ?>"><</a></li>
            <?php
        }
        ?>

        <?php
        for( $i=0; $i<$loopCnt; $i++){
            $currPage = $startPageBlockNum + $i;
            $pointClass = "";
            if( $currPage== $pageNum) $pointClass = "Selected";
            else $pointClass = "page_num";
            ?><li ><a class="<?php echo $pointClass; ?>" href="./freeboard.php?page_num=<?php echo $currPage; ?>"><?php echo $currPage; ?></a></li>
        <?php } ?>

        <?php
        if( $lastPageBlockNum < ceil( $pageCnt ) ){
            ?>
            <li><a class="page_arrow" href="./freeboard.php?page_num=<?php echo $lastPageBlockNum+1; ?>">></a></li>
            <li><a class="page_arrow" href="./freeboard.php?page_num=<?php echo ceil( $pageCnt ); ?>">>></a></li>
            <?php
        }
        ?>
    </ul>
</div>