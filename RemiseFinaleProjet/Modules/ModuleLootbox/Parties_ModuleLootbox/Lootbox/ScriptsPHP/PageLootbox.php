<?php
require 'CreateLootbox.php';
require '../Ressource/ImportRessourceBD.php';
require '../Ressource/CreateRessource.php';
require '../Etudiant/CreateEtudiant.php';
require '../Transaction/ImportTransactionTestBD.php';
require '../Transaction/ImportTransactionLootboxBD.php';

//On va chercher le numéro d'étudiant reçu en POST
$noEtudiant = $_POST['Etudiants'];
?>
<link rel="stylesheet" href="styles.css">
<!-- Fonctionnement du bouton qui permet de faire apparaître et/ou disparaître les informations de la lootbox lorsqu'on clique sur l'image -->
<script type="text/javascript">
    function btnShow(noLootbox)
    {	
	var Description = document.getElementsByClassName(noLootbox);
	for(var i = 0; i < Description.length; i++){
	   if (Description[i].style.display === "none") {
	       Description[i].style.display = "block";
	   }
	   else{
	       Description[i].style.display = "none";
	   }	
	}
	
    }
</script>
<div>
    <?php //On va chercher toutes les transactionTest et toutes les transactionLootbox 
	$TransactionsTest = GetTransactionTestBD($noEtudiant);
	$TransactionsLootbox = GetTransactionLootboxBD($noEtudiant);
	require '../Transaction/CreateTransactionTest.php';
	require '../Transaction/CreateTransactionLootbox.php';
	//Pour chaque transactionTest, on ajoute le nb de fortune obtenue 
	foreach($listeTransactionsTest as $transactionTest){
		$fortunePositive += $transactionTest->ReturnNbFortune();
	}
	//Pour chaque transactionLootbox, on ajoute le prix dans une variable et le nombre de fortune obtenue dans une autre
	foreach($listeTransactionsLootbox as $transactionLootbox){
		$prixNegatif += $transactionLootbox->ReturnPrix();
		$fortunePositive += $transactionLootbox->ReturnNbFortune();
	}
	//On calcule la fortune en soustrayant le prix des lootbox achetées de la fortune totale obtenue
	$fortune = $fortunePositive - $prixNegatif;
	?>
	
    <h1>Page Lootbox</h1>
    <form action="PageLootbox.php" method="post">
		<select name="Etudiants" id="Etudiants">
		<?php //On affiche la liste des étudiants dans un select pour que l'utilisateur puisse choisir le compte
		foreach($listeEtudiants as $etudiant){ 
			if($noEtudiant == $etudiant->ReturnNo()){
				$etudiantActuel = $etudiant;?>
				<option selected="selected" value=<?php echo $etudiant->ReturnNo() ?>><?php echo $etudiant->ReturnNom().' '.$etudiant->ReturnPrenom() ?></option>
		<?php }
			else{?>
				<option value=<?php echo $etudiant->ReturnNo() ?>><?php echo $etudiant->ReturnNom().' '.$etudiant->ReturnPrenom() ?></option>
			<?php }
		}?>
		</select>
		<input type="submit" value="Valider"/>
	</form>
	
</div>
<div>
	<?php
	//Si on a reçu un numéro d'étudiant au chargement de la page, on affiche les lootbox et les informations de celles-ci (dans un div hidden)
	if($noEtudiant != NULL){
	 	?> <p><?php echo "Fortune : ".$fortune."$" ?></p>
		<h4><?php echo utf8_encode ("Les lootbox contiennent une ressource assurée de la catégorie avec le niveau de rareté affiché dans la description. En plus de cette ressource, chaque lootbox donne deux autres objets, soit de la fortune ou une autre ressource.") ?> </h4><?php
		$totalLootbox = count((array)$listeLootbox);
		for($i3 = 0; $i3 < $totalLootbox; $i3++){ ?>
			<h2><?php echo $listeLootbox[$i3]->ReturnNom() ?></h2>
			<div>
				<button type="submit" value="<?php echo $listeLootbox[$i3]->ReturnNo()?>" name="id" style="border: 0; background: transparent" onclick="btnShow(<?php echo $listeLootbox[$i3]->ReturnNo()?>)">
					<img src="http://dicj.info/etu/p2019/ModuleLootbox/Lootbox/img/lootbox_petite.png" width="90" height="50" alt="submit" />
				</button>
			</div>
			<div>
				<p><?php echo "Prix : ".$listeLootbox[$i3]->ReturnPrix()." $" ?></p>
			</div>
			<div id="description" class="<?php echo $listeLootbox[$i3]->ReturnNo()?>" style="display:none;">
				<p><?php echo $listeLootbox[$i3]->ReturnDescription()?></p>
			</div>	
			<?php 
			//On va chercher la liste des ressources disponibles dans la lootbox (selon la rareté et la catégorie de celle-ci)
			$InfosRessources = GetRessourcesWithParamBD($listeLootbox[$i3]->ReturnCategorie(), $listeLootbox[$i3]->ReturnRarete());
			$listeRessources = CreateRessources($InfosRessources);
			$totalRessource = count((array)$listeRessources); ?>
			<div style="display:none;" class="<?php echo $listeLootbox[$i3]->ReturnNo() ?>">
				<p><?php echo "La lootbox contient ces ressources : " ?></p>
			</div>
			<?php
			for($i4 = 0; $i4 < $totalRessource; $i4++){ ?>
				<div id="lstRessource" style="display:none;" class="<?php echo $listeLootbox[$i3]->ReturnNo() ?>">
					<p><?php echo $listeRessources[$i4]->ReturnNom() ?></p>
				</div>
			<?php 
			} 
			//Quand on clique sur Acheter, on envoie un numéro de lootbox et un numéro d'étudiant à la prochaine page dans un champ hidden?>
			<form action='AleatoireEtReroll.php' method="post">
				<?php $valeur = $listeLootbox[$i3]->ReturnNo()."|".$noEtudiant; ?>
				<input type="hidden" name="noLootboxEtudiant" value="<?php echo $valeur ?>">
				<input class="<?php echo $listeLootbox[$i3]->ReturnNo() ?>" type="submit" <?php if($fortune < $listeLootbox[$i3]-> ReturnPrix()) {echo "disabled";}?> value="Acheter" name="acheter" style="display:none;" onclick="btnAcheter(<?php echo $listeLootbox[$i3]->ReturnNo()?>)">
				</input>
				</form>    
		<?php
		} 
	}
	//Si on a pas obtenu de numéro d'étudiant au chargement de la page, on oblige l'utilisateur a choisi un compte pour pouvoir voir les loobox
	else
	{
	?>
	<p><?php  echo utf8_encode("Veuillez choisir un étudiant") ?></p>
	<?php
	}
	?>
</div>