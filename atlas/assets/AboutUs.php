<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
    <script src="./js/main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "atlas";
// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<body>
<ul id="headbarr">
        <li class="headbar">
            <a href="#contact">Contact Us</a>
        </li>
        <li class="headbar">
            <a href="#">About Us</a>
        </li>
        <button type="button" style="margin-top:0.5%;float:right;margin-right:1%" class="btn btn-primary">Login</button>
        <button type="button" style="margin-top:0.5%;float:right;margin-right:1%" class="btn btn-primary">Signup</button>
    </ul>
    <?php
      $sql = "SELECT * FROM aboutus_users where is_active=1";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<div class="card" style="width: 15rem;margin-left:1%;float:left;margin-top:10px;display:block">
              <img class="card-img-top" src="'.$row["image_name"].'" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">'.$row["name"].'</h5>
                <span class="glyphicon glyphicon-phone">'.$row["email"].'</span>
                <span class="glyphicon glyphicon-phone">'.$row["mobile_number"].'</span>
              </div>
              </div>';
          }
      } else {
          echo "0 results";
      }
      $conn->close();
      ?>
</div>
</body>
</html>