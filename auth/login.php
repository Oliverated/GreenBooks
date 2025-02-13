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
    <title>Document</title>
</head>

<body>
    <main>
        <form class="auth-form" action="../includes/login.inc.php" method="POST">
            <h5>Login</h5>

            <div>
                <input type="text" id="email" placeholder="Email..." name="email">
            </div>
            <div>
                <input type="password" id="pwd" placeholder="Password..." name="pwd">
            </div>
            <button id="loginBtn">Login</button>
 
        <p class="orBlock">
          <a href="./sign_up.php">Sign Up</a> 
          <!-- <b>|</b> <a href="#">Forget Password</a> -->
        </p> 

        <?php if (isset($_GET['error'])): ?>
                <p class="auth-err" style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
        </form>


        
    </main>
</body>

</html>