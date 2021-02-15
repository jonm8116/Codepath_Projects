<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$territories_result = find_territory_by_id($_GET['id']);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);

?>
<?php $page_title = 'Staff: Edit Territory ' . $territory['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
function territory_validations(){
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
    $position = $_POST['position'];
    if(!empty($_POST['name'])){
      //$firstName = $_POST['firstname'];
      $nameValue = has_length($name, $nameSizeRange);
      if(!$nameValue){
        $errors[] = 'The name is in an invalid format \n';
        $mysqlQuery= false;
      }
      //CUSTOM VALIDATION
      $nameValue = preg_match('/[^A-Z a-z0-9]/', $name);
      if($nameValue){
        $errors[] = "The name should only contain letters or numbers \n";
        $mysqlQuery = false;
      }
    } else{
      $errors[] = "The name is missing \n";
      $mysqlQuery = false;
    }
    //Position
    if(!empty($_POST['position'])){
      //$codeValue = has_length($code, $nameSizeRange);
      //CUSTOM VALIDATION

      $positionValue = has_length($position, $nameSizeRange);
      if(!$positionValue){
        $errors[] = "The position has an invalid number of characters \n";
        $mysqlQuery= false;
      }
      //CUSTOM VALIDATION
      //$positionValue = preg_match('/[^A-Z]/', $position);
    } else{
      $errors[] = "The position is missing \n";
      $mysqlQuery = false;
    }
    //PREPARE TO POST TO DATABASE
    if($mysqlQuery){
      echo 'in the if statement';
      //if(false){  //this if is used for debugging
        //$country_id_value = 2;
        $dbc = db_connect();
        //echo $dbc;
        // $query = "UPDATE territories SET name='".$name."', position='".$position.
        // "' WHERE id='". $_GET['id']."';";
        // //echo $query;
        // $query_value = db_query($dbc, $query);
        //echo $query_value;
        $stmt = $dbc->prepare("UPDATE territories SET name=?, position=? WHERE id=?;");
        $stmt->bind_param("ssi", $name, $position, $_GET['id']);
        $stmt->execute();
        $stmt->close();
        //mysqli_error needs the database connection
        echo mysqli_error($dbc);
        //confirm_query($query_value);
        db_close($dbc);
        //$id = mysqli_insert_id($dbc);
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
  <a href="show.php?id=<?php echo $_GET['id']; ?>">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo htmlspecialchars($territory['name']); ?></h1>

  <!-- TODO add form -->
  <?php territory_validations(); ?>
  <form action="" method="post">
    Name: <br/>
    <input type="text" name="name" value="<?php echo $territory['name']; ?>" /> <br/>
    Position: <br/>
    <input type="text" name="position" value="<?php echo $territory['position']; ?>" /> <br/>
    <br/>
    <input type="submit" name="submit" />
  </form> <br/>
  <!--CANCEL BUTTON  -->
  <a href="show.php?id=<?php echo $_GET['id']; ?>">Cancel </a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
