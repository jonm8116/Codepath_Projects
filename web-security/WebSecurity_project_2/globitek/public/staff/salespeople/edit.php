<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);

?>
<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
function sales_validations(){
  if(isset($_POST['submit'])){
    //function global variables
    $mysqlQuery = true;
    $errors = array();
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
      $nameValue = has_length($firstName, $nameSizeRange);
      if(!$nameValue){
        $errors[]= 'The first name is an invalid format \n';
        $mysqlQuery= false;
      }
    } else{
      $errors[]= "The first name is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve last_name
    if(!empty($_POST['lastname'])){
      //$lastName = $_POST['lastname'];
      $nameValue = has_length($lastName, $nameSizeRange);
      if(!$nameValue){
        $errors[]= 'The last name is an invalid format \n';
        $mysqlQuery= false;
      }
    } else{
      $errors[]= "The last name is missing \n";
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
        $errors[]= "email has an invalid number of characters \n";
        $mysqlQuery = false;
      }
      $emailValue = has_valid_email_format($email);
      if(!$emailValue){
        $errors[]= "email is not in a valid format \n";
        $mysqlQuery = false;
      }
      //Check this point
      $emailValue = character_validations($email, false, true, false);
      //echo $emailValue;
      //$truth = false;
      //echo $truth;
      if($emailValue==0){ //do this for checking?
        $errors[]= "The email does not follow the valid format";
        $mysqlQuery = false;
      }
    } else{
      $errors[]= "The email is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve user_name
    if(!empty($_POST['phone'])){
      //$userName = $_POST['username'];
      // if(!$phoneValue){
      //   echo "The user name is in an invalid format \n";
      //   $mysqlQuery = false;
      // }
    //  echo"right here"; //debug
      $phoneValue = character_validations($phone, true, false, false);
      if(!$phoneValue){
        $errors[]= "The phone does not follow a valid format";
        $mysqlQuery = false;
      }
    } else{
      $errors[]= "The phone is missing \n";
      $mysqlQuery = false;
    }
    //PREPARE TO POST TO DATABASE
    //instead of just inserting a value into the database
    //we are going to update the vlaue in the database
    //SANITIZE DATA
    $firstName = htmlspecialchars($firstName);
    $lastName = htmlspecialchars($lastName);
    $email = htmlspecialchars($email);
    $phone = htmlspecialchars($phone);
    if($mysqlQuery){
      //echo 'in the if statement';
    //  if(false){  //this if is used for debugging
        $dbc = db_connect();

        // $query = "UPDATE salespeople SET first_name='".$firstName."', last_name='".$lastName.
        // "', phone='".$phone."', email='".$email."' WHERE id='". $_GET['id']."';";
        // $query_value = db_query($dbc, $query);

        $stmt = $dbc->prepare("UPDATE salespeople SET first_name=?, last_name=?, phone=?, email=? WHERE id=? ;");
        $stmt->bind_param("ssssi", $firstName, $lastName, $phone, $email, $_GET['id']);
        $stmt->execute();
        $stmt->close();
        //mysqli_error needs the database connection
        // echo mysqli_error($dbc);
        // confirm_query($query_value);
        db_close($dbc);
        //echo "yes";
        //This bottom bit of code is used to redirect the web page.
        header("Location: show.php?id=".$_GET['id']."");
        exit;
    //  }
  } else{
    echo display_errors($errors);
  }
  }
}
// function getOldValues(){
//
// }
 ?>
<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>
  <?php sales_validations() ?>
  <!-- TODO add form -->
  <form action="" name="editform" method="POST">
    First name: <br/>
    <input type="text" name="firstname" value="<?php echo $salesperson['first_name'];?>"/> <br/>
    Last name: <br/>
    <input type="text" name="lastname" value="<?php echo $salesperson['last_name'];?>"/> <br/>
    Phone: <br/>
    <input type="text" name="phone" value="<?php echo $salesperson['phone'];?>"/> <br/>
    Email: <br/>
    <input type="text" name="email" value= "<?php echo $salesperson['email'];?>" /> <br/>
    <!--submit button-->
    <input type="submit" name="submit" value="submit"/>
  </form> <br/>
  <a href="show.php?id=<?php echo $salesperson['id']; ?>">Cancel</a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
