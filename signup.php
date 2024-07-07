<?php 
    session_start();
    include("./config/config.php");
    if (isset($_SESSION["user_id"])) {
        header("Location: home.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets//favicon-32x32.png">
    <title>Address Book - Sign up</title>
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body style="display: flex;">
    <div class="signup-section sign-widget">
        <h2>Sign up</h2>
        <?php 
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
                $password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
                if(empty($username)){
                    echo "Please enter your name";
                } elseif (empty($password)){
                    echo "Please enter your password";
                } else {
                    $hashPwd=password_hash($password,PASSWORD_DEFAULT);
                    $sql="INSERT INTO users (name,password) VALUES ('$username','$hashPwd')";
                    try{
                        mysqli_query($connect,$sql);
                        echo "<p class='done_msg'>You are registered</p>";
                        $_SESSION["user_id"] = mysqli_insert_id($connect);
                        $_SESSION["user_name"] = $username;
                        header("Location: home.php");
                        exit();
                    } catch(mysqli_sql_exception){
                        echo "<p class='error_msg'>The name is taken</p>";
                    }
                }
            }
            $connect->close();
        ?>
        <form id="registerForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <label>Username</label>
            <input type="text" id="username" name="username" placeholder="Username">
            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
            <p>Do you have an account ? <a href="./index.php">Sign in</a></p>
            <button type="submit">Sign up</button>
        </form>
    </div>
    <!-- <script src="./js/sign.js"></script> -->
</body>
</html>