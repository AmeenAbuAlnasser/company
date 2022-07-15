<?php 
require_once("inc/header.php");

?>
<?php
require("handel/conection.php");
$query="SELECT * FROM admins";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
$admins=mysqli_fetch_all($result,MYSQLI_ASSOC);
}
?>

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Admins</h3>
                    <a href="add-admin.php" class="btn btn-success"> add admin</a>
                </div>
                <?php
                 if(isset($_SESSION['errors'])):
                  foreach($_SESSION['errors'] as $error):
                    ?>
                    <li class="alert alert-danger"><?php echo $error;?></li>
                  <?php
                endforeach;
                 endif;
                 unset($_SESSION['errors']);
                 
                           if(isset($_SESSION['succes'])):
                         
                            ?>
                            <div class="alert alert-success"><?php echo $_SESSION['succes'];?></div>
                          <?php
                        
                         endif;
                         unset($_SESSION['succes']);
                        ?>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($admins)):
                      foreach ($admins as $index=>$admin): ?>
                      <tr>
                        <th scope="row"><?= $index+1 ?></th>
                        <td><?= $admin['name']; ?></td>
                        <td><?= $admin['email']; ?></td>
                        <td>
                          <?php 
                        if($admin['status']==1 ){
                          ?>
                          <span class="badge badge-success"> <i class="fas fa-check"></i></span>

                          <?php
                         } else{
                          ?>
                          <span class="badge badge-danger"><i class="fas fa-times"></i></span>
                          <?php
                        }
                        ?>
                      
                      </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="update-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/delete-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        
                        </td>
                       
                      </tr>
                      <?php 
                      endforeach;
                  else:
                    ?>

                    <a class="btn btn-sm btn-danger mb-2" href="#">data not found</a>
                    <?php

                  endif;
   mysqli_close($conn);
                      ?>
                    </tbody>
                   
                </table>
            </div>

        </div>
    </div>
   
<?php require_once('inc/footer.php');?>
