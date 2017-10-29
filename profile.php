<?php
// Include the file containing the database connection code
require_once('include/header.php');

// Redirect the user to the login page if they are not logged in
if(!isset($_SESSION['user'])) redir('auth.php', "Please log in");

?>
        <div class="row text-center">
            <div class="col-sm-6 col-sm-push-3">
            <h4><b>User Profile:</b> <?php echo$_SESSION['user'] ?></h4>
            <div class="well">Upload Image<hr>
                <form action="config/upload.php" class="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" placeholder="Title" class="form-control">
                    </div><br>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" placeholder="Description" class="form-control">
                    </div><br>
                    <div class="form-group">
                        <label for="title">Select image to upload:</label>
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>