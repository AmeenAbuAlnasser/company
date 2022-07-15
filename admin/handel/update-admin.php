<?php
session_start();
require('conection.php');
$id=$_POST['id'];
$query="SELECT * FROM admins where id=$id";
$result=mysqli_query($conn,$query);
$admin=mysqli_fetch_assoc($result);
$name=htmlspecialchars(trim($_POST['name']));
$email=htmlspecialchars(trim($_POST['email']));
$status=htmlspecialchars(trim($_POST['status']));
$errors=[];
$oldImg=$admin['img'];
  //name 
  if(empty($name)){
    $errors[]="name is requerd";
  }elseif(is_numeric($name)){
      $errors[]="name must be string";
  }elseif(strlen($name)>100){
      $errors[]="name size more than 100";
  }

  //email
  
  if(empty($email)){
      $errors[]="email is requerd";
  }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
             $errors[]="is not a valid email";
  }elseif(strlen($email)>40){
      $errors[]="email size more than 40";
  }
      //img
      if($_FILES==true && $_FILES['img']['name']){
        //with img
        $image=$_FILES['img'];
        $imgName=$image['name'];
        $imgTempName=$image['tmp_name'];
        $size=$imge['size'];
        $sizeMb=$size/(1024*1024);
        $ext=pathinfo($imgName,PATHINFO_EXTENSION);
        $newName=uniqid().".".$ext;
   
        if($sizeMb>1){
           $errors[]="imge size more than 1MB";
        }elseif(!in_array(strtolower($ext),['png','jpg','jpeg','gif'])){
             $errors[]="img not correct";
        }
       }else{
          $newName=$oldImg;
       }
    //status
    if($status!=1 ){
       if($status!=0){
       $errors[]="invalid status";
       }
    }
    if(empty($errors)){
       $query="UPDATE admins SET name='$name',email='$email',status='$status',img='$newName' WHERE id='$id'";
       $result=mysqli_query($conn,$query);
       if($result){
        if($_FILES['img']['name']){
        move_uploaded_file($imgTempName,"../uplodes/$newName");
        unlink("../uplodes/$oldImg");
        }
        $_SESSION['succes']='admin updated successfly';
        header("location:../admins.php");
       }

    }else{
    $_SESSION['errors']=$errors;
    header("location:../admins.php");
    }
?>