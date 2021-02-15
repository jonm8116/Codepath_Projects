<?php
require_once('../../../private/initialize.php');
?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php
function states_validations(){
  /*Custom validations in states:
  - State code is only of length 2
  - State name contains only characters
  */
  if(isset($_POST['submit'])){
    //function global variables
    $mysqlQuery = true;
    $errors = array();
    //$itemMissing = false;
    $nameSizeRange = array();
    $nameSizeRange[0] = 2;
    $nameSizeRange[1] = 255;

    $name = $_POST['name'];
    $code = $_POST['code'];
    if(!empty($_POST['name'])){
      //$firstName = $_POST['firstname'];
      $nameValue = has_length($name, $nameSizeRange);
      if(!$nameValue){
        $errors[] = 'The name is in an invalid format \n';
        $mysqlQuery= false;
      }
      //CUSTOM VALIDATION
      $nameValue = preg_match('/[^A-Z a-z]/', $name);
      if($nameValue){
        $errors[] = "The name should only contain letters \n";
        $mysqlQuery = false;
      }
    } else{
      $errors[] = "The name is missing \n";
      $mysqlQuery = false;
    }
    //Retrieve last_name
    if(!empty($_POST['code'])){

      //$codeValue = has_length($code, $nameSizeRange);
      //CUSTOM VALIDATION
      $codeValue = strlen($code);
      if($codeValue != 2){
        $errors[] = "The code should be only 2 letters long \n";
        $mysqlQuery= false;
      }
      //CUSTOM VALIDATION
      $codeValue = preg_match('/[^A-Z]/', $code);
      if($codeValue){
        $errors[] = "The code must be only uppercase letters";
      }
    } else{
      $errors[] = "The code is missing \n";
      $mysqlQuery = false;
    }

    //PREPARE TO POST TO DATABASE
    if($mysqlQuery){
      //echo 'in the if statement';
      //if(false){  //this if is used for debugging
        $country_id_value = 2;
        $dbc = db_connect();
        // $query = "INSERT INTO states (id, name, code, country_id
        // ) VALUES ('NULL', '".$name."', '".$code."', '"
        // .$country_id_value."')";
        // $query_value = db_query($dbc, $query);
        $stmt = $dbc->prepare("INSERT INTO states (name, code, country_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $code, $country_id_value);
        $stmt->execute();
        //get id from entry
        $id = mysqli_insert_id($dbc);
        $stmt->close();

        //echo $query_value;
        //mysqli_error needs the database connection
        echo mysqli_error($dbc);
        //confirm_query($query_value);
        db_close($dbc);
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
<div id="main-content">
  <a href="index.php">Back to States List</a><br />
  <h1>New State</h1>
  <?php states_validations(); ?>
  <!-- TODO add form -->
  <form action="" name ="addstate" method="post">
    Name: <br/>
    <input type="text" name="name"/> <br/>
    Code: <br/>
    <input type="text" name="code"/> <br/>
    <br/>
    <input type="submit" name="submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
