<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);

?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
/*Custom validations in states:
- State code is only of length 2
- State name contains only characters
*/
function states_validations(){
  if(isset($_POST['submit'])){
    //function global variables
    $mysqlQuery = true;
    $errors = array();
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
        $errors[] = "The code is an invalid format \n";
        $mysqlQuery= false;
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
        // $query = "UPDATE states SET name='".$name."', code='".$code.
        // "' WHERE id='". $_GET['id']."';";
        // $query_value = db_query($dbc, $query);
        $stmt = $dbc->prepare("UPDATE states SET name=?, code=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $code, $_GET['id']);
        $stmt->execute();
        $stmt->close();
        //echo $query_value;
        //mysqli_error needs the database connection
        //echo mysqli_error($dbc);
        //confirm_query($query_value);
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
?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>Edit State: <?php echo htmlspecialchars($state['name']); ?></h1>
  <?php states_validations(); ?>
  <!-- TODO add form -->
  <form action="" name="statesform" method="POST">
    Name:<br />
    <input type="text" name="name" value="<?php echo htmlspecialchars($state['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo htmlspecialchars($state['code']); ?>" /><br />
    <input type="submit" name="submit"/>
  </form> <br/>
  <a href="show.php?id=<?php echo $state['id']; ?>">Cancel </a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
