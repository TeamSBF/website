<html>

    <a href="login.php">Log In</a>
<?php
require(__DIR__.'\..\Controller\SbfController.php');

	echo "<h1>Register</h1>";


	//all the fields here
	$firstname = strip_tags((isset($_POST['firstname']) ? $_POST['firstname'] : null));
	$lastname = strip_tags((isset($_POST['lastname']) ? $_POST['lastname'] : null));
	$gender = (isset($_POST['gender']) ? $_POST['gender'] : null);
	$dobMonth = strip_tags((isset($_POST['DOBMonth']) ? $_POST['DOBMonth'] : null));
	$dobDay = strip_tags((isset($_POST['DOBDay']) ? $_POST['DOBDay'] : null));
	$dobYear = strip_tags((isset($_POST['DOBYear']) ? $_POST['DOBYear'] : null));
	$email = strip_tags((isset($_POST['email']) ? $_POST['email'] : null));
	$emailRe = strip_tags((isset($_POST['emailr']) ? $_POST['emailr'] : null));
	$username = strip_tags((isset($_POST['username']) ? $_POST['username'] : null));
	$password = strip_tags((isset($_POST['pwd']) ? $_POST['pwd'] : null));
	$passwordRe = strip_tags((isset($_POST['pwdr']) ? $_POST['pwdr'] : null));
	$agreeTerms = strip_tags((isset($_POST['agreeTerms']) ? $_POST['agreeTerms'] : null));
	$register = (isset($_POST['register']) ? $_POST['register'] : null);
	$signIn = (isset($_POST['signIn']) ? $_POST['signIn'] : null);
	$dob = $dobYear."-".$dobMonth."-".$dobDay;  //push together YYYY-MM-DD

	//if user hit register
	if($register)
	{
		//data scrubbing here
		if($firstname && $lastname && $gender && $dobMonth && $dobDay && $dobYear && $email && $emailRe && $username && $password && $passwordRe && $agreeTerms)
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
     			echo "email can't be empty<br>";
			}
			else if($email !== $emailRe)
			{
				echo "email does not match<br>";
			}
			
			else if($password !== $passwordRe)
			{
				echo "password does not match, try again! <br>";
			}
			else // registration success
			{
				echo "Registration successful!<br>";
				//adding data to the array
				$userdata["email"] = $email;
				$userdata["lastName"] = $lastname;
				$userdata["firstName"] = $firstname;
				$userdata["userName"] = $username;
				$userdata["gender"] = $gender;
				$userdata["dob"] = $dob;
				$userdata["password"] = $password;
				$userdata["agreedTerms"] = $agreeTerms;


				/*echo "printing from array <br>";
				echo $userdata["email"];
				echo "<br>";
				echo $userdata["lastName"];
				echo "<br>";
				echo $userdata["firstName"];
				echo "<br>";
				echo $userdata["userName"];
				echo "<br>";
				echo $userdata["gender"];
				echo "<br>";
				echo $userdata["dob"];
				echo "<br>";
				echo $userdata["password"];
				echo "<br>";
				echo $userdata["agreedTerms"];*/
				$controller = new SbfController();
				$controller->registerUser($userdata);  //this is how you call another method in sami's pass the array to his function
			}
			
			

		}//end if
		else// one of the things missing 
		{
			echo "Enter all fields!<br>";
		}
		

	}

	//if user hit sign in
	elseif($signIn)
	{
		echo "Go to sign in page <br>";
	}

		
	
?>
	<form action='Registration.php' method='POST'>
		<!-- this value='' is for when the user made a mistake so we keep this field next time around so they dont have to retype -->
		First name: <input type="text" name = "firstname" value="<?php echo $firstname ?>">
			<br>
			Last name: <input type = "text" name = "lastname" value="<?php echo $lastname ?>">
			<br>
			Gender: <input type = "radio" name = "gender" value ="Male"> MALE
				 <input type = "radio" name = "gender" value ="Female"> FEMALE
			<br>
			Date of Birth:
			<select name="DOBMonth" >
				<option> - Month - </option>
				<option value="1">January</option>
				<option value="2">Febuary</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>

			<select name="DOBDay" >
				<option> - Day - </option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>

			<select name="DOBYear">
				<option> - Year - </option>
				<option value="1993">1993</option>
				<option value="1992">1992</option>
				<option value="1991">1991</option>
				<option value="1990">1990</option>
				<option value="1989">1989</option>
				<option value="1988">1988</option>
				<option value="1987">1987</option>
				<option value="1986">1986</option>
				<option value="1985">1985</option>
				<option value="1984">1984</option>
				<option value="1983">1983</option>
				<option value="1982">1982</option>
				<option value="1981">1981</option>
				<option value="1980">1980</option>
				<option value="1979">1979</option>
				<option value="1978">1978</option>
				<option value="1977">1977</option>
				<option value="1976">1976</option>
				<option value="1975">1975</option>
				<option value="1974">1974</option>
				<option value="1973">1973</option>
				<option value="1972">1972</option>
				<option value="1971">1971</option>
				<option value="1970">1970</option>
				<option value="1969">1969</option>
				<option value="1968">1968</option>
				<option value="1967">1967</option>
				<option value="1966">1966</option>
				<option value="1965">1965</option>
				<option value="1964">1964</option>
				<option value="1963">1963</option>
				<option value="1962">1962</option>
				<option value="1961">1961</option>
				<option value="1960">1960</option>
				<option value="1959">1959</option>
				<option value="1958">1958</option>
				<option value="1957">1957</option>
				<option value="1956">1956</option>
				<option value="1955">1955</option>
				<option value="1954">1954</option>
				<option value="1953">1953</option>
				<option value="1952">1952</option>
				<option value="1951">1951</option>
				<option value="1950">1950</option>
				<option value="1949">1949</option>
				<option value="1948">1948</option>
				<option value="1947">1947</option>
			</select>
			<br>
			Email Address: <input type = "text" name = "email" value="<?php echo $email ?>"> 
			<br>
			Re-Enter Email Address: <input type = "text" name = "emailr" value="<?php echo $emailRe ?>" > 
			<br>
			Username: <input type="text" name = "username" >
			<br>
			Password: <input type = "password" name = "pwd">
			<br>
			Re-Enter password: <input type = "password" name = "pwdr">
			<br>
			<input type = "checkbox" name = "agreeTerms" value = "agree"> I have read and agree with terms and conditions
			<br>
			<input type = "submit" value = "Register" name="register">
			<!--input type = "submit" value = "Sign in" name="signIn"-->
	</form >
</html>