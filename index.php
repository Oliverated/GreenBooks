<!DOCTYPE html>
    <html lang="en">
    <a href="./u"></a>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./asset/styles/main.css">
        <title>Books Collection</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Bokor&family=Playwrite+AU+SA:wght@100..400&family=Playwrite+AU+VIC+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sevillana&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap");
            body {
                background-color: rgb(250, 248, 236);

                font-family:  "Roboto", serif;
            }

            .landing-main {
                align-content: center;
                align-items: center;
                height: 100vh;
                padding-left: 3%;
            }

            .intro-block {
                align-content: center;
                border-left: 3px solid var(--secondary);
                padding-left: 2%;
            }

            .intro-block .title {
                font-size: 50px;
                display: block;

            }

            .intro-block .title span {
                color: rgb(241, 228, 141);
            }

            .intro-block .intro-text {
                font-weight: 300;
                
            }

            .btn-block {
                display: flex;
                gap: 3%;
                margin-top: 2%;
            }

            .btn-block a {
                text-decoration: none;
                display: block;
                width: 12%;
                height: 8vh;
                text-align: center;
                align-content: center;
                border-radius: 5px;
            }

            .sign-up {
                background-color: var(--secondary);
                color: var(--text);
            }

            .login {
                border: 2px solid var(--secondary);
                color: var(--secondary);
            }

            @media (max-width:790px) {
                
            .landing-main {
                padding-left: 5%;
            }

            .intro-block {
                padding-left: 5%;
            }

            .intro-block .title {
                font-size: 30px;
            }


            .btn-block {
                display: flex;
                gap: 3%;
                margin-top: 3%;
            }

            .btn-block a {
                width: 25%;
                height: 10vh;
            }

            }

            
            @media (max-width:600px) {
                .intro-block {
                    padding-left: 5%;
                }
    
                .intro-block .title {
                    font-size: 20px;
                }

                .intro-block .intro-text {
            font-size: 18px;
            }
    
                .btn-block {
                    margin-top: 4%;
                }
    
                .btn-block a {
                    width: 35%;
                    height: 6vh;
                }
    
                }
        </style>
    </head>

    <body>

        <main class="landing-main">
            <div class="intro-block">
                <b class="title">Welcome to Green<span>Book!</span> </b>
                <span class="intro-text">
                    Where user can easily browser and download digital book online
                </span>
                <p class="btn-block">
                    <a class="sign-up" href="./auth/sign_up.php">Sign Up</a> <a class="login"
                        href="./auth/login.php">Login</a>
                </p>
            </div>
            <section>


            </section>

        </main>

    </body>

    </html>