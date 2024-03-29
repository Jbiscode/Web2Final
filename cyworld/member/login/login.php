<?php 
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/dbconn.php";
include "/Users/sajaebin/Documents/Web2FinalHW/cyworld/assets/inc/session.php";

if(isset($userid)){ ?>
    <script>
      alert( "로그인 상태에서는 접근할 수 없습니다." );
      history.back();
      <?php session_destroy(); ?>
    </script>
<?php } ?>


<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <title>로그인 화면</title>
    <link rel="stylesheet" href="/assets/css/login.css" />
    <script src="/assets/js/index.js"></script>
    </head>
  <body>
    <div class="login-card">
      <h2>로그인</h2>
      <h3>로그인 정보를 입력하세요</h3>
      <form class="login-form" name="loginform" action="login_confirm.php" method="post" onsubmit="return loginTest()">
        <input name="user_id" type="text" placeholder="아이디를 입력하세요" />
        <span id="id_error" class="error_msg"></span>
        <input name="user_pw" type="password" placeholder="비밀번호를 입력하세요" / value="">
        <span id="pw_error" class="error_msg"></span>
        <a href="/index.php">아이디가 없으신가요?</a>
        <button type="submit">로그인</button>
      </form>
    </div>
  </body>
</html>