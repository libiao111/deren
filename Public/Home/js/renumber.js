
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
        phone_w = document.getElementById('phone_w'),

        oldPhone = document.getElementById('oldPhone'),
        oldPhoneNum = oldPhone.value,
        oldPhone_w = document.getElementById('oldPhone_w'),

	    btnValidate = document.getElementById('btnValidate'),
        submit = document.getElementById('renumberSubmit');


    // 验证旧手机号格式
    if(!(/^1[3|4|5|7|8]\d{9}$/.test(oldPhoneNum))){

        // 旧手机号格式错误
        oldPhone_w.style.display = "block";
        oldPhone.focus();
        oldPhone.removeEventListener("blur",clear);
        oldPhone.addEventListener("blur",clear);
        return false;

    } else if (!(/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){

        // 验证新手机号格式
        // 格式错误
        phone_w.style.display = "block";
        phone.focus();
        phone.removeEventListener("blur",clear);
        phone.addEventListener("blur",clear);
        return false;

    } else if(phoneNum == oldPhoneNum){

        // 新手机号与旧手机号重复
        phone_w.style.display = "block";
        phone.focus();
        phone.removeEventListener("blur",clear);
        phone.addEventListener("blur",clear);
        return false;

    } else {

		// 验证旧手机号是否存在
    	$.post("{:U('Login/register1')}",{user_mobi:oldPhoneNum},function(status){
    		if(status){
				// 旧手机存在，发送手机号以获取验证码
				$.post("{:U('Login/sms')}",{user_mobi:phoneNum},function(status){
					if(status == 0){
						// 生成验证码失败

					}else{
                        submit.addEventListener('click',sendMsg);
                    }
				});
				// 开始倒计时
				count(btnValidate);
    		}else{
    			phone.value = "该手机号不存在";
    		}
    	});	

        // 发送信息
        function sendMsg(){
            $.post("{:U('Login/mobi')}",{
                user_mobi:oldPhoneNum,
                phone:phoneNum,
                id:
            },function(status){
                if(status == 0){

                }else{
                    window.location.href = "{:U('gotouser')}"; // 这里需要传入用户id
                }
            })
        }

    }

    // 清除警告图标
    function clear(){       
        phoneNum = phone.value;
        if ((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){
            phone_w.style.display = "none";         
        }
        oldPhoneNum = oldPhone.value;
        if ((/^1[3|4|5|7|8]\d{9}$/.test(oldPhoneNum))){
            oldPhone_w.style.display = "none"; 
        }
        validateNum = validate.value;
        if(validateNum){
            validate_w.style.display = "none"; 
        }
    }
}



    } else if (validateNum == ""){

    	// 验证码是否为空
    	validate_w.style.display = "block";
    	validate.focus();
        validate.removeEventListener("blur",clear);
        validate.addEventListener("blur",clear);
        return false;


    	// 发送信息  	
		$.post("{:U('Login/xiugai')}",{
			user_mobi:phoneNum,
			password:passwordNum,
			code:validateNum
		},function(status){
			if(status){
				// 验证成功，跳转到首页
				window.location.href = "{:U('index')}";
			}else{
				// 验证失败，显示提示图标
				phone_w.style.display = "block";
				password_w.style.display = "block";
			}
		}); 	   	
    }

}



