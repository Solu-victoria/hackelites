<?php
    include 'includes/db.php';

    /* login section*/
$logName ='';

if (isset($_POST['log-btn'])) {
    echo 'mama';
    
    $logName = strtolower($_POST['log-name']);
    $logPass = $_POST['log-pass'];

    if ($logName && $logPass != "") {
        $sql = "SELECT * FROM customers WHERE Name='$logName' AND Password='$logPass'";
        $result = mysqli_query($con,$sql);
        $exist = mysqli_num_rows($result);
        
        if ($exist > 0) { 
            $_SESSION['username'] = $logName;
            $_SESSION['success'] = "Welcome to your dashboard user $logName 😍😍";
            header('location:index.php');
        }else {
            $_SESSION['failure'] = 'Incorrect username/password! Try again!';
            header('location:Login.php');
        }  
    }else {
        $_SESSION['failure'] = 'Pls  make all inputs before submitting!';
        header('location:Login.php');
    }

}

/*regnew btn */
// if (isset($_POST['regbtn'])) {
//     $uname = $_POST['uname'];
//     header('location:registernew.php');

/*register product section */
if (isset($_POST['regnew'])) {
    $uname = $_POST['uname'];
    $pname = $_POST['pname'];
    $pcolor = $_POST['pcolor'];
    $price = $_POST['price'];

    $fileName = $_FILES['pimage']['name'];
    $type = $_FILES['pimage']['type'];
    $temp = $_FILES['pimage']['tmp_name'];
    $size = $_FILES['pimage']['size'];
    $error = $_FILES['pimage']['error'];

  
    if ($pname && $pcolor && $price != "") {
       
        $fileExt = explode('.', $fileName);

        $fileActual = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActual,$allowed)){

            if ($size <= 3000000) {

                if($error === 0){
                    $uniq = uniqid('', true) . '.' . $fileActual;

                    $fileDest = "uploads/" . $uniq;

                    $_SESSION['image'] = $fileDest;

                    move_uploaded_file($temp,$fileDest);

                    $sql = "CREATE TABLE IF NOT EXISTS $uname (
                        id INT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        productname VARCHAR(30) NOT NULL,
                        productcolor VARCHAR(30) NOT NULL,
                        price VARCHAR(30),
                        productimage VARCHAR(30)
                        )";
                    
                    $result = mysqli_query($con,$sql);
                                    
                    if ($result){
                        $sql = " INSERT INTO $uname ( productname, productcolor, price, productimage) VALUES ('$pname','$pcolor','$price','$fileDest') ";
                        $result = mysqli_query($con,$sql);

                        if ($result){
                            $_SESSION['success'] = "You have successfully registered a new product!😍✔";
                            header('location:index.php');

                        }else{
                            $_SESSION['failure'] = 'Failure in registering product!!';
                            header('location:Registernew.php');
                            //  print('failed'. mysqli_error($sql));
                        }


                    }else{
                        $_SESSION['failure'] = 'Failure in creating a table for your product! Try again!!';
                        // header('location:Registernew.php');
                    }

                }else {
                    $_SESSION['failure'] = 'There is ERROR!';
                    header('location:Registernew.php');
                }

            }else {
                $_SESSION['failure'] = 'Size limit is 3mb!! Upload smaller image';
                header('location:Registernew.php');
            }
        }else {
            
            $_SESSION['failure'] = 'Try again!' .'<br>'. 'Image version not allowed (upload only .jpg, .jpeg and .png images)' . '<br>'. '/Input an image before submitting!!';
            header('location:Registernew.php');
        }
    }else{
        echo $pcolor;
        $_SESSION['failure'] = 'Pls  make all inputs before submitting!';
        header('location:Registernew.php');
    }  

}
// }

/* logout section*/
if(isset($_POST['logout-btn'])){

    header('location:login.php');
    session_destroy();
    unset($_SESSION['username']);
    
}
?>