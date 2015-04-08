<?php
if(isset($_POST['loggedOut']))
{
	session_start();
	session_destroy();
	header("location: index.php");
}

?>
<div class="container-fluid">
	<div class="row">
	<div>
		<form method="POST" class="form-signin">
			<button name="loggedOut" class="btn btn-lg btn-primary btn-block" type="submit">Log out</button>
		</form>
	</div>
</div>