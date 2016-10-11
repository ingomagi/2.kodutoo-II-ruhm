<?php 
	
	require("functions.php");
	
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
	
	if 	(isset($_POST["plate"])&&
		isset($_POST["color"])&&
		!empty($_POST["plate"])&&
		!empty($_POST["color"])
		) {
		saveCar(cleanInput($_POST["plate"]), $_POST["color"]);
	}
		$carData=getAllCars();
	//echo "<pre>";	
	//	var_dump($carData);
	//echo "</pre>";
?>
<h1>Data</h1>
<?=$msg;?>
<body bgcolor="#e6ffe6">
<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logi välja</a>
</p>

<form method="POST">
	<textarea name="comment" rows="5" cols="40"></textarea><br><br>
  <input name="plate" placeholder = "numbri märk" type ="text" value=""><br><br>
   <input type="color" name="color"><br><br>
   <input type="submit" value="Sisesta">
  </form>
  
<h2>Autod</h2>


  <?php
  $html = "<table>";
  $html .="<tr>";
	$html .="<th>id</th>";
	$html .="<th>plate</th>";
	$html .="<th>color</th>";
  $html .="</tr>";
  foreach($carData as $c){
	  //iga auto on $c
	  echo $c->plate."<br>";
		$html .="<tr>";
			$html .="<td>".$c->id."</td>";
			$html .="<td>".$c->plate."</td>";
			$html .="<td style='background-color:".$c->color."'>".$c->color."</td>";
		$html .="</tr>";
		
	} echo $html;
	
	$html .= "</table>";
	
	$listHtml = "";
	foreach($carData as $c){
		$listHtml .= "<h1 style='color:".$c->color."'>".$c->plate."</h1>";
	}
	echo $listHtml;
	
?>