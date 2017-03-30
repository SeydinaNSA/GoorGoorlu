<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	#mes{margin-left: 34%; }
	td{width: 10px;}
	th{background-color: #4a95cf; color: white;}
	tr,td,table{}
	td{padding: 0px 10px 0px 10px; width:100px;}
	table{margin-left: 0%; width:100%; color: black; font-size: 20px; background-color: #efeced;}
	</style>
</head>
<body>

	<div  id="recherche">
			
			<form class ="forme"  method="post" action="">
			<div id="rech">
				Je donne ma localit&eacute; :
			<select name="lieu">
				  <option  value="medina" >M&eacute;dina</option>
				<option value="gwd">Gu&egrave;diaway</option>
				<option value="pikine">pikine</option>
				<option value="col">colobane</option>
				<option value="ct"> centenaire</option>
				<option value="Gd">grand dakar</option>
				<option value="Dl">DaliFort</option>
				<option value="Hlm">HLM</option>
				<option value="Ntally"> Niary Tally </option>
				<option value="Okm">	Ouakam </option>
				<option value="Pa"> Parcelle assainies </option>
				<option value="Fass"> Fass </option>
				<option value="of">Ouest Foire</option>
			</select>
			je cherche un :
			<select name="prest">
				<option value="Electricite">Eléctricité</option>
         <option value="Mecanique">Mecanique</option>
         <option value="Menuiserie">Menuiserie</option>
         <option value="Sdb">Salon de beauté</option>
         <option value="Plomb">Plomberie</option>
         <option value="dt">DIAY Tiaf </option>
         <option value="eb"> Eboueur  </option>
			</select>
			<input type="submit" id="bR" name="bCherche" value="rechercher" >
			</div>
			
			
				
			</form>
	</div>
	<?php
$connexion = new PDO("mysql:host=localhost;dbname=goorgoorlu","root","");

			if (isset($_POST['lieu']) AND isset($_POST['prest']) ) 
			{
				$i=1;
				$localite = $_POST['lieu'];
				$service = $_POST['prest'];
				$requete = $connexion -> query("SELECT * FROM prestataire where pseudoPrest in (Select prestataire from prestataire_service where service='$service' AND rayon='$localite' ) AND dispo='oui'  ORDER BY tauxSatis DESC");



				echo '<form name="cacher" method="post">';		
				echo '</form>';	
				//
				echo '<div id ="mes">Si le taux est égal à 0 % , le prestataire n est pas encore évalué.</div>';
				echo '<div id ="resultat">';

				echo '<table>';	
				echo '<th class"tete"> Nom </th> <th > Prénom </th> <th> Localité </th> <th> Pseudo </th> <th> Contact </th> <th> Tarif </th> <th> Taux </th>';
				$i=0;
				 while ($resultat = $requete ->fetch()) {
				 	$p=$resultat['pseudoPrest'];

				 	$r = $connexion -> query("SELECT tarif FROM prestataire_service where prestataire ='$p' AND service='$service'");
				 	$res = $r ->fetch();
				 	$larg=$resultat['tauxSatis']*10;
				 	
				 		echo '<tr >';


echo '<td > '.$resultat['nomPrest'].' </td> <td> '.$resultat['prenomPrest'].' </td> <td>'.$resultat['localite'].'</td>  <td>'.$resultat['pseudoPrest'].'</td> <td> '.$resultat['contact'].' </td> <td> '.$res['tarif'].' </td> <td> '.$larg.' % </td>';
						$i++;
					
					 		echo '<tr>';
					 } 
					 echo  '</table >'; 
				echo  '</div >';
				if ($i==0) {
						echo '<script type="text/javascript"> alert("Aucun resultat trouve")</script>';
						 }
					             
			}

			if (isset($_POST['username']) AND isset($_POST['pwd']) ) 
			{

				$username = $_POST['username'];
				$pwd = $_POST['pwd'];
				$mes=$_POST['message'];

				 $req= $connexion->prepare("INSERT INTO messagePrestataire (pseudoP,pseudoC,message,dat) VALUES (?,?,?,NOW())" );
				 $req->execute(array($pwd,$username,$mes));

				$requete = $connexion -> query("SELECT  * FROM messageClient WHERE pseudoC='$username'");					
				echo '<div id ="resultat">';
				while ($resultat = $requete ->fetch()) {

					echo '<p > message </p></br> ';  
					echo $resultat['pseudoP'].' '.$resultat['message'];
					 
				 } 

				echo  '</div>';	       
			}	
?>	
</body>
</html>
