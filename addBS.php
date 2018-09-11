<?php 
include("php/doAddBS.php");
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
	 
	var errors = [];
	var location_address = form.location_address.value;
	var location_latitude = form.location_latitude.value;
	var location_longtitude = form.location_longtitude.value;	

	if(location_address==""){
		errors.push("Please enter location address");
	}
	
	if(location_latitude==""){
		errors.push("Please enter location latitude");
	}else if(parseFloat(location_latitude)<1.2 || parseFloat(location_latitude)>1.475){
		errors.push("Invalid Latitude. Please enter in Singapore range.");
	} 
	
	if(location_longtitude==""){
		errors.push("Please enter location longtitude");
	}else if(parseFloat(location_longtitude)<103.6 || parseFloat(location_longtitude)>104.1){
		errors.push("Invalid Longitude. Please enter in Singapore range.");
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
<?php include("php/header/manageHeader.php")?> 
<!-- navbar -->


<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
<!-- Side bar-->
	<?php include("php/sidebar/manageSideBar.php");?>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
			<?php include("php/Notification/Error.php");?>
			
			<h1>Add BlackSpot</h1>
			<hr>
 <form action=""  method="post" style="padding:20px" class="spanx well" onsubmit="return validateForm(this)">
	<input type="hidden" name="user_id" value="<?php echo $user_id?>" />
   
	<div class="form-group">
	  <label for="location_address" style="padding-bottom:8px;" tabindex="1">Address: </label>
	  <input type="text"  name="location_address" class="form-control"  >

	</div>
	<div class="form-group">
	  <label for="location_latitude" style="padding-bottom:8px;" tabindex="1">Latitude: </label>
	  <input type="number" step=0.00001 name="location_latitude" class="form-control"  >
	</div>
	
	<div class="form-group">
	  <label for="location_longtitude" style="padding-bottom:8px;" tabindex="1">Longtitude: </label>
	  <input type="number" step=0.0001 name="location_longtitude" class="form-control"  >
	</div>	
	
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <a  class="btn btn-large   btn-primary" style="width:40%;margin-right:10px;" href="aManageBS.php" >Back</a>
				<input type="submit" name="submit" class="btn btn-large btn-primary " value="Submit" style="width:40%;" />
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

