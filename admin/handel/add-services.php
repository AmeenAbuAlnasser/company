<?php
require('conection.php');
session_start();
$title=$_POST['title'];
$paragraph=$_POST['paragraph'];
$icon=$_POST['icon'];
$status=$_POST['status'];
$errors=[];
if(isset($_POST['submit'])){
//title
if (empty($title)){
    $errors[]="data is requerd";
}
//paragraph
if (empty($paragraph)){
    $errors[]="data is requerd";
}
//icons
if($_FILES==true && $_FILES['icon']['name']){
$icons=$_FILES['icon'];
$iconName=$icons['name'];
$iconTemp=$icons['tmp_name'];
$size=$icons['size'];
$sizeMb=$size/(1024*1024);
$ext=pathinfo($iconName,PATHINFO_EXTENSION);
$newIcon=uniqid().".".$ext;

if($sizeMb>1){
    $errors[]="the size must be less than 1 MB";
}elseif(!in_array(strtolower($ext) ,['png'])){
    $errors[]="icon not correct";
}
}else{
    $newIcon="defult.png";
}
 //status
 if($status!=1 ){
    if($status!=0){
    $errors[]="invalid status";
    }
 }
 if(empty($errors)){
    $query="INSERT INTO services(`title`,`paragraph`,`icon`,`status`) VALUES('$title','$paragraph','$newIcon','$status')";
    $result=mysqli_query($conn,$query);
    if($result){
        if($_FILES['icon']['name']){
            move_uploaded_file($iconTemp,"../uplodes/icon/$newIcon");
        }
        $_SESSION['succes']="service added successfully";
        header("location:../services.php");
    }

 }else{
    $_SESSION['errors']=$errors;
    $_SESSION['title']=$title;
    $_SESSION['paragraph']=$paragraph;
    header("location:../add-services.php");
 }


}else{
    header("location:../services.php");
}
?>