//* 정보 입력값 확인
test = () => {
    var myForm = document.myform;
    var userpwValue = myForm.user_pw0.value;
    var userpwConfirmValue = myForm.user_pw1.value;
    var idError = document.getElementById("id_error");
    var pwError = document.getElementById("pw_error");
    var pw2Error = document.getElementById("pw2_error");
    var nameError = document.getElementById("name_error");
    var genderError = document.getElementById("gender_error");
    var hobbyError = document.getElementById("hobby_error");
    var phoneError = document.getElementById("phone_error");
    var emailError = document.getElementById("email_error");

    const ERROR_MESSAGE = {
        ID_ERROR: "아이디를 입력해주세요.",
        PW_ERROR: "비밀번호를 입력해주세요.",
        PW2_ERROR: "비밀번호를 확인해주세요.",
        NAME_ERROR: "이름을 입력해주세요.",
        GENDER_ERROR: "성별을 선택해주세요.",
        HOBBY_ERROR: "취미를 1개 이상선택해주세요.",
        PHONE_ERROR: "휴대폰 번호를 입력해주세요.",
        EMAIL_ERROR: "이메일을 입력해주세요.",
    };
    var inputCheck = false;
    var idCheck,
        pwCheck,
        pw2Check,
        nameCheck,
        emailCheck,
        genderCheck,
        hobbyCheck,
        phoneCheck;


    if (myForm.user_id.value == "") {
        idError.innerText = ERROR_MESSAGE.ID_ERROR;
        idCheck = false;
    } else {
        idError.innerText = "";
        idCheck = true;
    }

    if (myForm.user_pw0.value == "") {
        pwError.innerText = ERROR_MESSAGE.PW_ERROR;
        pwCheck = false;
    } else {
        pwError.innerText = "";
        pwCheck = true;
    }

    if (userpwValue != userpwConfirmValue) {
        pw2Error.innerText = ERROR_MESSAGE.PW2_ERROR;
        pw2Check = false;
    } else {
        pw2Error.innerText = "";
        pw2Check = true;
    }

    if (myForm.name_input.value == "") {
        nameError.innerText = ERROR_MESSAGE.NAME_ERROR;
        nameCheck = false;
    } else {
        nameError.innerText = "";
        nameCheck = true;
    }

    if (myForm.email0.value == "" || myForm.email1.value == "") {
        emailError.innerText = ERROR_MESSAGE.EMAIL_ERROR;
        emailCheck = false;
    } else {
        emailError.innerText = "";
        emailCheck = true;
    }

    if ((myForm.gender1.checked || myForm.gender2.checked) == false) {
        genderError.innerText = ERROR_MESSAGE.GENDER_ERROR;
        genderCheck = false;
    } else {
        genderError.innerText = "";
        genderCheck = true;
    }

    if ((myForm.hobby1.checked || myForm.hobby2.checked || myForm.hobby3.checked || myForm.hobby4.checked) !== true) {
        hobbyError.innerText = ERROR_MESSAGE.HOBBY_ERROR;
        hobbyCheck = false;
    } else {
        hobbyError.innerText = "";
        hobbyCheck = true;
    }

    if ((myForm.phone0.value && myForm.phone1.value && myForm.phone2.value) == "") {
        phoneError.innerText = ERROR_MESSAGE.PHONE_ERROR;
        phoneCheck = false;
    } else {
        phoneError.innerText = "";
        phoneCheck = true;
    }

    if ((idCheck && pwCheck && pw2Check && nameCheck && emailCheck && genderCheck && hobbyCheck && phoneCheck) == true) {
        inputCheck = true;
    } else {
        inputCheck = false;
    }

    if (inputCheck == false) {
        alert("입력값을 확인해주세요.");
        return false;
    } else {
        return true;
    }
};


//* 자동으로 포커스 이동
changeFocus = () => {
    const phone0 = document.getElementById("phone0").value;
    const phone1 = document.getElementById("phone1").value;

    if (phone0.length === 3) {
        document.getElementById("phone1").focus();
    }
    if (phone1.length === 4) {
        document.getElementById("phone2").focus();
    }
};

menuReset = () => {
    document.getElementById("menuHome").style="color:white;background-color:#298eb5"
    document.getElementById("menuGame").style="color:white;background-color:#298eb5"
    document.getElementById("menuJukebox").style="color:white;background-color:#298eb5"
    document.getElementById("menuVisit").style="color:white;background-color:#298eb5"
    document.getElementById("menuAll").style="color:white;background-color:#298eb5"
}

commentTest = () =>{
    if( document.commentform.comment_userid.value == "" ){
        alert( "아이디는 필수 항목입니다.");
        document.commentform.comment_userid.focus();
        return false;
    }
    if( document.commentform.comment_pw.value == "" ){
        alert( "비밀번호는 필수 항목입니다.");
        document.commentform.comment_pw.focus();
        return false;
    }
    if( document.commentform.comment_content.value == "" ){
        alert( "내용은 필수 항목입니다.");
        document.commentform.comment_content.focus();
        return false;
    }
    return true;
}