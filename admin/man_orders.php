<?php
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
<link rel="stylesheet" href="../asset/styles/main.css">
    <title>order admin</title>
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

        .book-main {
            padding-top: 2%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .book-list {
            display: flex;
            font-size: 15px;
            width: 80%;
            height: 15vh;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
           justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            font-weight: 500;
          justify-content: space-evenly;
          border-radius: 20px;
        }

        .book-list li {
            list-style: none;
            margin: 5px 0;
            /* display: flex; */
        }

        .book-list li em {
            display: block;
            font-weight: 300;
        }

        .book-list:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        select,
        button {
            margin-top: 10px;
            padding: 5px;
            font-size: 14px;
        }

        button {
            background-color: var(--secondary);
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color:rgb(100, 95, 0);
        }



        @media (max-width:600px) {
            .book-main {
            gap: 20px;
        }

        .book-list {
            font-size: 15px;
            width: 98%;
            height: 15vh;
            border-radius: 5px;
           justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            font-weight: 500;
          justify-content: space-evenly;
        }


        select,
        button {
            margin-top: 10px;
            padding: 3px;
            font-size: 14px;
        }

        button {
            padding: 5px 8px;
        }
        }
    </style>
</head>

<body>



    <?php
    // Handle form submission to update order status
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
        $orderId = intval($_POST['order_id']);
        $newStatus = htmlspecialchars($_POST['statusHandler']);

        // Update the order status in the database
        $stmt = $conn->prepare("UPDATE orders SET status1 = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $orderId);
        $stmt->execute();


        $stmt->close();
    }

    // Fetch orders and associated books
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);
    ?>
    <main class="book-main">
    <?php

    if ($result->num_rows > 0) {
        while ($order = $result->fetch_assoc()) {
            $book_sql = "SELECT * FROM books WHERE id = " . intval($order['book_id']);
            $book_result = $conn->query($book_sql);

            while ($book = $book_result->fetch_assoc()) {
                echo "<form method='post' class=book-list>  
                        <li> <em>Title:</em> {$book['title']}</li>
                        <li> <em>Author:</em> {$book['author']}</li>
                        <li> <em>Price:</em> \${$book['price']}</li>
                        <li> <em>Status:</em> {$order['status1']}</li>

                            <input type='hidden' name='order_id' value='{$order['id']}'>
                            <select name='statusHandler'>
                                <option value='Pending' " . ($order['status1'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                <option value='Shipped' " . ($order['status1'] == 'Shipped' ? 'selected' : '') . ">Shipped</option>
                                <option value='Delivered' " . ($order['status1'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                                <option value='Cancel' " . ($order['status1'] == 'Cancel' ? 'selected' : '') . ">Cancel</option>
                            </select>
                            <button type='submit'>Update Status</button>
                        </form>";
            }
        }
    } else {
        echo "<p style='text-align:center; color:red;'>No orders found.</p>";
    }
    ?>

    </main>

</body>

</html>