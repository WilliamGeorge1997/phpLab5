<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div class="w-50 m-auto mt-5">
    <form action="<?php $_PHP_SELF ?>" method="POST">

    
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <hr>
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php if(!empty($_POST["name"]) && !empty($_POST["password"])   ){
                                echo "";
                            }elseif(isset($_POST["submit"])){
                                if(isset($_POST["username"]))
                            {
                               if(!empty($_POST["username"])){
                                echo $_POST["username"];
                               }
                            }
                            } ?>">

                <?php  
if(isset($_POST["submit"])){
    if(empty($_POST["username"]))
{
    echo "<p class='text-danger'>* Username is required.</p>";
}
}
?>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3">

                <?php  
if(isset($_POST["submit"])){
    if(empty($_POST["password"]))
{
    echo "<p class='text-danger'>* Password is required.</p>";
}
}
?>
                <input class="btn btn-primary" type="submit" name="submit" value="Login">
                <p class="mt-3">Don't have an account? <a href="signup.php" class="text-decoration-none">Sign up now.</a></p>

             
            </form>
    </div>

    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST["submit"]) && !empty($_POST["username"]) && !empty($_POST["password"])){

$username = $_POST["username"];
$password = $_POST["password"];
include 'config.php';
$sql = "SELECT username, password 
        FROM users
        WHERE username = '$username';";

mysqli_select_db($conn,$dbname);
$result = mysqli_query($conn,$sql); // Info about data


if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result); //Row data
    if($row["username"] == $username ){ //Username check
        if($row["password"] == $password){ //Password check
            session_start();
            print_r($_SESSION);
            $_SESSION["login"] = true; //Put login in session
            $_SESSION["username"] = $username; //Put username in session 
            header("Location: index.php");
            
        }else{
            echo "<p class='text-danger text-center'>Wrong password, Please enter correct password.</p>";
        }
    }
}else{
    echo "<p class='text-danger text-center'>Wrong username, Please enter correct username.</p>";

}
mysqli_close($conn);
}

?>
