$(document).ready(function() {

    
    $("#UserName").addClass("fa fa-user fa-fw");
    $("#UserName").text(" 234");
    var _table = $('#dataTables-example').DataTable({
        "responsive": true,
        "bPaginate": true,//分页按钮
        "bLengthChange" : true,//每行显示记录数
        "bFilter": true,//搜索栏
        "bSort": true,//排序
        "bInfo": true,//Showing 1 to 10 of 23 entries 总记录数没也显示多少等信息
        
        // bProcessing: true,
        // bScrollInfinite: true,
        // bSortClasses: false, //不清楚是做什么用的，如果处理大量数据时，必须关闭

        //sScrollX: "100%",
        //bScrollCollapse: true,

        // sScrollY: "200px",
        // bPaginate: false,
        // "ajax": {
        //   url: "../ajax/data/role.json",
        // },
        "ajax": {
          //url: "../ajax/data/role_demo.json",
          type: "POST",
          url: "../classes/class.func.php",
          //dataType: "json",

          data: function ( d ) {
              d.search_con =  $('#search_con').val();
          }
        },
        // "ajax": "../classes/class.b_roles.php", 
        // "order": "",
        "columns": [
            {
              "data":           null,
            },
            {
                "class":          "",
                "orderable":      false,
                "data":           null,
                "defaultContent": "<input type='checkbox' name='func_chk_list'>"
            },
            // { "data": "order_id" },
            { "data": "FUNC_CODE" },
            { "data": "FUNC_NAME" },
            { "data": "NOTE" },
            { 
              "visible": false,
              "data": "UPDATE_DATE"
            }
        ],

        "oLanguage": {
               "oAria": {
                   "sSortAscending": " - click/return to sort ascending",
                   "sSortDescending": " - click/return to sort descending"
               },
               "sLengthMenu": "显示 _MENU_ 记录",
               "sZeroRecords": "对不起，查询不到任何相关数据",
               "sEmptyTable": "未有相关数据",
               "sLoadingRecords": "正在加载数据-请等待...",
               "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录。",
               "sInfoEmpty": "当前显示0到0条，共0条记录",
               "sInfoFiltered": "（数据库中共为 _MAX_ 条记录）",
               "sProcessing": "<img src='../resources/user_share/row_details/select2-spinner.gif'/> 正在加载数据...",
               "sSearch": "模糊查询：",
               "sUrl": "",
               //多语言配置文件，可将oLanguage的设置放在一个txt文件中，例：Javascript/datatable/dtCH.txt
               "oPaginate": {
                   "sFirst": "首页",
                   "sPrevious": " 上一页 ",
                   "sNext": " 下一页 ",
                   "sLast": " 尾页 "
               }
           },

        "columnDefs": [
          {
             "orderable": false,
             "targets": 0 
          },
          {
             "orderable": false,
             "targets": 1 
          }
         ],//第一列与第二列禁止排序
        "order": [
           [0, null],
           [5, "desc"]
        ],//第一列排序图标改为默认

               // initComplete: function () {//列筛选
               //     var api = this.api();
               //     api.columns().indexes().flatten().each(function (i) {
               //         if (i != 0 && i != 1) {//删除第一列与第二列的筛选框
               //             var column = api.column(i);
               //             var $span = $('<span class="addselect">▾</span>').appendTo($(column.header()))
               //             var select = $('<select><option value="">All</option></select>')
               //                     .appendTo($(column.header()))
               //                     .on('click', function (evt) {
               //                         evt.stopPropagation();
               //                         var val = $.fn.dataTable.util.escapeRegex(
               //                                 $(this).val()
               //                         );
               //                         column
               //                                 .search(val ? '^' + val + '$' : '', true, false)
               //                                 .draw();
               //                     });
               //             column.data().unique().sort().each(function (d, j) {
               //                 function delHtmlTag(str) {
               //                     return str.replace(/<[^>]+>/g, "");//去掉html标签
               //                 }
 
               //                 d = delHtmlTag(d)
               //                 select.append('<option value="' + d + '">' + d + '</option>')
               //                 $span.append(select)
               //             });
 
               //         }
               //     });
 
               // },
        "bAutoWidth": true

    });


    //添加索引列
    _table.on('order.dt search.dt',
      function() {
          _table.column(0, {
              search: 'applied',
              order: 'applied'
          }).nodes().each(function(cell, i) {
              cell.innerHTML = i + 1;
          });
      }).draw();

    //单机行，选中复选框
    $('#dataTables-example tbody').on( 'click', 'tr', function (event) {
      $(this).toggleClass('selected');
      var p = this;
        $($(p).children()[1]).children().each(function(){
          if(this.type=="checkbox"){
            if(!this.checked){
              this.checked = true;
            }else{
              this.checked = false;
            }
          }
        });
    });

    $('#updRow').click( function () {
      var sel = _table.rows('.selected').data().length;
      if(!sel){
        alert("请选择要修改的数据");
        return;
      }
      if(sel>=2){
        alert("修改只能选择一条数据!");
        return;
      }

      var rowIdx = _table.row('.selected').index();
      var func_code = _table.cell( rowIdx, 2 ).data();
      var func_name = _table.cell( rowIdx, 3 ).data();
      var note = _table.cell( rowIdx, 4 ).data();

      $.ajax({
        type:"post",
        url:"func_add.html",
        ceach: false,
        data:"",
        success:function(html){
          // alert("跳转成功");
          $("#page-wrapper").empty();
          $("#page-wrapper").html(html);
          $(".panel-heading").html("修改权限");
          $("#func_code").val(func_code);
          $('#func_code').attr("readonly",true);
          $("#func_name").val(func_name);
          $("#note").val(note);
          $("#func_add_reset").attr("readonly",true);
          $("#action_type").val("update");
          // $("#page-wrapper").on("click","#func_add_cancel",function(event){
          //   event.preventDefault(); 
          // });  
        },
        error: function(result){
            //请求失败之后的操作
            console.log("修改跳转失败" + result);
         }
      });
    });

    $('#delRow').click( function () {

      //alert( _table.rows('.selected').data().length +' row(s) selected' );

      var dataArr = [];
      var rows = $('tr.selected');
      var rowData = _table.rows(rows).data();
      
      var sel = rowData.length;
      if(!sel){
        alert("请选择要删除的数据");
        return;
      }else{
        var r=confirm("确定要删除数据");
        if (!r) return;
      }

      $.each(rowData,function(key,value){
          dataArr.push(value.FUNC_CODE); 
      });
      //console.log(dataArr);

      // var sel = _table.rows('.selected').data().length;
      // if(!sel){s
      //   alert("请选择要删除的数据");
      //   return;
      // }

      // var rowIdx = _table.row('.selected').index();
      // var cellData = _table.cell( rowIdx, 2 ).data();
      
      // var r=confirm("确定要删除 ROLE_ID:"+cellData);
      // if (!r) return;

      $.ajax({
          type: "POST",
          url: "../classes/class.func.php",
          //dataType: "json",
          data: {
              action_type: "remove",
              func_codes: dataArr
          }, 
          success: function (data) {
              if(data){
                _table.ajax.reload();
              }else{
                alert("删除失败!" + data);
              }
              
          },
          error: function(result){
            //请求失败之后的操作
            alert("error:删除失败!" + result);
         }
      });
    });

    $('#addRow').click( function () {

      // $('#func_add_reset').attr("visibility", "visible");
     // $('#func_add_reset').show();
      $.ajax({
        type:"post",
        url:"func_add.html",
        ceach: false,
        data:"",
        success:function(html){
          // alert("跳转成功");
          $("#page-wrapper").empty();
          $("#page-wrapper").html(html);
        },
        error: function(result){
            //请求失败之后的操作
            console.log("失败" + result);
         }
      });
    });
    
    //全选
    $("#func_chk_all").click(function(){
      if($(this).prop("checked"))
      {
        $("input[name=func_chk_list]").closest("tr").addClass('selected');
      }else
      {
         $("input[name=func_chk_list]").closest("tr").removeClass('selected');
      }

      $("input[name=func_chk_list]").prop("checked",$(this).prop("checked"));
    });

    // $("input[name=role_chk_list]").unbind("click");

    //func_add
    $("#page-wrapper").on("click","#func_add_submit",function(){
      //alert("hello:"+$("#func_form").serialize());
      //
      if($("#action_type").val()=="create"){
        $.ajax({
            type: "POST",
            url: "../classes/class.func.php",
            //dataType: "json",
            data:  $("#func_form").serialize(),
            success: function (data) {
                if(data){
                  if(data=="2"){
                    alert("权限编码或权限名称已经存在!");
                    exit();
                  }
                  //_table.ajax.reload();
                  window.location.reload()
                }else{
                  alert("添加失败!" + data);
                }
                
            },
            error: function(result){
              //请求失败之后的操作
              alert("添加失败!" + result);
              // console.log("添加失败" + data);
           }
        });
      }else if($("#action_type").val()=="update"){
        $.ajax({
            type: "POST",
            url: "../classes/class.func.php",
            //dataType: "json",
            data:  $("#func_form").serialize(),
            success: function (data) {
                if(data){
                  //_table.ajax.reload();
                  window.location.reload()
                }else{
                  alert("修改失败!"+ data);
                }
                
            },
            error: function(result){
              //请求失败之后的操作
              alert("修改失败!" + result );
              // console.log("添加失败" + data);
           }
        });
      }
      return false;
    });

    $('#btnTop').click( function () {
      _table.ajax.reload();
    });

    $("#search_con").keypress(function(event){
        if(event.keyCode == 13){
            //这里写你要执行的事件;
            //alert('你输入的内容为：' + $('#search_con').val());
            _table.ajax.reload();
            event.preventDefault();
        }
    });

    $("#page-wrapper").on("click","#func_add_reset",function(){
      $("form :input").val("");
    });

    $("#page-wrapper").on("click","#func_add_cancel",function(){
      window.location.reload();
    });    
});