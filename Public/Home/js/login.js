function checkPhone(){ 
    var phone = document.getElementById('phone'),
    	phoneNum = phone.value,
    	phoneIsWrong = document.getElementById('phoneIsWrong'),

    	password = document.getElementById('password'),
    	passwordNum = password.value,
    	passwordIsWrong = document.getElementById('passwordIsWrong');
        js_tooltips = document.getElementsByClassName('js_tooltips')[0];
    /* 验证 */
    if(!(/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){ 
    	// 验证手机号格式
    	phoneIsWrong.style.display = "block";
        phone.focus();
        phone.removeEventListener("blur",clear);
        phone.addEventListener("blur",clear);
        return false; 
    } else if(passwordNum == ""){
    	// 验证密码是否为空
    	passwordIsWrong.style.display = "block";
    	password.focus();
        password.removeEventListener("blur",clear);
        password.addEventListener("blur",clear);
    } else{
    	// 发送手机号和密码
    	$.post(loginHandle,{
    		user_mobi:phoneNum,
    		password:passwordNum
    	}, function(status){
            switch(status.status){
                case 3:
                    // 密码错误
                    passwordIsWrong.style.display = "block";
                    password.removeEventListener("blur",clear);
                    password.addEventListener("blur",clear);
                    break;
                case 2:
                    // 账户被停用
                    js_tooltips.style.display = 'block';
                    setTimeout(function () {
                        js_tooltips.style.display = 'none';
                    }, 2000);
                    break;
                case 1:
                    // 验证成功，跳转到首页
                    window.location.href = goToIndex;
                    break;
                default:
                    // 验证失败，显示提示图标
                    phoneIsWrong.style.display = "block";
                    phone.removeEventListener("blur",clear);
                    phone.addEventListener("blur",clear);
                    break;
            }
    	});
    }

    function clear(){
    	phoneNum = phone.value;
    	if ((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){
    		phoneIsWrong.style.display = "none";   		
    	}
    	passwordNum = password.value;
    	if (passwordNum){
    		passwordIsWrong.style.display = "none"; 
    	}
    }
}
