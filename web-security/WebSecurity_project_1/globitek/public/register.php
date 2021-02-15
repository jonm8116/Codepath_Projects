<?php
  require_once('../private/initialize.php');
  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.
    // Perform Validations
    // Hint: Write these in private/validation_functions.php
	
	//ERROR VALIDATIONS
	function checkErrors(){
		if(isset($_POST['submit'])){
			//function global variables
			$mysqlQuery = true;
			
			//$itemMissing = false;
			$nameSizeRange = array();
			$nameSizeRange[0] = 2;
			$nameSizeRange[1] = 255;
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$email = $_POST['email'];
			$userName = $_POST['username'];
			if(!empty($_POST['firstname'])){
				//$firstName = $_POST['firstname'];
				$nameValue = has_length($firstName, $nameSizeRange);
				if(!$nameValue){
					echo 'The first name is an invalid format \n';
					$mysqlQuery= false;
				}
			} else{
				echo "The first name is missing \n";
				$mysqlQuery = false;
			}
			//Retrieve last_name
			if(!empty($_POST['lastname'])){
				//$lastName = $_POST['lastname'];
				$nameValue = has_length($lastName, $nameSizeRange);
				if(!$nameValue){
					echo 'The last name is an invalid format \n';
					$mysqlQuery= false;
				}
			} else{
				echo "The last name is missing \n";
				$mysqlQuery = false;
			}
			//Retrieve email
			if(!empty($_POST['email'])){
				//$email = $_POST['email'];
				$emailArr = array();
				$emailArr[0] = 1;
				$emailArr[1] = 255;
				$emailValue = has_length($email, $emailArr);
				if(!$emailValue){
					echo "email has an invalid number of characters \n";
					$mysqlQuery = false;
				}
				$emailValue = has_valid_email_format($email);
				if(!$emailValue){
					echo "email is not in a valid format \n";
					$mysqlQuery = false;
				}
			} else{
				echo "The email is missing \n";
				$mysqlQuery = false;
			}
			//Retrieve user_name
			if(!empty($_POST['username'])){
				//$userName = $_POST['username'];
				$userNameArr = array();
				$userNameArr[0] = 8;
				$userNameArr[1] = 255;
				$userNameValue = has_length($userName, $userNameArr);
				if(!$userNameValue){
					echo "The user name is in an invalid format \n";
					$mysqlQuery = false;
				}
			} else{
				echo "The username is missing \n";
				$mysqlQuery = false;
			}
			/*if($itemMissing){
				$mysqlQuery = false;
				echo '<div id="itemMissing">One item is missing</div>';
			}*/
			//echo $mysqlQuery;
			//PREPARE TO POST TO DATABASE
			if($mysqlQuery){
				//echo 'in the if statement';
				$dbc = db_connect();
				//echo $dbc;
				$query = "INSERT INTO users (id, first_name, last_name, email,
				username, created_at) VALUES ('NULL', '".$firstName."', '".$lastName."', '"
				.$email."', '".$userName."', '".date("Y-m-d H:i:s")."')";
				//echo $query;
				$query_value = db_query($dbc, $query);
				
				//echo $query_value;
				//mysqli_error needs the database connection
				echo mysqli_error($dbc);
				confirm_query($query_value);
				
				db_close($dbc);
				//echo "yes";
				
				//This bottom bit of code is used to redirect the web page.
				header("Location: registration_success.php");
				exit;
			}
		}
	}
	
    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }
	  //checkErrors();

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>
  <form name="submitForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
   <!--<form name="submitForm" action="form_action.php" method="POST">-->
	First name <input type="text" name="firstname" value="<?php if(!empty($_POST['firstname'])){ 
									echo htmlspecialchars($_POST['firstname']);} 
									else { echo htmlspecialchars("");}?>"><br/>
	Last name <input type="text" name="lastname" value="<?php 
							if(!empty($_POST['lastname'])){ echo htmlspecialchars($_POST['lastname']);} else{echo htmlspecialchars("");}?>"><br/>
	Email <input type="text" name="email" value ="<?php 
							if(!empty($_POST['email'])){ echo htmlspecialchars($_POST['email']);} else{echo htmlspecialchars("");}?>"><br/>
	Username <input type="text" name="username" value="<?php 
							if(!empty($_POST['username'])){ echo htmlspecialchars($_POST['username']);} else{echo htmlspecialchars("");}?>"><br/>
	<br/>
	<input type="submit" name="submit" value="submit">
  </form>
  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
	checkErrors();
	//This function is used to check whether an html form has been submitted
	
		//ERROR VALIDATIONS
	
  ?>

  <!-- TODO: HTML form goes here -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
