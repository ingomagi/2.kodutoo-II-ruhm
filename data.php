<?php 
	
	require("functions.php");
	
	$commentError = "";
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	$msg="";
	if(isset($session["message"])){
		$msg = $_SESSION["message"];
		unset($_SESSION["message"]);
	}
	if (strlen ($_POST["comment"])>255)
		{
			
				$commentError = "tekst on suurem kui lubatud";
			}
	
	
	
	
	if 	(isset($_POST["plate"])&&
		isset($_POST["color"])&&
		isset($_POST["masinatyyp"])&&
		isset($_POST["comment"])&&
		!empty($_POST["plate"])&&
		!empty($_POST["masinatyyp"])&&
		!empty($_POST["comment"])&&
		!empty($_POST["color"])&&
		strlen ($_POST["comment"])<255
		) {
		saveCar(cleanInput($_POST["plate"]), $_POST["color"], $_POST["masinatyyp"], $_POST["comment"]);
	}
?>


<h1>Data</h1>
<?=$msg;?>
<body bgcolor="#e6ffe6">
<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>

<form method="POST">
	Sisestage kommentaar oma pakutava masina kohta (255 char pikkus): <br>
	<textarea name="comment" rows="5" cols="40"></textarea><br>
	<select name="masinatyyp" type="masinatyyp">
	<option value="">...</option>
	<option value="klassikaline">Klassikaline</option>
	<option value="Bike">Bike</option>
	<option value="mopeed">mopeed</option>
	<option value="Cruiser">Cruiser</option>
	<option value="Enduro">Enduro</option>
	<option value="Touring">Touring</option> 
	</select> <br><br> 
	<input name="plate" placeholder = "numbri märk" type ="text" value=""><br><br>
	Valige passis olev masina värv: <br>
   <input type="color" name="color"><br><br>
   <input type="submit" value="Sisesta">
  </form>