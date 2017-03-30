<?php
session_start();
$_SESSION=array();
session_destroy();

session_start();

$db = new PDO ('mysql:host=127.0.0.1;dbname=goorgoorlu','root','');

if (isset($_POST['bconnexion']))
	{
	$pseudo0=htmlspecialchars($_POST['pseudo']);
	$pwd0=sha1($_POST['pwdC']);
	echo $pwd0;

      if (!empty($pseudo0) AND !empty($pwd0)) 
      	{
	      	
		     		$requser= $db->prepare("SELECT * FROM client WHERE idClient=? AND password=?" );
		     		$requser->execute(array($pseudo0,$pwd0));
		     		$userexist = $requser->rowCount();

		     		if ($userexist ==1) 
		     		{
			     		
			     		$userinfo = $requser-> fetch();
				  		$_SESSION['id']= $userinfo['idC'];
				  		$_SESSION['pseudo']= $userinfo['idClient'];
				  		$_SESSION['nom']= $userinfo['nomClient'];
				  		$_SESSION['prenom']= $userinfo['prenom'];
				  		$_SESSION['mail']= $userinfo['mail'];
				  		header("Location: profilclient.php?id=".$_SESSION['id']);     					
	
				    }
      	
      				else
     				{
     					echo '<script type="text/javascript" >alert("Votre pseudo ou mot de passe incorrecte")</script>';
      				}
      	}
      	else
      	{
      		echo '<script type="text/javascript" >alert("Saisissez votre pseudo et votre mot de passe !")</script>';
      	}
    }
?>

<?php
$db = new PDO ('mysql:host=127.0.0.1;dbname=goorgoorlu','root',''); 

if (isset($_POST['binscript']))
	{
	$pseudo=htmlspecialchars($_POST['pseudoC']);
	$pwd=sha1($_POST['pwdC']);
	$pwd2=sha1($_POST['pwdC1']);

	$mail=htmlspecialchars($_POST['mail']);
      if (!empty($_POST['binscript'])and !empty($_POST['pseudoC'])and !empty($_POST['pwdC'])and !empty($_POST['mail'])) 
      	{
	      	$pseudolg= strlen($_POST['pseudoC']);
	      	
	      	if ($pseudolg <=255) 
	      	{

	      			$reqpseudo=$db->prepare("SELECT * FROM client WHERE pseudoC=?");
		     		$reqpseudo->execute(array($pseudo));
		     		$pseudoexist =$reqpseudo->rowCount();
		     		if ($pseudoexist==0) 
		     		{
			     			if ($pwd==$pwd2) 
		      				{
					     		$reqmail=$db->prepare("SELECT * FROM client WHERE mail=?");
					     		$reqmail->execute(array($mail));
					     		$mailexist =$reqmail->rowCount();
					     		if ($mailexist==0) 
					     		{
						     		if (filter_var($mail,FILTER_VALIDATE_EMAIL)) 
							      	{
							  			$inserrermbr= $db->prepare("INSERT INTO client(idClient,password,mail) VALUES (?,?,?)");
							  			$inserrermbr->execute(array($pseudo,$pwd,$mail));
							  			echo '<script type="text/javascript">alert("Vous vous etes inscris avec sucées");</script>';
							      	}
							      	else
							      	{
							      		$error="Votre adresse mail est invalide !";
							      	}
					     		}
					     		else
					     		{
					     			$error="mail déjà utilisé !";
					     		}
					     	}	
							else
					      	{
					      		$error= "Vos mots de passes ne correspondent pas !";
					      	}
					}
		     		else
		     		{
		     			$error="Pseudo déjà utilisé !";
		     		}
	      			      		
	      	}
	      	else
	      	{
	      	   	$error="Votre pseudo est très long !";
	      	}
	      
      	}
      else
      {
      	
      	$error= "remplir les case svp !";
      }

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>inscription du client</title>
	<link rel="stylesheet" type="text/css" href="style/footer.css">
	<link rel="stylesheet" type="text/css" href="Style/styleHeaderFooter.css">
	<link rel="stylesheet" type="text/css" href="Style/styleAccueil0.css">
	<link rel="stylesheet" type="text/css" href="Style/styleclient.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/conIns.js"></script>
    <style type="text/css">
    	#error{background-color: #fa3c3c; padding-left: 43%; }
    </style>

</head>
<body>
		<?php include 'header.php';?>
		<?php 
				
					if (isset($error)) {
						echo '<div id ="error">';
						echo '<font style="color: white; font-size:20px; ">'.$error.'</font>';
						echo '</div>';
					} 
				
		?>

		<div id="boxclient">
		   <img id="im1" src=" images/conn.png" > <img  id="im2" src=" images/insc.png" ><br><br>
			<div class="espaceC ins" style="display: none;">
			<form method="post" action="">
			<h3>Inscription</h3>
				<input type="text" name="pseudoC"  placeholder="votre pseudo" /><br><br>
				<input type="password" name="pwdC" placeholder="mot de passe" /><br><br>
				<input type="password" name="pwdC1" placeholder="confirmer mot de passe" /><br><br>
				<input type="text" name="mail" placeholder="mail" /><br><br>
				<input type="submit" name="binscript" value="valider" >
					
			</form>

			</div>
			<div class="espaceC con">
				<form method="post" action="">
				<h3>Connexion</h3>
					<input type="text" name="pseudo"  placeholder="votre pseudo" /><br><br>
					<input type="password" name="pwdC" placeholder="mot de passe" /><br><br><br>
					<label> Se souvenir de moi?<input type="checkbox" name="souvenir"></label><br><br>
					<input type="submit"  name="bconnexion" value="se connecter" >
						
				</form>

			</div>
		</div>
		
		<?php include 'footer.php';?>
</body>
</html>