<?php
   //    login page 
    session_start();
    
    require_once('dbconnect.php');
    if(isset($_SESSION['user'])){
       header('location: home.php');
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = hash('sha256',($_POST['password']));
        $result = $db->users->findOne(array('username'=>$username,'password'=>$password));
        if(!$result){
        }else{
            $_SESSION['user'] = $result->_id;
            header('location: home.php');
        }
    }
?>
<html>
<header>
    <title>Twitter Clone</title>
</header>
<body>
    <form method="post" action="index.php">
        <fieldset>
            <label for="username">username:</label><input type="text" name="username" /><br>
            <label for="username">password:</label><input type="password" name="password" /><br>
            <button type="submit" >login</button><br>
        </fieldset>
    </form>
    <a href="register.php">No account? Register here.</a>
    <body>
 <html>