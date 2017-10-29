<?php
// Include the file containing the database connection code
require_once('include/header.php');

// Redirect the user to the login page if they are not logged in
if(!isset($_SESSION['user'])) header('location: auth.php');

if(!isset($_GET['id'])) redir('index.php', 'Please select a valid image');

$statement = "SELECT * FROM images WHERE id='".$_GET['id']."';";
$query = $conn->query($statement);
$query->setFetchMode(PDO::FETCH_ASSOC);
$img = $query->fetchAll()[0];

?>
<!-- <h1 class="text-center">Browse Gallery</h1><hr> -->
<div class="row">
    <div class="col-sm-8 col-sm-push-2 bg-info">
        <div class="imgcont">
            <h2 class="text-center"><?php echo $img['title'] ?></h2><hr>
            <a href="uploads/<?php echo $img['id'] ?>.jpg" target="_blank" download="<?php echo $img['title'] ?>"><img src="uploads/<?php echo $img['id'] ?>.jpg" class="img-rounded theimg"></a>
            <br><br>
            <p class="text-muted">Click on the image to download</p>
            <p class="text-center"><?php echo $img['description'] ?></p>
            <hr>
        </div>
    </div>        
</div>
<?php
// Include the file containing the database connection code
require_once('include/header.php');
?>
