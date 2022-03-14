
<?php
session_start();
include('dbconnect.php');

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
                $sFile =  "The file has been uploaded.";
                header('location: profile_picture.php');
              } else {
                $sFile =  "Sorry, there was an error uploading your file.";
              }
              header('location: profile_picture.php');
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