<?php
  include "db_conn.php";

$search = '';
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

$sql = "SELECT * FROM `books`";
if ($search) {
    $sql .= " WHERE `Title` LIKE '%$search%' OR `ISBN` LIKE '%$search%'";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Custom CSS -->
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/w3.css">

  
  

  <title>HelloWorld</title>
  
  <style>
    /* ALERT */
    .alert {
      position: relative;
      padding: 1rem;
      margin-bottom: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #f8d7da;
      color: #721c24;
    }
    
    .alert .close-btn {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: none;
      border: none;
      color: #721c24;
      font-size: 1.2rem;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="w3-panel w3-card-4 w3-padding-16 container my-5">

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert"><strong>
      ' . $msg . '
      </strong><button type="button" class="close-btn">&times;</button>
    </div>';
    }
    ?>
    <a class="btn btn-primary" href="add-books.php" class="add-btn">Add Books</a>
    <br>
    <br>
    <!-- SEARCH BAR -->
    <form action="" method="post" class="search-form">
        <input class="form-control" type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by title or ISBN" />
      <button type="submit" class="search-btn">Search</button>
    </form>
    <br>
    <br>
    <table class="w3-table-all w3-centered w3-hoverable">
      <thead>
        <tr class="w3-light-green">
          <th>ISBN</th>
          <th>Title</th>
          <th>Copyright</th>
          <th>Edition</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["ISBN"] ?></td>
            <td><?php echo $row["Title"] ?></td>
            <td><?php echo $row["Copyright"] ?></td>
            <td><?php echo $row["Edition"] ?></td>
            <td><?php echo $row["Price"] ?></td>
            <td><?php echo $row["Quantity"] ?></td>
            <td><?php echo $row["Total"] ?>
            <!-- <td php echo $row['Price'] * $row['Quantity']; ?>td -->
            <td>
              <a class="btn btn-primary" href="update.php?id=<?php echo $row["ISBN"] ?>">Update</a>
              <a class="btn btn-danger" href="delete.php?id=<?php echo $row["ISBN"] ?>">Delete</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add event listener to all close buttons
      const closeButtons = document.querySelectorAll('.close-btn');
      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          const alertBox = this.parentElement;
          alertBox.style.display = 'none';
        });
      });
    });
  </script>
</body>

</html>
