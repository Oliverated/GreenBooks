<?php

require_once "../includes/db.inc.php";
include_once "nav.php";
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
        }

        li,
        a {
            text-decoration: none;
            list-style: none;
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
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 0 1%;
            display: flex;
            gap: 5%;
            border-bottom: 3px solid black;
            align-items: center;
            font-weight: 500;
            justify-content: center;
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



        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .book-main {
                gap: 15px;
            }

            .book-menu {
                width: 55%;
            }

            
        .book-list {
            font-size: 15px;
            width: 80%;
            justify-content: space-evenly;
        }

        }

        @media screen and (max-width: 480px) {
            .book-menu {
                width: 100%;
            }

            .book-list {
            font-size: 12px;
            width: 95%;
            justify-content: space-evenly;
        }
        }
    </style>
</head>

<body>

    <main class="book-main">

        <?php

        $sql = "SELECT * FROM orders  WHERE user_id = $_SESSION[user_id] ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($order = $result->fetch_assoc()) {

                $book_sql = "SELECT * FROM books WHERE id = $order[book_id]";
                $book_result = $conn->query($book_sql);

                while ($book = $book_result->fetch_assoc()) {
                    echo "<div class=book-list>  
                        <li> <em> Title: </em> {$book['title']}</li>
                        <li>  <em> Author: </em>{$book['author']}</li>
                        <li> <em> Price: </em>\${$book['price']}</li>
                        <li> <em> Dated: </em> {$order['created_at']}</li>
                    </div>";

                }
            }

        }

        ?>

    </main>

</body>

</html>