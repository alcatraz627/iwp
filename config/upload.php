<?php

// Include the file containing the database connection code
require_once('db.php');

// Get the number of entries
$statement = "SELECT count(*) FROM images;";
$query = $conn->query($statement);
$query->setFetchMode(PDO::FETCH_ASSOC);
$row = $query->fetchAll()[0];

// Basic configuration
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG and JPEG extensions are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";

    // if everything is ok, try to upload file
} else {
    // $target_file = $target_dir.((int)$row['count(*)']+1).'.'.$imageFileType;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        chmod($target_path, 0755);
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

if($uploadOk)
{
// Enter into db
$statement = "INSERT INTO images (title, description) VALUES (:title, :description);";        
$insert = $conn->prepare($statement);
$insert->bindValue(':title', $_POST['title']);
$insert->bindValue(':description', $_POST['description']);
$insert->execute();    

echo "Record updated successfully!<br>";

redir('../pic.php?id='.$row['count(*)']);
}
?>