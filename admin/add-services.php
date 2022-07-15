<?php 
require_once("inc/header.php");
session_start();
?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add service</h3>
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
                        <form method="post" action="handel/add-services.php" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Title</label>
                              <input type="text" class="form-control" name="title" value="<?php if(isset($_SESSION['title'])){echo $_SESSION['title'];}?>">
                            </div>

                          
                            

                            <div class="form-group">
                              <label>paragraph</label>
                              <input type="text" class="form-control" name="paragraph" value="<?php if(isset($_SESSION['paragraph'])){echo $_SESSION['paragraph'];}?>">
                            </div>

                         
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="icon">
                                <label class="custom-file-label" for="customFile">Choose icon</label>
                            </div>
                            <div class="form-group">
                                <label>status</label>
                                <select class="form-control" name="status">
                                  <option value="1">Active</option>
                                  <option value="0">not Active</option>
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