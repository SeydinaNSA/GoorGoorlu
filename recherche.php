<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div  id="recherche">
			
			<form class ="forme"  method="post" action="rechercher_prestataire.php">
			<div id="rech">
				<a class="r" style="font-size: 20px; padding:0% 5% 0% 5%; ">Je donne ma localit&eacute; :</a>
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
			<a class="r" style="font-size: 20px; padding:0% 5% 0% 5%;">Je cherche un :</a>
			<select name="prest">
				<option value="Electricite"> Eléctricité </option>
         <option value="Mecanique">Mecanique</option>
         <option value="Menuiserie">Menuiserie</option>
         <option value="Sdb">Salon de beauté</option>
         <option value="Plomb">Plomberie</option>
         <option value="dt">DIAY Tiaf </option>
         <option value="eb"> Eboueur  </option>
			</select>
			<input type="submit" id="bR" name="bCherche" value="rechercher">
			</div>
			
			

				
			</form>
	</div>
</body>
</html>
