<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Address Book</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
	
	<style>
	 .drop-shadow {
        -webkit-box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
	</style>
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    
	<div class="jumbotron" id="jumbotron">
      <div class="container" align="center">
	  <!--<img class="img-responsive  img-circle img-thumbnail" src="mike.jpg"> -->
        <h1 id="aname">Azure Address Book</h1>
		<hr class="star-light">
		<h3 id="title"> Author: mjl566</h3>
   
      </div>
    </div>



    

    <div class="container">

      <!-- Three columns of text below the carousel -->
      <div class="row">
		<?php
			$server = "tcp:gpntf5hrgo.database.windows.net,1433";
			$user = "SQLAdmin";
			$pwd = "henry0422!";
			$db = "Assignment2";
			try{
				$conn = new PDO( "sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				//echo "Connection successfully</br>";
			}
			catch(Exception $e){
				die("Connection failed: ".print_r($e));
			}
			
			try{
				$sql = "INSERT INTO AddressBook(firstname, lastname, company, phone, email, url, address,";
				
				if(!empty($_POST["birthday"])){
					$sql .= "birthday,";
				}
				$sql .= "add_date,note)
						VALUES ('".$_POST['fname']."', '".$_POST['lname']."','".$_POST['company']."', '".$_POST['phone']."',
						'".$_POST['email']."','".$_POST['url']."', '".$_POST['address']."',";
				
				if(!empty($_POST["birthday"])){
					$sql .= "'".$_POST['birthday']."',";
				}		
						
				$sql .= "'".$_POST['add_date']."', '".$_POST['note']."')";
					
				$conn->exec($sql);
				
				echo "<div class='alert alert-success' role='alert'><h1>Added Contact!</h1></br> You are being redirected
						  <a href='home.php class='alert-link'>Home.</a>
						</div>";
				
			}
			catch(Exception $e){
				echo "<div class='alert alert-danger' role='alert'>Error updating contact :".$e->getMessage()."
						</div><a href='home.php class='alert-link'>Go Home.</a>";
			
			}
			header("Refresh: 5; url=home.php");
		 ?> 
        
      </div><!-- /.row -->


      


      <!-- FOOTER -->
      <footer>
       
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
