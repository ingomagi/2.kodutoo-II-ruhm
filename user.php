<?php
	
	require("functions.php");
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
	}
//get ja posti muutujad
//
	//var_dump ($_GET);
	//echo "<br>";
	//var_dump ($_POST);
	$signupPasswordError = "";
	$signupEmailError = "";
	$genderError = "";
	$ageError = "";
	$langError = "";
	$signupEmail="";
	$signupAge="";
	
	//on �ldse olemas
	if(isset($_POST["signupEmail"]))
	{
		//jah on olemas
		//kas on t�hi
		if(empty($_POST["signupEmail"]))
		{
			$signupEmailError = "see v�li on kohustuslik";
		}else
			{ 
			$signupEmail=$_POST["signupEmail"];
			}
	}
	if(isset($_POST["signupPassword"]))
	{
				if(empty($_POST["signupPassword"]))
				{
			$signupPasswordError = "see v�li on kohustuslik";
		} else{ 
			if (strlen ($_POST["signupPassword"])<8)
			{
			
				$signupPasswordError = "parool on l�hem kui 8 m�rki";
			}
		}
	}	
	
	if(isset($_POST['signupGender'])) 
	{
		if(empty($_POST["signupGender"]))
		{
		$genderError = " Unustasite valida oma soo";
		}
	}
	if(isset($_POST['signupAge'])) 
	{
		if(empty($_POST["signupAge"]))
		{
		$ageError = " Unustasite sisestada oma s�nnip�eva";
		}
	}
	
	// peab olema email ja parool
	//ja �htegi errorit ei olema
	if (  $signupEmailError == "" 
			&&
			$signupPasswordError == ""
			&&
			isset($_POST["signupEmail"])
			&&
			isset($_POST["signupPassword"])
			
		)
		{
			//salvestame andmebaasi
			echo "email: ".$signupEmail. "<br>";
			$age=$_POST["signupAge"];
			echo "vanus: ".$age. "<br>";
			
			echo "password: ".$_POST["signupPassword"]."<br>";
			$password = hash("sha512", $_POST["signupPassword"]);
			$gender=$_POST["signupGender"];
			echo "sugu: ".$gender. "<br>";
			$language=$_POST["Language"];
			echo "sugu: ".$language. "<br>";
			echo "password hashed: ".$password."<br>";
			
			signUp($signupEmail, $password, $gender, $age, $language);
		}
		$error ="";
	if ( isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
	  ) {
		  
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
	}
  ?>
 

 
 
 
<!DOCTYPE html>
<html>
<head>
<title>Logi sisse v�i loo kasutaja</title>
</head>
<body>
<body bgcolor="pink">
<h1>Logi sisse</h1>

<form method="POST">
  <input name="loginEmail" placeholder = "e-mail" type ="e-mail"> <br><br>
  <input name="loginPassword" placeholder = "parool" type ="password"> <br><br>
    <input type="submit" value="logi sisse">
  
</form>

<h1>Loo kasutaja</h1>

<form method="POST">

  <input name="signupEmail" placeholder = "e-mail" type ="e-mail" value="<?php echo $signupEmail;?>"> <?php echo $signupEmailError;?> <br><br>
  <input name="signupPassword" placeholder = "parool" type ="password"> <?php echo $signupPasswordError;?>  <br><br>

  valige oma sugu
  <select name="signupGender" type="signupGender">
	<option value="">...</option>
	<option value="mees">Mees</option>
	<option value="naine">Naine</option>
	<option value="meesnaine">muu</option>
  </select><?php echo $genderError;?>  <br><br>
  Sisestage oma s�nnip�ev<br> 
  <input name="signupAge" placeholder = "p�ev/kuu/aasta" type ="age"value="<?php echo $signupAge;?>">
  <?php echo $ageError;?>  <br><br>
	Valige oma eelistatud suhtlus keel: <br>
	<input type="radio" name="Language" value="EST" checked />EST
	<input type="radio" name="Language" value="ENG"/>ENG
	<?php echo $langError;?>
  <br><br><input type="submit" value="loo kasutaja">
  
</form> 




</body>
</html>