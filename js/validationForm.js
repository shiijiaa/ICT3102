//Default Bootstrap Dialog
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

//Register
function validateRegister(form) {
	 
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

	
	//Name Validation
	if (name == "") {
		errors.push("Please enter your full name");
    }
	else if (!RE_NAME.test(name)){
		errors.push( "Please enter valid  name");
	}
	
	//Gender
	
		if (gender == "") {
		errors.push("Please select your gender");
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
		errors.push("Your password and confirmation password do not match");
	}
	

	//Birthday Validation
	if (!RE_DATE.test(birthday)){
		errors.push("Birthday format must be: YYYY-MM-DD and must be valid date");
	}
	else if(birthday==""){
		errors.push("Birthday required");
	}
	
	
	//If more than 1 error
	if (errors.length > 0) {
		validationFunction(errors);
		return false;
    }
	
		

}