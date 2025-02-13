<?php
session_start();
require_once "../includes/db.inc.php";
if( isset($_SESSION["Aemail"]) ){
    header("location: admin_menu.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/styles/auth.css">
    <style>
        .auth-form{
            margin: 10% auto;
        }

        .auth-form .erro{
            color: red;
            font-size: 20px;
            margin-top: 5%;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <main>
        <form class="auth-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h5>Admin Login</h5>

            <div>
                <input type="text" id="email" placeholder="Email..." name="email">
            </div>
            <div>
                <input type="password" id="pwd" placeholder="Password..." name="pwd">
            </div>
            <button id="loginBtn">Login</button>
 
        <?php
$admin_email = "admin@oliver";
$admin_pwd = "pwd123";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $Email = strtolower(htmlspecialchars(trim($_POST['email'])));
    $Pwd = htmlspecialchars(trim($_POST['pwd']));

        // Verify password
        if ($Email == $admin_email && $Pwd == $admin_pwd) {
            $_SESSION["Aemail"] = $Email;
            header("location: admin_menu.php");
        } else if (empty($Email)  && empty($Pwd) ) {
      echo "<p class=erro> Please enter a value </p>";
        } else {
            echo "<p class=erro>Wrong Email or Password!</p>";
        }
    }

?>

        </form>


        
    </main>
 <script>
        let name = document.getElementById("name")
        let username = document.getElementById("username")
        let email = document.getElementById("email")
        let pwd = document.getElementById("pwd")
        let signBtn = document.getElementById("signBtn")
        let err_msg = document.getElementById("error")

        signBtn.addEventListener("click", (e) => {
            e.preventDefault()
            if (name === "") {
                err_msg.innerHTML = "Please enter your full name"
            } else if (username == "") {
                err_msg.innerHTML = "Please enter your username"
            } else if (email.value == "") {
                err_msg.innerHTML = "Please enter your email"
            } else if (pwd.value == "") {
                err_msg.innerHTML = "Please enter your password"
            } 
        })



    </script>

</body>

</html>