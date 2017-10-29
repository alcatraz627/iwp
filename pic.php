<?php
// Include the file containing the database connection code
require_once('include/header.php');

// Check if the image ID is supplied in the URL
if(!isset($_GET['id'])) redir('index.php', 'Please select a valid image');

// Fetch the image from the db
$statement = "SELECT * FROM images WHERE id='".$_GET['id']."';";
$query = $conn->query($statement);
$query->setFetchMode(PDO::FETCH_ASSOC);
$img = $query->fetchAll()[0];

// If the image is not found in the db...
if(!count($img)) redir('index.php', 'Record not found')

?>
    <div class="row">
        <div class="col-sm-8 col-sm-push-2 bg-info">
            <div class="imgcont">
                <h2 class="text-center"><?php echo $img['title'] ?></h2><hr>
                <!-- The download="filename" attribute lets the image be downloaded with the filename as the default name -->
                <a href="uploads/<?php echo $img['id'] ?>.jpg" target="_blank" download="<?php echo $img['title'] ?>"><img src="uploads/<?php echo $img['id'] ?>.jpg" class="img-rounded theimg"></a>
                <br><br>
                <p class="text-muted">Click on the image to download</p>
                <p class="text-center"><?php echo $img['description'] ?></p>
                <hr>
            </div>
        </div>        
    </div>
</div>
</body>
</html>