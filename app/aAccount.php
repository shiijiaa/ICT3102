<?php 
include("php/cookieSessionVar.php");
include("php/getAllAcc.php");
include("php/doUpdateUserStatus.php");
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
	if(sumbitBtn=="Unban"){
		if (confirm('Are you sure you want to unban? User Violation will reset to 0.')) {
			return true;
		} else {
			return false;
		}
		
	}
	
	else{
		if (confirm('Are you sure you want to ban this user?')) {
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
<?php include("php/header/accountsHeader.php")?> 
<!-- navbar -->


<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
			<?php include("php/sidebar/accountSideBar.php");?>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
			<!-- Notification-->
		  <?php include("php/Notification/ErrorSuccess.php");?>
			<h1>Accounts</h1>
			<hr>
		<a href="addAcc.php" class="btn btn-primary btn-xs pull-right" ><b>+</b> Add new Account</a>
		<table id="displayTable" class="table table-striped custab" >
        <thead>
            <tr>
            <th>#</th>
            <th>Name</th>
			<th>Email</th>
			<th>Violation</th>
			<th>Role</th>
			<th>Status</th>
			<th>Action</th>

            </tr>
        </thead>

        <tbody>
		<?php
				for($i=0;$i<count($userArr) ; $i++){
					$id = $i+1;
					$name = $userArr[$i]['user_name'];
					$email = $userArr[$i]['user_email'];
					$role = $userArr[$i]['user_role'];
					$status = $userArr[$i]['user_status'];
					$uid = $userArr[$i]['user_id'];
					$uViol = $userArr[$i]['user_violation'];
					
					if($email != $user_email){
					if($role =="A"){$role = "Admin";}
					else{$role= "User";}
					
					if($status=="A"){$status="Active";} 
					else if($status=="I"){$status="Inactive";} 
					else if($status=="B"){$status="Banned";}
					
					
					
					echo "<tr><td>$id</td>";
					echo "<td><a href ='accountDetail.php?acc_id=$uid' >$name</a></td>";
					echo "<td>$email</td>"; 
					echo "<td>$uViol</td>"; 
					echo "<td>$role</td>";
					echo "<td>$status</td>";

					
					
					
					?>
		
				<td >
				<form action="php/doBanUser.php" method="post" class="form-inline" onsubmit="return validateThis(this)">
				<input type="hidden" name="user_id" value="<?php echo $uid?>" />
				<input type="hidden" name="user_name" value="<?php echo $name?>" />
				
			
				<a  href="editAccount.php?acc_id=<?php echo $uid?>" class="btn btn-info btn-xs" ><span class="glyphicon glyphicon-edit"></span> Edit</a>
				
				<?php
				if (strcasecmp($status ,'Banned')==0){
					echo "<button type='submit' class='btn btn-success btn-xs' name='submit' value='Unban'><span class='glyphicon glyphicon-ok-circle'></span> Unbanned</button>";
		
				}
				else{
					echo "<button type='submit' class='btn btn-danger btn-xs' name='submit' value='Ban'><span class='glyphicon glyphicon-ok-circle'></span> Ban</button>";
					
				}
				?>
				
				</form>
				</tr>
					
					<?php
				}}
            ?>
				</td>
		
	
            
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