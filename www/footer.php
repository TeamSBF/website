    </div>
    <?php if(!$user){?>
    <div class="grid_4 omega">
        <section>
        <h1>Login</h1>
        <?php require_once"login/loginWidget.php";?>
        </section>
    </div>
    <?php } ?>
</body>
</html>
<?php ob_end_flush();?>