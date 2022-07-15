<?php
session_start();
require('conection.php');


    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT * FROM admins where id=$id";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $admin=mysqli_fetch_assoc($result);
            $img=$admin['img'];
            unlink("../uplodes/$img");
        $query="DELETE FROM admins WHERE id=$id";
        $result=mysqli_query($conn,$query);
        if ($result){
            $_SESSION['succes']="admin deleted succesfully";
            header('location:../admins.php');
        }
    }else{
        $_SESSION['errors']="data not found";
        header('location:../admins.php');
    }

    }else{
        header('location:../admins.php');
    }
    


?>