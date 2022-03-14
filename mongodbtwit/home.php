<html>
<header>
    <title>
        home
    </title>
</header>
<body>
<?php
session_start();
 require_once('dbconnect.php');
if(!isset($_SESSION['user'])){  
      header("Location: index.php");
}
$userData = $db->users->findone(array('_id'=>$_SESSION['user']));
function get_recent_tweets($db){
    $result = $db->following->find(array('follower'=>$_SESSION['user']));
    $result = iterator_to_array($result);
    //var_dump($result);
    $user_following = array();
    foreach ($result as $entry){
        $user_following[] = $entry['user'];
    }
    $result = $db->tweets->find(array('authorId'=>array('$in'=>$user_following)));
    $recent_tweets = iterator_to_array($result);
    return $recent_tweets; 
}

?>
<?php  include('header.php'); ?>
<form method="post" action="create_tweet.php">
    <fieldset>
        <label  for ="tweet">What's happenting?</label><br>
        <textarea rows="5" cols="50" name="body"></textarea><br>
        <input type="submit" value="Tweet"/><br>
    </fieldset>

    <?php
    $recent_tweets = get_recent_tweets($db);
    foreach( $recent_tweets as $tweet){
        $imgDa = $db->images->findOne(array('owner'=> ($tweet['authorId'])));
        $pathimg = "" ;
        if(!empty($imgDa)){
            $path_img = $imgDa->img_path;
        }else{
            $path_img = "img/blank-profile.png";
        }

        echo '<table><tr>';
        echo '<td> <img src="'.$path_img.'?'.rand().'" width="50" height="50"  class = "img-style"> '.'</td>';
        echo '<td>';
        echo '<p><a href="profile.php?id='.$tweet['authorId'].'">'.$tweet['authorName'].'</a></p>';
        echo '<p>'.$tweet['body'].'</p>';
        echo '<p>'.$tweet['created'].'</p>';
        echo '</td>';        
        echo '</tr></table>';
        echo '<hr>';
    }
    ?>
</form>
</body>
</html>