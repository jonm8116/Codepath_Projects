<?php
//get other functions
require_once('../../../private/initialize.php');

if(isset($_POST['yes']) || isset($_POST['no'])){
  if(isset($_POST['yes'])){
    $dbc = db_connect();

    $query = "DELETE FROM users WHERE id=".$_GET['id'] ."";
    $query_value = db_query($dbc, $query);
    db_close($dbc);

    header("Location: index.php");
  } else{
    header("Location: show.php?id=".$_GET['id']."");
  }
}
 ?>
 <div id="container">
   <h2>Are you sure you want to delete this user?</h2><br/>
   <br/>
   <form action="" method="POST">
   <input type="submit" name="yes" value="yes"/>
   <input type="submit" name="no" value="no" />
  </form>
 </div>
