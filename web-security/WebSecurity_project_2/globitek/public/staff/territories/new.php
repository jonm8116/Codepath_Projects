<?php
require_once('../../../private/initialize.php');
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php
    if(isset($_GET["data"])){
      $id = $_GET["data"];
    }
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
            // $query = "INSERT INTO territories (id, name, state_id, position
            // ) VALUES ('NULL', '".$name."', '".$_GET['data']."', '"
            // .$position."')";
            // $query_value = db_query($dbc, $query);
            $stmt = $dbc->prepare("INSERT INTO territories (name, state_id, position) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $name, $_GET['data'], $position);
            $stmt->execute();
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
<?php echo "<a href=\"../states/show.php?id=".$_GET['data'] ."\">";?>  Back to State Details</a><br />
  <h1>New Territory</h1>
  <!-- TODO add form -->
  <?php territory_validations(); ?>
  <form action="" name="addterritory" method="post">
    Name: <br/>
    <input type="text" name="name"/> <br/>
    Position: <br/>
    <input type="text" name="position"/> <br/>
    <br/>
    <input type="submit" name="submit"/>
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
