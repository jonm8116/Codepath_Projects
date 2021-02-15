<html>
<?php require_once('../../private/initialize.php'); ?>
<h3>Database data sender page</h3>
<h3> Admin access only</h3>
<form action="" method="POST" name="send_data">
<textarea name="data" rows="10" cols="70">
  Type database information here.
</textarea>
<p>
<p>
</p>
<input type="submit" name="submit">
</p>
</form>
<?php
if(isset($_POST['submit'])){
  $dbc = db_connect();
  $query = $_POST["data"];

  $query_value = db_query($dbc, $query);

  //echo $query_value;
  //mysqli_error needs the database connection

  echo mysqli_error($dbc);
  confirm_query($query_value);

  //Always must pass database connection to mysqli_insert_id
  //$id = mysqli_insert_id($dbc);
  db_close($dbc);
  //echo "yes";
  //This bottom bit of code is used to redirect the web page.
  //header("Location: show.php?id=".$id."");
  exit;
}
 ?>
