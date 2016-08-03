<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a href="#">
            <img src="image/QR_1_1.gif" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/aYongHuGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/bQuanXianGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/cQueSeGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/dRiZhiGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/eSheBeiLeiBieGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/fLeiBieShuXingGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="image/gShuJuKuGuanLi.jpg" class="img-rounded" />
          </a>
        </li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
    <div class="container-fluid">
    <div class="table-responsive">
      <table class="table" id="myTable" data-bind="visible: true">
        <thead class="panel-heading">
          <tr>
            <th></th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Title/Position</th>
            <th>Contact Number</th>
          </tr>
        </thead>
        <!-- Table Head -->
        <tbody 
                data-bind="foreach: cList">
                    <tr>
                        <td>
                            <div class="btn-toolbar" role="toolbar" aria-label="">
                                <div class="btn-group btn-group-xs" role="group" aria-label="">
                                    <span><span class="glyphicon glyphicon-minus-sign" 
                                    data-bind="click: cDelete"></span></span>
                                </div>
                                <span> </span> 
                                <div class="btn-group btn-group-xs" role="group" aria-label="">
                                    <span><span class="glyphicon glyphicon-edit" id="save" data-toggle="modal" data-target="#cModal2" 
                                    data-bind="click:  cUpdate.bind($data,$index())"></span></span>
                                </div>
                            </div>
                        </td>
                        <td><span 
                        data-bind="text: cFName"> </span> <span 
                        data-bind="text: cLName"></span></td>
                        <td 
                        data-bind="text: cEmail"></td>
                        <td 
                        data-bind="text: cTitle"></td>
                        <td 
                        data-bind="text: cPhone"></td>
                        
                    </tr>
                </tbody> 
        <!-- Table Body -->
      </table>
      <!-- end-of-table -->
    </div>
    <!-- responsive-div -->
    <input type="hidden" id="studentID" name='student_id' data-bind="value: student_id" /> 
    <!--hiddent input for ID-->
    <div class="modal-footer">
    <button type="reset" class="btn btn-default" id="close">Reset</button> 
    <button type="button" class="btn btn-primary" id="save" data-bind="click: sSave">Save changes</button></div>
    <!--end of modal-footer-->
    <!--end of form--></div>
	
	<?php include('includes/modal/modals.php'); ?>
	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cModal2" data-bind="click: cAdd"><span class="glyphicon glyphicon-plus-sign"></span> Add Contact</button>
	
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> 
    <!--end of container-->
     
    <!--

            <div class="container-fluid">
                        
                        

                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
                        --></div>
    <!-- /#page-content-wrapper -->
  </div>
  
  <!-- /#wrapper -->
  <!-- jQuery -->
  <script src="js/jquery.js"></script> 
  <!-- Bootstrap Core JavaScript -->
   
  <script src="js/bootstrap.min.js"></script> 
  <!-- Menu Toggle Script -->
  
  <!-- knockoutJS -->
   <script src="js/knockout-3.3.0.debug.js"></script>

    <!-- Knockout Mapping plugin-->
   <script src="js/knockout.mapping-2.4.1.js"></script>
  
  <script src="js/viewModel.js"></script>
   <script src="js/studentinfo.js"></script>
  </body>
</html>
