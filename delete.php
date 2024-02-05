<?php
include("connect.php");

if (isset($_GET["deleteID"])) {
  
  $id = $_GET['deleteID'];

  // Fetch the photo filename before deleting the user record
  $getPhotoSql = "SELECT photo FROM userdetails WHERE id = $id";
  $photoResult = mysqli_query($conn, $getPhotoSql);

  if ($photoResult) {
    $row = mysqli_fetch_assoc($photoResult);
    $photoFilename = $row['photo'];

    // Delete the user record
    $deleteUserSql = "DELETE FROM userdetails WHERE id = $id";
    $result = mysqli_query($conn, $deleteUserSql);

    if ($result) {
      // Delete the associated photo file
      $photoPath = "uploads/" . $photoFilename;
      if (file_exists($photoPath)) {
        unlink($photoPath);
      }

      header("location:display-user.php");
    } else {
      die(mysqli_error($conn));
    }
  } else {
    die(mysqli_error($conn));
  }
}
?>
