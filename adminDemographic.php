<?php 
include ("php/getEducationLevel.php");
include ("php/getDemographic.php");
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
//Reference: https://stackoverflow.com/questions/15869232/create-google-chart-data-table-array-from-two-arrays
//

//Convert php to javascript 
var demographic = <?php echo json_encode($demographic);?>;

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
	
		//Message
		dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', ['Age Range', 'Male', 'Female' ]); 
		
		//Header
		dataTable.addColumn('number', 'Male');  
		dataTable.addColumn('number', 'Female');          

          // now add the rows.
          for (var i = 0; i < demographic.length; i++)
            dataTable.addRow([ demographic[i]['age_range'],  parseInt(demographic[i]['male']),      parseInt(demographic[i]['female'])    ]);            
		
      var options = {
        title: 'Population of School Looker',
        chartArea: {width: '40%',height:'90%'},
        hAxis: {
          title: 'Total Population',
		  format:'0',
          minValue: 0,
          textStyle: {
            bold: true,
            fontSize: 12,
            color: '#4d4d4d'
          },
          titleTextStyle: {
            bold: true,
            fontSize: 16,
            color: '#5d5d5d'
          }
        },
        vAxis: {
          title: 'Age Range',
          textStyle: {
            fontSize: 14,
            bold: true,
            color: '#848484'
          },
          titleTextStyle: {
            fontSize: 16,
            bold: true,
            color: '#5d5d5d'
          }
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(dataTable, options);
    }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

			<h1>Demographic</h1>
		<hr>
  
  <div id="chart_div" style="height:400px;"></div>
      
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