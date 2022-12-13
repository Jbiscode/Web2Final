<?php
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/inc/dbconn.php";

$seq = $_GET['seq'];
$visitor_name = $_GET['visitor_name'];
$visit_seq = $_GET['visit_seq'];

$query = "SELECT * FROM member WHERE seq = '$seq'";
$result = $connect->query($query) or die($connect->errorInfo());
$row = $result->fetch();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/register.css">
    <title>삭제접근</title>
</head>

<body>
    <form id='access_form' action="./delete_confirm.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>아이디</td>
                <td><span>
                        <?php echo $row['userid'] ?>
                    </span></td>    
                <td><input type="hidden" name="user_id" id="user_id" value="<?php echo $row['userid'] ?>"></td>
                <td><input type="hidden" name="visitor_name" id="visitor_name" value="<?php echo $visitor_name ?>"></td>
                <td><input type="hidden" name="visit_seq" id="visit_seq" value="<?php echo $visit_seq ?>"></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="password" name="user_pw0" id="user_pw0" class="pw_check" placeholder='기존비밀번호를 입력하시오'>
                </td>
            </tr>
        </table>
        <button>
            확인
        </button>
    </form>
</body>

</html>