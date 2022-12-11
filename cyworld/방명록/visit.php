<?php

include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";

if( isset($_REQUEST['seq']) == false ){
    echo "잘못된 접근입니다.";
    exit;
}

$seq = $_REQUEST['seq'];


// 방명록 상세 가져오기
$query = "select * from visit WHERE user_seq = $seq";
$result = $connect->query( $query ) or die($connect->errorInfo());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/styles/freeboard.css">
    <script src="/scripts/index.js"></script>
</head>
<body>
    <div id="visit_insert_wrap">
        <form id="visit_insert_form" name="commentform" action="visit_insert_confirm.php" method="post" onsubmit="return commentTest()">
            <input type="hidden" name="user_seq" value="<?php echo $seq; ?>">
            <div>
                <span>아이디 : <input type="text" name="visit_userid"></span>
                <span>비밀번호 : <input type="password" name="visit_pw"></span>
            </div>
            <div>
                <span>방명록 : </span><textarea id="visitor_content" type="text" name="visit_content" ></textarea> 
            </div>
            <button>방명록 등록</button>
        </form>
    </div>
    <div>
        <ul>
        <?php
        while($row = $result->fetch())
        {
            ?>
                <div>
                    작성자: <?php echo $row["visitor_name"]; ?>
                    (<?php echo $row["reg_date"]; ?>)
                </div>
                <div>
                    <img id='comment_img' src="/images/profile_pic/<?php echo $row['profilepic'] ?>" alt="1">
                    <p1>내용 : <?php echo $row["content"]; ?></p1>
                </div>
                    <hr>
            <?php
        }
        ?>
        </ul>
    </div>

</body>
</html>