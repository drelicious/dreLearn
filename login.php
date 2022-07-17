<?php
session_start();
$servername = "";
$username = "";
$password = "";
$dbname = "";
$message = "";
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submitButton'])){ 
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
    exit;
} else {
    $message = "Invalid email or password";
}
}
?>






<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>dreLearn - Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/login.css">
        <script src="https://kit.fontawesome.com/bc89b66626.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    </head>
    <body>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script>
        function errorpass() {
            Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '<?php echo $message?>',
})
        }
        </script>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="logo">
                            <h1 id="title">dreLearn</h1>
                            <h5>Login</h5>
                        </div>
                        <div class="form">
                            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                                <div class="form-group">
                                    <label for="username" style="margin: 5px 0px">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="password" style="margin: 5px 0px">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <a href="forgot-password.php">Forgot Password?</a>
                                <h6><a href="register.php">Don't have account</a></h6>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary" name="submitButton" style="margin: 15px 0px">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (!$message == "") {
                     echo '<script>errorpass()</script>';   
                    }
                        ?>
                </div>
                <div class="col-md-4"></div>
            </div>
        
        <script src="" async defer></script>
    </body>
</html>