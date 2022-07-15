<?php 
require_once("inc/header.php");
session_start();

require("handel/conection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $admin="SELECT * FROM admins where id=$id";
    $query=mysqli_query($conn,$admin);
    $admin=mysqli_fetch_assoc($query);
}   
?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">UPDATE ADMIN</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <ul class="list-unstyled">
                        <?php
                           if(isset($_SESSION['errors'])):
                          foreach($_SESSION['errors'] as $error):
                            ?>
                            <li class="alert alert-danger"><?php echo $error;?></li>
                          <?php
                        endforeach;
                         endif;
                         unset($_SESSION['errors']);
                        ?>
                        </ul>
                        <form method="post" action="handel/update-admin.php" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $id ?>" name="id">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name" value="<?= 
                              $admin['name'];
                              ?>">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= 
                           
                               $admin['email'];
                              ?>">
                            </div>

                           
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="img">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            <div class="img-group">
                                <img class="w-100 my-4" src="uplodes/<?= $admin['img']?>" alt="">
                    
                            </div>
                            <div class="form-group">
                                <label>status</label>
                                <select class="form-control" name="status">
                                  <option value="1" <?php
                                  $query="SELECT status FROM admins where id=$id";
                                  $result=mysqli_query($conn,$query);
                                   $admin=mysqli_fetch_assoc($result);
                                   if($admin['status']==1)
                                   echo 'selected';
                                  ?>
                                  >Active</option>
                                  <option value="0" <?php
                                  $query="SELECT status FROM admins where id=$id";
                                  $result=mysqli_query($conn,$query);
                                   $admin=mysqli_fetch_assoc($result);
                                   if($admin['status']==0)
                                   echo 'selected';
                                  ?>>not Active</option>
                                </select>
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
require_once('inc/footer.php');
?>