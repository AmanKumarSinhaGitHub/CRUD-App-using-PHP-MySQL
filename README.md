# CRUD-App-using-PHP-MySQL

### [Live Preview - Click to Open](https://php-mysql-crud-app.000webhostapp.com/index.php)

![Preview Image](https://github.com/AmanKumarSinhaGitHub/CRUD-App-using-PHP-MySQL/assets/65329366/fdd01fae-afc0-4543-a542-9db27913dea2)

This repository contains a simple CRUD (Create, Read, Update, Delete) application using PHP and MySQL. The application allows users to manage user details in a MySQL database.

### In this branch we will learn crud operation with images

Add one more column to store images in Database named **"photo"** type **"mediumtext"**

```html
<!-- Add this line to work with images in "add-user.php form"  -->
<!-- enctype="multipart/form-data" -->
<!-- action="" This is often used when you want the form data to be processed by the same page or script that contains the form. -->

<form action="" method="post" enctype="multipart/form-data">
  <!-- Input field for user's photo -->
  <div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <!-- Input type set to "file" for handling file uploads -->
    <!-- Accept attribute set to "image/*" to restrict file types to images -->
    <input
      type="file"
      class="form-control"
      id="photo"
      name="photo"
      accept="image/*"
    />
  </div>
</form>
```

Edit php code of add-user.php

```php
// File upload handling
$photo = $_FILES['photo']['name'];          // Get the original name of the uploaded file
$temp_name = $_FILES['photo']['tmp_name'];  // Get the temporary name assigned to the file by the server
$folder = "uploads/";                       // Set the folder where uploaded files will be stored

// Move the uploaded file from the temporary location to the specified folder
move_uploaded_file($temp_name, $folder . $photo);

// Edit the sql query and add photo and also create a "uploads" folder in your project
$sql = "INSERT INTO `userdetails` (`name`, `email`, `mobile`, `password`, `photo`) VALUES ('$name', '$email', '$mobile', '$password', '$photo')";
```

All set. Now you can insert photo in your db

## Now lets learn how to display or fetch img from db

Open "display-user.php" file and make some changes.

```php
<!-- Loop through each user record -->
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row["id"];
  $name = $row["name"];

  // Store photo in variable
  $photo = $row["photo"];

  echo
    '<tr>
      <th scope="row">' . $id . '</th>
      <td>' . $name . '</td>

      <!-- Display user photo -->

      <td><img src="uploads/' . $photo . '" alt="User Photo" style="width: 75px; height: 75px;"></td>
    </tr>';
}
```

All set Your photo will be displayed.

## Now lets learn how to delete any photo with specific id from db

Open delete.php file and make these changes.

```php
<?php
// Include the file containing the database connection details
include("connect.php");

// Check if the "deleteID" parameter is set in the URL
if (isset($_GET["deleteID"])) {

  // Get the user ID from the URL
  $id = $_GET['deleteID'];

  // Fetch the photo filename associated with the user record before deleting the user
  $getPhotoSql = "SELECT photo FROM userdetails WHERE id = $id";
  $photoResult = mysqli_query($conn, $getPhotoSql);

  // Check if the photo query was successful
  if ($photoResult) {
    // Fetch the photo filename from the query result
    $row = mysqli_fetch_assoc($photoResult);
    $photoFilename = $row['photo'];

    // Delete the user record from the database
    $deleteUserSql = "DELETE FROM userdetails WHERE id = $id";
    $result = mysqli_query($conn, $deleteUserSql);

    // Check if the user record deletion was successful
    if ($result) {
      // Delete the associated photo file from the "uploads" folder
      $photoPath = "uploads/" . $photoFilename;
      if (file_exists($photoPath)) {
        unlink($photoPath); // Delete the photo file
      }

      // Redirect to the display-user.php page after successful deletion
      header("location:display-user.php");
    } else {
      // If user record deletion fails, display an error message
      die(mysqli_error($conn));
    }
  } else {
    // If fetching the photo filename fails, display an error message
    die(mysqli_error($conn));
  }
}
?>
```

Explanation:

1. **Database Connection:**

   - The `include("connect.php");` line includes a file (`connect.php`) that presumably contains the database connection details.

2. **Check for "deleteID" Parameter:**

   - `if (isset($_GET["deleteID"]))` checks if the "deleteID" parameter is set in the URL.

3. **Fetch Photo Filename:**

   - `$getPhotoSql` is an SQL query that retrieves the `photo` column from the `userdetails` table where the `id` matches the specified `$id`.

   - `mysqli_query($conn, $getPhotoSql)` executes the query, and the result is stored in `$photoResult`.

   - The code checks if the query was successful (`if ($photoResult)`) and fetches the photo filename from the result.

4. **Delete User Record:**

   - An SQL query (`$deleteUserSql`) is used to delete the user record from the `userdetails` table where the `id` matches the specified `$id`.

   - `mysqli_query($conn, $deleteUserSql)` executes the query, and the result is stored in `$result`.

   - If the user record deletion is successful (`if ($result)`), it proceeds to delete the associated photo file.

5. **Delete Photo File:**

   - The code constructs the file path (`$photoPath`) to the associated photo file in the "uploads" folder.

   - It checks if the file exists using `file_exists($photoPath)` and deletes it using `unlink($photoPath)`.

6. **Redirect After Deletion:**

   - If the user record deletion and photo file deletion are successful, the code redirects to the `display-user.php` page using `header("location:display-user.php")`.

7. **Error Handling:**
   - If any part of the process encounters an error, it uses `die(mysqli_error($conn));` to terminate the script and display the MySQL error message.

This code essentially deletes a user record and its associated photo file, providing a comprehensive explanation of each step in the process.

### Lets learn update operation

Open update.php

```php
// Fetch the user details into an associative array
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];
// Add line to retrieve the existing photo filename
$photo = $row['photo'];
```

Add these lines also

```php
// File upload handling
  $newPhoto = $_FILES['new_photo']['name']; // Get the name of the uploaded file
  $tempName = $_FILES['new_photo']['tmp_name']; // Get the temporary name assigned to the file by the server
  $folder = "uploads/"; // Set the folder where uploaded files will be stored

  // If a new photo is provided, update the photo filename
  if (!empty($newPhoto)) {
    // Move the uploaded file from the temporary location to the specified folder
    move_uploaded_file($tempName, $folder . $newPhoto);
    $photo = $newPhoto; // Update the photo filename
  }

```

Update query and add "$photo"

```php
$sql = "UPDATE `userdetails` SET `id`='$id',`name`='$name',`email`='$email',`mobile`='$mobile',`password`='$password', `photo`='$photo' WHERE `id`='$id'";
```

and in html part

```html
<!-- Form with POST method to submit data to PHP -->
<!-- Add this line -->
<!-- enctype="multipart/form-data" -->
<form method="post" enctype="multipart/form-data"></form>
```

```html
<div class="mb-3">
  <label for="new_photo" class="form-label">New Photo</label>
  <!-- Input field for a new photo -->
  <input
    type="file"
    class="form-control"
    name="new_photo"
    id="new_photo"
    accept="image/*"
  />
</div>
```

All set

### Our More Branches ## Insert Data ```bash git checkout main

## Fetch Data

```bash
git checkout read-data
```

## Delete Data

```bash
git checkout delete-data
```

## Update Data

```bash
git checkout update-data
```

## Crud Operations with Images

```bash
git checkout crud-with-images
```
