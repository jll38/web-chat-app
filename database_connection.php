<?php
$ini_array = parse_ini_file("login.ini");
$dbUsername = $ini_array['username'];
$dbPassword = $ini_array['password'];
$dbName = $ini_array['dbname'];
$connect = mysqli_connect('sql1.njit.edu', $dbUsername,$dbPassword,$dbName);

