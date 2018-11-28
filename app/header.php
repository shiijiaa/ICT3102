<?php 
include("php/cookieSessionVar.php");
include("php/doLogin.php");
if($user_role!=""){

	$welcome= '<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle"><span></span><b>Welcome, '.$user_name.'</b> 
	<b class="caret"></b></a><ul class="dropdown-menu"><li><a href="php/doLogout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li></ul></li>';
}
$logoLink = "index.php";
if($user_role=="A"){
	$logoLink = "main.php?postalcode=";
}
if(!isset($user_name) && empty($user_name)) {
	$user_name = "";
	$user_id = "";
	$welcome = "";
}
?>

<!-- CSS -->
<link rel="stylesheet" href="css/header.css" type="text/css"/>

<nav class="navbar navbar-default" id="headerBar">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo $logoLink?>"><img id="logo" src="Images/logo.png"/></a>
		</div>
	

			<div class="collapse navbar-collapse"  style="margin-left:80px;">
			<?php 
			if ($user_role=="A"){
			?>
			<ul class="nav navbar-nav" >
                <li><a href="adminHomePage.php">Home</a></li>
				<li><a href="aManage.php">Manage</a></li>
                <li><a href="aAccount.php">Accounts</a></li>
                <li><a href="aFeedback.php">Feedback</a></li>
            </ul>
			<?php 
			}
			?>
			<ul id="userDetails" class="nav navbar-nav navbar-right" >
				<li><a href="register.php"> <span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="#" onclick="showLogin()"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
			
		</div>
	</div>
</nav>

<!-- The Modal -->
<div id="loginModal" onclick="hideLogin()" class="modal">
</div>
<!-- Modal Content -->
<div id="loginDialog" class="col-xs-12">
	<button id="loginClose" type="button" class="close" onclick="hideLogin()" aria-hidden="true">&times;</button>
	<!-----------------Error message for Login ----------------------------->
	<div id="loginError" class="alert alert-danger alert-dismissable">
		<p id="errorMessage"></p>
	</div>
	<p>Login</p>
	<form id="loginForm" class="col-xs-12" method="POST" action="">
		<div class="input-group required login">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input class="form-control" type="text" placeholder="Email" name="login-email" required>
		</div>
		<div class="input-group required login">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input class="form-control" type="password" placeholder="Password" name="login-password" required>
		</div>
		
		<div id="rememberMe" class="input-group login"> 
			<input type="checkbox" name="rmbMe"> Remember me
		</div> 
		<input type="submit" class="btn btn-large btn-primary" value="Login">
	</form>
</div>
<!-- Custom JavaScript -->
<script src="js/header.js"></script>
<script type="text/javascript">
var loginStatus = <?php echo json_encode($login_validation); ?>;
var errorMessage = <?php echo json_encode($login_message); ?>;
var userName = <?php echo json_encode($user_name); ?>;
var userID = <?php echo json_encode($user_id); ?>;
var welcome = <?php echo json_encode($welcome); ?>;
<?php
if ($login_validation==-1 && $login_message!="" ){
	$login_validation=0;
	$login_message="";
}
?>
if (loginStatus == -1) {
	document.getElementById("loginError").style.display = "block";
	document.getElementById("loginError").innerHTML = errorMessage;
	showLogin();
}
if (userName != "") {
	document.getElementById("userDetails").innerHTML = welcome;
}
</script>