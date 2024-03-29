<?php

include "../assets/inc/dbconn.php";

$searchKey = isset($_REQUEST['search_key']) ? $_REQUEST['search_key'] : "";
$searchfield = isset($_REQUEST['search_field']) ? $_REQUEST['search_field'] : "";

// 게시글의 전체 갯수 가져오기
$query = "select count( * ) as cnt from freeboard";
if( $searchfield == "all" ) {
    $query = $query . " WHERE title like '%$searchKey%' or writer_name like '%$searchKey%' or content like '%$searchKey%'";
}elseif($searchfield == "title"){
    $query = $query . " WHERE title like '%$searchKey%'";
}elseif($searchfield == "content"){
    $query = $query . " WHERE content like '%$searchKey%'";
}elseif($searchfield == "writer_name"){
    $query = $query . " WHERE writer_name like '%$searchKey%'";
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
if( $searchfield == "all" ) {
    $query = $query . " WHERE title like '%$searchKey%' or writer_name like '%$searchKey%' or content like '%$searchKey%'";
}elseif($searchfield == "title"){
    $query = $query . " WHERE title like '%$searchKey%'";
}elseif($searchfield == "content"){
    $query = $query . " WHERE content like '%$searchKey%'";
}elseif($searchfield == "writer_name"){
    $query = $query . " WHERE writer_name like '%$searchKey%'";
}
$query = $query . " order by seq DESC LIMIT $startIndex, $viewCnt";

//3. 쿼리 실행
$result = $connect->query($query ) or die($connect->errorInfo());

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>자유게시판 리스트</title>
    <link rel="stylesheet" href="../assets/css/freeboard.css">

</head>
<body>
    <div id="board_listBox">
        <div id="searchBox">
            <form id="search_form" action="list.php" method="get" name="search_form">
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
            <thead id="freeboard_head">
            <tr>
                <td class="board_num">No</td>
                <td class="board_name">제목</td>
                <td class="board_writer">작성자</td>
                <td class="board_reg">작성일</td>
                <td class="board_hit">조회수</td>
            </tr>
            </thead>
            <tbody id="freeboard_body">
            <?php
            //4. 결과 처리
            $index=$totalCnt - (($pageNum-1)*$viewCnt);
            while($row = $result->fetch())
            {
                ?>
                <tr>
                    <td class="board_num"><?php echo $index--; ?></td>
                    <td class="board_name"><a href="view.php?seq=<?php echo $row["seq"]; ?>"><?php echo $row["title"]; ?></a></td>
                    <td class="board_writer"><?php echo $row["writer_name"]; ?></td>
                    <td class="board_reg"><?php echo date("y-m-d", strtotime($row["reg_date"])); ?></td>
                    <td class="board_hit"><?php echo $row["hit"]; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php include_once "../assets/inc/paging.inc.php"; ?>
    <div class="util_menu">
        <a href="./insert.php" class="btn_write">쓰기</a>
    </div>

</body>
</html>
