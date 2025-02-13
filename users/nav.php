<?php
session_start();
$sql = "SELECT COUNT(*) AS total_items FROM cart WHERE user_id = $_SESSION[user_id]";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Bokor&family=Playwrite+AU+SA:wght@100..400&family=Playwrite+AU+VIC+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sevillana&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap");


    :root {
      --primary: #f9f0b8;
      --secondary: #4e4a00;
      --oxiliary: #021000b3;
      --accent: red;
      --text: #ffffff;
      --my-font: "Roboto", serif;
    }

    /* nav bar */
    .cover-bg {
      background-color: transparent;
      position: fixed;
      display: none;
    }

    header nav.match {
      box-shadow: 0 0 20px 0 var(--primary);
      background-color: var(--primary);
    }

    header .harm {
      display: none;
    }

    .cancel {
      display: none;
    }

    nav {
      position: fixed;
      width: 100%;
      background-color: var(--secondary);
      height: 10vh;
      border-radius: 0 0 10px 10px;
      z-index: 5;
      padding-bottom: 1%;
      align-content: center;
    }

    li,
    a {
      text-decoration: none;
      list-style: none;
    }

    .nav-menu .logo {
      align-content: center;
    }

    nav .logo a {
      font-size: 25px;
      color: var(--text);
      font-family: var(--my-font);
      align-items: center;
    }

    nav .logo span {
      font-size: 20px;
      font-style: italic;
      color: var(--primary);
    }

    .nav-menu {
      display: flex;
      justify-content: space-between;
      width: 95%;
      margin: auto;
      align-items: center;
      align-content: center;
    }

    .nav-list {
      display: flex;
      gap: 20px;
      align-items: center;
      align-content: center;
    }

    .nav-list a {
      color: var(--text);
      font-size: 15px;
      transition: 500ms;
      position: relative;
      font-style: italic;
      align-items: center;
      align-content: center;
    }

    .nav-list a:hover {
      color: var(--primary);
    }

    .nav-list a::before {
      content: "";
      position: absolute;
      bottom: -1px;
      left: 50%;
      width: 0%;
      height: 1px;
      background-color: var(--primary);
      transform: rotateY(0deg) scaleX(0);
      transition: 1000ms;
    }

    .nav-list a:hover::before {
      left: 0%;
      width: 100%;
      transform: rotateY(200deg) scaleX(1);
    }

    .nav-list li a {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    li a em {
      background-color: var(--accent);
      width: 20px;
      height: 20px;
      border-radius: 50%;
      display: block;
      text-align: center;
      align-content: center;
    }

    .locate {
      border-bottom: 2px solid var(--oxiliary);
      color: var(--primary);
    }



    @media (max-width: 768px) {
      /* nav bar  tab*/

      header {
        padding-bottom: 0;
      }

      header .harm {
        display: block;
        position: fixed;
        right: 15px;
        cursor: pointer;
        font-weight: bolder;
        font-size: 30px;
        z-index: 50;
      }

      .harm.active {
        display: none;
      }

      .cover-bg {
        backdrop-filter: blur(20px);
        background-color: #c9efffa1;
        position: fixed;
        width: 100%;
        height: 100dvh;
        display: block;
        left: 100vw;
        transition: 500ms;
        top: 0;
      }

      .cover-bg.active {
        left: 0vw;
      }

      nav {
        height: 100vh;
        width: 70%;
        align-content: start;
        border-radius: 0 10px 0px 0;
        z-index: 2;
        transition: 1000ms;
        left: -100vw;
        display: block;

      }

      header nav.active {
        left: 0vw;
        display: block;
      }

      nav .logo a {
        font-size: 20px;
      }

      nav .logo span {
        font-size: 15px;
      }

      header .nav-menu {
        display: block;
        margin: 1% 0%;
        padding-left: 5%;
        /* text-align: start; */
      }

      .nav-list {
        display: block;
        text-align: start;
      }

      .nav-list li {
        margin-top: 5%;
      }

      .nav-list a {
        font-size: 15px;
      }


      .nav-list a:hover {
        color: var(--primary);
      }

      .nav-list a::before {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0px;
        width: 0%;
        height: 1px;
        background-color: var(--primary);
        transform: rotateY(0deg) scaleX(0);
        transition: 1000ms;
      }

      .nav-list a:hover::before {
        left: 0%;
        width: 50%;
        transform: rotateY(2deg) scaleX(1);
      }

    }

    /* nav ends tab*/


    @media (max-width: 600px) {

      /* nav bar for phone */
      nav .logo a {
        font-size: 18px;
      }

      nav .logo span {
        font-size: 13px;
      }

      .nav-list li {
        margin-top: 15%;
      }


      .nav-list a {
        font-size: 15px;
      }
    }
  </style>
  <title>Document</title>

</head>

<body>
  <div class="cover-bg"></div>
  <header>
    <span class="harm">&#9776;</span>
    <nav>
      <div class="nav-menu">
        <div class="logo"><a href="#">- Green<span>Books </span> </a> </div>
        <ul class="nav-list">
          <li><a href="home.php">Home</a></li>
          <li><a href="book.php">Books</a></li>
          <li><a href="cart.php">Cart <?php echo "<em> $row[total_items]</em>" ?></a></li>
          <li><a href="order.php">order</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <script>


    let nav_bar = document.querySelector("header nav");
    let harm_btn = document.querySelector(".harm");
    let cover_bg = document.querySelector(".cover-bg");
    let nav_list = document.querySelectorAll(".nav-list a");
    let cancel_btn = document.querySelector(".cancel");

    // for nav

    harm_btn.addEventListener("click", () => {
      nav_bar.classList.toggle("active");
      cover_bg.classList.toggle("active");
      harm_btn.classList.toggle("active");
    });

    cover_bg.addEventListener("click", () => {
      cover_bg.classList.remove("active");
      nav_bar.classList.remove("active");
      harm_btn.classList.remove("active");
    });

    nav_list.forEach((nav_li) => {
      nav_li.addEventListener("click", () => {
        cover_bg.classList.remove("active");
        nav_bar.classList.remove("active");
        harm_btn.classList.remove("active");
      });
    });



  </script>
</body>

</html>