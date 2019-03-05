
<a href="#" class="brand-pic">
 <img src="/acme/images/site/logo.gif" alt="Acme Logo">
</a>
<div class="account-link">
    <?php if(isset($cookieFirstname)){
        echo "<span>Welcome $cookieFirstname</span>";
   } ?>
    <a href="/acme/accounts/?action=login">My Account</a>
</div>
    
    
       
