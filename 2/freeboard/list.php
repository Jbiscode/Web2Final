<?php

include "dbconn.php";

$searchKey = isset($_REQUEST['search_key']) ? $_REQUEST['search_key'] : "";

// 게시글의 전체 갯수 가져오기
$query = "select count( * ) as cnt from freeboard";
if( $searchKey ) {
    $query = $query . " WHERE title like '%$searchKey%' or writer_name like '%$searchKey%'";
}
$result = $connect->query( $query ) or die($connect->errorInfo());
$resultData = $result->fetch();

$totalCnt = $resultData["cnt"];
$viewCnt = 10;
$pageCnt = $totalCnt / $viewCnt;
$pageNum = isset($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 1;

$startIndex = ($pageNum-1) * $viewCnt;

//2. 쿼리 생성
$query = "select * from freeboard";
if( $searchKey ) {
    $query = $query . " WHERE title like '%$searchKey%' or writer_name like '%$searchKey%'";
}
$query = $query . " order by seq DESC LIMIT $startIndex, $viewCnt";

//3. 쿼리 실행
$result = $connect->query($query ) or die($connect->errorInfo());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>자유게시판 리스트</title>
    <style>
        .bold { font-weight: bold;}
    </style>
    <script>
        // window.onload = function (){
        //     var searchBtn = document.querySelector("#searchBtn");
        //     var searchKey = document.querySelector("#searchKey");
        //     searchBtn.addEventListener("click", function (){
        //         location.href = "./list.php?search_key=" + searchKey.value;
        //     })
        // }
    </script>
</head>
<body>
<div id="searchBox">
    <form id="search_form" action="./list.php" method="get" name="search_form">
        <select name="search_field" id="">
            <option value="all">전체</option>
            <option value="writer_name">작성자</option>
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>
        <input type="text" name="search_key" id="searchKey" value="<?php echo $searchKey; ?>">
        <button id="searchBtn">검색</button>
    </form>
</div>

<table>
    <thead>
    <tr>
        <td>번호</td>
        <td>제목</td>
        <td>작성자</td>
        <td>작성일</td>
        <td>조회수</td>
    </tr>
    </thead>
    <tbody>
    <?php
    //4. 결과 처리
    $index=$totalCnt - (($pageNum-1)*$viewCnt);
    while($row = $result->fetch())
    {
        ?>
        <tr>
            <td><?php echo $index--; ?></td>
            <td><?php echo $row["title"]; ?></td>
            <td><?php echo $row["writer_name"]; ?></td>
            <td><?php echo $row["reg_date"]; ?></td>
            <td><?php echo $row["hit"]; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<div>
    <ul>
        <?php
        $startPageBlockNum = floor( ($pageNum-1)/$viewCnt )+1;
        $startPageBlockNum =($startPageBlockNum-1)*10 + 1;

        $lastPageBlockNum = ($startPageBlockNum-1) + $viewCnt;
        $lastPageBlockNum = min( $lastPageBlockNum, ceil( $pageCnt ) );
        $loopCnt = $lastPageBlockNum-$startPageBlockNum+1;
        ?>

        <?php
        if( $startPageBlockNum > 1 ){
        ?>
            <li><a href="./list.php?page_num=1"><<</a></li>
            <li><a href="./list.php?page_num=<?php echo $startPageBlockNum-10; ?>"><</a></li>
        <?php
        }
        ?>

        <?php
        for( $i=0; $i<$loopCnt; $i++){
            $currPage = $startPageBlockNum + $i;
            $pointClass = "";
            if( $currPage== $pageNum) $pointClass = "bold";
                ?><li class="<?php echo $pointClass; ?>"><a href="./list.php?page_num=<?php echo $currPage; ?>"><?php echo $currPage; ?></a></li>
        <?php } ?>

        <?php
        if( $lastPageBlockNum < ceil( $pageCnt ) ){
        ?>
        <li><a href="./list.php?page_num=<?php echo $lastPageBlockNum+1; ?>">></a></li>
            <li><a href="./list.php?page_num=<?php echo ceil( $pageCnt ); ?>">>></a></li>
            <?php
        }
        ?>
    </ul>
</div>
</body>
</html>
