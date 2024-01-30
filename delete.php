<?php
include("connect.php");

if (isset($_GET["deleteID"])) {
  
  $id = $_GET['deleteID'];

  // SQL query to delete the user record with the specified ID
  $sql = "DELETE FROM userdetails WHERE `userdetails`.`id` = $id";

  // Execute the SQL query
  $result = mysqli_query($conn, $sql);

  // Check if the query execution was successful
  if ($result) {
    header("location:display-user.php");
  } else {
    die(mysqli_error($conn));
  }
}
