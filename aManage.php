<?php 
include("php/getAllSchool.php");
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
<script>
function validateThis(form) {

	if (confirm('Are you sure you want to delete ?')) {
		return true;
} else {
    return false;
}
	
	
}
</script>
<script>
$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  
  $('#displayTable').dataTable( {
	  fixedHeader: true,
    "iDisplayLength": 20,
    "lengthChange": false,
    "ordering": false,
    "searching": false
  } );

});
</script>

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
			<br><br><br><br>
			<h1>Schools</h1>
			<hr>
			
			<!------------------------------- Notification-------------------->
			
		  <?php 
		  
		  if (isset($_SESSION['info']) && isset($_SESSION['passFail'])){
			  $info = $_SESSION['info'];
			  $passFail = $_SESSION['passFail'];
			  
			  if($passFail ==1){
				  echo "<div class='alert alert-success' style='margin:10px'>";
				  echo "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>";
				  echo "$info";
				  echo "</div>";
			  }
			  
			  else{
				  echo "<div class='alert alert-danger' style='margin:10px'>";
				  echo "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>";
				  echo "$info";
				  echo "</div>";
				  
			  }
			unset($_SESSION['info']);
			unset($_SESSION['passFail']);
		  }
		  ?>
		  			<!------------------------------- Notification-------------------->
		
		<a href="addSchool.php" class="btn btn-primary btn-xs pull-right" ><b>+</b> Add new School</a>
		<table id="displayTable" class="table table-striped custab" >
        <thead>
            <tr>
            <th>#</th>
            <th>School</th>
			<th>Education Level</th>
			<th>Action</th>
	
            </tr>
        </thead>

        <tbody>
		<?php
				for($i=0;$i<count($schArr) ; $i++){
					$id = $i+1;
					$sch_id = $schArr[$i]['sch_id'];
					$location_id = $schArr[$i]['location_id'];
					$name = $schArr[$i]['sch_name'];
					$edu_lvl = $schArr[$i]['sch_education_level'];
					
					echo "<tr><td>$id</td>";
					echo "<td><a href ='schoolDetail.php?sch_id=$sch_id' >$name</a></td>";
					echo "<td>$edu_lvl</a></td>
					
					
					
					";?>
				<td >
				
				<form action="php/doDeleteLocation.php" method="post" class="form-inline" onsubmit="return validateThis(this)">
				<a class="btn btn-info btn-xs"  href="editSchool.php?sch_id=<?php echo $sch_id?>&location_id=<?php echo $location_id ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a>
				<input type="hidden" name="location_id" value="<?php echo $location_id?>">
				<input type="hidden" name="deleteType" value="School">
				<input type="hidden" name="deleteName" value="<?php echo $name?>">
				<button type="submit" class="btn btn-danger btn-xs" name="del_submit"><span class="glyphicon glyphicon-remove"></span> Delete</button>
				
				</form>
				</td>
				</tr>
					
					<?php
				}
            ?>
            
        </tbody>
    </table>
			
			
		
            <!--/row-->
        </div>
        <!--/span-->


    </div>
    <!--/row-->

   <br> <br>  <br>

<footer class="navbar-default navbar-fixed-bottom" id="footer">
        <center><h4>© SchoolLooker 2017</h4><center>
</footer>

</div>
<!--/.container-->

</body>


</html>