<?php 
include("php/cookieSessionVar.php");
?>
<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			
            <a href="main.php?postalcode="><img src="Images/logo.png"/></a> 
        </div>
						<ul class="nav navbar-nav navbar-right" style="margin-top:3px;margin-right:20px;">
				
				<!-- User haven't login -->
				
				<?php 
						if ($user_id == ""){
							header("Location: index.php");
						}
						else{
							
				?>
				
				  <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" >
					  <span></span>
					  <b >Welcome, <?php echo $user_name?></b> <b class="caret"></b></a>
					<ul class="dropdown-menu"> 
					  <li><a href="php/doLogout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
				  </li> 
				 <?php }?>
				<!-- --> 
				</ul>
				
				
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="adminHomePage.php">Home</a></li>
				<li><a href="aManage.php">Manage</a></li>
                <li><a href="aAccount.php">Accounts</a></li>
                <li><a href="aFeedback.php">Feedback</a></li>
            </ul>
        </div>
		

        <!-- /.nav-collapse -->
    </div>
    <!-- /.container -->
</nav>