var register = document.querySelector('#register');
var arrIp = register.getElementsByTagName('input');
var R_username = arrIp[0];
var R_email = arrIp[1];
var R_password = arrIp[2];
var repassword = arrIp[3];


function isError(input, message) {
    let parent = input.parentElement;
    let small = parent.querySelector('small');

    parent.classList.add('error')
    small.innerHTML = message;
}

function isNotError(input) {
    let parent = input.parentElement;
    let small = parent.querySelector('small');

    parent.classList.remove('error');
    small.innerHTML = '';
}

function checkEmptyError(input) {
    let isEmptyError = false;
    input.value = input.value.trim();
    if (input.value == '') {
        isError(input, 'không được để trống');
        isEmptyError = true
    } else {
        isNotError(input);
    }
    return isEmptyError;
}

function checkRegex(input, message, regex) {
    var test = regex.test(input.value)
    let isErrorCheckEmail = false;
    if (test) {
        isNotError(input);
    } else {
        isError(input, message)
        isErrorCheckEmail = true;
    }
    return isErrorCheckEmail
}

function checkPW(pw, repw, message) {
    let ischeckBothPW = false;
    if (pw.value == repw.value) {
        isNotError(repw);
    } else {
        isError(repw, message);
        ischeckBothPW = true;
    }
    return ischeckBothPW
}

function checkLength(min, max, input) {
    let ischeckLength = false;
    if (input.value.length < min || input.value.length > max) {
        ischeckLength = true;
        if (input.value.length < min) {
            isError(input, `Nhập tối thiểu ${min} kí tự`);
            return ischeckLength;
        }
        if (input.value.length > max) {
            isError(input, `Nhập tối đa ${max} kí tự`);
            return ischeckLength;
        }
    }
    return ischeckLength;
}

register.addEventListener('submit', function (e) {
    e.preventDefault();
    //check tên tài khoản
    let isUsernameEmptyError = checkEmptyError(R_username);
    if (!isUsernameEmptyError) {
        var isLengthUsernameError = checkLength(6, 12, R_username);
        if (!isLengthUsernameError) {
            var isUserNameError = checkRegex(R_username, 'Chữ cái đầu tiên phải viết hoa [A-Z]', /^[A-Z]/);
        }
    }
    //check email
    let isEmailEmptyError = checkEmptyError(R_email);
    if (!isEmailEmptyError) {
        var isEmaiError = checkRegex(R_email, 'email sai định dạng', /@gmail.com$/);
    }
    //check pw
    let isPWEmptyError = checkEmptyError(R_password);
    if (!isPWEmptyError) {
        var isPWError = checkLength(4, 6, R_password);
    }
    //check repw
    var isRePWEmptyError = checkEmptyError(repassword);
    if (!isRePWEmptyError) {
        var isRePWError = checkLength(4, 6, repassword);
        if (!isRePWError) {
            var ischeckBothPW = checkPW(R_password, repassword, 'mật khẩu không trùng khớp')
        }
    }

    if (isUsernameEmptyError || isLengthUsernameError || isUserNameError || isEmailEmptyError || isEmaiError || isPWEmptyError || isPWError || isRePWEmptyError || isRePWError || ischeckBothPW) {
        console.log("đăng kí thất bại")
    } else {
        e.target.submit();
    }
});