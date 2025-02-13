<?php
require_once "../includes/db.inc.php";
include_once "nav.php";
$sql = "SELECT * FROM orders WHERE user_id = $_SESSION[user_id] ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Collection</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            /* display: flex; */
        }

        li,
        a {
            text-decoration: none;
            list-style: none;
            /* background-color: aqua; */
        }

        .book-main {
            padding-top: 8%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }



        .book-list {
            font-size: 15px;
            width: 50%;
            height: 10vh;
            background-color: transparent;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* overflow: hidden; */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 0 1%;
            display: flex;
            gap: 5%;
            border: 1px solid var(--secondary);
            align-items: center;
            font-weight: 500;
            justify-content: center;
            /* display: ; */
        }

        .book-list li em {
            display: block;
            text-align: start;
            font-weight: 300;
        }

        .book-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .book-img {
            display: block;
            height: 180px;
            width: 90%;
            border-radius: 10px;
            background-color: #f0f0f0;
            margin-bottom: 15px;
            object-fit: cover;
            margin: auto;
            margin-bottom: 5%;
        }

        .addToCart {
            display: block;
            width: 80%;
            margin: 15px auto;
            background-color: rgb(255, 0, 0);
            color: #fff;
            padding: 8px 0;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            transition: background-color 0.3s ease;
        }

        .addOrder {
            display: block;
            width: 80%;
            margin: 15px auto;
            background-color: rgb(0, 106, 255);
            color: #fff;
            padding: 8px 0;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            transition: background-color 0.3s ease;
        }

        .addToCart:hover {
            background-color: rgb(255, 78, 78);
        }

        .cart-btn {
            display: flex;
            width: 80%;
            gap: 10px;
            margin: auto;
        }

        .cancel {
            width: 20%;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Responsive Design */
        /* @media screen and (max-width: 768px) {
            .book-main {
                gap: 15px;
            }

            .book-menu {
                width: 45%;
            }

            .book-img {
                height: 150px;
                width: 150px;
            }
        }

        @media screen and (max-width: 480px) {
            .book-menu {
                width: 100%;
            }

            .book-img {
                height: 130px;
                width: 130px;
            }
        } */
    </style>
</head>

<body>

    <main class="book-main">

        <?php

        if ($result->num_rows > 0) {
            while ($order = $result->fetch_assoc()) {

                $book_sql = "SELECT * FROM books WHERE id = $order[book_id]";
                $book_result = $conn->query($book_sql);

                while ($book = $book_result->fetch_assoc()) {
                    echo "<div class=book-list>  
                    <li> <em> Title: </em> {$book['title']}</li>
                    <li>  <em> Author: </em>{$book['author']}</li>
                    <li> <em> Price: </em>\${$book['price']}</li>
                    <li> <em> Status: </em> {$order['status1']}</li>
                    <button class=cancel>Cancel</button>
                    </div>";
                }
            }

        }

        ?>
    </main>

</body>

</html>