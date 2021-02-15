<?php
  require_once('../private/initialize.php');
  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php
	
	//ERROR VALIDATIONS
	if(isset($_POST['submit'])){
		/*$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$email = $_POST['email'];
		$userName = $_POST['username'];
		//Place values in array
		$input_arr = array();
		$input_arr = $firstName;
		$input_arr = $lastName;
		$input_arr = $email;
		$input_arr = $userName;*/
		$itemMissing = false;
		//Retrieve first_name
		if(isset($_POST['firstname'])){
			$firstName = $_POST['firstname'];
		} else{
			$itemMissing = true;
		}
		//Retrieve last_name
		if(isset($_POST['lastname'])){
			$firstName = $_POST['lastname'];
		} else{
			$itemMissing = true;
		}
		//Retrieve email
		if(isset($_POST['email'])){
			$firstName = $_POST['email'];
		} else{
			$itemMissing = true;
		}
		//Retrieve user_name
		if(isset($_POST['username'])){
			$firstName = $_POST['username'];
		} else{
			$itemMissing = true;
		}
		//Call error validation functions
		/*function checkErrors(){
			$textLength;
			$missingField=true;
			for($i=0; $i<=4; $i++){
				if($input_arr[$i]==null){
					$missingField = true;
				}
				//has_length($input_arr[$i],)
			}
			if($missingField){
				echo 'Missing an input field';
			}
			echo "missing field";
		}*/
		if($itemMissing){
			echo '<div id="itemMissing">One item is missing</div>';
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


?>