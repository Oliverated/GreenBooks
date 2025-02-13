<?php
require "../includes/db.inc.php";
include_once "nav.php";
$sql = "SELECT * FROM books ORDER BY id DESC LIMIT 4";
$result = $conn->query($sql);
if (!isset($_SESSION["email"])) {
    // header("location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<a href="./u"></a>

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

.book-main {
    padding-top: 8%;
}

section {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    padding: 0 5%;
}

.intro-block {
    padding-left: 8%;
    margin-bottom: 3%;
}

.book-list {
    font-size: 15px;
    width: 22%;
    height: auto;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
    padding-top: .8%;
}

.book-list:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.book-img {
    display: block;
    height: 150px;
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
    background-color: var(--secondary);
    color: #fff;
    padding: 8px 0;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.addToCart:hover {
    background-color: rgb(132, 125, 0);
}

.viewAll {
    text-align: end;
    margin:2% auto;
    padding-right: 8%;
    font-size: 20px;
    border: 2px solid var(--secondary);
    width: 80%;
    border-radius: 10px;
    padding: .8% 2%;
}

.viewAll a{
    color: var(--text);
    background-color: var(--secondary);
    padding: .3% 2%;
    border-radius: 6px;
    font-size: 20px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .book-list {
        width: 30%; /* Adjust width for tablets */
    }
}

@media (max-width: 768px) {
    .book-main {
        padding-top: 2%;
    }

    .intro-block {
        padding-left: 5%;
    }

    .book-list {
        width: 45%; 
        padding-top: 1.5%;
    }
    

    .viewAll {
        text-align: center;
        padding-right: 0;
    }
}

@media (max-width: 480px) {
    .book-main {
        padding-top: 1%;
    }

    .book-list {
        width: 90%; 
        padding-top: 2%;
    }


    .viewAll {
        font-size: 18px;
    }
}

    </style>
</head>

<body>

    <main class="book-main">
        <div class="intro-block">
            <h2>Welcome <?php echo $_SESSION["username"] ?> to GreenBooks </h2>
            <h5>Here are latest books you should check out!</h5>
        </div>
        <section>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($book = $result->fetch_assoc()) {
                    echo "<div class='book-list'>  
                            <img class='book-img' src='../asset/images/book-imgs/{$book['image']}' alt='Book Image'> 
                            <li><b> {$book['title']}</b></li>
                            <li>{$book['author']}</li>
                            <li>\${$book['price']}</li>
                            <a class='addToCart' href='../includes/quickAdd.php?id={$book['id']}'>Add to cart</a>
                        </div>";
                }
            }

            ?>

        </section>
        <p class="viewAll"> <a href="./users/book.php">View all</a> </p>
    </main>

</body>

</html>