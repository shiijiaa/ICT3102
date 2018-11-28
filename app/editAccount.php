<?php 
	include("php/doGetAccountDetail.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Looker</title>
<link href="css/css.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Latest compiled&minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!-- jQuery library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Dialog -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">


</head>
<body>
<!-- /.navbar -->
<?php include("php/header/accountsHeader.php")?> 
<!-- navbar -->


<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
<!-- Side bar-->
	<?php include("php/sidebar/accountSideBar.php");?>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
			<?php include("php/Notification/ErrorSuccess.php");?>
			
			<h1>Edit Account</h1>
			<hr>


 <form action="php/doEditAccRole.php"  method="post" style="padding:20px" class="spanx well" >
 
		<input type="hidden" name="acc_id" id="acc_id" value="<?php echo $acc_id; ?>" >
		<div class="form-group required">
		<label for="reg_full_name" style="padding-bottom:8px;" tabindex="1">Full Name: </label>
			<input type="text" name="reg_full_name" id="fullname" class="form-control" value="<?php echo $acc_name;?>" disabled >
		</div>
                  
        <!-- Gender -->
         <div class="form-group required" >
		  <label for="reg_gender" style="padding-bottom:8px;" tabindex="1">Gender: </label>
            <select name="reg_gender" id="reg_gender" class="form-control" tabindex="2" disabled >
				<option value="<?php echo $acc_gender?>" disabled selected><?php echo $acc_gender;?></option>
           </select>
        </div>
                  
        <!--Birthday-->
        <div class="form-group required">
		<label for="reg_birthday" style="padding-bottom:8px;" tabindex="1">Birthday: </label>
        <input class="form-control" id="reg_birthday" name="reg_birthday" placeholder="YYYY-MM-DD" type="date_format"  value="<?php echo $acc_birthdate;?>" disabled>
        </div>
                  
                  
        <!--Email -->     
        <div class="form-group required">
		<label for="reg_email" style="padding-bottom:8px;" tabindex="1">Email: </label>
        <input type="email" name="reg_email" id="email" tabindex="1" class="form-control"  value="<?php echo $acc_email;?>"  disabled >
        </div>
                    
		
		 <!-- Role -->
         <div class="form-group required" >
		 <label for="user_role" style="padding-bottom:8px;" tabindex="1">Role: </label>
            <select name="user_role" class="form-control" >
				<?php 
				if (strcasecmp($acc_role, "Admin") == 0) {
					echo "<option  value='A' selected='selected'>Admin</option>";
					echo "<option  value='U' >User</option>";
					
				}else if (strcasecmp($acc_role, "User") == 0){
					echo "<option  value='U' selected='selected' >User</option>";
					echo "<option  value='A' >Admin</option>";
					
				}
				?>
              </select>
        </div>
                  
                  
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<a  class="btn btn-large  btn-primary " style="width:40%;margin-right:10px;" href="aAccount.php" >Back</a>
					<input type="submit" name="submit" class="btn btn-large  btn-primary" value="Submit" style="width:40%;" />
				</div>
			</div>
		</div>
</form>
            <!--/row-->
        </div>
        <!--/span-->


    </div>
    <!--/row-->
</div>
</body>
</html>

