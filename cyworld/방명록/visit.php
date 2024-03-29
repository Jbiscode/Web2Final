<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/session.php";

if( isset($_REQUEST['seq']) == false ){
    echo "잘못된 접근입니다.";
    exit;
}
$seq = $_REQUEST['seq'];

$query = "select count( * ) as cnt from visit WHERE user_seq = $seq";
$result = $connect->query( $query ) or die($connect->errorInfo());
$resultData = $result->fetch();

$totalCnt = $resultData["cnt"];
$viewCnt = 5;
$pageCnt = $totalCnt / $viewCnt;
$pageNum = isset($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 1;

$startIndex = ($pageNum-1) * $viewCnt;

// 방명록 상세 가져오기
$query = "select * from visit WHERE user_seq = $seq ORDER BY reg_date DESC LIMIT $startIndex, $viewCnt";
$result = $connect->query( $query ) or die($connect->errorInfo());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/assets/css/freeboard.css">
    <script src="/assets/js/index.js"></script>
</head>
<body>
    <div id="visit_insert_wrap">
        <form id="visit_insert_form" name="visitform" action="visit_insert_confirm.php" method="post" onsubmit="return visitTest()">
            <input type="hidden" name="user_seq" value="<?php echo $seq; ?>">
            <?php if(isset($_SESSION['userid'])){?>
                <input type="hidden" name="visit_userid" value="<?php echo $_SESSION['userid']; ?>">
            <?php }else{ ?>
            <div>
                <span>아이디 : <input type="text" name="visit_userid"></span>
                <span>비밀번호 : <input type="password" name="visit_pw"></span>
            </div>
            <?php } ?>
            
            <div>
                <span>
                    <img id="visitor_image" src="/assets/imgs/profile_pic/<?php 
                    if (isset($_SESSION['userid'])) {
                        echo $login_pic;
                    } else {
                        echo "basic_pic.png";}?>">
                </span>
                <textarea id="visitor_content" type="text" name="visitor_content" ></textarea> 
            </div>
            <button>방명록 등록</button>
        </form>
    </div>
    <div id="visit_list_wrap">
        
        <?php
        while($row = $result->fetch())
        {
            ?>
                <div id="visit_list_header">
                    <span><?php echo $row["visitor_name"]; ?></span>
                    <span>(<?php echo $row["reg_date"]; ?>)</span>
                    <a href="/방명록/delete_access.php?seq=<?php echo $seq; ?>&&visitor_name=<?php echo $row['visitor_name'] ?>&&visit_seq=<?php echo $row['seq'] ?>">삭제</a>
                </div>
                <div id="visit_list_content">
                    <img id='comment_img' src="/assets/imgs/profile_pic/<?php echo $row['profilepic'] ?>" alt="1">
                    <p1><?php echo $row["content"]; ?></p1>
                </div>
                    <hr>
            <?php
        }
        ?>
        <?php include_once "../assets/inc/paging.visit.php"; ?>
    </div>

</body>
</html>