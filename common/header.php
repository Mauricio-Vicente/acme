<a href="http://Localhost/acme/index.php"><img class="logo"  src="/acme/images/site/logo.gif" alt="The site logo"></a>

<div class="folder">
     
        <?php if(isset($cookieFirstname)){
 echo "<span>Welcome $cookieFirstname   &nbsp</span>     ";
} ?>
    <?php
     if (isset($_SESSION['loggedin'])) {
       
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $wm = '<a href="/acme/accounts/index.php?action=admin">Welcome  ';
        $wm .= $clientFirstname;
        $wm .= '      |     </a>';
        echo $wm;
    }
    ?>

    <div class="myaccount">
        <?php
        if (isset($_SESSION['loggedin'])) {
            echo '<a href="/acme/accounts/index.php?action=logout"><p>Logout</p></a>';
        } else {
            echo '<a href="/acme/accounts/index.php?action=login"><img   class="folder" src="/acme/images/site/account.gif" alt="Image of a folder">My Account</a>';
        }
        ?>
    </div>
</div>  
