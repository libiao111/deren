
// 验证码倒计时
function count(val){
	var countdown = 60;
	if (countdown == 0) { 
		val.removeAttribute("disabled");    
		val.value = "获取验证码"; 
		countdown = 60; 
		return;
	} else { 
		val.setAttribute("disabled", true); 
		val.value = countdown +"秒后重新获取"; 
		countdown--; 
	} 
	setTimeout(function() { 
		count(val);
	},1000);
}

// 点击获取验证码
function getValidation() {

	var phone = document.getElementById('phone'),
	    phoneNum = phone.value,
	    btnValidate = document.getElementById('btnValidate');

	// 验证手机号格式
	if((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){

		// 验证手机号是否被注册
    	$.post(register1,{
    		user_mobi:phoneNum
    	},function(status){
    		// 已被注册
    		if(status){
				phone.value = "该手机号已被注册";
    		}else{
    			// 发送手机号
				$.post(sms,{user_mobi:phoneNum},function(status){
					if(status == 0){
						// 生成验证码失败

					}
				});
				// 开始倒计时
				count(btnValidate);
    		}
    	});	
	} else {
		// 手机号格式错误
		$("#newPhone_w").show();
		$("#newPhone").unbind("blur").blur(function(){
			if((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){
				$("#newPhone_w").hide();
			}
		});
	}	
}

// 点击提交，验证表单数据
function vali(){ 
    var phone = document.getElementById('phone'),
    	phoneNum = phone.value,
    	phone_w = document.getElementById('phone_w'),

    	validate = document.getElementById('validate'),
    	validateNum = validate.value,
    	validate_w = document.getElementById('validate_w'),

    	password = document.getElementById('password'),
    	passwordNum = password.value,
    	password_w = document.getElementById('password_w'),

    	repassword = document.getElementById('repassword'),
    	repasswordNum = repassword.value;
    	repassword_w = document.getElementById('repassword_w');
   
    /* 验证 */
    if (!(/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){ 

    	// 验证手机号格式
    	phone_w.style.display = "block";
        phone.focus();
        phone.removeEventListener("blur",clear);
        phone.addEventListener("blur",clear);
        return false; 

    } else if (validateNum == ""){

    	// 验证码是否为空
    	validate_w.style.display = "block";
    	validate.focus();
        validate.removeEventListener("blur",clear);
        validate.addEventListener("blur",clear);
        return false;

    } else if (passwordNum == ""){

    	// 验证密码是否为空

    	password_w.style.display = "block";
    	password.focus();
        password.removeEventListener("blur",clear);
        password.addEventListener("blur",clear);
        return false;

    } else if (repasswordNum !== passwordNum){

    	// 重复密码是否一致
    	repassword_w.style.display = "block";
    	repassword.focus();
        repassword.removeEventListener("blur",clear);
        repassword.addEventListener("blur",clear);
        return false;

    } else {

    	// 发送信息 	
		$.post(register,{
			user_mobi:phoneNum,
			password:passwordNum,
			code:validateNum
		},function(status){
			if(status){
				// 验证成功，跳转到提示页面
				window.location.href = goToIndex;
			}else{
				// 验证失败，显示提示图标
				phone_w.style.display = "block";
				password_w.style.display = "block";
			}
		});   	   	
    }

    // 清除警告图标
    function clear(){   	
    	phoneNum = phone.value;
    	if ((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){
    		phone_w.style.display = "none";   		
    	}
    	validateNum = validate.value;
    	if(validateNum){
    		validate_w.style.display = "none"; 
    	}
    	passwordNum = password.value;
    	if (passwordNum){
    		password_w.style.display = "none"; 
    	}
    	repasswordNum = repassword.value;
    	if (repasswordNum == passwordNum){
    		repassword_w.style.display = "none"; 
    	}
    }
}



