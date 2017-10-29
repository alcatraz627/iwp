<?php

// Connecting to the db
$servername= "localhost";
$username="root";
$password="12017";
$dbname="iwp";

try {
    //make a connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// Start the PHP session
session_start();

// Custom functions
function redir($url, $err='')
{
    $_SESSION['err'] = $err;
    header('location: '.$url);
}

?>
