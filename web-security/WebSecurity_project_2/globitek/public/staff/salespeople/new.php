<?php
require_once('../../../private/initialize.php');
//The function written below will be used to validate
//the input data to the html form and cms
/*Validations that must be passed for this form are:
- No field can be blank
- All string values are less than 255 char (max size of sql column)
- usernames contain only: A-Z, a-z, 0-9," _"
- phone numbers contain: 0-9, spaces, "()", "-"
- email addresses contain only: A-Z, a-z, 0-9, "@", ".", "_", "-"
*5 more custom validations:
-username is a minimum of 5 characters
-username must contain at least 2 letters
- email must be minimum of 7 characters
- any kind of name must contain minimum of 2 characters
- the code for states should only be two characters long
*/
function sales_validations(){
  if(isset($_POST['submit'])){
    //function global variables
    $errors = array();
    $mysqlQuery = true;
    //$itemMissing = false;
    $nameSizeRange = array();
    $nameSizeRange[0] = 2;
    $nameSizeRange[1] = 255;
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if(!empty($_POST['firstname'])){
      //$firstName = $_POST['firstname'];
      //NORMAL AND CUSTOM VALIDATION
      $nameValue = has_length($firstName, $nameSizeRange);
      if(!$nameValue){
        $errors[] ='The first name is an invalid format \n';
        $mysqlQuery= false;
      }
    } else{
      $errors[] = "The first name is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve last_name
    if(!empty($_POST['lastname'])){
      //$lastName = $_POST['lastname'];
      $nameValue = has_length($lastName, $nameSizeRange);
      if(!$nameValue){
        $errors[] = 'The last name is an invalid format \n';
        $mysqlQuery= false;
      }
    } else{
      $errors[] = "The last name is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve email
    if(!empty($_POST['email'])){
      //$email = $_POST['email'];
      $emailArr = array();
      $emailArr[0] = 7;
      $emailArr[1] = 255;
      $emailValue = has_length($email, $emailArr);
      if(!$emailValue){
        $errors[] = "email has an invalid number of characters \n";
        $mysqlQuery = false;
      }
      $emailValue = has_valid_email_format($email);
      if(!$emailValue){
        $errors[] = "email is not in a valid format \n";
        $mysqlQuery = false;
      }
      //Check this point
      $emailValue = character_validations($email, false, true, false);

      if($emailValue==0){ //do this for checking?
        $errors[] = "The email does not follow the valid format";
        $mysqlQuery = false;
      }
    } else{
      $errors[] = "The email is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve user_name
    if(!empty($_POST['phone'])){
      $phoneValue = character_validations($phone, true, false, false);
      if(!$phoneValue){
        $errors[] = "The phone does not follow a valid format";
        $mysqlQuery = false;
      }
    } else{
      $errors[] = "The phone is missing \n";
      $mysqlQuery = false;
    }
    //SANITIZE DATA
    $firstName = htmlspecialchars($firstName);
    $lastName = htmlspecialchars($lastName);
    $phone = htmlspecialchars($phone);
    $email = htmlspecialchars($email);  //originally this bit was lastName
    //echo $firstName;
    //PREPARE TO POST TO DATABASE
    if($mysqlQuery){
      //echo 'in the if statement';
      //if(false){  //this if is used for debugging
        $dbc = db_connect();
        // $query = "INSERT INTO salespeople (id, first_name, last_name, phone, email
        // ) VALUES ('NULL', '".$firstName."', '".$lastName."', '"
        // .$phone."', '".$email."')";

        //TO PROTECT AGAINST SQL INJECTION
        $stmt = $dbc->prepare("INSERT INTO salespeople (first_name, last_name, phone, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $phone, $email);
        //Send to database
        $stmt->execute();
        $stmt->close();

        //$query_value = db_query($dbc, $query);

        //echo $query_value;
        //mysqli_error needs the database connection

        //echo mysqli_error($dbc);
        //confirm_query($query_value);

        //Always must pass database connection to mysqli_insert_id
        $id = mysqli_insert_id($dbc);
        db_close($dbc);
        //echo "yes";
        //This bottom bit of code is used to redirect the web page.
        header("Location: show.php?id=".$id."");
        exit;
    //  }
  } else{
    echo display_errors($errors);
  }
  }
}
?>

<?php $page_title = 'Staff: New Salesperson'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>New Salesperson</h1>
<?php sales_validations(); ?>
  <!-- TODO add form -->
  <form action="" name="addform" method="POST">
    First name: <br/>
    <input type="text" name="firstname"/> <br/>
    Last name: <br/>
    <input type="text" name="lastname"/> <br/>
    Phone: <br/>
    <input type="text" name="phone"/> <br/>
    Email: <br/>
    <input type="text" name="email"/> <br/>
    <!--submit button-->
    <input type="submit" name="submit" value="submit"/>
  </form>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
