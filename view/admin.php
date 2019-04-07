<?php
if (!$_SESSION['loggedin']) {
    header('Location: /acme/');
}
?>
<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Administration Page for ACME Inc.">
        <title>Template - ACME, Inc.</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>

    </head>

    <body>

        <header class="top-layer">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> 
        </header>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main class="top-layer">  
            <h1>Admin View</h1>

            <h1>
                <?php if (isset($clientData)) {
                    echo $clientData['clientFirstname'];
                } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                    echo $_SESSION['clientData']['clientFirstname'];
                } ?>
            </h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <ul id="user_data">
                <li>ID number:
<?php if (isset($clientData)) {
    echo $clientData['clientId'];
} elseif (isset($_SESSION['clientData']['clientId'])) {
    echo $_SESSION['clientData']['clientId'];
} ?>
                </li>
                <li>First name:
<?php if (isset($clientData)) {
    echo $clientData['clientFirstname'];
} elseif (isset($_SESSION['clientData']['clientFirstname'])) {
    echo $_SESSION['clientData']['clientFirstname'];
} ?>
                </li>
                <li>Last name:
            <?php if (isset($clientData)) {
                echo $clientData['clientLastname'];
            } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                echo $_SESSION['clientData']['clientLastname'];
            } ?>
                </li>
                <li>Email address:
<?php if (isset($clientData)) {
    echo $clientData['clientEmail'];
} elseif (isset($_SESSION['clientData']['clientEmail'])) {
    echo $_SESSION['clientData']['clientEmail'];
} ?>
                </li>
            </ul>

<?php
if ($_SESSION['clientData']['clientLevel'] > 1) {
    echo '<p>Use the following link to manage products</p>';
    echo '<p><a href="../products/">Product Management</a></p>';
}
echo '<p><a href="../accounts?action=update">Update Account</a></p>';
?>
        </main>

        <footer class="top-layer">
            <hr>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>

    </body>
</html>