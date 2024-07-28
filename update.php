<?php
include "db_conn.php";

if (isset($_GET['id'])) {
  $ISBN = $_GET['id'];
} else {
  echo "No book selected for update.";
  exit;
}

if (isset($_POST['submit'])) {
  $Title = $_POST['Title'];
  $Copyright = $_POST['Copyright'];
  $Edition = $_POST['Edition'];
  $Price = $_POST['Price'];
  $Quantity = $_POST['Quantity'];

  $sql = "UPDATE `books` SET `Title`='$Title', `Copyright`='$Copyright', `Edition`='$Edition', `Price`='$Price', `Quantity`='$Quantity' WHERE `ISBN` = '$ISBN'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
} else {
  $sql = "SELECT * FROM `books` WHERE `ISBN` = '$ISBN' LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if (!$row) {
    echo "No book found with ISBN: $ISBN";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/w3.css">

  <title>asd</title>
</head>

<body>
  

  <div class="w3-panel w3-card-4 w3-padding-16 container my-5" style="width: 500px; margin: 0 auto;">
    <div class="text-center mb-4">
      <h3>Update</h3>
      <p class="text-muted"></p>
    </div>

    <div class="form-container text-center mb-4">
      <form action="" method="post">
        <div class="form-group">
          <label for="Title">Title:</label>
          <input type="text" id="Title" name="Title" value="<?php echo $row['Title'] ?>" required>
        </div>

        <div class="form-group">
          <label for="Copyright">Copyright:</label>
          <input type="text" id="Copyright" name="Copyright" value="<?php echo $row['Copyright'] ?>" required>
        </div>

        <div class="form-group">
          <label for="Edition">Edition:</label>
          <input type="text" id="Edition" name="Edition" value="<?php echo $row['Edition'] ?>" required>
        </div>
        <div class="form-group">
          <label for="Price">Price:</label>
          <input type="text" id="Price" name="Price" value="<?php echo $row['Price'] ?>" required>
        </div>
        <div class="form-group">
          <label for="Quantity">Quantity:</label>
          <input type="text" id="Quantity" name="Quantity" value="<?php echo $row['Quantity'] ?>" required>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
