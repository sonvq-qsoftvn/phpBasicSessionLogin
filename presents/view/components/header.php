<?php if(isset($_SESSION['user']['role']) && isset($_SESSION['user']['email'])) : ?>
<div>
    <p style="display:inline-block">        
        Welcome <?php echo $_SESSION['user']['role'] . ', <b>' . $_SESSION['user']['email'] . "</b>"; ?>
    </p>
    <p style="display:inline-block">
        (<a style="text-decoration: none;" href="login.php?action=logout">Logout</a>)
    </p>
</div>
<?php endif; ?>