# CRUD-App-using-PHP-MySQL

### [Live Preview - Click to Open](https://php-mysql-crud-app.000webhostapp.com/index.php)

This PHP-MySQL CRUD application provides options for updating and deleting user records.

## Delete Data

In the `display-user.php` file, each row in the table includes a "Delete" button for deleting the corresponding user record.

```html
<!-- ... (Previous HTML code remains unchanged) -->

<td>
    <!-- Delete Button -->
    <button class="btn btn-danger">
        <!-- Anchor Tag with Href -->
        <a href="delete.php?deleteID=<?php echo $id; ?>" class="text-light">
            Delete
        </a>
    </button>
</td>

<!-- ... (Continue with the rest of the HTML code) -->
```

- The "Delete" button is linked to the `delete.php` file with the user ID (`?deleteID=<?php echo $id; ?>`) as a query parameter. This allows the `delete.php` file to identify which user record to delete.

## Delete Operation in delete.php

The `delete.php` file handles the deletion of a user record based on the provided user ID. When a user clicks the "Delete" button in `display-user.php`, the associated user ID is sent as a query parameter to `delete.php`.

```php
<?php
include("connect.php");

if(isset($_GET["deleteID"])){
  $id = $_GET['deleteID'];

  // SQL query to delete the user record with the specified ID
  $sql = "DELETE FROM userdetails WHERE `userdetails`.`id` = $id";

  // Execute the SQL query
  $result = mysqli_query($conn, $sql);

  // Check if the query execution was successful
  if($result){
    // Redirect to the display-user.php page after deletion
    header("location:display-user.php");
  } else {
    // Display an error message and terminate the script
    die(mysqli_error($conn));
  }
}
?>
```

- The `delete.php` file checks if a user ID is provided via the `GET` method (`$_GET["deleteID"]`).

- If a user ID is present, it constructs and executes an SQL query to delete the corresponding user record from the `userdetails` table.

- After deletion, it redirects the user back to the `display-user.php` page to reflect the updated data.

- If there's an error during the deletion process, it displays the error message and terminates the script.

#### Checkout More Branches for Fetching Data, Editing Data, and Deleting Data from Database.

## Insert Data
```bash
git checkout main
```

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