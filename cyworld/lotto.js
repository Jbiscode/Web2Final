function numLotto(){
    let Num = [];                           //중복되지 않은 1에서 45의 숫자들이 6개 들어감
    
    for (let j = 0; j < 999; j++)           //중복된 숫자가 나올 수 있으므로 넉넉하게 999번 반복
    {
      let randomNum = Math.floor(Math.random()* 45) + 1;  //1부터 45의 랜덤한 숫자가 생성됨
      {
      if(Num.indexOf(randomNum) == -1)      //num에 들어간 숫자중에 randomNum의 숫자와 다른지 확인
    
        Num.push(randomNum);                //다르다면 num배열에 randomNum을 넣는다
        if (Num.length == 6)             
        {
          break;                            //num의 길이가 6이 되면 멈춤
        } 
      }
    }
    
    
    function sortNum(a,b)  //로또 숫자들을 오름차순으로 정렬 해주는 함수
    {
      return a - b;
    }
    
    Num.sort(sortNum);     //로또 번호들이 오름차순으로 나온다
    
    document.getElementById("lotto__number").innerText = Num[0]+" "+Num[1]+" "+Num[2]+" "+Num[3]+" "+Num[4]+" "+Num[5];

}
