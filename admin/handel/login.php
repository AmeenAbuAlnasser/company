<?php
session_start();
require('conection.php');
if(isset($_POST['login'])){
    $email=htmlspecialchars(trim($_POST['email']));
     $password=htmlspecialchars(trim($_POST['password']));
     $errors=[];
         
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

    if(empty($errors)){
        $sql="SELECT * FROM admins WHERE email='$email'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
          $admin=mysqli_fetch_assoc($query);
          $adminPassword=$admin['password'];
          if(password_verify($password,$adminPassword)){
            $_SESSION['loginId']=$admin['id'];
            header('location:../index.php');
          }else{
            $_SESSION['errors']=["incroect password"];
            header('location:../login.php');
          }
        }else{
          $_SESSION['errors']=["pls check your email"];
          header('location:../login.php');
        }
  
      }else{
        $_SESSION['errors']=$errors;
        header('location:../login.php');
      }


}else{
    header('location: ../login.php');
}


?>