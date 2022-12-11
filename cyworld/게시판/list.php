<?php

include "../inc/dbconn.php";

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

</head>
<body>
<div id="searchBox">
    <form id="search_form" action="게시판/list.php" method="get" name="search_form">
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
            <td><a href="view.php?seq=<?php echo $row["seq"]; ?>"><?php echo $row["title"]; ?></a></td>
            <td><?php echo $row["writer_name"]; ?></td>
            <td><?php echo $row["reg_date"]; ?></td>
            <td><?php echo $row["hit"]; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<?php include_once "../inc/paging.inc.php"; ?>
    <div class="util_menu">
        <a href="./insert.php" class="btn_write">쓰기</a>
    </div>

</body>
</html>
