<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new product!</title>
</head>
<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php

if (isset($_SESSION['success']) && $_SESSION['success'] != ' ') { ?>

    <span style="font-family:cursive;" class="h2 text-info fw-bolder" ><center><?php echo $_SESSION['success'] ; ?></center></span>
    <?php unset($_SESSION['success']);
}

if (isset($_SESSION['failure']) && $_SESSION['failure'] != '') { ?>

    <span class="h2 text-danger fw-bolder" ><center><?php echo $_SESSION['failure'];?></center></span>
    <?php unset($_SESSION['failure']);
} ?>

<script> 
    document.getElementById('regnew').setAttribute('disabled', "");
</script>
<body>

<span style="font-family:cursive;" style="color:#000080" class="h2 fw-bolder" > <center> Register your new product!</center></span>

<form action="back.php" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label>INPUT PRODUCT NAME:</label>
    <input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="uname">
    <input type="text" class="form-control" name="pname" placeholder="Product name" >
</div>
<br>

<div class="form-group">
    <label>INPUT PRODUCT SIZE:</label>
    <input type="text" class="form-control" name="psize" placeholder="Product size" >
</div>
<br>

<div class="form-group">
    <label>INPUT PRODUCT COLOR:</label>
    <br>
    <input type="color" name="pcolor" value="">
</div>
<br>

<div class="form-group">
    <label>INPUT PRODUCT PRICE: (number only) (currency in NGN)</label>
    <input type="number" class="form-control" name="price" placeholder="Product price" >
</div>
<br>

<div class="form-group">
    <label>INPUT IMAGE:</label>
    <br>
    <input type="file" name="pimage" id="file">
</div>
<br>

<button name="regnew" class="btn btn-lg btn-primary">Register</button> 
<a href="index.php"><button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancel</button></a>
</form>
<br>
<?php include 'includes/fandj.php'; ?>
</body>

</html>