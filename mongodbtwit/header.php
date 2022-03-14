<div > 
<style>
    .img-style {
        border-radius: 50%;
        object-fit: cover;

    }
    .font-success {color: green;

    }
</style>

    <?php
    include('dbconnect.php');
    $userID = $userData['_id'];
    $img_topleft = $db->images->findOne(array('owner'=>$userID));
    $pathimg_topleft = "" ;
    if(!empty( $img_topleft)){
        $pathimg_topleft =$img_topleft->img_path;
    }else{
        $pathimg_topleft = "img/blank-profile.png";
    }
   
    ?>  
 
    <img src="<?php echo $pathimg_topleft."?".rand() ; ?>" width="150" height="150"  class = "img-style"> 
    welcome <?php echo $userData->username; ?> <br>
    [<a href="home.php">Home</a>]
    [<a href="profile.php?id=<?php echo $_SESSION['user']; ?>"> View Profile</a>]
    [<a href="profile_picture.php">Profile Picture</a>]
    [<a href="userlist.php">View Users List</a>]
    [<a href="logout.php">logout</a>] 
</div>