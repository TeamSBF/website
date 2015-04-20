    </div>
    <?php if(!$user){?>
    <div class="grid_4 omega">
      <div class="background">
            <h1>Login</h1>
	  <?php require_once"login/loginWidget.php";?>
	  </div>
	</div>
    <?php } ?>
</body>
</html>
<?php ob_end_flush();?>
