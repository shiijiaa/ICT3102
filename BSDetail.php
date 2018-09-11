<?php 
	include("php/doGetBSDetail.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Looker</title>
<link href="css/css.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- Latest compiled&minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!-- jQuery library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Latest compiled JavaScript -->
<!-- Sidemenu-->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
</head>
<body>

<!-- /.navbar -->
<?php include("php/header/manageHeader.php")?> 
<!-- navbar -->


<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
	<!-- Side bar-->
	<?php include("php/sidebar/manageSideBar.php");?>
        <!--/span-->

		
        <div class="col-xs-12 col-sm-9">
			<br><br>
			
			<br><br>
				<?php 
			  if (isset($_SESSION['info']) && isset($_SESSION['passFail'])){
			  $info = $_SESSION['info'];
			  $passFail = $_SESSION['passFail'];
			  
			  if($passFail ==1){
				  echo "<div class='alert alert-success' style='margin:10px'>";
				  echo "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>";
				  echo "$info";
				  echo "</div>";
				  unset($_SESSION['info']);
				  unset($_SESSION['passFail']);
			  }}
			?>
		
			<h1>Blackspot Detail</h1>
			<hr>
			<p><b>Location Address:</b> <?php echo $bs_add ?></p>
			<p><b>Latitude:</b> <?php echo $bs_lat ?></p>
			<p><b>Longitude:</b> <?php echo $bs_long ?></p>
			<br>
			
			<a class="btn btn-primary btn-lg"  href="aManageBS.php">Back</a>
        </div>
        <!--/span-->


    </div>
    <!--/row-->

   

<footer class="navbar-default navbar-fixed-bottom" id="footer">
        <center><h4>© SchoolLooker 2017</h4><center>
</footer>

</div>
<!--/.container-->

</body>


</html>