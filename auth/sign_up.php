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
        <form class="auth-form" action="../includes/signup.inc.php" method="post">
            <h5>Sign Up</h5>

            <div>
                <input type="text" id="username" placeholder="Username..." name="username">
            </div>
            <div>
                <input type="text" id="name" placeholder="Full Name..." name="name">
            </div>
            <div>
                <input type="text" id="email" placeholder="Email..." name="email">
            </div>
            <div>
                <input type="password" i d="pwd" placeholder="Password..." name="pwd">
            </div>
            <button id="signBtn">Sign Up</button>

            <p class="orBlock">
                <a href="../auth/login.php">Login</a> 
                <!-- <b>|</b> <a href="#">Forget Password</a> -->
            </p>


            <?php if (isset($_GET['error'])): ?>
                <p class="auth-err" style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
        </form>


    </main>
</body>

</html>