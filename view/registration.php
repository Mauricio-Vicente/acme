<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACM - Register</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="content">
        <?php require '../common/header.php'; ?>

        <main>
        <h1>User Registration</h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form method="post" action="<?php echo $basepath ?>/accounts/index.php" id="registrationform">
                <fieldset>
                    <div>
                        <input class="requiredinvalid" id="clientFirstname" name="clientFirstname"
                        type="text" required placeholder="First Name" tabindex="1"
                        title="Enter your First Name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> />
                        <label for="clientFirstname">First Name</label>
                    </div>
                    <div>
                        <input class="requiredinvalid" id="clientLastname" name="clientLastname"
                        type="text" required placeholder="Last Name" tabindex="2"
                        title="Enter your Last Name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>/>
                        <label for="clientLastname">Last Name</label>
                    </div>
                    <div>
                        <input class="requiredinvalid" id="clientEmail" name="clientEmail"
                        type="email" required placeholder="email@address.com" 
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" tabindex="3" 
                        title="E-mail address must be a valid e-mail address format." <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>/>
                        <label for="clientEmail">e-Mail Address</label>
                    </div>
                    <div>
                        <input class="requiredinvalid" id="clientPassword" name="clientPassword"
                        type="password" required tabindex="4" 
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W+)(?=^.{8,12}$).*$"
                        title="Passwords must be between 8 and 12 characters and contain at least 1 number, 1 lower casse, 1 capital letter and 1 special character."/>
                        <label for="clientPassword">Password</label>
                    </div>
                </fieldset>

                <input type="submit" name="submit" value="Register">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="Register">
                
            </form>
        </main>
    <?php require "../common/footer.php" ?>
    </body>
</html>
