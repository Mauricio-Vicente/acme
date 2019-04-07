
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title>ACM - Login page</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
        <title>Acme</title>
    </head>
    <body>
        <header class="top-layer">
            
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>
        <main class="top-layer">

            <form method="post" action="/acme/accounts/">
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<p>' . $_SESSION['message'] . '</p>';
                }
                ?>
                <div class="imgcontainer">
                    <img src="/acme/images/site/avatar.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="clientEmail" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="clientPassword" required>
                    <input type="hidden" name="action" value="login">

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>

                </div>

                <div class="container1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                    <span class="psw"> <a href="/acme/accounts/?action=register">REGISTRATION</a></span>
                </div>
            </form>
        </main>
        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>


    </body>
</html>