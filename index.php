<?php

require_once 'php/connect.php';
require_once 'php/database.php';

$database = new Database;
$members_data = $database->select_table(30, "id, name, image, email, title, group_name", "members",null,"id DESC");
$recent_members = $database->select_table(4, "id, name, image, group_name", "members", null, "id DESC");
if(!isset($info)) $info = '';

//$columns = array('name', 'title', 'image', 'date_of_birth', 'gender', 'group_name', 'date_joined', 'proposed_day_of_leaving', 'parent_name', 'parent_number', 'phone_number', 'email');
$search_columns = array('id', 'name', 'title', 'date_of_birth', 'group_name', 'date_joined', 'proposed_day_of_leaving', 'parent_name', 'phone_number', 'email');
require_once 'php/functions.php';

//for the search
if(isset($_GET['search'])){
	$key = $_GET['search_key'];
	$column = $_GET['column'];
	$search_results = $database->select_table(null, "id, name, image, email, title, group_name", "members", "$column LIKE '%$key%'", "id DESC");
	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../ccu.ico">

    <title>CCU Members Database</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script src="js/functions.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-image:url('images/ccun.png');" >

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" onclick="home()">CCU(YOUTH) Members Database</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" onclick="home()">Dashboard</a></li>
            <li><a href="#" onclick="about()">About</a></li>
          </ul>
          <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form navbar-right">
			<select class="form-control" name="column">
			<?php foreach($search_columns as $k){ ?>
				<option value="<?php echo $k; ?>"><?php echo Ucwords(str_replace("_", " ", $k)); ?></option>
			<?php }?>
			</select>
			
            <input type="text" class="form-control" placeholder="Search..." name="search_key">
			<input type="submit" class="btn btn-default" name="search" >
			<!--<input type="number" class="form-control" value="100" name="limit" maxlength="6" width="10" width="1px">-->
				
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
       
		<?php
		//place side bar
		require_once "templates/sidebar.php";
		
		$uri = explode("?", $_SERVER['REQUEST_URI']);
		$page = $uri[count($uri)-1];
		
		//place corresponding page
		if($page == "insert" || strstr($page, "edit")){
			require_once "templates/insert.php";
			
		}elseif(strstr($page, "about")){
			require_once "templates/about.php";
			
		}elseif(strstr($page, "read")){
			require_once "templates/read.php";
			
		}elseif(strstr($page, "delete")){
			require_once "templates/delete.php";
			
		}elseif(count($uri) < 2){
			require_once "templates/home.php";
			
		}else{
			require_once "templates/search_results.php";
		}
		?>
        
      </div>
    </div>
	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
