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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>