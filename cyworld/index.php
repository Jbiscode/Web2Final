<?php
include "./inc/dbconn.php";
include_once "./inc/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>회원 리스트</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div id="background">
        <div id="wrapper">
            <div id="header">
                <div id="left_header">
                    <img id="main_logo" src="https://cyworld.com/img/svg/logo_cyworld.svg" alt="">
                    <h2>ㄷr시 만나서 반ㄱr워!</h2>
                    <p>새롭게 쌓이는 추억, 우리 함께 만들어요.</p>
                </div>
                <div id="right_header">
                    <img src="https://cyworld.com/img/gif/landing2_gif3.gif" alt="1">
                    <img src="https://cyworld.com/img/gif/landing2_gif4.gif" alt="2">
                </div>
            </div>
            <div id="container">
                <div id="left_container">
                    <?php if(!isset($_SESSION['userid'])){ ?>
                    <div id="left_container_wrapper">
                        <h1>
                            지금 바로 싸이월드에 접속하세요!
                        </h1>
                        <div id="login_container">
                            <a href="<?php echo $_SERVER ?>/member/login/login.html">
                                <img src="https://cyworld.com/img/svg/logo_cyworld.svg" alt="">로그인
                            </a>
                        </div>
                        <p>
                            아이디가 없으신가요? <a href="/member/register/index.html">회원가입</a>
                        </p>
                    </div>
                    <?php }else{ ?>
                    <div id="left_container_wrapper">
                        <h1>
                        <?php echo $login_username ?>님! 어서오세요!
                        </h1>
                        <div id="login_container">
                            <a href="<?php echo $_SERVER ?>/main.php?seq=<?php echo $login_seq ?>">
                                <img src="https://cyworld.com/img/svg/logo_cyworld.svg" alt="">미니홈피로 이동 
                            </a>
                        </div>
                        <p>
                            <a href="<?php echo $_SERVER ?>/member/login/logout.php">로그아웃</a>
                        </p>
                    </div>
                    <?php } ?>
                </div>
                <div id="right_container">
                    <img src="./images/indeximg2.png" alt="">
                    <img src="./images/indeximg3.png" alt="">
                </div>
        </div>
    </div>
</body>

</html>