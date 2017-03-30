<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Style/styleAccueil0.css">
<link rel="stylesheet" type="text/css" href="Style/footer.css">
<link rel="stylesheet" type="text/css" href="Style/styleHeaderFooter.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/conIns.js"></script>
<style type="text/css">
	#rr{ background-image: url("images/satis.png");}
	td{width: 10px;}
	th{background-color: #4a95cf; color: white;}
	tr,td,table{}
	td{padding: 0px 10px 0px 10px; width:100px;}
	table{ width:100%; color: black; font-size: 20px; background-color: #efeced;}
#resultat{
		height: 409px; 
		width: 80%;
		color: white;
		margin: 15px auto 0 auto;
		background-color: #fff;
		border: 8px solid #656363;
		border-radius: 5px 5px 0px 0px;
	}
#grand h4 {margin: 0px;  }
#grand{display:flex; height: 100px;}
#contenu {margin-left: 35%; width: 12%; position: relative; padding: 0px;}
#contenu a, #contact p{margin: 0px 0px 0px 8% ; margin-top: 0px; font-size: 14px;}
#contenu,#contact{margin-bottom: 0px;}
a{color: white; text-decoration: none;}
#grand a:hover{text-decoration: underline;}
#contact{position: relative; width: 18%; padding: 1px; }
#g{font-size: 35px; margin-left: 1.5%;}
#c{margin-left: 40%; font-size: 10px; margin-top: 0px; }
#client{
	color: black;
	text-decoration: underline;
	color: blue;

}
</style>
</head>
<body>
<?php include 'header.php';?> 
<?php include 'recherche.php';?> 
<a href="client.php" class="ins" ><br>Connectez-vous pour envoyer des messages !</a>

<?php
$connexion = new PDO("mysql:host=localhost;dbname=goorgoorlu","root","");

			if (isset($_POST['lieu']) AND isset($_POST['prest']) ) 
			{

				$localite = $_POST['lieu'];
				$service = $_POST['prest'];
				$requete = $connexion -> query("SELECT * FROM prestataire where pseudoPrest in (Select prestataire from prestataire_service where service='$service' AND rayon='$localite') AND dispo='oui'  ORDER BY tauxSatis DESC");
				echo '<a href="client.php" id="client">Connectez-vous pour choisir un prestataire !</a>';						
				echo '<div id ="resultat">';
				echo '<table>';	
				echo '<th class"tete"> Nom </th> <th > Prénom </th> <th> Localité </th> <th> Pseudo </th> <th> Contact </th><th> Tarif </th> <th> Taux </th>';
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
	
<?php include 'footer.php';?>
			
</body>
</html>