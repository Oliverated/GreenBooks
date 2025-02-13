<?php
session_start();
if (!isset($_SESSION["Aemail"])) {
    header("location: admin_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        main {
            margin: auto;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

.menu-header{
    text-align: center;
}

.menu-header span{
    color: red;
}

        .sector {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            gap: 8%;
            width: 90%;
            height: 15vh;
            background-color: transparent;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 3% auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 0 1%;
            border: 1px solid var(--secondary);
            align-items: center;
            font-weight: 500;
            justify-content: center;
            border-radius: 20px;
        }

        .sector p {
            font-size: 30px;
            font-weight: bold;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .sector div {
            display: flex;
            width: 100%;
            align-items: center;
            gap: 5%;
            font-size: 20px;
        }

        .sector a {
            display: block;
            width: 30%;
            border: 2px solid rgb(255, 0, 0);

            color: rgb(255, 0, 0);
            padding: 8px 0;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        @media (max-width:600px) {
            .sector {

                width: 98%;
                height: 20vh;
                background-color: transparent;
                border-radius: 5px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin: 3% auto;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                text-align: center;
                padding: 0 1%;
                border: 1px solid var(--secondary);
                align-items: center;
                font-weight: 500;
                justify-content: center;
            }

            .sector p {
                font-size: 15px;
                font-weight: bold;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            }

            .sector div {
                display: flex;
                width: 100%;
                align-items: center;
                gap: 5%;
                font-size: 14px;
            }

            .sector a {
                display: block;
                width: 15%;
                padding: 5px 0;
                transition: background-color 0.3s ease;
                font-size: 15px;
                width: 50%;
            }
        }
    </style>

    <title>Document</title>
</head>

<body>
    <main>

    <h2 class="menu-header">Welcome <span><?php echo $_SESSION["Aemail"] ?></span> </h2>
        <section class="sector">
            <div>
                <p>Manage Book</p>
                <span>This is the page where you can add and delete books</span>
            </div>
            <a href="book_man.php">Manage Books</a>
        </section>
        <section class="sector">
            <div>
                <p>Manage User</p>
                <span>View all registered users</span>
            </div>
            <a href="man_users.php">Manage Users</a>
        </section>
        <section class="sector">
            <div>
                <p>Manage Order</p>
                <span>View all order and change order status</span>
            </div>
            <a href="man_orders.php">Manage Orders</a>
        </section>
        <section class="sector">
            <div>
                <p>Logout</p>
                <span>Logout of Admin Page</span>
            </div>
            <a href="admin_logout.php">Logout</a>
        </section>
    </main>
</body>

</html>