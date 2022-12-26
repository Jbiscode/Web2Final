<?php

include "../assets/inc/dbconn.php";
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/session.php";
if( isset($_REQUEST['seq']) == false ){
    echo "잘못된 접근입니다.";
    exit;
}

$seq = $_REQUEST['seq'];

// 조회수 증가시키기
$query = "update freeboard set hit = hit+1 WHERE seq = $seq";
$result = $connect->query( $query ) or die($connect->errorInfo());

// 게시글 상세 가져오기
$query = "select * from freeboard WHERE seq = $seq";
$result = $connect->query( $query ) or die($connect->errorInfo());
$resultData = $result->fetch();

// 댓글 가져오기
$query = "select count( * ) as cnt from comment WHERE origin_seq = $seq";
$result = $connect->query( $query ) or die($connect->errorInfo());
$resultData1 = $result->fetch();

$totalCnt = $resultData1["cnt"];
$viewCnt = 5;
$pageCnt = $totalCnt / $viewCnt;
$pageNum = isset($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 1;

$startIndex = ($pageNum-1) * $viewCnt;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/assets/css/freeboard.css">
    <script src="/assets/js/index.js"></script>
</head>
<body>
<div id="wrap">
    <table class="board_view">
        <tbody>
        <tr>
            <th>제목</th>
            <td><?php echo $resultData["title"]; ?></td>
        </tr>
        <tr>
            <th>조회수</th>
            <td><?php echo $resultData["hit"]; ?></td>
        </tr>
        <tr>
            <th>등록일</th>
            <td><?php echo date("Y-m-d", strtotime($resultData["reg_date"]));  ?></td>
        </tr>
        <tr>
            <th>작성자</th>
            <td><?php echo $resultData["writer_name"]; ?></td>
        </tr>
        <tr>
            <th>내용</th>
            <td class="board_content"><?php echo $resultData["content"]; ?></td>
        </tr>
        </tbody>
    </table>
    <div class="util_menu">
        <a href="./freeboard.php" class="btn btn_list">목록</a>
    </div>

    <?php
    $query = "select * from comment where origin_seq = $seq ORDER BY reg_date DESC LIMIT $startIndex, $viewCnt";
    $result = $connect->query($query ) or die($connect->errorInfo());
    

    
    ?>
    <div class="comment_wrap">
        <?php
        while($row = $result->fetch())
        {
            ?>
                <div id="comment_list_header">
                    <span><?php echo $row["writer_name"]; ?></span>
                    <span>(<?php echo $row["reg_date"]; ?>)</span>
                </div>
                <div id="comment_list_content">
                    <img id='comment_img' src="/assets/imgs/profile_pic/<?php echo $row['profilepic'] ?>" alt="1">
                    <p1><?php echo $row["content"]; ?></p1>
                </div>
                    <hr>
            <?php
        }
        ?>
        <?php include_once "../assets/inc/paging.comment.php"; ?>

        <!-- <div class="comment_insert_wrap">
            <form name="commentform" action="/게시판/comment_insert_confirm.php" method="post" onsubmit="return commentTest()">
            <input type="hidden" name="origin_seq" value="<?php echo $seq; ?>"><br>
            작성자 아이디 : <input type="text" name="comment_userid"><br>
            비밀번호 : <input type="password" name="comment_pw"><br>
            내용 : <textarea name="comment_content" cols="30" rows="10"></textarea><br>
            <button>댓글등록</button>
            </form>
        </div> -->
        <div id="comment_insert_wrap">
            <form id="comment_insert_form" name="commentform" action="comment_insert_confirm.php" method="post" onsubmit="return commentTest()">
                <input type="hidden" name="origin_seq" value="<?php echo $seq; ?>">
                <?php if(isset($_SESSION['userid'])){?>
                    <input type="hidden" name="comment_userid" value="<?php echo $_SESSION['userid']; ?>">
                <?php }else{ ?>
                <div>
                    <span>아이디 : <input type="text" name="comment_userid"></span>
                    <span>비밀번호 : <input type="password" name="comment_pw"></span>
                </div>
                <?php } ?>
                
                <div>
                    <span>
                        <img id="comment_image" src="/assets/imgs/profile_pic/<?php 
                        if (isset($_SESSION['userid'])) {
                            echo $login_pic;
                        } else {
                            echo "basic_pic.png";}?>">
                    </span>
                    <textarea id="comment_content" type="text" name="comment_content" ></textarea> 
                </div>
                <button>댓글 등록</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>