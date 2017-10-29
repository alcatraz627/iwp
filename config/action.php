<?php
require_once('db.php');

if(!isset($_POST['actiontype'])) die('Unauthorized Access');

switch($_POST['actiontype']) {
    
    case 'signup':
        // echo 'Signup';
        print_r($_POST);

        $statement = "SELECT * FROM users WHERE email='".$_POST['email']."';";
        // echo $statement;
        
        $query = $conn->query($statement);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetchAll();

        if(count($row)) redir('../auth.php', 'User already exists.');

        $statement = "INSERT INTO users (email, password) VALUES (:email, :password);";        
            $insert = $conn->prepare($statement);
            $insert->bindValue(':email', $_POST['email']);
            $insert->bindValue(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
            $insert->execute();    

        $_SESSION['user'] = $_POST['email'];
        redir('../index.php');        
    
        break;
        
    case 'login':
        $statement = "SELECT * FROM users WHERE email='".$_POST['email']."';";
        // echo $statement;
        
        $query = $conn->query($statement);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetchAll();

        if(!count($row)) redir('../auth.php', 'User Not Found. Please Check your credentials.');

        if($row[0]['password'] !== password_hash($_POST['password'], PASSWORD_BCRYPT)) redir('../auth.php', 'Invalid Credentials.');
        else {
            $_SESSION['user'] = $_POST['email'];
            redir('../index.php');            
        }
        break;
        
    default:
        echo 'Invalid input';

    }

    // Custom functions
    function redir($url, $err='')
    {
        $_SESSION['err'] = $err;
        header('location: '.$url);
    }
?>