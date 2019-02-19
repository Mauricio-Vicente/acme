

/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/style.css" rel="stylesheet" >
        <title>Acme</title>
    </head>
    <body>
        <header>
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>
        <main>
            <form action="action_page.php">
                <div class="imgcontainer">
                    <img src="/acme/images/site/avatar.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                    <span class="psw"> <a href="/acme/accounts/?action=register">REGISTRATION</a></span>
                </div>
            </form>
        </main>
        <?php require '../common/footer.php' ?>
    </body>
</html>