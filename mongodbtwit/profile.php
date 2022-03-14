<?php
session_start();

require_once('dbconnect.php');

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}

if(!isset($_GET['id'])){
    header('Location: index.php');
}
   $userData = $db->users->findOne(array('_id'=> $_SESSION['user']));
   $profile_id = $_GET['id'];
   $result = $db->users->findOne(array('_id' => new MongoDB\BSON\ObjectID("$profile_id")));

    function get_recent_tweets($db){
        $id =$_GET['id'];
        $result = $db->tweets->find(array('authorId' => new MongoDB\BSON\ObjectID("$id")));
        $recent_Tweets = iterator_to_array($result);
        return $recent_Tweets;
    }
?>


<html>
<header>
    <title>Twitterclone </title>
</header>
<body>
<?php 
   include('header.php'); 
   
   $recent_Tweets = get_recent_tweets($db);
    foreach ($recent_Tweets as $tweet){
        $imgDa = $db->images->findOne(array('owner'=> ($tweet['authorId'])));
        $pathimg = "" ;
        if(!empty($imgDa)){
            $path_img = $imgDa->img_path;
        }else{
            $path_img = "img/blank-profile.png";
        }

        echo '<table><tr>';
        echo '<td> <img src="'.$path_img.'?'.rand().'" width="75" height="75"   class = "img-style"> '.'</td>';
        echo '<td>';
        echo '<p><a href="profile.php?id='. $tweet['authorId'].'">'.$tweet['authorName'].'</a></p>';
        echo '<p>'.$tweet['body'].'</p>';
        echo '<p>'.$tweet['created'].'</p>';
        echo '</td>';        
        echo '</tr></table>';
        echo '<hr>';
    }

?>
</body>

</html>