<?php 
include("php/getEducationLevel.php");
//include("php/getAllMostVisited.php")

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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
//-----------------ajax refresh page------------------------
var mostVisited = "";
$(document).ready(function() {
	//Get All Data from the start
	$.ajax({
		 type:"GET",
		 url:"php/getMostVisited.php",
		 data:"sch_education_level",
		 cache:false,
		 success: function(msg){
			 mostVisited= $.parseJSON(msg);
			 google.charts.setOnLoadCallback(drawAxisTickColors);
		 }
		});
		
	//Call Chart	
	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(drawAxisTickColors);
	
	//Call change function
    $('#sch_educaiton_level').change(function () {
	 selectedValue = $(this).find(":selected").val();
	 $("#title").html(selectedValue); 
	 strlink = "sch_education_level="+selectedValue;
	 if(selectedValue=="All"){
	 strlink ="sch_education_level"}
		
		$.ajax({
		 type:"GET",
		 url:"php/getMostVisited.php",
		 data:strlink,
		 cache:false,
		 success: function(msg){
			 mostVisited= $.parseJSON(msg);
			 google.charts.setOnLoadCallback(drawAxisTickColors);
		 }
	 });
	 


	 
    });
});


//-----------------ajax refresh page------------------------




      function drawAxisTickColors(){
		//Message
		dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', ['School', 'Visited']); 
		
		//Header
		dataTable.addColumn('number', 'Visited');       

          // now add the rows.
          for (var i = 0; i < mostVisited.length; i++)
            dataTable.addRow([ mostVisited[i]['sch_name'],  parseInt(mostVisited[i]['visited'])]);            
		
var options = {
        title: 'Most Visited School',
        chartArea: {width: '40%',height:'90%'},
        hAxis: {title: 'Number of people',format:'0',minValue: 0, 
		textStyle: {bold: true,fontSize: 12,color: '#4d4d4d'},
        titleTextStyle: { bold: true,fontSize: 16,color: '#5d5d5d'}},
		
        vAxis: {title: 'School',textStyle: {fontSize: 10,bold: true,color: '#848484'},
		
        titleTextStyle: {fontSize: 16,bold: true,color: '#5d5d5d'}}
      };
      
	  var chart = new google.visualization.BarChart(document.getElementById('popularVisitedSchool'));
      chart.draw(dataTable, options);
      }
    </script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
</head>
<body>


<!-- /.navbar -->
<?php include("php/header/header.php")?> 
<!-- /.navbar -->

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
			<?php include("php/sidebar/adminSidebar.php");?>
            <!--/.well -->
        </div>
        <!--/span-->

        <div class="col-xs-12 col-sm-9">
		 <br><br><br><br>

			<h1>Most visited schools ( <span id="title">All</span> )</h1>
			<hr>
			
		
		<!-- Drop down button -->
		<div class="dropdown" style="float:right;clear:both;">
		 
		<select name="sch_educaiton_level" id="sch_educaiton_level"  class="btn btn-info dropdown-toggle" >
		<option value="All">All</option>
		<?php 
		for($i=0;$i<count($eduLevelArr) ; $i++){
			$eduCate = $eduLevelArr[$i];
			echo "<option value='$eduCate'>$eduCate</option>";	
		}
		?>
        </select>
		</div>
		
		<br><br>
		<div id="popularVisitedSchool" style="width: 100%; height: 450px;"></div>
			<br><br>
        <br>
            
        </div>
        <!--/span-->


    </div>
    <!--/row-->

<footer class="navbar-default navbar-fixed-bottom" id="footer">
        <center><h4>© SchoolLooker 2017</h4><center>
</footer>

</div>
<!--/.container-->

</body>


</html>