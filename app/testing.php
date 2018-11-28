<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Testing 123</title>
<link href="css/css.css" rel="stylesheet">

<!-- Default-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- Latest compiled&minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!-- jQuery library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Latest compiled JavaScript -->
<!-- Star rating-->

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/star-rating.css" media="all" type="text/css"/>
    <script src="js/star-rating.js" type="text/javascript"></script>
<style>

/*
 * ------------Off Canvas--------------------
 */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -40%;
  }

  .row-offcanvas-left.active {
    left: 40%;
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 40%;
    margin-left: 12px;
  }
}

#sidebar {
    padding:15px;
    margin-top:10px;
}
</style>

</head>
<body>
   <div class="form-group">
  <label for="helpful" style="padding-bottom:8px;"> 1) This lesson topic was helpful:</label><br>
  <!--http://plugins.krajee.com/star-rating-demo-basic-usage#basic-example-1-->
	<input id="helpful" name="helpful" class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="0.5" data-size="xs">
</div>
</body>


</html>