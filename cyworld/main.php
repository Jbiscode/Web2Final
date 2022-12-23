<?php
include "./assets/inc/dbconn.php";
include "./assets/inc/session.php";

$seq = $_GET['seq'];

$query = "SELECT * FROM member WHERE seq = '$seq'";
$result = $connect->query($query) or die($connect->errorInfo());
$row = $result->fetch();

$query = "SELECT * FROM member";
$result1 = $connect->query($query) or die($connect->errorInfo());
$_SESSION['now_url'] =$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>미니홈피</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <script src="/assets/js/index.js"></script>
    <script>
    function menuHome(){
        /* 눌렀을때 선택된것 표시하기 설정 */
        document.getElementById("contentFrame").setAttribute("src","home.php?seq=<?php echo $seq ?>")
        document.getElementById("menuHome").style="color:black;background-color:white;"
    }
    function menuGame(){
        /* 눌렀을때 선택된것 표시하기 설정 */
        document.getElementById("contentFrame").setAttribute("src","game.php")
        document.getElementById("menuGame").style="color:black;background-color:white;"
    }
    function menuJukebox(){
        /* 눌렀을때 선택된것 표시하기 설정 */
        document.getElementById("contentFrame").setAttribute("src","jukebox.php")
        document.getElementById("menuJukebox").style="color:black;background-color:white;"
    }
    function menuVisit(){
        /* 눌렀을때 선택된것 표시하기 설정 */
        document.getElementById("contentFrame").setAttribute("src","./방명록/visit.php?seq=<?php echo $seq ?>")
        document.getElementById("menuVisit").style="color:black;background-color:white;"
    }
    function menuAll(){
        /* 눌렀을때 선택된것 표시하기 설정 */
        document.getElementById("contentFrame").setAttribute("src","./게시판/freeboard.php")
        document.getElementById("menuAll").style="color:black;background-color:white;"
    }
    </script>
</head>
<body>
    <div class="background">
        <div class="outerbox">
            <div class="wrapper">
                <div class="wrapper__left">
                    <div class="wrapper__left__header">
                        <div class="today">
                            TODAY
                            <span class="zero">0</span> | TOTAL
                            <span class="count">12345</span>
                        </div>
                    </div>
                    <div class="wrapper__left__body">
                        <div class="left__body__header">
                            <div class="left__body__header__gray"><img class="main_pic" src="assets/imgs/profile_pic/<?php echo $row['profilepic'] ?>"></div>
                            <div class="left__body__header__line"></div>
                        </div>
                        <div class="left__body__profile">
                            <div class="profile__detail">
                                <i class="fas fa-user-circle"></i>
                                이름 <span><?php echo $row['username'] ?></span>
                            </div>
                            <div class="profile__detail">
                                <i class="fas fa-phone"></i>
                                Phone <span><?php echo $row["phone0"] . '-' . $row["phone1"] . '-' . $row["phone2"]; ?></span>
                            </div>
                            <div class="profile__detail">
                                <i class="fas fa-envelope-open-text"></i>
                                E-mail <span><?php echo $row['email0']."@".$row['email1'] ?></span>
                            </div>
                            <div class="profile__detail">
                                <i class="fab fa-instagram"></i>
                                인스타그램 <span><?php echo $row['userid'] ?></span>
                            </div>
                        </div>
                        <div class="left__body__footer">
                            <div class="wrapper__friend">
                                <div class="friend__title">일촌</div>
                                <select class="friend__select" onchange="if(this.value) location.href = (this.value);">
                                <option value="" select>파도타기</option>
                                <?php
                                $index = 0;
                                while ($map = $result1->fetch()) {
                                ?>
                                    <option value="<?php echo SERVER_ADDR ?>/main.php?seq=<?php echo $map['seq'] ?>"><?php echo $map['username'] ?>(<?php echo $map['userid'] ?>)</option>
                                <?php
                                    $index++;
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['userid'])){ ?>
                        <?php if($login_seq == $row['seq']){ ?>
                        <a class="profile__detail profile__update" href="/member/update/update_access.php?seq=<?php echo $row['seq']; ?>">정보수정</a>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="wrapper__right">
                    <div class="wrapper__right__header">
                        <div class="right__header__title">Jbiscode</div>
                        <div class="right__header__setting">
                            <?php if(!isset($_SESSION['userid'])){?>
                                <a href="/member/login/login.php">로그인</a>
                            <?php }else{ ?>
                                <a href="/member/login/logout.php"><?php echo $login_username ?> 로그아웃</a>
                            <?php } ?>
                            <a href=""></a>
                            <a href="<?php SERVER_ADDR ?>/index.php">메인페이지로 <i class="fas fa-caret-right arrow"></i></a>
                        </div>
                    </div>
                    <div class="wrapper__right__body">
                        <iframe id="contentFrame" src="home.php?seq=<?php echo $row['seq'] ?>"></iframe>
                    </div>
                </div>
                <div class="navigation">
                    <div id="menuHome" class="navigation__item" onclick="menuReset(); menuHome();">홈</div>
                    <div id="menuGame" class="navigation__item" onclick="menuReset(); menuGame();">게임</div>
                    <div id="menuJukebox" class="navigation__item" onclick="menuReset(); menuJukebox();">쥬크박스</div>
                    <div id="menuVisit" class="navigation__item" onclick="menuReset(); menuVisit();">방명록</div>
                    <div id="menuAll" class="navigation__item" onclick="menuReset(); menuAll();">게시판</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>