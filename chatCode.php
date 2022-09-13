<?php
session_start();
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

$sql = " SELECT * FROM chat";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        if($_SESSION['userID'] == $row['userID'])
        {
            echo "<p style = 'text-align:right;text-decoration:underline'><strong>$user</strong></p>";
            $message = $row['message'];
            echo "<p style = text-align:right>$message</p>";
        }
        else
        {
            $otheruserID = $row['userID'];
            $result2 = mysqli_query($con, "SELECT * FROM users WHERE id = '$otheruserID'");
            $row2 = mysqli_fetch_assoc($result2);
            $otheruser = $row2['Username'];
            echo "<p style = 'text-align:left;text-decoration:underline'><strong>$otheruser</strong></p>";
            $message = $row['message'];
            echo "<p style = text-align:left>$message</p>";
        }
    }
}
else
{
    echo("No messages have been sent yet");
}

?>
