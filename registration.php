<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <?php
    include "db.php";
    if(isset($_REQUEST['username']))
    {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($connection, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($connection, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query = "INSERT into users(username, password, email, create_datetime) ";
        $query .= "Values ('$username',  '" . md5($password) . "', '$email', '$create_datetime')";
        $result = mysqli_query($connection, $query);
        if($result)
        {
            echo "<div class='form'><h3>You are regsterd successfully.</h3><br><p class='link'>Click here to <a href='login.php'>Login</a></p></div>";
        }
        else
        {
            echo "<div class='form'><h3>Required fields are missing.</h3><br><p class='link'>Click here to <a href='registration.php'>registration</a> again.</p></div>";

        } 
    }
    else
    {
    ?>
        <form class="form" action="" method="POST">
            <h1 class="login-title">Registration</h1>
            <input type="text" class="login-input" name="username" placeholder="username" required>
            <input type="text" class="login-input" name="email" placeholder="email adress" required>
            <input type="password" class="login-input" name="password" placeholder="password" required>
            <input type="submit" class="login-button" name="submit" value="Register">
            <p class="link"><a href="login.php">Click to Login</a></p>
        </form>
    <?php
    }
    ?>
</body>
</html>