function checkPhone(event){ 
    var phone = document.getElementById('phone'),
    	phoneNum = phone.value,
    	phoneIsWrong = document.getElementById('phoneIsWrong'),

    	password = document.getElementById('password'),
    	passwordNum = password.value,
    	passwordIsWrong = document.getElementById('passwordIsWrong');
   
    /* 验证 */
    if(!(/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){ 
    	// 验证手机号
    	phoneIsWrong.style.display = "block";
        phone.focus();
        phone.removeEventListener("change",clear);
        phone.addEventListener("change",clear);
        return false; 
    } else if(passwordNum == ""){
    	// 验证密码是否为空
    	passwordIsWrong.style.display = "block";
    } else{
    	// 发送手机号和密码
    	$.post("{:U('Login/loginhandle')}",{
    		user_mobi:phoneNum,
    		password:passwordNum
    	},function(status){
    		if(status){
    			// 验证成功，跳转到首页
    			window.location.href = "{:U('index')}";
    		}else{
    			// 验证失败，显示提示图标
    			phoneIsWrong.style.display = "block";
    			passwordIsWrong.style.display = "block";
    		}
    	});
    }

    function clear(){
    	console.log(1);
    	if ((/^1[3|4|5|7|8]\d{9}$/.test(phoneNum))){
    		phoneIsWrong.style.display = "none";   		
    	}
    }
}
