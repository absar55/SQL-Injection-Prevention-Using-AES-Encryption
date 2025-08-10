<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: welcome.php");
    exit;
}

require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    // Validate
    if (empty($username_err) && empty($password_err))
    {
        $sql = "SELECT id, username FROM users WHERE username = '$username' and password = md5('$password')";
        // $sql = "SELECT id, username FROM users WHERE username = '$username' and password = '$password' ";

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            header("location: welcome.php");
        }
        else
        {
            $password_err = "The password you entered was not valid.";
        }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="login.php <?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
                          <h5>Username</h5>
                          <input type="text" name="username" pattern="[A-Za-z0-9\s]{1,15}" title="Don't use Special Characters & max limit is 15 Letters" required autocomplete="name" class="input" value="<?php echo $username; ?>">
                          <span class="help-block"><?php echo $username_err; ?></span>
           		   </div>
           		</div>
           		<div class="input-div pass <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" pattern="[A-Za-z0-9@!_.]{8,15}" title="Don't use Space & Special Characters excpet ( @ ! _ .) & Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autocomplete="password" class="input" >
                        <span class="help-block"><?php echo $password_err; ?></span>
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
				<a href="register.php" style="text-align:center;">New Member?</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/main.js"></script>
</body>
</html>
