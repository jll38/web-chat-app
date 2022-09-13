<?php
session_start();
if(empty($_SESSION['userID']))
{
    header('location: ./login.php');
}


$userID = $_SESSION['userID'];
$user = $_SESSION['user'];
$dbServer = "sql1.njit.edu";
$ini_array = parse_ini_file("login.ini");
$dbUsername = $ini_array['username'];
$dbPassword = $ini_array['password'];
$dbName = $ini_array['dbname'];
$con = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$chatResults = mysqli_query($con, " SELECT * FROM chat");

?>
<html lang = "en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chatroom</title>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
<div class = "wrapper">
  <div class = "container">
    <div class = "row" style = "border-bottom: solid grey 2px">
        <?php
        echo("<h1>Logged in as: $user <br/></h1><p>Chatroom A <br/>User ID: $userID</p>");
        echo("<a href = ./login.php>Return to Login</a>")
        ?>
    </div>
    <div class = "row" style = "border-bottom: solid grey 2px" id = "row">
      <div class = "modal-body" name = "msgBody" id ="msgBody" style = "height:500px; overflow-y:scroll;">


      </div>
      <div class = "modal-footer">
        <form method = "POST" style ="width:500px">
          <textarea type = "text" method = "POST" name = "message" class = "form-control" style = "height:50px;overflow-y:scroll;overflow-x: hidden"></textarea>

            <input type = "submit" id = "btn" name = "btn"></input>


          <script type = "text/javascript">
                $(document).ready(function()
                {
                    setInterval(function(){
                        $("#msgBody").load("./chatCode.php");
                        }, 250)

                });

          </script>
            <?php
            if (isset($_POST['btn']))
            {
                $textmessage = addslashes($_POST['message']);
                if(empty($textmessage))
                    echo("Message must contain text!");
                else
                {
                    $upload = mysqli_query($con, " INSERT INTO chat(userID,message) VALUES('$userID', '$textmessage')");
                }
            }

            ?>
        </form>

    </div>

    </div>
  </div>

</div>
</form>
</body>
</html>
