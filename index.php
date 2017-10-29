<?php
// Include the file containing the database connection code
require_once('include/header.php');

// Fetch all the images
$statement = "SELECT * FROM images;";
$query = $conn->query($statement);
$query->setFetchMode(PDO::FETCH_ASSOC);
$row = $query->fetchAll();

?>
<h1 class="text-center">Browse Gallery</h1><hr>
        <div class="row">
        <?php
            foreach($row as $img)
            {
                // Run through all the images in the db, fetching the title and description and loading from the folder
                echo "
            <div class=\"col-sm-4\">
                <div class=\"imgcont\">
                    <h2 class=\"text-center\">".$img['title']."</h2>
                    <a href=\"pic.php?id=".$img['id']."\" target=\"_blank\"><img src=\"uploads/".$img['id'].".jpg\" class=\"img-rounded theimg\"></a>
                    <br><br>
                    <p>".$img['description']."</p>
                    <hr>
                </div>
            </div>        
                ";
            }
        ?>
        </div>
    </div>
</body>
</html>