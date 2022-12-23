<!-- 
/**
 * 필수 변수 목록
 * $pageNum : 현재 페이지 번호
 * $viewCnt : 한 화면에 보이는 게시글의 수
 * $pageCnt : 전체 페이지의 수
 */ -->
<?php 
$seq = $_REQUEST['seq'];
?>
<style>
    .paging_wrap{ width: 473px; }
    .paging_wrap ul { width: 473px; margin: 20px auto 0 auto;}
    .paging_wrap ul li{ float: left; list-style-type: none; width: 35px; height: 30px; text-align: center; padding: 0px 5px; }
    .page_arrow{ color:blue ;text-decoration: none; font-weight: bold;}
    .page_num{ color: #000;text-decoration: none; font-size: 18px;}
    .Selected{ font-weight: bold; color: red; text-decoration: none; font-size: 20px;}
    .paging_wrap ul li a{display: block;}
</style>
<div class="paging_wrap">
    <ul>
        <?php
        $startPageBlockNum =floor( ($pageNum-1)/$viewCnt )+1;
        $startPageBlockNum =($startPageBlockNum-1)*5 + 1;

        $lastPageBlockNum = ($startPageBlockNum-1) + $viewCnt;
        $lastPageBlockNum = min( $lastPageBlockNum, ceil( $pageCnt ) );
        $loopCnt = $lastPageBlockNum-$startPageBlockNum+1;
        ?>

        <?php
        if( $startPageBlockNum > 1 ){
            ?>
            <li><a class="page_arrow" href="./visit.php?page_num=1&seq=<?php echo $seq ?>"><<</a></li>
            <li><a class="page_arrow" href="./visit.php?page_num=<?php echo $startPageBlockNum-5; ?>&seq=<?php echo $seq ?>"><</a></li>
            <?php
        }
        ?>

        <?php
        for( $i=0; $i<$loopCnt; $i++){
            $currPage = $startPageBlockNum + $i;
            $pointClass = "";
            if( $currPage== $pageNum) $pointClass = "Selected";
            else $pointClass = "page_num";
            ?><li ><a class="<?php echo $pointClass; ?>" href="./visit.php?page_num=<?php echo $currPage; ?>&seq=<?php echo $seq ?>"><?php echo $currPage; ?></a></li>
        <?php } ?>

        <?php
        if( $lastPageBlockNum < ceil( $pageCnt ) ){
            ?>
            <li><a class="page_arrow" href="./visit.php?page_num=<?php echo $lastPageBlockNum+1; ?>">></a></li>
            <li><a class="page_arrow" href="./visit.php?page_num=<?php echo ceil( $pageCnt ); ?>">>></a></li>
            <?php
        }
        ?>
    </ul>
</div>