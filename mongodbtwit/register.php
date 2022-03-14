<?php
   // register page
    session_start();
    require_once('dbconnect.php');    
    if(isset($_SESSION['user'])){
       header('location: home.php');
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = hash('sha256',($_POST['password']));
        $result = $db->users->insertOne(array('username'=>$username,'password'=>$password));
        header('location: index.php');
    }
?>
<html>
<header>
    <title>Twitter Clone</title>
</header>
<body>
    <form method="post" action="register.php">
        <fieldset>
            <label for="username">username:</label><input type="text" name="username" /><br>
            <label for="username">password:</label><input type="password" name="password" /><br>
            <button type="submit" >sigin</button><br>
        </fieldset>
    </form>
    <a href="index.php">Already have a account? Login here</a>
    <body>
 <html>