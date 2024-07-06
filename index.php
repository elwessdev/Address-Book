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
    <title>Address Book - Sign in</title>
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body style="display: flex;">
    <div class="login-section sign-widget">
        <h2>Sign in</h2>
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['username'], $_POST['password'])) {
                    function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $username = validate($_POST['username']);
                    $password = validate($_POST['password']);
                    if (empty($username)) {
                        echo "<p class='error_msg'>Username is required</p>";
                    } else if (empty($password)) {
                        echo "<p class='error_msg'>Password is required</p>";
                    } else {
                        // Use prepared statements to prevent SQL injection
                        $stmt = $connect->prepare("SELECT id, password FROM users WHERE name = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $stmt->store_result();
                        // Check if any rows were returned
                        if ($stmt->num_rows==1) {
                            $stmt->bind_result($id, $pwd);
                            $stmt->fetch();
                            // Verify the password
                            if (password_verify($password, $pwd)) {
                                echo "<p class='done_msg'>Logged in!</p>";
                                $_SESSION["user_id"] = $id;
                                header("Location: home.php");
                                exit();
                            } else {
                                echo "<p class='error_msg'>Incorrect username or password</p>";
                            }
                        } else {
                            echo "<p class='error_msg'>Incorrect username or password</p>";
                        }
                        $stmt->close();
                    }
                } else {
                    echo "<p class='error_msg'>Please fill username and password fields!</p>";
                }
            }
        ?>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <label>Username</label>
            <input type="text" name="username" placeholder="Username">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password">
            <p>Did you not have account ? <a href="./signup.php">Sign up</a></p>
            <button type="submit">Sign in</button>
        </form>
    </div>
    <!-- <script src="./js/sign.js"></script> -->
</body>
</html>