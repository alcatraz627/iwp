<?php
// Include the db connection file
require_once('db.php');

// If this page is accessed manually, throw a tantrum
if(!isset($_POST['actiontype'])) die('Unauthorized Access');

// This section handles registering and logging in users
// Check what type of authentication action is required - login or signup
switch($_POST['actiontype']) {
    
    case 'signup':
        // Looking for the user in the database
        $statement = "SELECT * FROM users WHERE email='".$_POST['email']."';";
        $query = $conn->query($statement);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetchAll();

        // If the email is already registered, throw an error
        if(count($row)) redir('../auth.php', 'User already exists.');

        // Otherwise, enter the details into the db
        $statement = "INSERT INTO users (email, password) VALUES (:email, :password);";        
            $insert = $conn->prepare($statement);
            $insert->bindValue(':email', $_POST['email']);
            $insert->bindValue(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
            $insert->execute();    

        // Log in the user
        $_SESSION['user'] = $_POST['email'];
        redir('../index.php');        
    
        break;
        
    case 'login':
        // Check if the user exists
        $statement = "SELECT * FROM users WHERE email='".$_POST['email']."';";
        $query = $conn->query($statement);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetchAll();

        // If not...
        if(!count($row)) redir('../auth.php', 'User Not Found. Please Check your credentials.');

        // If yes, then check if the password is correct
        if($row[0]['password'] !== password_hash($_POST['password'], PASSWORD_BCRYPT)) redir('../auth.php', 'Invalid Credentials.');
        else {
            $_SESSION['user'] = $_POST['email'];
            redir('../index.php');            
        }
        break;
        
    default:
        echo 'Invalid input';
    }
?>