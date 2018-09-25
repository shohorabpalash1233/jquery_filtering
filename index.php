<?php include("config.php"); ?>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];

    if (empty($name)) {
      echo "Name cannot be empty<br>";
    }
    if (empty($address)) {
      echo "Address cannot be empty";
    }
    if (empty($phone)) {
      echo "Phone cannot be empty";
    }
    if (empty($email)) {
      echo "Email cannot be empty";
    }

    $sql = "INSERT INTO data (name, address, phone, email) VALUES ('$name', '$email', '$phone', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

  <div class="jumbotron text-center">
      <h2>Table Data Filtering With jQuery</h2>
    </div>
    <div class="container">
      <form method="post">
        <div class="form-group">
          <label>Name</label>
          <input class="form-control" type="text" name="name" required="">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input class="form-control" type="text" name="address" required="">
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input class="form-control" type="text" name="phone" required="">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input class="form-control" type="text" name="email" required="">
        </div>
        <div class="form-group">
          <input class="btn btn-block btn-primary" type="submit" name="submit" value="Add">
        </div>
      </form>
    </div>
    <div class="container">
      <h2 class="well">Filterable Table</h2>
      <p>Type something in the input field to search the table for first names, last names or emails:</p>  
      <input id="myInput" type="text" placeholder="Search..">
      <br><br>

      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
          </tr>
        </thead>
        <?php
          $sql    = "SELECT * FROM data";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($value = $result->fetch_assoc()) {
              ?>    
        <tbody id="myTable">
          <tr>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['address']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td><?php echo $value['email']; ?></td>
          </tr>
        </tbody>
        <?php
            }
          }
        ?>
      </table>
      <br><br>
    </div>
    <div class="alert alert-success text-center">
        <h2>A simple app to evaluate table data filtering with jQuery</h2>
    </div>
</body>
</html>
