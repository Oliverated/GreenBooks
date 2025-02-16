<?php

session_start();
// the guard
if (isset($_SESSION["email"])) {
    header("location: ../users/home.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/styles/auth.css">
    <title>Forget Password</title>
</head>

<body>
    <main>
        <form class="auth-form" action="mail.php" method="POST">
            <h5>Forget Password</h5>

            <div>
                <input type="text" id="email" placeholder="Email..." name="email">
            </div>
            <button id="loginBtn">Send Code</button>
 
        <p class="orBlock">
          <a href="./sign_up.php">Sign Up</a> 
          <b>||</b>
          <a href="./login.php">Login</a> 
        </p> 

        <?php if (isset($_GET['error'])): ?>
                <p class="auth-err" style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
        </form>


        
    </main>
</body>

</html>