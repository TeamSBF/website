<?php require_once"header.php";?>
  	<div class="container">
  		<div class="row">
			<div class ="col-sm-4">
<?php

if (isset($_SESSION['user_id'])) 
{
	require_once('login/logout.php');
}
else
{
	require_once('login/login.php');
}

?>
		</div>
	</div>
</div>
