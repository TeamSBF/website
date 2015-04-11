<?php
    require_once"header.php"; 
?>
  <div class="container">
    <div class="grid_8 alpha">
      <h1>Contact Information</h1>
        <section>
          <p>Telephone:      (509)448-9438</p>
          <p>Toll Free:      1-888-678-9438</p>
          <p>Fax:           (509)448-5078</p>
          <p>Website: <a href="http://www.sitandbefit.org">www.sitandbefit.org</a></p>
          <p>E-mail:<a href="mailto:sitandbefit@sitandbefit.org"> sitandbefit@sitandbefit.org </a></p>
          
        </section>
    </div>
    <div class="grid_4 omega">
      <h1>Login</h1>
      <section>
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <input type="hidden" name="key" value="<?=$_SESSION['regKey'];?>" />
            <div>
                <input type="text" name="email" placeholder="Email Address" />
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" />
            </div>
            <div>
                Need to Register?<a href="registration.html">Register</a>
            </div>
          <div>
            <button type="submit">Login</button>
          </div>
        </form>
    </section>
    </div>
</body>
</html>