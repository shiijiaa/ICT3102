<br><br><br><br>
			<!-- Notification-->
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