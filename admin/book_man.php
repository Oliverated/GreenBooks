<?php
require_once "../includes/db.inc.php";
error_reporting(E_ALL);
if (isset($_SESSION["Aemail"])) {
    header("location: admin_menu.php");
}
ini_set("display_errors", 1);
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/styles/auth.css">
    <script src="../asset/scripts/main.js"></script>
    <title>Document</title>
    <style>
        body {
            background-color: azure;
        }

        li,
        a {
            list-style: none;
            text-decoration: none;
        }

        section {
            display: flex;
            justify-content: space-evenly;
            padding-top: 3%;
            flex-wrap: wrap;
            margin: 3% 0;
        }

        .book-list {
            display: flex;
            /* flex-wrap: wrap; */
            border: 1px solid;
            width: 45%;
            height: 10vh;
            border-radius: 20px;
            align-items: center;
            gap: 20px;
            justify-content: center;
            /* padding-right: 1% */
            padding: 3% 0;
            margin: 1% auto;
        }

        .book-list li {
            font-size: 15px;
        }

        .book-list li em {
            display: block;
            text-align: start;
            font-weight: 300;
        }

        .book-details {
            font-size: 20px;
            align-content: center;
            display: flex;
            gap: 20px;
        }

        .book-img {
            height: 2rem;
            width: 2rem;
            border-radius: 10px;
        }

        .del-btn {
            background-color: var(--secondary);
            color: var(--primary);
            border-radius: 10px;
            padding: 5% 30%;
        }

        /* edit form */

        .edit-block {
            transition: 500ms;
            top: 6px;
            left: 4vw;
            backdrop-filter: blur(50px);
            width: 20%;
            padding: 1%;
            border-radius: 20px;
            width: 40%;
            text-align: center;
        }

        .edit-block input {
            display: block;
            width: 80%;
            margin: 1% auto;
            border: none;
            border-bottom: 3px solid var(--secondary);
            background-color: transparent;
            outline: none;
            color: #ffeede;
        }

        ::placeholder {
            color: rgba(179, 105, 45, 0.68);
        }

        .edit-block button {
            margin-top: 2%;
            width: 30%;
            border-radius: 10px;
            padding: 1%;
            background-color: transparent;
            border: 3px solid var(--secondary);
            color: var(--text);
        }



        .edit-block.active {
            scale: 1;
        }

        .auth-form {
            margin: 0 auto;
        }

        @media screen and (max-width:760px) {
            section {
                display: block;
            }

            .book-list {
                border: 2px solid;
                width: 95%;
                height: 15vh;
                border-radius: 20px;
                align-items: center;
                gap: 5%;
                justify-content: center;
                padding-right: 1%;
                margin: auto;
                font-size: 20px;
            }

            .book-list li em {
                display: block;
                text-align: start;
                font-weight: 300;
            }

            .book-details {
                font-size: 20px;
                align-content: center;
                justify-content: center;
                display: flex;
                gap: 10px;
            }

            .book-img {
                height: 1.5rem;
                width: 1.5rem;
                border-radius: 10px;
            }

            .del-btn {
                border-radius: 8px;
                padding: 5% 30%;
            }

        }



        @media screen and (max-width:760px) {
            section {
                display: block;
            }

            .book-list {
                border: 2px solid;
                width: 99%;
                height: 15vh;
                border-radius: 20px;
                align-items: center;
                gap: 10px;
                justify-content: center;
                padding-right: 1%;
                margin: auto;
                font-size: 20px;
            }

            .book-list li em {
                display: block;
                text-align: start;
                font-weight: 300;
            }

            .book-details {
                font-size: 20px;
                align-content: center;
                justify-content: center;
                display: flex;
                gap: 10px;
            }

            .book-img {
                height: 1.5rem;
                width: 1.5rem;
                border-radius: 10px;
            }

            .del-btn {
                border-radius: 8px;
                padding: 5% 30%;
            }

        }
    </style>
</head>

<body>

    <!-- INSERT BOOK -->
    <form class="auth-form" action="../includes/book_db.inc.php" method="post" enctype="multipart/form-data">
        <h5>Add Book</h5>
        <div>
            <input type="text" id="" placeholder="Title..." name="title">
        </div>
        <div>
            <input type="text" id="" placeholder="Author..." name="author">
        </div>
        <div>
            <input type="text" id="" placeholder="Price..." name="price">
        </div>

        <input type="file" name="fileToUpload">
        <img src="<?php echo $target_file ?>" alt="">

        <button id="signBtn">Add</button>
        <?php if (isset($_GET['msg'])): ?>
            <p class="auth-err" style="color: red;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['smsg'])): ?>
            <p class="auth-err" style="color: green;"><?php echo htmlspecialchars($_GET['smsg']); ?></p>
        <?php endif; ?>
    </form>


    <section>

        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($book = $result->fetch_assoc()) {

                echo "<ul class='book-list'>           
                <li> <img class='book-img' src='../asset/images/book-imgs/$book[image]' alt=''> </li>
                <div class='book-details'>
                 <li> <em> Title: </em> {$book['title']}</li>
                    <li>  <em> Author: </em>{$book['author']}</li>
                    <li> <em> Price: </em>\${$book['price']}</li>
                              
                </div>
<div class='control-btn'>
    <a class=del-btn href=../includes/delHandler.inc.php?id=$book[id] >Delete</a>
</div>

            </ul>";
                echo "<br>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>

    </section>



</body>

</html>