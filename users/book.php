<?php
require_once "../includes/db.inc.php";
include_once "nav.php";
?>

<?php
// Pagination settings
$booksPerPage = 8; // Number of books per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startFrom = ($page - 1) * $booksPerPage;

$totalBooksQuery = "SELECT COUNT(*) AS total FROM books";
$totalBooksResult = $conn->query($totalBooksQuery);
$totalBooks = $totalBooksResult->fetch_assoc()['total'];
$totalPages = ceil($totalBooks / $booksPerPage);

$sql = "SELECT * FROM books ORDER BY id DESC LIMIT $startFrom, $booksPerPage";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Collection</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        li, a {
            text-decoration: none;
            list-style: none;
        }

        main {
            padding-top: 8%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .book-menu {
            font-size: 15px;
            width: 250px;
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
            width: 90%;
            height: 150px;
            border-radius: 10px;
            background-color: #f0f0f0;
            object-fit: cover;
            margin: auto;
            margin-bottom: 5%;
        }

        .addToCart {
            display: block;
            width: 80%;
            margin: 15px auto;
            background-color: var(--secondary);
            color: #fff;
            padding: 8px 0;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .addToCart:hover {
            background-color: rgb(95, 109, 6);
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;
        }

        .pagination a {
            text-decoration: none;
            background-color: var(--secondary);
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .pagination a:hover {
            background-color: #777;
        }

        .pagination .active {
            background-color: var(--primary);
            color: var(--secondary);
            font-weight: bold;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            main {
                gap: 15px;
            }

            .book-menu {
                width: 45%;
            }

            .book-img {
                height: 150px;
                width: 90%;
            }
        }

        @media screen and (max-width: 480px) {
            .book-menu {
                width: 100%;
            }

            .book-img {
                height: 130px;
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <main class="book-main">

        <?php
        if ($result->num_rows > 0) {
            while ($book = $result->fetch_assoc()) {
                echo "<div class='book-menu'>  
                    <img class='book-img' src='../asset/images/book-imgs/{$book['image']}' alt='{$book['title']}'> 
                    <li><b> {$book['title']}</b></li>
                    <li>{$book['author']}</li>
                    <li>\${$book['price']}</li>
                    <a class='addToCart' href='../includes/cart.inc.php?id={$book['id']}'>Add to cart</a>
                </div>";
            }
        } else {
            echo "<p style='text-align:center;'>No books available.</p>";
        }
        ?>
    </main>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="?page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages) : ?>
            <a href="?page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

</body>
</html>
