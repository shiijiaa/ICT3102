
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

<script>
function showError(message) {
  BootstrapDialog.show({
    title: 'Attention',
    message: message,
	type: BootstrapDialog.TYPE_DANGER,
    buttons: [{
      label: 'Ok',
      cssClass: 'btn-default',
      action: function(dialog) {
        dialog.close();
      }
    }]
  });
  
  return false;
}



function validationFunction($msg){
	var list = document.createElement('ul');
	for(var i = 0; i < $msg.length; i++) {
		 var item = document.createElement('li');
		 item.appendChild(document.createTextNode($msg[i]));
		 list.appendChild(item);	
	}

	showError(list);
}

//The reason of puttig this script here because got some bug if I put at the header. It will affect doLogin.php.
function validateForm(form) {
	 
	var RE_NAME = /^[A-Z a-z]+$/
	var RE_EMAIL = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/
	var RE_PASSWORD = /^[\S]{6,20}$/
	var RE_DATE = /^\d{4}[\-\/\s]?((((0[13578])|(1[02]))[\-\/\s]?(([0-2][0-9])|(3[01])))|(((0[469])|(11))[\-\/\s]?(([0-2][0-9])|(30)))|(02[\-\/\s]?[0-2][0-9]))$/
	var errors = [];

    var name = form.reg_full_name.value;
	var email = form.reg_email.value;
	var password = form.reg_password.value;
	var confirmPass = form.reg_cfm_password.value;
	var birthday = form.reg_birthday.value;
	var gender = form.reg_gender.value;
	var user_role = form.user_role.value;


	
	//Name Validation
	if (name == "") {
		errors.push("Please enter your full name");
    }
	else if (!RE_NAME.test(name)){
		errors.push( "Please enter valid  name");
	}
	
	//Gender
	if (gender == "") {
		errors.push("Please select user gender");
    }
	
	
	
	
	//Email Validation
	if (!RE_EMAIL.test(email)){
		errors.push( "Please enter a valid Email");
	}
	
		
	//Password Validation
	if (password =="" || confirmPass =="" ){
		errors.push("Password and Comfirmation Password required");
	}
	
	else if (!RE_PASSWORD.test(password)){
		errors.push("Please a enter a password 6 - 20 characters in length");
	}
	
	else if (password!= confirmPass){
		errors.push("The password and confirmation password do not match");
	}
	

	//Birthday Validation
	if (!RE_DATE.test(birthday)){
		errors.push("Birthday format must be: YYYY-MM-DD and must be valid date");
	}
	else if(birthday==""){
		errors.push("Birthday required");
	}
	
		//Role
	if (user_role == "") {
		errors.push("Please select user role");
    }
	


	//If more than 1 error
	if (errors.length > 0) {
		validationFunction(errors);
		return false;
    }
	
		

}
</script>


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
			<?php include("php/Notification/Error.php");?>
			
			<h1>Add Account</h1>
			<hr>

  <form action="php/doAddAcc.php" method="post"  style="padding:20px" class="spanx well" onsubmit="return validateForm(this)" >
		
		
		<div class="form-group required">
		<label for="reg_full_name" style="padding-bottom:8px;" tabindex="1">Full Name: </label>
			<input type="text" name="reg_full_name" id="fullname" class="form-control" >
		</div>
                  
        <!-- Gender -->
         <div class="form-group required" >
		  <label for="reg_gender" style="padding-bottom:8px;" tabindex="1">Gender: </label>
            <select name="reg_gender" id="reg_gender" class="form-control" tabindex="2"  >
			
				<option value="" disabled selected>Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                </select>
        </div>
                  
        <!--Birthday-->
        <div class="form-group required">
		<label for="reg_birthday" style="padding-bottom:8px;" tabindex="1">Birthday: </label>
            <input class="form-control" id="reg_birthday" name="reg_birthday" placeholder="YYYY-MM-DD" type="date_format"/>
        </div>
                  
                  
        <!--Email -->     
        <div class="form-group required">
		<label for="reg_email" style="padding-bottom:8px;" tabindex="1">Email: </label>
            <input type="email" name="reg_email" id="email" tabindex="1" class="form-control"  value="" >
        </div>
                    
        <!-- Password-->
        <div class="form-group required">
		<label for="reg_email" style="padding-bottom:8px;" tabindex="1">Password: </label>
            <input type="password" name="reg_password" id="password" tabindex="2" class="form-control regex" >
        </div>
		
        <div class="form-group required">
		<label for="reg_email" style="padding-bottom:8px;" tabindex="1">Confirm Password: </label>
            <input type="password" name="reg_cfm_password" id="confirm-password" tabindex="2" class="form-control match"  >
        </div>
		
		 <!-- Role -->
         <div class="form-group required" >
		 <label for="user_role" style="padding-bottom:8px;" tabindex="1">Role: </label>
            <select name="user_role" id="user_role" class="form-control" tabindex="2" >
				<option value="" disabled selected>Role</option>
                <option value="U">User</option>
                <option  value="A">Admin</option>
                </select>
        </div>
                  
                  
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<a  class="btn btn-large  btn-primary " style="width:40%;margin-right:10px;" href="aAccount.php" >Back</a>
					<input type="submit" name="submit" class="btn btn-large btn-primary  " value="Submit" style="width:40%;" />
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

