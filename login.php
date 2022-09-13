<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<html lang = "en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script type = "text/javascript">
  </script>
  <style class = "text/css">
    body
    {
      display:flex;
      align-items:center;
      justify-content:center;
      background-image:url("https://www.grahambrown.com/dw/image/v2/BBBG_PRD/on/demandware.static/-/Sites-product-master/default/dw496dc722/images/large/CT-060-096_1.jpg?sw=1024&sh=1024&sm=fit");
    }
    .wrapper{
      width:500px;
      border-radius:16px;
      box-shadow: 0 32px 64px -48px rgba(0,0,0,0.5);
      background:white;
    }
    form{
      padding: 25px 30px;
    }
    .inside{
      padding:25px 30px;
    }


  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
<div class = "wrapper">
  <div class = "row">
    <div class = "col-4">
      <h1 class = "inside">Login</h1>
    </div>
    <div class = "col-6">
      <form method ="POST">
        <div class = "form-group" >
          <label for="inputUsername">Username</label>
          <input type ="text" class = "form-control" name = "username" placeholder = "JohnDoe">
        </div>
        <div class = "form-group">
          <label for = "inputPassword">Password</label>
          <input type ="password" class = "form-control" name = "password" placeholder = "Password">
        </div>
        <div class = "form-group">
          <input type = "submit" name = "submit">
          <?php
          $username = $_POST['username'];
          $password = $_POST['password'];
          if(isset($_POST['submit'])) {
            $dbServer = "sql1.njit.edu";
            $ini_array = parse_ini_file("login.ini");
            $dbUsername = $ini_array['username'];
            $dbPassword = $ini_array['password'];
            $dbName = $ini_array['dbname'];
            $con = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);
            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

              $result = mysqli_query($con," select * from users where
                                                            Username = '$username' and Password = '$password'")
              or die("fatal error");
              $num = mysqli_num_rows($result);

              if($num > 0)
              {
                  session_start();
                  $fetch = mysqli_fetch_assoc($result);
                  $_SESSION['user'] = $username;
                  $_SESSION['userID'] = $fetch["id"];

                  header('Location: ./chat.php');
              }

              else
              {
                  die("invalid credentials");


              }
}
          ?>
        </div>
    </div>
    <p style = "padding: 0px 0px 0px 20px">Not a user? <a href = "./register.php">Register here!</a></p>
  </div>
</div>
</form>
</body>
</html>
