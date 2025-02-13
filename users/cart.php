<?php
require_once "../includes/db.inc.php";
include "nav.php";
$sql= "SELECT * FROM cart WHERE user_id = $_SESSION[user_id]";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<!-- <a href="./u"></a> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Collection</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        li,
        a {
            text-decoration: none;
            list-style: none;
        }

        main {
            padding-top: 8%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }



        .book-menu {
            font-size: 15px;
            width: 30%;
            height: auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding-top: 1%;
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
            margin-bottom: 15px;
            object-fit: cover;
            margin: auto;
            margin-bottom: 5%;
        }

        .addToCart {
            display: block;
            width: 80%;
            margin: 15px auto;
            background-color:rgb(255, 0, 0);
            color: #fff;
            padding: 8px 0;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            transition: background-color 0.3s ease;
        }

        .addOrder{
            display: block;
            width: 80%;
            margin: 15px auto;
            background-color: var(--secondary);
            color: #fff;
            padding: 8px 0;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            transition: background-color 0.3s ease;
        }

        .addToCart:hover {
            background-color:rgb(255, 78, 78);
        }

        .cart-btn{
            display: flex;
            width: 80%;
            gap: 10px;
            margin: auto;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
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
        }
    </style>
</head>

<body>

    <main class="book-main">

        <?php

while ($book = $result->fetch_assoc()) {
    $cart_id = $book['id'];
    $book_id = intval($book['book_id']);  

    // Check if book_id is valid before executing the query
    if ($book_id > 0) {
        $sql2 = "SELECT * FROM books  WHERE  id = $book_id";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while ($book2 = $result2->fetch_assoc()) {
                echo "<div class='book-menu'>  
                        <img class='book-img' src='../asset/images/book-imgs/{$book2['image']}' alt='Book Image'> 
                        <li><strong>{$book2['title']}</strong></li>
                        <li>Author: {$book2['author']}</li>
                        <li>Price: \${$book2['price']}</li>
                        <li class='cart-btn'> 
                            <a class='addOrder' href='../includes/order.inc.php?id={$book2['id']}'>Order</a> 
                            <a class='addToCart' href=../includes/delCart.inc.php?id=$cart_id>Remove</a> 
                
                        </li>
                    </div>";

            }
        } else {
            echo "<p>No book found for order ID: {$book['book_id']}</p>";
        }
    } else {
        echo "<p>Invalid book ID: {$book['book_id']}</p>";
    }
}


        ?>

    </main>

</body>

</html>



<?php

?>