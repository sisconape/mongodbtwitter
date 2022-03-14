<?php
   // register page
    session_start();
    include('dbconnect.php');

    if(!isset($_SESSION['user'])){
        header('location: index.php');
    }
    $userData = $db->users->findone(array('_id'=>$_SESSION['user']));
    
    $ss = $_SESSION['user'];
    $imgData = $db->images->findOne(array('owner'=> $ss));
    
    
if(empty($imgData)){    
   $result = $db->images->insertOne(array('owner'=>$ss,'img_path'=>'img/blank-profile.png'));   
}


$ss = $_SESSION['user'];

if(isset($_POST['submit'])){
    $filename = $_FILES['fileToUpload']['name'];
    if(!empty($filename)){
    $target_file = "img/".$ss.".png";
    //echo $filename;
    $sFile = $target_file;
        if(getimagesize($_FILES["fileToUpload"]["tmp_name"])){
            $updateResult = $db->images->updateOne(array('owner'=> $ss) , array( '$set' => array( 'img_path' => $target_file)));
            if(file_exists($target_file)){
                unlink($target_file);
            }
           
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $sFile =  '<span class="font-success">'."The file has been uploaded.".'<span>';
              } else {
                $sFile =  "Sorry, there was an error uploading your file.";
              }
        } 
       
    else {        
        $sFile = "File is not an image.";    
    }
}
    else{
        $sFile =  "Please choose file";
    } 

        
}
else{
        $sFile =  "";
    }  
  

?>




    

<html>
<header>
    <title>Twitter Clone</title>
</header>
<body>
<?php  include('header.php'); ?>


<form action="profile_picture.php" method="Post" enctype="multipart/form-data">    
<fieldset>
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit"> 
</fieldset>
</form>
<?php echo $sFile; ?>
</body>
 <html>