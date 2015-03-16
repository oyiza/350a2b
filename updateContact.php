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
        <h1 id="name">Azure Address Book</h1>
		<hr class="star-light">
		<h3 id="title"> Author: mjl566</h3>
   
      </div>
    </div>



    

    <div class="container-fluid">
		
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
			
			$id=$_GET['ContactID'];
			$sql = "SELECT * FROM AddressBook WHERE id=".$id;
			$result = $conn->query($sql);
			
			//if($result->num_rows > 0){
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				
				$adate = strtotime($row["add_date"]);
				//echo "<p>".$bday."</p>";
				$adate = date('Y-m-d', $adate);
				//echo "<p>".$adate."</p>";
				
				echo "
					<div class='row'>
						<div class='col-lg-3'  >
							<div class='panel panel-default'>
								<div class='panel-heading text-center'>
									<h4>Update Contact</h4>
								</div>
								<div class='panel-body'>
									<div id='error'>
									Please check for errors!
								</div>
								  <form class='form-horizontal' action='update.php' method='post' >
									<input type='hidden' name='contact_id' value='".$_GET['ContactID']."' />
									<div class='form-group'>
									  <label for='fname' class='col-xs-3'>First Name:</label>
									  <div class=' col-xs-8'>
										<input type='text' class='form-control' name='fname' id='fanme' value='".$row["firstname"]."'>
									  </div>
									</div>
									<div class='form-group'>
									  <label for='lname' class='col-xs-3'>Last Name:</label>
									  <div class=' col-xs-8'>
									  <input type='text' class='form-control' name='lname'id='lname' value='".$row["lastname"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='company' class='col-xs-3'>Company:</label>
									  <div class=' col-xs-8'>
									  <input type='text' class='form-control' name='company'id='company' value='".$row["company"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='phone' class='col-xs-3'>Phone:</label>
									  <div class=' col-xs-8'>
									  <input type='number' class='form-control' name='phone'id='phone' value='".$row["phone"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='email' class='col-xs-3'>Email:</label>
									  <div class=' col-xs-8'>
									  <input type='email' class='form-control' name='email'id='email' value='".$row["email"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='url' class='col-xs-3'>URL:</label>
									  <div class=' col-xs-8'>
									  <input type='text' class='form-control'name='url'id='url' value='".$row["url"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='address' class='col-xs-3'>Address:</label>
									  <div class=' col-xs-8'>
									  <input type='text' class='form-control'name='address'id='address' value='".$row["address"]."'>
									</div></div>
									<div class='form-group'>
									  <label for='brithday' class='col-xs-3'>Birthday:</label>
									  <div class='col-xs-8'>
									  <input type='date' class='form-control'name='birthday' id='birthday'  >
									</div></div>
									<div class='form-group'>
									  <label for='add_date' class='col-xs-3'>Date:</label>
									  <div class=' col-xs-8'>
									  <input type='date' class='form-control'name='add_date' id='add_date' value='".$adate."'>
									</div></div>
									<div class='form-group'>
									  <label for='note' class='col-xs-3'>Notes:</label>
									  <div class=' col-xs-8'>
									  <input type='text' class='form-control'name='note'id='note' value='".$row["note"]."' >
									</div></div>
									<div class='cl-xs-12'>
										<button class='btn btn-block btn-custom' type='submit' id='submit' >Save Changes</button>
										<a class='btn btn-warning btn-block' href='home.php'>
													Cancel
												</a>
									</div>
									
								  </form>
								  </div>
							</div>
						</div>";
			
			//}
			
			
			
			
			
			
			$sql= "SELECT * FROM AddressBook";
			$result = $conn->query($sql);
			$ctr = 1;
			
			//if($result->num_rows > 0){
			echo "<div class='col-lg-9'>";
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					if($ctr == 1){
						echo	"
								<div class='row'>
									<div class='col-lg-4 img-rounded'  >
										<div class='panel panel-default'  >
											<div class='panel-heading text-center'>
														<h4>".$row["firstname"]." ".$row["lastname"]."</h4>
											</div>
											<div class='panel-body'>
												<p>Company: ".$row["company"]."</p>
												<p>Phone: ".$row["phone"]."</p>
												<p>Email: ".$row["email"]."</p>
												<p>URL: ".$row["url"]."</p>
												<p>Address: ".$row["address"]."</p>
												<p>Birthday: ".$row["birthday"]."</p>
												<p>Date: ".$row["add_date"]."</p>
												<p>Note: ".$row["note"]."</p>
											</div>
											<div class='panel-footer'>";
												
							if($id == $row["id"]){
								echo "	<a class='btn btn-warning btn-block disabled' href='updateContact.php?ContactID=".$row["id"]."'>
												Update
											</a>
											<a class='btn btn-danger btn-block disabled' href='deleteContact.php?ContactID=".$row["id"]."' 
												onclick='return confirm(\"This cannot be undone,are you sure?\")'>
												Delete
											</a>";
							}else{
								echo "		<a class='btn btn-warning btn-block' href='updateContact.php?ContactID=".$row["id"]."'>
													Update
												</a>
												<a class='btn btn-danger btn-block ' href='deleteContact.php?ContactID=".$row["id"]."' 
													onclick='return confirm(\"This cannot be undone,are you sure?\")'>
													Delete
												</a>";
							}
							echo "
											</div>
										</div>
									</div>
								";
						$ctr ++;
					}else{
						echo	"
									<div class='col-lg-4 img-rounded'  >
										<div class='panel panel-default'  >
											<div class='panel-heading text-center'>
														<h4>".$row["firstname"]." ".$row["lastname"]."</h4>
											</div>
											<div class='panel-body'>
												<p>Company: ".$row["company"]."</p>
												<p>Phone: ".$row["phone"]."</p>
												<p>Email: ".$row["email"]."</p>
												<p>URL: ".$row["url"]."</p>
												<p>Address: ".$row["address"]."</p>
												<p>Birthday: ".$row["birthday"]."</p>
												<p>Date: ".$row["add_date"]."</p>
												<p>Note: ".$row["note"]."</p>
											</div>
											<div class='panel-footer'>";
												
							if($id == $row["id"]){
								echo "	<a class='btn btn-warning btn-block disabled' href='updateContact.php?ContactID=".$row["id"]."'>
												Update
											</a>
											<a class='btn btn-danger btn-block disabled' href='deleteContact.php?ContactID=".$row["id"]."' 
												onclick='return confirm(\"This cannot be undone, are you sure?\")'>
												Delete
											</a>";
							}else{
								echo "		<a class='btn btn-warning btn-block' href='updateContact.php?ContactID=".$row["id"]."'>
													Update
												</a>
												<a class='btn btn-danger btn-block ' href='deleteContact.php?ContactID=".$row["id"]."' 
													onclick='return confirm(\"This cannot be undone, are you sure?\")'>
													Delete
												</a>";
							}
							echo "
											</div>
										</div>
									</div>";
						if($ctr == 3){
							$ctr = 1;
							echo "</div><div class='row' style='padding: 5px'></div>";
						}else{
							$ctr ++;
						}
							
					}//end inside if
				} //endWhile
				echo "</div>";
			//} //end main if
			
		 ?> 
		   
      </div><!-- /.row -->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('#submit').click(function(){
					return validForm();   
				});
				$('#error').hide();
			});
 
			function validForm(){
				var nameReg = /^[A-Za-z]+$/;
				var ccReg = /^[0-9]{16}$/;
				var dateReg = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
				var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
				var urlReg = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;

				var fname = $('#fname').val();
				var lname = $('#lname').val();
				var company = $('#company').val();
				var phone = $('#phone').val();
				var email = $('#email').val();
				var url = $('#url').val();
				var address = $('#address').val();
				var birthday = $('#birthday').val();
				var addDate = $('#add_date').val();
				var note = $('note').val();
				
				var err = false;
				$('.error').hide();
				$('#error').hide();

				if(fname == ""){
					$('#error').after('<div class="error"> Please enter the first name</div>');
					$('#fname').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				else if(!nameReg.test(fname)){
					$('#error').after('<div class="error">Letters only</div>');
					$('#fname').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}

				if(lname == ""){
					$('#error').after('<div class="error"> Please enter the last name</div>');
					$('#lname').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				else if(!nameReg.test(lname)){
					$('#error').after('<div class="error"> Letters only</div>');
					$('#lname').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}

				if(email == ""){
					$('#error').after('<div class="error"> Please enter the email</div>');
					$('#email').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				else if(!emailReg.test(email)){
					$('#error').after('<div class="error"> You need a valid email address like: abc123@gmail.com</div>');
					$('#email').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				
				if( (url != "") && (!urlReg.test(url)) ){
					$('#error').after('<div class="error"> You need a valid url</div>');
					$('#url').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				
				if(phone == ""){
					$('#error').after('<div class="error"> Please enter phone number</div>');
					$('#phone').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				
				if( (birthday != "") && (!dateReg.test(birthday)) ){
					$('#error').after('<div class="error"> You need a valid birthday, YYYY-MM-DD only </div>');
					$('#birthday').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				
				if(addDate == ""){
					$('#error').after('<div class="error"> Please enter add contact date</div>');
					$('#add_date').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				else if(!dateReg.test(addDate)){
					$('#error').after('<div class="error">You need a valid add contact date,YYYY-MM-DD only</div>');
					$('#add_date').after('<span class="error">*</span>');
					$('#error').show();
					err = true;
				}
				
				return !err;
			}
		</script>
  </body>
</html>