<?php 
require_once("inc/header.php");
session_start();
?>
<?php
require("handel/conection.php");
$query="SELECT * FROM services";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
$services=mysqli_fetch_all($result,MYSQLI_ASSOC);
}
?>

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All services</h3>
                    <a href="add-services.php" class="btn btn-success"> add service</a>
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
                        <th scope="col">title</th>
                        <th scope="col">paragraph</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($services)):
                      foreach ($services as $index=>$service): ?>
                      <tr>
                        <th scope="row"><?= $index+1 ?></th>
                        <td><?php $service['title']; ?></td>
                        <td><?= $service['paragraph']; ?></td>
                        <td>
                          <?php 
                        if($service['status']==1 ){
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
                            <a class="btn btn-sm btn-info" href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handel/delete-services.php?id=<?=$service['id'] ?>">
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
