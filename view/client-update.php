<?php
if (!$_SESSION['loggedin']) {
    header('Location: /acme/');
}
?>
<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Account Update | Acme Inc.</title>
        <meta name="description" content="Update a current account with ACME Inc.">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/></head>

    <body>

        <header class="top-layer">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>



        <main class="top-layer">
            <br>

            <h1>Update Account</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form  method="post" action="/acme/accounts/">
                <label>First Name</label><input type="text" name="clientFirstname" id="clientFirstname" placeholder="First Name" <?php
                if (isset($clientFirstname)) {
                    echo "value='$clientFirstname'";
                } elseif (isset($clientInfo['clientFirstname'])) {
                    echo "value='$clientInfo[clientFirstname]'";
                }
                ?> required>

                <label>Last Name</label><input type="text" name="clientLastname" id="clientLastname" placeholder="Last Name" <?php
                if (isset($clientLastname)) {
                    echo "value='$clientLastname'";
                } elseif (isset($clientInfo['clientLastname'])) {
                    echo "value='$clientInfo[clientLastname]'";
                }
                ?> required>

                <label>Email</label><input type="text" name="clientEmail" id="clientEmail" placeholder="Email"                <?php
                if (isset($clientEmail)) {
                    echo "value='$clientEmail'";
                } elseif (isset($clientInfo['clientEmail'])) {
                    echo "value='$clientInfo[clientEmail]'";
                }
                ?> required>

                <div>
                    <input type="submit" value="Update Account" class="submitBtn">
                    <input type="hidden" name="action" value="updateClient">

                    <input type="hidden" name="clientId" value="<?php
                    if (isset($clientInfo['clientId'])) {
                        echo $clientInfo['clientId'];
                    } elseif (isset($clientId)) {
                        echo $clientId;
                    }
                    ?>">
                </div>
            </form>

            <h1>Update Password</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form  method="post" action="/acme/accounts/">
                <label>Password</label>
                <p class="password">This will change your password.  Passwords, must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</p>
                <input   type="password" id="clientPassword" name="clientPassword" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                         required>
                <div>
                    <input type="submit" value="Update Password" class="submitBtn">
                    <input type="hidden" name="action" value="updatePass">
                    <input type="hidden" name="clientId" value="<?php
                    if (isset($clientInfo['clientId'])) {
                        echo $clientInfo['clientId'];
                    } elseif (isset($clientId)) {
                        echo $clientId;
                    }
                    ?>">
                </div>
            </form>
        </main>

        <footer class="top-layer">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>


    </body>
</html>