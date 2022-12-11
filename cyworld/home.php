<?php
include "./inc/dbconn.php";

$seq = $_GET['seq'];

$query = "SELECT * FROM member WHERE seq = '$seq'";
$result = $connect->query($query) or die($connect->errorInfo());
$row = $result->fetch();

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/styles/home.css">
</head>
<body>
    <div class="wrapper">
        <div class="wrapper__header">
            <div class="wrapper__header__title">
                <div class="wrapper__home__title">Updated news</div>
                <div class="wrapper__home__sub"> TODAY STORY</div>
            </div>
            <div class="hr">
            </div>
            <div class="wrapper__first__body">
                <?php echo $row['introduce'] ?>
            </div>
        </div>
        <div class="wrapper__body">
            <div class="wrapper__header__title">
                <div class="wrapper__home__title">My Video</div>
                <div class="wrapper__home__sub"> Introduce yourself</div>
            </div>
            <div class="wrapper__second__body">

            </div>
        </div>
    </div>
</body>
</html>