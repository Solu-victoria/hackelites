<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php if (isset($_SESSION['success']) && $_SESSION['success'] != ' ') { ?>

<span style="font-family:cursive;" style="color:brown" class="h2 fw-bolder" ><center><?php echo $_SESSION['success'] ; ?></center></span>
<?php unset($_SESSION['success']); }?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Here are the products</h1>
                    <p class="lead fw-normal text-white-50 mb-0">that you've registered with us! 🤩</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        
        <section class="py-5">
            
            <div class="container px-4 px-lg-5 mt-5">
            
            <?php 
                $uname = $_SESSION['username'];
                $query = "SELECT * FROM $uname ";
                $result = mysqli_query($con, $query); 

                
                if(mysqli_num_rows($result) > 0){

                while ($display = mysqli_fetch_assoc($result)) {
            ?>      
                
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $display['productimage']; ?>" alt="<?php echo $display['productname']; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $display['productname']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $display['price']; ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            }
            ?>
            </div>
        </section>

<?php include 'includes/fandj.php'; ?>