/**
 * 
 */
$(function(){
	
	/**
	function CreateTable(rowCount,cellCount,tb_th,msg,flag,tb_td){
		var table=$("<table border=\"1\">");
		table.appendTo($("#createtable"));
		//add th
		var tr=$("<tr id=\"table_th\"></tr>");
		tr.appendTo(table);
		for(var j=0;j<cellCount;j++){
			if(!j){
				var th=$("<th><input type=\"checkbox\"/>"+tb_th[j]+"</th>");
				th.appendTo(tr);
			}else{
				var th=$("<th>"+tb_th[j]+"</th>");
				th.appendTo(tr);
			}
		}
		/*
		var i=0,flag="roles";
		var tbodyId = eval("msg."+flag+"["+i+"]."+tb_td[i]);
		alert("d = " + tbodyId);
		
		
		//alert("rowCount "+rowCount);
		//alert("cellCount "+cellCount);
		//add th
		for(var i=0;i<rowCount;i++){
			var tr=$("<tr></tr>");
			tr.appendTo(table);
			var k=0,rowID=1;
			for(var j=0;j<cellCount;j++){
				if(!j){
					var td=$("<td><input id=\"yinxin\" type=\"checkbox\"/></td>");
					/**
					$("#yinxin").unbind().bind("click",function(){
						alert("yinxin");
					});
					*
				}else if(j==1){
					var td=$("<td>"+ eval(i+1) +"</td>");
				}else if(j>1 && j<(cellCount-1)){
					var tbodyId = eval("msg."+flag+"["+i+"]."+tb_td[k++]);
					var td=$("<td>"+tbodyId+"</td>");
				}else{
					//var td=$("<td>"+msg.flag.tb_td[j]+"</td>");
					td.appendTo(tr);
				}
				td.appendTo(tr);
			}
			
		}

		//trend.appendTo(table);
		$("#createtable").append("</table>");
  };
**/

function CreateTable(rowCount,cellCount,tb_th,msg,flag,tb_td){
		var table=$("#fTable");
		//add th
		var tr=$("<thead><tr></tr></thead>");
		tr.appendTo(table);
		for(var j=0;j<cellCount;j++){
			if(!j){
				var th=$("<th><input id=\"chk_all\" type=\"checkbox\"/>"+tb_th[j]+"</th>");
				th.appendTo(tr);
			}else{
				var th=$("<th>"+tb_th[j]+"</th>");
				th.appendTo(tr);
			}
		}
		
		for(var i=0;i<rowCount;i++){
			var tr=$("<tbody><tr></tr>");
			tr.appendTo(table);
			var k=0,rowID=1;
			for(var j=0;j<cellCount;j++){
				if(!j){
					var td=$("<td id=\"col_0\"><input name=\"chk_list\" type=\"checkbox\"/></td>");
					/**
					$("#yinxin").unbind().bind("click",function(){
						alert("yinxin");
					});
					**/
				}else if(j==1){
					var td=$("<td id=\"col_1\">"+ eval(i+1) +"</td>");
				}else if(j>1 && j<(cellCount-1)){
					var tbodyId = eval("msg."+flag+"["+i+"]."+tb_td[k++]);
					var td=$("<td id=\"col_"+(k+1)+"\">"+tbodyId+"</td>");
				}else{
					var td=$("<td><img src=../images/info.gif> <img src=../images/update.gif> </td>");
					td.appendTo(tr);
				}
				td.appendTo(tr);
			}
		}

		//trend.appendTo(table);
		tr.append("</tbody>");
		
		$("#chk_all").unbind().bind("click",function(){
			 $("input[name='chk_list']").attr("checked",$(this).attr("checked"));
			 //$("#chk_list").attr("checked", true);
		});


  };
	
	$.ajax({
		url : '../classes/class.b_roles.php',
		//data: user_info,
		type : 'POST',
		dataType : 'JSON',
		error : function(ts) {
			//alert("error" + ts.responseText)
			alert("roles.js: ajax error");
		},
		success: callbackFun
	});
	
	function callbackFun(msg){
		//alert(msg.roles[0].FUNCTION_ID);
		//alert(msg[1].FUNCTION_ID);
		//alert(msg.roles.length+1);
		
		//$("#roles").html(" 登录成功");
		var tb_th=new Array("","序号","权限代码","权限名称","备注","操作");
		var tb_td=new Array("ROLE_ID","ROLE_NAME","NOTE");
		var flag="roles";
		//var jsontext = JSON.stringify(msg);
		//alert(jsontext);
		//alert(jsontext[0].ROLE_ID);
						
		CreateTable(msg.roles.length,tb_th.length,tb_th,msg,flag,tb_td);
	};
	
	$("#chk_all").click(function(){
			 
	});


	//$("#yinxin").click(function(){alert("yinxin");});
	
})