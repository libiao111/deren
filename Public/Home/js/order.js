function submitOrder(){

	var nameIpt = document.getElementById('name'),
		name = nameIpt.value,
		phoneIpt = document.getElementById('phone'),
		phone = phoneIpt.value,
		nameRequired = document.getElementById('nameRequired'),
		phoneIsWrong = document.getElementById('phoneIsWrong'),
		form = document.getElementById('orderInfo');

	// 姓名是否为空
	if(name == ''){
		nameRequired.style.display = "block";
		nameIpt.focus();
		nameIpt.removeEventListener("blur",clear);
        nameIpt.addEventListener("blur",clear);
	}else if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){
		// 手机号格式错误
		phoneIsWrong.style.display = "block";
		phoneIpt.focus();
		phoneIpt.removeEventListener("blur",clear);
        phoneIpt.addEventListener("blur",clear);
	}else{
		// 支付订单
		form.submit();
	}

	// 清除警告图标
	function clear(){
    	phoneNum = phoneIpt.value;
    	if ((/^1[3|4|5|7|8]\d{9}$/.test(phone))){
    		phoneIsWrong.style.display = "none";   		
    	}
    	name = nameIpt.value;
    	if (name){
    		nameRequired.style.display = "none"; 
    	}
    }

}