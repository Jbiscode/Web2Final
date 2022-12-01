<?php

include "../inc/dbconn.php";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table{ border-collapse: collapse; }

        #wrap{ width: 500px;}
        .board_view{ width: 100%; border-top:2px solid #666; }
        .board_view th, .board_view td{ border: 1px solid #efefef; padding: 5px; }
        .board_view .board_content{ height: 200px; vertical-align: top; }

        .btn{ text-align: center; display: inline-block; float: right; padding: 7px 10px; border: 1px solid #bbb; background-color: #efefef; }
        .util_menu{ padding-top: 20px; }
    </style>
    <script src="../index.js"></script>
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
        <a href="./all.php" class="btn btn_list">목록</a>
    </div>

    <?php
    $query = "select * from comment where origin_seq = $seq";
    //3. 쿼리 실행
    $result = $connect->query($query ) or die($connect->errorInfo());
    ?>
    <div class="comment_wrap">
        <ul>
        <?php
        while($row = $result->fetch())
        {
            ?>
             <li>
                 작성자 : <?php echo $row["writer_name"]; ?><br>
                 작성일 : <?php echo $row["reg_date"]; ?><br>
                 내용 : <?php echo $row["content"]; ?><br>
             </li>
            <?php
        }
        ?>
        </ul>
        <div class="comment_insert_wrap">
            <form name="commentform" action="comment_insert_confirm.php" method="post" onsubmit="return commentTest()">
            <input type="hidden" name="origin_seq" value="<?php echo $seq; ?>"><br>
            작성자 아이디 : <input type="text" name="comment_userid"><br>
            비밀번호 : <input type="password" name="comment_pw"><br>
            내용 : <textarea name="comment_content" cols="30" rows="10"></textarea><br>
            <button>댓글등록</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>