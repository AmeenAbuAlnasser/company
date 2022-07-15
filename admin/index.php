<?php
 
require_once("inc/header.php");

?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Admins</div>
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-between align-items-center">
                            <h5>
                                <?php
                                require("handel/conection.php");
                                $query="SELECT COUNT(id) as AdminAcount FROM admins";
                                $result=mysqli_query($conn,$query);
                                $adminCount=mysqli_fetch_assoc($result);
                                echo $adminCount['AdminAcount'];
                                ?>
                            </h5>
                          <a href="admins.php" class="btn btn-light">Show</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">services</div>
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-between align-items-center">
                            <h5>
                         <?php
                          require('handel/conection.php');
                          $query="SELECT COUNT(id) as countservices FROM services";
                          $result=mysqli_query($conn,$query);
                        $countServices=mysqli_fetch_assoc($result);
                        echo $countServices['countservices'];
                         ?>

                            </h5>
                          <a href="services.php" class="btn btn-light">Show</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Orders</div>
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-between align-items-center">
                            <h5>1120</h5>
                          <a href="#" class="btn btn-light">Show</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
require_once('inc/footer.php');
?>