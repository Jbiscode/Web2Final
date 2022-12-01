function testBtn() {
  const testBtn = document.getElementById("register_button");
  testBtn.disabled = false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

let inputOk = false;

function emailCheck() {}



function inputCheck() {
  //각각 형식이 맞는지 확인하는 함수
  let email = document.getElementById("email").value;
  let name = document.getElementById("name").value;
  let pw1 = document.getElementById("pw1").value;
  let pw2 = document.getElementById("pw2").value;

  const INPUT_CHECK_MASSAGE = {
    EMAIL_INVALID_MASSAGE: "메일을 다시 입력하세요.",
    NAME_INVALID_MASSAGE: "이름을 입력하세요.",
    PW2_INVALID_MASSAGE: "비밀번호가 다릅니다."
}

  if (email.includes("@") !== false) {
    document.getElementById("email_error").innerText = "";
    inputOk = true;
  } else {
    document.getElementById("email_error").innerText = INPUT_CHECK_MASSAGE.EMAIL_INVALID_MASSAGE;
    inputOk = false;
  }

  if (name !== "") {
    document.getElementById("name_error").innerText = "";
    inputOk = true;
  } else {
    document.getElementById("name_error").innerText = INPUT_CHECK_MASSAGE.NAME_INVALID_MASSAGE;
    inputOk = false;
  }

  if (pw1 === pw2) {
    document.getElementById("pw2_error").innerText = "";
    inputOk = true;
  } else {
    document.getElementById("pw2_error").innerText = INPUT_CHECK_MASSAGE.PW2_INVALID_MASSAGE;
    inputOk = false;
  }
}

///////////// //////////////////////////////////////////////////////////////////////////////////////////////////

let isStarted = false; //변수를 바깥에 설정해놔야 확실히 적용이된다.  버튼 타이머

const pressedBtn = () => {
  if (isStarted === false && inputOk === true) {
    isStarted = true;

    const token = String(Math.floor(Math.random() * 1000000)).padStart(6, "0");
    document.getElementById("auth").innerText = token;
    // document.getElementById("auth").style.color ="#"+ token

    let time = 180;

    const cfBtn = document.getElementById("cf");
    cfBtn.disabled = false;

    // let getTime = null                  위에안쓰고
    //getTime =  이렇게안하고           (const , let)  getTime = 지정해도 됌

    let getTime = null;
    getTime = setInterval(() => {
        if (time >= 0) {
            const min = String(Math.floor(time / 60)).padStart(1, "0");
            const sec = String(time % 60).padStart(2, "0");
            document.getElementById("timer").innerText = min + ":" + sec;
            time = time - 1;
            const cfBtn = document.getElementById("cf");
            cfBtn.disabled = false;
            console.log(time);
          } else {
            const cfBtn = document.getElementById("cf");
            cfBtn.disabled = true;
            document.getElementById("auth").innerText = "000000";
            document.getElementById("timer").innerText = "0:00";
    
            clearInterval(getTime);
            isStarted = false;
          }
    }, 1000);
  } else if (inputOk === false) {
    alert("입력한 정보를 확인하세요");
  } else {
    alert("인증번호가 아직 유효합니다.");
  }
};


////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////////////////////
function changeFocus1() {
  //휴대폰번호 입력하면 다음으로 커서이동

  const phone1 = document.getElementById("phone1").value;

  if (phone1.length === 3) {
    document.getElementById("phone2").focus();
  }
}

function changeFocus2() {
  const phone2 = document.getElementById("phone2").value;

  if (phone2.length === 4) {
    document.getElementById("phone3").focus();
  }
}

/////////////////////////////////////////////////////////////////////////////////////////
function isAllInputEmpty(){
 
  const allInputs = ["email", "name", "pw1", "pw2", "phone1", "phone2", "phone3"];
  // 배열을 순회 하면서 익명함수를 배열 요소에 하나씩 적용한 결과를 다시 배열로 만든다.
  // map 은 배열 => 함수 => 배열  
  const values = allInputs.map((input) => document.getElementById(input).value);
  
  return values.every((value) => value !== "");

 // map, filter, reduce 

//   const email = document.getElementById("email").value; //  (1)각각 입력값 불러오기 정의
//   const name = document.getElementById("name").value;
//   const pw1 = document.getElementById("pw1").value;
//   const pw2 = document.getElementById("pw2").value;
//   const phone1 = document.getElementById("phone1").value;
//   const phone2 = document.getElementById("phone2").value;
//   const phone3 = document.getElementById("phone3").value;

//   email.le

//   return email !== "" &&
//   name !== "" &&
//   pw1 !== "" &&
//   pw2 !== "" &&
//   phone1 !== "" &&
//   phone2 !== "" &&
//   phone3.length == "4"
}

////////////////////////////////////////////////////////////////////////
function checkValidation() {                                //입력값에 빈칸이 없을때 회원가입 버튼 활성화시키는 함수


  if (isAllInputEmpty()) {
    document.getElementById("auth_button").disabled = false;
    document
      .getElementById("auth_button")
      .setAttribute("style", "background-color:white");
  } else {
    document.getElementById("auth_button").disabled = true;
    document
      .getElementById("auth_button")
      .setAttribute("style", "background-color:none");
  }
}

function cfButton() {
  //인증확인버튼 눌렀을때 인증완료뜨기
  alert("인증이 완료되었습니다.");
  document.getElementById("register_button").disabled = false;
  document.getElementById("auth").innerText = "000000";
  document.getElementById("timer").innerText = "0:00";
  document.getElementById("cf").disabled = true;
  time = 0;
  clearInterval(getTime);
}
