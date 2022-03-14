<?php

session_start();
require_once('dbconnect.php');

if(!isset($_SESSION['user'])){
    header('location: index.php');
}
$userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

function get_user_list($db){
$result = $db->users->find();
$users = iterator_to_array($result);
return $users;
}
?>
<html>
<header>
    <title>Twitter clone</title>
</header>
<body>
    
<?php include ('header.php'); ?>
<div>
<p><b>List of users:</b></p>
<?php
    $user_list = get_user_list($db);
    foreach($user_list as $user){
        $imgDa = $db->images->findOne(array('owner'=> ($user['_id'])));
        $pathimg = "" ;
        if(!empty($imgDa)){
            $path_img = $imgDa->img_path;
        }else{
            $path_img = "img/blank-profile.png";
        }

        echo '<table><tr>';
        echo '<td> <img src="'.$path_img.'?'.rand().'" width="75" height="75" class="img-style" > '.'</td>';
        echo '<td>';
        echo '<span>'.$user['username'].'</span>';
        echo '[<a href="profile.php?id='.$user['_id'].'">Visit Profile</a>]';
        echo '[<a href="follow.php?id='.$user['_id'].'">follow </a>]';
        echo '</td>';        
        echo '</tr></table>';
        echo '<hr>';
        echo '<hr>';
    }


?>


</div>




</body>


</html>