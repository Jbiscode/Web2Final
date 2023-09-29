<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/game.css">
    <script src="/assets/js/lotto.js"></script>
    
    <script>
        function startWord(){
            const word = document.getElementById("word").innerText;
            const lastword = word[word.length - 1]

            const myword = document.getElementById("myword").value;
            const firstword = myword[0]

            if(firstword === lastword){
                document.getElementById("result").innerText = "정답입니다 !"
                document.getElementById("word").innerText = myword
                document.getElementById("myword").value = ""
            }else {
                document.getElementById("result").innerText = "틀렸습니다 !"
                document.getElementById("myword").value = ""
            }
        }
    </script>

</head>
<body>
    <div class="wrapper">
        <div class="wrapper__header">
            <div class="header__title">
                <div class="title">GAME</div>
                <div class="subtitle">TODAY CHOICE</div>
            </div>
            <div class="divided__line"></div>
        </div>
        <div class="game__container">
            <img src="./assets/imgs/word.png" alt="끝말잇기">
            <div class="game__title">끝말잇기</div>
            <div class="game__subtitle">제시어 : <span id="word">바나나</span></div>
            <div class="word__text">
                <input id="myword" class="textbox" type="text" placeholder="단어를 입력하세요.">
                <button class="search" onclick="startWord()">입력</button>
            </div>
            <div id="result" class="word__result">결과!</div>
        </div>
        <div class="game__container">
            <img src="./assets/imgs/lotto.png" alt="로또">
            <div class="game__title">LOTTO</div> 
            <div class="game__subtitle">버튼을 누르세요.</div>
            <div class="game__number">
                <div id="lotto__number"></div>
            </div>
            <button class="game__lotto" onclick=numLotto()>Button</button>
        </div>
    </div>
</body>
</html>