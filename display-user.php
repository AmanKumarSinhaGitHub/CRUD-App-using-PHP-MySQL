<?php
include("connect.php");
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
      <h2>CRUD OPERATIONS • Display Data</h2>
    </div>

    <div class="container px-5">
      <button class="btn btn-primary"> <a href="add-user.php" class="text-light"> Add User</a> </button>
    </div>

    <div class="container py-5 px-5">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Password</th>
          </tr>
        </thead>

        <tbody>
          <?php
          // SQL query to select all data from the 'userdetails' table
          $sql = "SELECT * FROM `userdetails`";

          // Execute the SQL query
          $result = mysqli_query($conn, $sql);

          // Check if the query was successful
          if ($result) {
            // Loop through the fetched data
            while ($row = mysqli_fetch_assoc($result)) {
              // Extract individual fields from the fetched row
              $id = $row['id'];
              $name = $row['name'];
              $email = $row['email'];
              $mobile = $row['mobile'];
              $password = $row['password'];

              // Display the data in a table row
              echo '
                <tr>
                  <th scope="row">' . $id . '</th>
                  <td>' . $name . '</td>
                  <td>' . $email . '</td>
                  <td>' . $mobile . '</td>
                  <td>' . $password . '</td>
                </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>