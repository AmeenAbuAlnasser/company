<?php
session_start();
require('conection.php');


    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT * FROM services where id=$id";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $admin=mysqli_fetch_assoc($result);
            $img=$admin['icon'];
            unlink("../uplodes/icon/$img");
        $query="DELETE FROM services WHERE id=$id";
        $result=mysqli_query($conn,$query);
        if ($result){
            $_SESSION['succes']="admin deleted succesfully";
            header('location:../services.php');
        }
    }else{
        $_SESSION['errors']="data not found";
        header('location:../services.php');
    }

    }else{
        header('location:../services.php');
    }
    


?>