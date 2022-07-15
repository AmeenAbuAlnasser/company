<?php
session_start();
require("conection.php");
if(isset($_POST['submit'])){
   $name=htmlspecialchars(trim($_POST['name']));
   $email=htmlspecialchars(trim($_POST['email']));
   $password=htmlspecialchars(trim($_POST['password']));
   $status=htmlspecialchars(trim($_POST['status']));
   $errors=[];
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
     //password

     if(empty($password)){
        $errors[]="password is requerd";
     }elseif(!preg_match("#[0-9]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
     
    $password=password_hash($password,PASSWORD_DEFAULT);
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
       $newName="defult.png";
    }
 //status
 if($status!=1 ){
    if($status!=0){
    $errors[]="invalid status";
    }
 }

    if(empty($errors)){
     $query="INSERT INTO admins(`name`,`email`,`password`,`status`,`img`) VALUES ('$name','$email','$password','$status','$newName')";
     $result=mysqli_query($conn,$query);

     if($result){
        if($_FILES['img']['name']){
            move_uploaded_file($imgTempName,"../uplodes/$newName");
        }
        $_SESSION['succes']="admin added successfully";
        header("location:../admins.php");
     }
    }else{
        $_SESSION['errors']=$errors;
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        header('location:../add-admin.php');
    }

}else{
header("location:../admins.php");
}


?>