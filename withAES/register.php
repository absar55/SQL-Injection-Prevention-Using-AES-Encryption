<?php
require_once "config.php";
require __DIR__ . '/encryption.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    }
    else
    {
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                }
                else
                {
                    $username = trim($_POST["username"]);
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";
    }
    elseif (strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";
    }
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($link, $sql))
        {
            $mode = 'encrypt0172';
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = aes($username, $mode);
            $param_password = aes($password, $mode);
            if (mysqli_stmt_execute($stmt))
            {
                header("location: login.php");
            }
            else
            {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Animated Signup Form</title>
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
			<form action="register.php" method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username" pattern="[A-Za-z0-9\s]{1,15}" title="Don't use Special Characters & max limit is 15 Letters" required autocomplete="name" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input" pattern="[A-Za-z0-9@!_.]{8,15}" title="Don't use Space & Special Characters excpet ( @ ! _ .) & Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autocomplete="password" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
            	   </div>
            	</div>


				<div class="input-div con-pass">
					<div class="i">
						 <i class="fas fa-lock"></i>
					</div>
					<div class="div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						 <h5>Confirm Password</h5>
						 <input type="password" name="confirm_password" pattern="[A-Za-z0-9@!_.]{8,15}" title="Don't use Space & Special Characters excpet ( @ ! _ .) & Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autocomplete="confirm_password" class="input" value="<?php echo $confirm_password; ?>">
                         <span class="help-block"><?php echo $confirm_password_err; ?></span>
				 </div>
			  </div>

				<div class="input-div one">
					<div class="i">
							<i class="fas fa-phone"></i>
					</div>
					<div class="div">
							<h5>Phone Number</h5>
							<input class="input" type="tel" name="phone_number" pattern="[0-9]{11}|0"  title="Like 03123456789" required autocomplete="phone_number"
							id="inputNumber4" />
					</div>
				 </div>

            	
            	<input type="submit" class="btn" value="Login">
				<a href="login.php" style="text-align:center;">Already Have a Account?</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/main.js"></script>
</body>
</html>
