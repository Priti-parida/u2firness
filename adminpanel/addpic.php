<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

    if(isset($_POST['upload'])){
        $img_name = $_FILES['img_name'];
        //echo '<br>';
        //print_r($img_name);
        //echo $id = $_POST['id'];die;
        if($keyvalue==0){
            $uploadsDir = "uploads/";
        $allowedFileType = array('jpg','png','jpeg');
        
        // Velidate if files exist
        if (!empty(array_filter($_FILES['img_name']['name']))) {
        
         // Loop through file items
         $data = array();
         foreach($_FILES['img_name']['name'] as $set=>$val){
             // Get files upload path
             $fileName        = $_FILES['img_name']['name'][$set];
             $tempLocation    = $_FILES['img_name']['tmp_name'][$set];
             $targetFilePath  = $uploadsDir . $fileName;
             $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
             $uploadDate      = date('Y-m-d H:i:s');
             $uploadOk = 1;
             if(in_array($fileType, $allowedFileType)){
                     if(move_uploaded_file($tempLocation, $targetFilePath)){
                        $data[] = $fileName;
                        $new=implode(",",$data);
                       
                     } else {
                         $response = array(
                             "status" => "alert-danger",
                             "message" => "File coud not be uploaded."
                         );
                     }
                 
             } else {
                 $response = array(
                     "status" => "alert-danger",
                     "message" => "Only .jpg, .jpeg and .png file formats allowed."
                 );
             }
             // Add into MySQL database
    
         }
         }
        
    
    //print_r ($new);die;
    //echo "INSERT INTO images set img_name='$new'"; die;
    
        mysqli_query($conn,"INSERT INTO images set img_name='$new'");
    }
    echo "<script>location='addpic.php'</script>";
    
        }
    }
    
    

      // Codefor Deletion
      
      if(isset($_GET['delnotid']))
      {
        $rid=$_GET['delnotid'];
      $query=mysqli_query($conn,"delete from images where id='$rid'");
      
      echo "<script>alert('images Deleted');</script>";
      
      
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
      <div class="formdesign">

<form method="post" 
	      action="addpic.php"
	      enctype="multipart/form-data">

	    <?php  
            if (isset($_GET['error'])) {
            	echo "<p class='error'>";
            	    echo htmlspecialchars($_GET['error']);
            	echo "</p>";
            }
	    ?>

		<input type="file"
		       name="img_name[]"
		       >

		<button type="submit"
		        name="upload">
		    Upload</button>
			<input type="hidden"
		       name="id"
		       >
	</form>
	

	<br/>
	<br/>

	
 
              
	<?php
     
     $sql = "SELECT * FROM images";
     $result = mysqli_query($conn,$sql);
     if(mysqli_num_rows($result)>0){
       while($fetch = mysqli_fetch_assoc($result)){
         $img_name = $fetch['img_name'];
         ?>
       <?php 
			foreach (explode(',',  $img_name) as $image) {
			?>
			<img src="uploads/<?php echo $image; ?>" width="300" height="250">
			<a href="addpic.php?delnotid=<?php echo $fetch['id'];?>" title="delete images"onClick="return confirm('Do you really want to delete');">DELETE</a>
			<?php }} }?>
   




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
