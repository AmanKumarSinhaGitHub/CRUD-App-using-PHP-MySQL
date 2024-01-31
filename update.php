<?php

// Include the database connection file
include("connect.php");

// Get the user ID to be updated from the URL parameter
$id = $_GET['updateID'];

// SQL query to fetch user details for the specified ID
$sql = "SELECT * FROM userdetails WHERE `userdetails`.`id` = $id";
$result = mysqli_query($conn, $sql);

// Fetch the user details into an associative array
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];

// Check if the update form is submitted
if (isset($_POST["submit"])) {

  // Retrieve user inputs from the form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  // Validate if all fields are filled
  if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
    echo "All fields are required";
  } else {
    // Construct SQL query to update user data in the 'userdetails' table
    $sql = "UPDATE `userdetails` SET `id`='$id',`name`='$name',`email`='$email',`mobile`='$mobile',`password`='$password' WHERE `id`='$id'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the update was successful
    if ($result) {
      // Redirect to the display-user.php page after the update
      header("location:display-user.php");
    } else {
      // Display an error message and terminate the script
      die(mysqli_error($conn));
    }
  }
}

// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD App using PHP MySQL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

  <style>
    html,
    body {
      background-color: gainsboro;
    }
  </style>

  <div class="container py-5 px-5">

    <div class="container text-center py-3">
      <h2>CRUD OPERATIONS • Update Data</h2>
    </div>

    <!-- Form with POST method to submit data to PHP -->
    <form method="post">

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <!-- Input field for name with pre-filled value from PHP -->
        <input type="name" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="<?php echo $name; ?>">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <!-- Input field for email with pre-filled value from PHP -->
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email address" aria-describedby="emailHelp" value="<?php echo $email; ?>">
      </div>

      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <!-- Input field for mobile with pre-filled value from PHP -->
        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Your Mobile Number" value="<?php echo $mobile; ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <!-- Input field for password with pre-filled value from PHP -->
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" value="<?php echo $password; ?>">
      </div>

      <!-- Submit button to update data -->
      <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>