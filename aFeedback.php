<?php 
$linkLocation="";
$title="";
if(isset($_GET['sch_id'])){
	$getSchID=$_GET['sch_id'];
	
	$linkLocation="aFeedback.php?sch_id=$getSchID";
	include("php/getSchoolFeedback.php");
	$title=$fbArr[0]['sch_name'];
}
else if (isset($_GET['flagged'])){
	$linkLocation="aFeedback.php?flagged";
	$title="Flagged Comment";
	include("php/getAllFlagged.php");
}
else{
	$linkLocation="aFeedback.php";
	$title="Most Recents";
	include("php/getAllFeedback.php");
}

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
	var sumbitBtn = form.submit.value;
	if(sumbitBtn=="Ignore"){
		if (confirm('Are you sure you want to unflag?')) {
			return true;
		} else {
			return false;
		}
		
	}
	
	else{
		if (confirm('Are you sure you want to delete this comment? Note that the user will be banned if they violated more than 3 times.')) {
			return true;
		} else {
			return false;
		}
		
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
<?php include("php/header/feedbackHeader.php")?> 
<!-- navbar -->


<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
		<?php include("php/sidebar/feedbackSideBar.php");?>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
			<?php include("php/Notification/ErrorSuccess.php");?>
			<h1>Feedback</h1><hr>
		<table id="displayTable" class="table table-striped custab" >
        <thead>
            <tr>
            <th><?php echo $title?></th>
			<th></th>
            </tr>

        </thead>
        <tbody>

		
		<?php 
		for($i=0;$i<count($fbArr) ; $i++){
			$schName = $fbArr[$i]['sch_name'];
			$schID = $fbArr[$i]['sch_id'];
			$comment = $fbArr[$i]['fb_comment'];
			$fbID = $fbArr[$i]['fb_id'];
			$accName = $fbArr[$i]['user_name'];
			$accID = $fbArr[$i]['user_id'];
			$postedDate= $fbArr[$i]['fb_date'];
			$flagged = $fbArr[$i]['fb_flag'];
			$accViolation =$fbArr[$i]['user_violation'];
			$fbRating =$fbArr[$i]['fb_rating'];
		?>
		<tr><td>
		
		<div style="height:100%; width:100%;">
			<div style="padding:2%;border-right:2px solid #E7E7E7;">
							<h4> <a href="aFeedback.php?sch_id=<?php echo $schID?>"><?php echo $schName?></a> 
							<span style="float:right;">
							<form action="php/doDeleteFeedback.php" method="post" class="form-inline" onsubmit="return validateThis(this)">
							<input type="hidden" name="linkLocation" value="<?php echo $linkLocation ?>">
							<input type='hidden' name='user_id' value='<?php echo $accID?>'>
							<input type='hidden' name='fb_id' value='<?php echo $fbID?>'>
							<input type='hidden' name='user_violation' value='<?php echo $accViolation?>'>
							<button type='submit' class='btn btn-danger btn-xs' name='submit' value='Delete' style='margin-right:6px;'><span class='glyphicon glyphicon-trash'></span> Delete</button>
							</form>
							</span>
</h4>
				
				<p>
				<?php echo $comment."<br><br><b>Rating:</b> ".$fbRating ?>
				</p>
				
				<p style="float:left;"><b>By:</b> <a href="accountDetail.php?acc_id=<?php echo $accID?>"><?php echo $accName ?></a></p>
				<p style="float:right;"><b>Posted on: </b><?php echo $postedDate?></p>
      
	</td>
	<td align="center" style="padding:50px;">
	
			
		
					<center>
					<?php 
					if($flagged>0){
						echo "<h2 style='color:red;'>$flagged</h2> ";
						echo "<h4>Flagged<h4> ";
						echo "<form action='php/doDeleteFeedback.php' method='post' class='form-inline' onsubmit='return validateThis(this)'>";
						
						echo "<input type='hidden' name='fb_id' value='$fbID'>";
						echo "<input type='hidden' name='linkLocation' value='$linkLocation'>";
						echo "<button type='submit' class='btn btn-success btn-xs' name='submit' value='Ignore' style='margin-right:6px;'><span class='glyphicon glyphicon-ok-circle'  ></span> Ignore</button>";
						echo "</form>";
						
					}else{
						echo "<h2>$flagged</h2> ";
						echo "<h4>Flagged<h4> ";
						
					}
					?>
						
						
						
					</center>

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
<br><br><br><br>
   

<footer class="navbar-default navbar-fixed-bottom" id="footer">
        <center><h4>© SchoolLooker 2017</h4><center>
</footer>

</div>
<!--/.container-->

</body>


</html>