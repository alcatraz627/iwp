<?php
// Include the file containing the database connection code
require_once('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IWP</title>

<!-- Bootstrap and jQuery include -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Custom -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- Bootstrap Navbar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">IWP</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="profile.php">Dashboard</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
        if(isset($_SESSION['user']))
        {
            echo "<li><a href=\"profile.php\"><span class=\"glyphicon glyphicon-user\"></span> Welcome, ".$_SESSION['user']."</a></li>";
            echo "<li><a href=\"auth.php?logout=logout\"><span class=\"glyphicon glyphicon-log-in\"></span> Log Out</a></li>";            
        } else
        {
            echo "<li><a href=\"auth.php?login\"><span class=\"glyphicon glyphicon-log-in\"></span> Log In</a></li>";            
            echo "<li><a href=\"auth.php?signup\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
        }
    ?>
    </ul>
  </div>
</nav>
<div class="container">

<?php
if(isset($_SESSION['err']))
echo "
<div class=\"alert alert-danger\">
  ".$_SESSION['err']."
</div>";
unset($_SESSION['err']);
?>