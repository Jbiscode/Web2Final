<?php
include "./inc/dbconn.php";

//2. 쿼리 생성
$query = ' select * from member';

//3. 쿼리 실행
$result = $connect->query($query) or die($connect->errorInfo());


?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>회원 리스트</title>
    <link rel="stylesheet" href="./styles/register.css">
</head>

<body>

    <div id='member_list_wrap'>
        <table id='member_list_table'>
            <thead>
                <tr>
                    <td>번호</td>
                    <td>이름</td>
                    <td>사용자아이디</td>
                    <td>전화번호</td>
                    <td>가입일</td>
                    <td>관리</td>
                </tr>
            </thead>
            <tbody>
                <?php
                //4. 결과 처리
                $index = 0;
                while ($row = $result->fetch()) {
                ?>
                <tr>
                    <td>
                        <?php echo ++$index; ?>
                    </td>
                    <td>
                        <?php echo $row["username"]; ?>
                    </td>
                    <td>
                        <a href="main.php?seq=<?php echo $row['seq']; ?>""> <?php echo $row["userid"]; ?></a>
                    </td>
                    <td>
                        <?php echo $row["phone0"] . '-' . $row["phone1"] . '-' . $row["phone2"]; ?>
                    </td>
                    <td>
                        <?php echo $row["reg_date"]; ?>
                    </td>
                    <td>
                        <a class="list_btn" href="update_access.php?seq=<?php echo $row['seq']; ?>">정보수정
                            <a class="list_btn" href="delete_access.php?seq=<?php echo $row['seq']; ?>">삭제
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="/member/register/index.html">신규회원가입하기</a>
    </div>
</body>

</html>