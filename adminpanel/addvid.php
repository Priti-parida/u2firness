<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
	
if(ISSET($_POST['submit'])){

  $video_id =$_POST['video_id'];
  $video_name =$_POST['video_name'];
  $location =$_FILES['location'];
  $description =$_POST['description'];


if($video_id==0){

     $pro_video = $_FILES['location']['name'];
       $file_type = $_FILES['location']['type'];
       $temp_name = $_FILES['location']['tmp_name'];
       $file_size = $_FILES['location']['size'];
        $file_destination = "video/".$pro_video;
        move_uploaded_file($temp_name,$file_destination);

  // $file_name = $_FILES['location']['name'];
  // $file_temp = $_FILES['location']['tmp_name'];
  // $file_size = $_FILES['location']['size'];
 
  // $file_type = $_FILES['location']['type'];
  // $temp_name = $_FILES['location']['tmp_name'];
       
  // $file_destination = "video/".$file_name;

  // //echo "INSERT into video set video_name='$video_name',location='$file_name'"; die;

  mysqli_query($conn,"INSERT into video set video_name='$video_name',location='$pro_video',description='$description'");

}
}


  // $file_name = $_FILES['video']['name'];
  // $file_temp = $_FILES['video']['tmp_name'];
  // $file_size = $_FILES['video']['size'];
  // $pro_video = $_FILES['video']['name'];
  // $file_type = $_FILES['video']['type'];
  // $temp_name = $_FILES['video']['tmp_name'];
       
  // $file_destination = "video/".$pro_video;
  // move_uploaded_file($temp_name,$file_destination);
  
  // /*if($file_size < 500000000){


  //   $file = explode('.', $file_name);
  //   $end = end($file);
  //   $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
  //   if(in_array($end, $allowed_ext)){*/
  //     $video_name = date("Ymd").time();
  //     $location = 'video/'.$video_name.".".$end;
      
  //       mysqli_query($conn, "INSERT INTO `video` VALUES('', '$video_name', '$file_name')") or die(mysqli_error());
       
}
  ?>
  <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>Videos</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/extended/form-extended.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <style>
    .errorWrap {
    padding: 10px;
    margin: 20px 0 0px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>


</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include('includes/header.php');?>
<?php include('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Add video
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
            
                </li>
                <li class="breadcrumb-item active">video</li>
              </ol>
            </div>
          </div>
        </div>
   
      </div>
      <div class="content-body">
        <!-- Input Mask start -->
   
        <!-- Formatter start -->
       
<form name="course" method="post" enctype='multipart/form-data'>        
        <section class="formatter" id="formatter">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">video</h4>
 
                </div>
                <div class="card-content">
                  <div class="card-body">
                    

  <div class="row">
                      <div class="col-xl-6 col-lg-12">
                        <fieldset>
                          <h5>video name
                         
                          </h5>
                          <div class="form-group">

  <input class="form-control white_bg" id="video_name" type="text" name="video_name" required>
                          </div>
                        </fieldset>

                         </div>
        

            </div>

   <div class="row">
                      <div class="col-xl-6 col-lg-12">           
 <fieldset>
                          <h5>video
                         
                          </h5>
                          <div class="form-group">

  <input  type="file" name="location" class="form-control" rows="12" cols="14">
                          </div>
                        </fieldset>

                      </div>


                      <div class="col-xl-6 col-lg-12">           
 <fieldset>
                          <h5>Description
                         
                          </h5>
                          <div class="form-group">

  <textarea  type="text" name="description" class="form-control" rows="12" cols="14" ></textarea>
                          </div>
                        </fieldset>

                      </div>
                    </div>

 
<div class="row">
<div class="col-xl-6 col-lg-12">
<button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">ADD</button>
</div>
</div>



 </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Formatter end -->
      </form>  
      
     
     </div>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php include('includes/footer.php');?>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

  <script src="app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/typeahead/handlebars.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/formatter/formatter.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/card/jquery.card.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-typeahead.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-inputmask.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-formatter.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-maxlength.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-card.js" type="text/javascript"></script>

</body>
</html>
