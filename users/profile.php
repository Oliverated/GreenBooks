<?php
require_once "../includes/db.inc.php";
include_once "nav.php";
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fullname = htmlspecialchars(trim($_POST['name'] ?? ""));
    $Email = filter_var(trim($_POST['email'] ?? ""), FILTER_SANITIZE_EMAIL);
    $Pwd = trim($_POST['pwd'] ?? "");

    // Hash the password only if a new one is provided
    $hashedPwd = !empty($Pwd) ? password_hash($Pwd, PASSWORD_DEFAULT) : null;

    // Prepare the SQL statement (conditionally update the password)
    if ($hashedPwd) {
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ?, pwd = ? WHERE id = ?");
        $stmt->bind_param("sssi", $Fullname, $Email, $hashedPwd, $_SESSION['user_id']);
    } else {
        // If no new password is provided, update only fullname and email
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $Fullname, $Email, $_SESSION['user_id']);
    }

    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}

    // $stmt->close();
    // $conn->close();
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        li,
        a {
            text-decoration: none;
            list-style: none;
        }

        .profile-main {
            padding-top: 8%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }


        .profile-form {
            background-color: var(--primary);
            width: 20rem;
            height: 10rem;
            padding: 2% 0;
            text-align: center;
            margin: auto;
            border-left: 5px solid #fffdf2;
            margin-top: 3%;
            align-content: center;
            border-radius: 15px;
        }

        .profile-form h5 {
            font-size: 30px;
            color: var(--secondary);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .profile-form input {
            border: none;
            border-bottom: 2px solid var(--secondary);
            background: transparent;
            width: 70%;
            outline: none;
            margin: 2% 0;
        }

        ::placeholder {
            color: var(--oxiliary);
            font-size: 15px;
        }

        .profile-form button {
            width: 50%;
            height: 6vh;
            background-color: var(--secondary);
            border: none;
            color: var(--primary);
            border-radius: 10px;
            font-size: 20px;
            margin-top: 2%;
        }

        .logout-block{
            border: 2px solid ;
          justify-content: space-evenly;
            display: flex;
            align-items: center;
            width: 70%;
            height: 8vh;
            margin:3% auto;
            border-radius: 8px;
        }

        .logoutBtn{
            width: 30%;
            height: 5vh;
            border: 2px solid var(--secondary);
            color:var(--secondary) ;
            border-radius: 5px;
            font-size: 20px;
            display: block;
            align-content: center;
            text-align: center;
        }

        @media screen and (max-width: 760px) {
            
        .profile-main {
            padding-top: 2%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .profile-intro{
            margin-bottom: 0%;
        }

        .profile-intro h2{
            font-size: 25px;
        }

        .profile-intro li{
            font-size: 15px;
        }

        .profile-intro h3{
            font-size: 20px;
            margin-top: 5%;
        }

        .profile-form {
            background-color: var(--primary);
            width: 18rem;
            height: 10rem;
        }

        .profile-form h5 {
            font-size: 25px;
        }


        .profile-form button {
            width: 50%;
            height: 6vh;
            border-radius: 10px;
            font-size: 20px;
            margin-top: 2%;
        }

        .logout-block{
            font-size: 15px;
        }

        .logoutBtn{
            width: 30%;
            height: 4vh;
            font-size: 15px;
        }
        }

        
        @media screen and (max-width: 600px) {
            
            .profile-main {
                padding-top: 2%;
            }
    
            .profile-intro{
                margin-bottom: 0%;
            }
    
            .profile-intro h2{
                font-size: 20px;
            }
    
            .profile-intro li{
                font-size: 13px;
          
            }
    
            .profile-intro h3{
                font-size: 15px;
                margin-top: 5%;
                padding-left: 3%;
            }
    
            .profile-form {
                background-color: var(--primary);
                width: 15rem;
                height: 10rem;
            }
    
            .profile-form h5 {
                font-size: 25px;
            }
    
    
            .profile-form button {
                width: 50%;
                height: 6vh;
                border-radius: 10px;
                font-size: 20px;
                margin-top: 2%;
            }
    
            .logout-block{
                font-size: 15px;
            }
    
            .logoutBtn{
                width: 30%;
                height: 5vh;
                font-size: 15px;
            }
            }
    </style>
</head>

<body>

    <main class="profile-main">
        <?php
        $sql = "SELECT * FROM users WHERE  id = $_SESSION[user_id]";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($info = $result->fetch_assoc()) {
                echo "<section>
              <div class=profile-intro>
                <h2> Welcome to your profile $info[username] 😊 </h2>
                <li> <b> fullname </b> $info[fullname] </li>
                  <li> <b> Email </b> $info[email] </li>
          <h3>Hey $info[fullname] Wanna Make some changes to your profile?</h3>
        </div> 
        
        <form class=profile-form method=post>
            <h5>Edit Profile</h5>
            <input placeholder=Name... type=text name=name value=$info[fullname]>
            <input placeholder=Email.. type=email name=email value=$info[email] >
            <input placeholder=Password... type=password name=pwd >
            <button>Change</button>
        </form>
<p class=logout-block>
<span>Want to Logout?</span>
     <a class=logoutBtn href=../includes/logout.inc.php>Logout</a>   
</p>
    
        </section>";
            }
        }

     
        ?>

    </main>


</body>

</html>