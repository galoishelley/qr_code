$(function() {

	$("#login").click(function(){
			//alert("hello");
		 var user_info = {
							user_name:$("#user_name").val(),
							pwd:$("#pwd").val(),
						};
				
			$.ajax({
				url : '../classes/class.login.php',
				data: user_info,
				type : 'POST',
				dataType : 'JSON',
				error : function(ts) {
					//alert("error" + ts.responseText)
					alert("login.js: ajax error");
				},
				success: callbackFun
			});
		return false;
	});
	
	function callbackFun(msg){
		
		iFlag = parseInt(msg.iCount);
		if(! iFlag){
			$("#warning").html(" 账户密码错误");
			$("#warning").addClass("fa fa-minus-circle");
		}else{
			$("#warning").html(" 登录成功");
			location.href="../pages/func.html";
		}
	};
	
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

});
