<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <?php
        include 'db.php';
        session_start();
        if(isset($_POST['username']))
        {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($connection, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($connection, $password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='" . md5($password) . "'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $rows = mysqli_num_rows($result);
            if($rows == 1)
            {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
            }
            else
            {
                echo "<div class='form'>
                <h3>Incorrect Username/password.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                </div>";
            }
        }
        else
        {
        ?>
        <form class="form" action=""  method="POST" name="login">
            <h1 class="login-title">Login</h1>
            <input type="text" class="login-input" name="username" placeholder="username" autofocus="true">
            <input type="password" class="login-input" name="password" placeholder="password">
            <input type="submit"class="login-button" value="Login" name="submit">
            <p class="link"><a href="registration.php">New Registration</a></p>

        </form>
        <?php
        }
    ?>
</body>
</html>