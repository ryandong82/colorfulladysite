window.onload = function() {
    var btnJoin = document.getElementById("join");
    btnJoin.onclick = function() {
        var divEle = document.getElementById("registerform");
        divEle.className = "formbody formbody-animation";
        btnJoin.className = "joinbutton";
        btnJoin.style.display = "none";
    }
}

function regSubmit(e) {
    var frm = e.target;
    var edtPassw = document.getElementById("retype_reg_password");
    var edtPass = document.getElementById("edtPass");
    edtPassw.attributes["value"].value = edtPass.attributes["value"].value;
    e.preventDefault();
    $.ajax({
        dataType: "json",
        url: frm.attributes["action"].value,
        method: "post",
        async: true,
        data: $(frm).serialize(),
        success: function(data) {
            if (data.result == 0) {
                var errmsg_box = document.getElementById("reg_error_msg");
                errmsg_box.innerHTML = data.error;
            } else {
                errmsg_box.innerHTML = "注册成功";
            }
        },
        error: function() {}
    });
}

function showDiv(divElement) {
    var $waitingCover = $(document.getElementById(divElement));
    $waitingCover.removeClass("waitCloseAnimation");
    $waitingCover.addClass("waitAnimation");
}

function closeDiv(divElement) {
    var $waitingCover = $(document.getElementById(divElement));
    $waitingCover.removeClass("waitAnimation");
    $waitingCover.addClass("waitCloseAnimation");
}

function validate(str) {
    var reg = /^1\d{10}$/;
    return reg.test(str);
}

function check_picCode() {
    var m_number = document.getElementById("edt_reg_mobile");
    if (!validate(m_number.value)) {
        alert("请入正确的手机号");
        m_number.focus();
        return;
    }
    send_post();
}

function send_post() {
    var btn = document.getElementById("btnSendVerifyCode");
    var phone = document.getElementById("edt_reg_mobile").value;
    $.ajax({
        type: "POST",
        url: "main/custom/mobile_verify_wx.php",
        data: {
            phone_number: phone
        },
        dataType: "JSON",
        success: function(data) {
            if (data.code != 0) {
                alert(data.msg + "\n" + data.sub_msg);
            } else {
                btn.disabled = true;
                intervalId = setInterval(desTime, 1000);
            }
        }
    });
}
var sec = parseInt(30);
var intervalId;

function desTime() {
    var btn = document.getElementById("btnSendVerifyCode");
    var btnText = document.getElementById("btnSendText");
    if (sec <= 0) {
        sec = parseInt(30);
        btnText.innerHTML = "发送验证码";
        btn.disabled = false;
        clearInterval(intervalId);
    } else {
        sec -= 1;
        btnText.innerHTML = "重新发送(" + sec + ")";
    }
}