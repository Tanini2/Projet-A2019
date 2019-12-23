<?php

require 'CreateLootbox.php';
require '../Ressource/ImportRessourceBD.php';
require '../Ressource/CreateRessource.php';
require '../Etudiant/CreateEtudiant.php';
require '../Transaction/ImportTransactionTestBD.php';
require '../Transaction/ImportTransactionLootboxBD.php';

//On va chercher le noLootbox et le noEtudiant du POST
$post = $_POST['noLootboxEtudiant'];
//On le split pour obtenir un tableau contenant les deux numéros
$noLootboxEtudiant = explode("|", $post);
//$noLootboxEtudiant[0] = noLootbox;
//$noLootboxEtudiant[1] = noEtudiant;
$fortunePositive = 0;
$prixNegatif = 0;
//On crée une constante pour le pourcentage du prix de la lootbox pour reroll
define("POURCENTAGE", 0.50);
//On crée un tableau contenant les fortunes possibles à obtenir
$FortunePossible = [1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 80];
//On passe chaque lootbox de la liste de lootbox
foreach($listeLootbox as $lootbox){
	//On vérifie si le numéro correspond
	if($noLootboxEtudiant[0] == $lootbox->ReturnNo()){
		//On crée la lootbox
		$lootboxChoisie = new Lootbox($lootbox->ReturnNo(), $lootbox->ReturnNom(), $lootbox->ReturnCategorie(), $lootbox->ReturnRarete(), $lootbox->ReturnDescription(), $lootbox->ReturnPrix(), $lootbox->ReturnPourcentageCommun(), $lootbox->ReturnPourcentageRare(), $lootbox->ReturnPourcentageEpique(), $lootbox->ReturnPourcentageLegendaire());
		break;
	}
}
//On passe chaque étudiant de la liste d'étudiants
foreach($listeEtudiants as $etudiant){
	//On vérifie que le numéro correspond
	if($noLootboxEtudiant[1] == $etudiant->ReturnNo()){
		//On crée l'étudiant
		$etudiantChoisi = new Etudiant($etudiant->ReturnNo(), $etudiant->ReturnNom(), $etudiant->ReturnPrenom());
		break;
	}
}
//On va chercher toutes les transactionsTest (retourne une liste) et toutes les transactionsLootbox (retourne une liste)
$TransactionsTest = GetTransactionTestBD($noLootboxEtudiant[1]);
$TransactionsLootbox = GetTransactionLootboxBD($noLootboxEtudiant[1]);
require '../Transaction/CreateTransactionTest.php';
require '../Transaction/CreateTransactionLootbox.php';

//Pour chaque transactionTest on ajoute le nbFortune dans une variable 
foreach($listeTransactionsTest as $transactionTest){
	$fortunePositive += $transactionTest->ReturnNbFortune();
}
//Pour chaque transactionLootbox on ajoute le prix dans une variable et la fortune obtenue dans une autre
foreach($listeTransactionsLootbox as $transactionLootbox){
	$prixNegatif += $transactionLootbox->ReturnPrix();
	$fortunePositive += $transactionLootbox->ReturnNbFortune();
}
//La fortune est la soustraction de la fortune obtenue et du prix des lootbox achetées
$fortune = $fortunePositive - $prixNegatif;

//On va chercher toutes les ressources de rareté commune et on crée une liste
$InfosRessourcesCommuns = GetRessourcesWithRareteBD(1);
$listeRessourcesCommuns = CreateRessources($InfosRessourcesCommuns);
//On va chercher toutes les ressources de rareté rare et on crée une liste
$InfosRessourcesRares = GetRessourcesWithRareteBD(2);
$listeRessourcesRares = CreateRessources($InfosRessourcesRares);
//On va chercher toutes les ressources de rareté épique et on crée une liste
$InfosRessourcesEpiques = GetRessourcesWithRareteBD(3);
$listeRessourcesEpiques = CreateRessources($InfosRessourcesEpiques);
//On va chercher toutes les ressources de rareté légendaires et on crée une liste
$InfosRessourcesLegendaires = GetRessourcesWithRareteBD(4);
$listeRessourcesLegendaires = CreateRessources($InfosRessourcesLegendaires);
//On va chercher toutes les ressources de la même rareté et de la même catégorie que celles de la lootbox
$InfosRessources2 = GetRessourcesWithParamBD($lootboxChoisie->ReturnCategorie(), $lootboxChoisie->ReturnRarete());
$listeRessourcesLootbox = CreateRessources($InfosRessources2);
//On va chercher toutes les ressources de l'étudiant
$InfosRessources3 = GetRessourcesWithEtudiantBD($noLootboxEtudiant[1]);
$listeRessourcesEtudiant = CreateRessources($InfosRessources3);
$uniquesDejaInventaire = array();
$ressourcesSansDoublons = array();
$ressourcesSansDoublons = array();
$ressourcesDoublons = array();
$pourcentages = array();
//On remplit une array contenant la rareté selon le pourcentage de chance d'obtenir une certaine rareté. 
// Ex. Les pourcentages sont 70% commun, 20% rare, 9% épique et 1% légendaire. Les index du tableau contiendront de 0-69 -> 1 | 70-89 -> 2 | 90-98 -> 3 | 99 -> 4
for($i = 1; $i <= $lootboxChoisie->ReturnPourcentageCommun(); $i++){
	array_push($pourcentages, 1);
}
for($i = 1; $i <= $lootboxChoisie->ReturnPourcentageRare(); $i++){
	array_push($pourcentages, 2);
}
for($i = 1; $i <= $lootboxChoisie->ReturnPourcentageEpique(); $i++){
	array_push($pourcentages, 3);
}
for($i = 1; $i <= $lootboxChoisie->ReturnPourcentageLegendaire(); $i++){
	array_push($pourcentages, 4);
}

//On boucle dans les ressources ayant la même catégorie et la même rareté que la lootbox
foreach($listeRessourcesLootbox as $ressourceLootbox){
	//Si la ressource est unique
	if($ressourceLootbox->ReturnRessourceUnique() == 1){
		$inventaire1 = false;
		//On boucle dans les ressources de l'étudiant
		foreach($listeRessourcesEtudiant as $ressourceEtudiant){
			//Si le numéro correspond
			if($ressourceEtudiant->ReturnNo() == $ressourceLootbox->ReturnNo()){
				//On le pousse dans un tableau contenant les uniques qui sont déjà dans l'inventaire de l'étudiant et on dit qu'on a trouvé une correspondance en changeant la valeur du booléen
				array_push($uniquesDejaInventaire, $ressourceLootbox);
				$inventaire1 = true;
			}
		}
		//Si on n'a pas trouvé de correspondance
		if(!$inventaire1){
			//On pousse la ressource dans la liste sans doublons
			array_push($ressourcesSansDoublons, $ressourceLootbox);
		}
	}
	//Si la ressource n'est pas unique
	else{
		$inventaire2 = false;
		//On boucle dans les ressources de l'étudiant
		foreach($listeRessourcesEtudiant as $ressourceEtudiant){
			//Si le numéro correspond
			if($ressourceEtudiant->ReturnNo() == $ressourceLootbox->ReturnNo()){
				//On le pousse dans le tableau contenant les doublons et on dit qu'on a trouvé une correspondance en changeant la valeur du booléen
				array_push($ressourcesDoublons, $ressourceLootbox);
				$inventaire2 = true;
			}
		}
		//Si on n'a pas trouvé de correspondance
		if(!$inventaire2){
			array_push($ressourcesSansDoublons, $ressourceLootbox);
		}
	}
} 
//Affichage des informations selon les tableaux que l'on a rempli ?>
<h1>Validation d'achat</h1>
<h2>Informations de la lootbox</h2>
<ul>
	<li>Nom : <?php echo $lootboxChoisie->ReturnNom() ?></li>
	<li>Description : <?php echo $lootboxChoisie->ReturnDescription() ?></li>
	<li>Prix : <?php echo $lootboxChoisie->ReturnPrix() ?> $</li>
</ul>
<h2>Ressources disponibles de la lootbox</h2>
<h3>Doublons (Ressources déjà dans votre inventaire)</h3>
	<?php if(count($ressourcesDoublons) > 0){ ?>
		<ul>
			<?php foreach($ressourcesDoublons as $ressourceLootbox){ ?>
				<li> Nom : <?php echo $ressourceLootbox->ReturnNom() ?> </li>
				<li> Description : <?php echo $ressourceLootbox->ReturnDescription() ?> </li>
				<li> Lien de l'image : <?php echo $ressourceLootbox->ReturnLienImage() ?> </li>
				<?php if($ressourceLootbox->ReturnRessourceUnique()){ ?>
					<li> Ressource Unique </li>
				<?php } ?>
				<br />
			<?php } ?>
		</ul>
	<?php }
	else{ ?>
		<p> Aucune ressource en double</p>
	<?php } ?>
<h3>Ressources que vous n'avez pas dans votre inventaire</h3>
	<?php if(count($ressourcesSansDoublons) > 0){ ?>
		<ul>
			<?php foreach($ressourcesSansDoublons as $ressourceLootbox){ ?>
				<li> Nom : <?php echo $ressourceLootbox->ReturnNom() ?> </li>
				<li> Description : <?php echo $ressourceLootbox->ReturnDescription() ?> </li>
				<li> Lien de l'image : <?php echo $ressourceLootbox->ReturnLienImage() ?> </li>
				<?php if($ressourceLootbox->ReturnRessourceUnique()){ ?>
					<li> Ressource Unique </li>
				<?php } ?>
				<br />
			<?php } ?>
		</ul>
	<?php }
	else{ ?>
		<p> Vous avez toutes les ressources de cette lootbox </p>
	<?php } ?>
<h2>Ressources non-disponibles de la lootbox (Uniques déjà dans votre inventaire)</h2>
	<?php if(count($uniquesDejaInventaire) > 0){?>
		<ul>
		<?php foreach($uniquesDejaInventaire as $uniqueInventaire){ ?>
			<li> Nom : <?php echo $uniqueInventaire->ReturnNom() ?> </li>
			<li> Description : <?php echo $uniqueInventaire->ReturnDescription() ?> </li>
			<li> Lien de l'image : <?php echo $uniqueInventaire->ReturnLienImage() ?> </li>
			<li> Ressource Unique </li>
			<br />
		<?php } ?> 
		</ul>
	<?php }
	else{?>
		<p>Aucune ressource non-disponible</p>
	<?php } ?>
<br />


<?php
//Si le nombre d'uniques dans l'inventaire est différent du nombre de ressources contenues dans la lootbox
if(count($uniquesDejaInventaire) != count($listeRessourcesLootbox)){
	$randomItem = array();
	$assetsObtenus = array();
	//On crée une liste contenant toutes les ressources disponibles dans la lootbox incluant les doublons possibles
	foreach($ressourcesSansDoublons as $ressourceSansDoublon){
		array_push($randomItem, $ressourceSansDoublon);
	}
	foreach($ressourcesDoublons as $ressourceDoublon){
		array_push($randomItem, $ressourceDoublon);
	}
	//Fonctionnement du aléatoire
	//Obtenir la ressource de la lootbox avec possibilité de doublon (liste random)
	$maxRandom = count($randomItem) - 1;
	$noRandom = mt_rand(0, $maxRandom);
	$ressourceRandom = $randomItem[$noRandom];
	$fortuneObtenue = 0;
	//Obtenir la ressource de la lootbox sans possibilité de doublon (liste sans doublons)
	$maxSansDoublons = count($ressourcesSansDoublons) - 1;
	//Vérification s'il y a des doublons dans la liste
	if($maxSansDoublons != -1){
		$noSansDoublons = mt_rand(0, $maxSansDoublons);
		$ressourceSansDoublon = $ressourcesSansDoublons[$noSansDoublons];
	}
	//Obtenir les ressources et/ou l'argent supplémentaires (boucle de 2, car on veut deux items supplémentaires)
	for($i = 0; $i < 2; $i++){
		//On fait un random entre 0 et 1. 0 = Fortune 1 = Ressources complètement aléatoires
		$FortuneOuAsset = mt_rand(0,1);
		if($FortuneOuAsset == 0){
			//On fait un random parmi les fortunes qu'il est possible d'obtenir
			$maxFortune = count($FortunePossible)- 1;
			$noFortune = mt_rand(0, $maxFortune);
			$fortuneObtenue += $FortunePossible[$noFortune];
		}
		else{
			//On va chercher la rareté obtenue selon l'index du tableau de pourcentage
			//Selon la rareté obtenue, on va chercher une ressource dans la bonne liste et on ajoute la ressource dans le tableau d'Assets /Ressources obtenues
			$noPourcentage = mt_rand(0, 99);
			$rarete = $pourcentages[$noPourcentage];
			if($rarete == 1){
				$maxAsset = count((array)$listeRessourcesCommuns) - 1;
				$noAsset = mt_rand(0, $maxAsset);
				array_push($assetsObtenus, $listeRessourcesCommuns[$noAsset]);
			}
			else if($rarete == 2){
				$maxAsset = count((array)$listeRessourcesRares) - 1;
				$noAsset = mt_rand(0, $maxAsset);
				array_push($assetsObtenus, $listeRessourcesRares[$noAsset]);
			}
			else if($rarete == 3){
				$maxAsset = count((array)$listeRessourcesEpiques) - 1;
				$noAsset = mt_rand(0, $maxAsset);
				array_push($assetsObtenus, $listeRessourcesEpiques[$noAsset]);
			}
			else{
				$maxAsset = count((array)$listeRessourcesLegendaires) - 1;
				$noAsset = mt_rand(0, $maxAsset);
				array_push($assetsObtenus, $listeRessourcesLegendaires[$noAsset]);
			}
		}
	}
	$doublon = false;
	//On va vérifier si l'item random obtenu est un doublon d'une ressource que l'étudiant a déjà dans son inventaire
	foreach($listeRessourcesEtudiant as $ressourceEtudiant){
		if($ressourceRandom->ReturnNo() == $ressourceEtudiant->ReturnNo()){
			$doublon = true;
			break;
		}
	} 
	//On affiche ce que l'étudiant a obtenu ?>
	<h3>Ressource obtenue</h3>
	<ul>
		<li><?php echo $ressourceRandom->ReturnNom(); ?></li>
		<li><?php echo $ressourceRandom->ReturnLienImage(); ?></li>
	</ul>
	<br />
	<h3>Items supplémentaires reçus</h3>
	<ul>
	<?php if($fortuneObtenue > 0){ ?>
		<li>Fortune obtenue : <?php echo $fortuneObtenue ?> $ </li>
		<br />
	<?php }
		if(count($assetsObtenus > 0)){
			foreach($assetsObtenus as $asset){ ?>
				<li><?php echo $asset->ReturnNom(); ?></li>
				<li><?php echo $asset->ReturnLienImage(); ?></li>
				<br />
			<?php }
		}?>
	</ul> <?php
	//Si on a obtenu un doublon et qu'il est possible d'obtenir une ressource sans doublon
	if($doublon && $ressourceSansDoublon != NULL){ ?>
		<?php //Vérification argent de l'étudiant
		//On vérifie si l'étudiant a assez d'argent pour reroll
		if(($fortune - $lootboxChoisie->ReturnPrix()) > ($lootboxChoisie->ReturnPrix() * POURCENTAGE)){ 
			//Afficher à l'étudiant qu'il peut reroll pour un certain montant d'argent. Il a la possibilité de reroll ou non.
			//Dépendamment du choix, on envoie la ressource random ou sans doublon
			//On envoie les infos nécessaires par des champs hidden
			?>
			<p> Vous avez déjà cet item dans votre inventaire. </p>
			<p> Débourser <?php echo number_format($lootboxChoisie->ReturnPrix() * POURCENTAGE, 2) ?> $ pour réessayer sans avoir de doublons? (*Vos items supplémentaires ne changeront pas*)</p>
			<form action="../Transaction/EnvoiTransactionBD.php" method="post">
				<input type="hidden" name="noEtudiant" value="<?php echo $noLootboxEtudiant[1] ?>"/>
				<input type="hidden" name="fortuneObtenue" value="<?php echo $fortuneObtenue ?>"/>
				<input type="hidden" name="prix" value="<?php echo ($lootboxChoisie->ReturnPrix() + ($lootboxChoisie->ReturnPrix()*POURCENTAGE)); ?>"/>
				<input type="hidden" name="noRessourceLootbox" value="<?php echo $ressourceSansDoublon->ReturnNo() ?>"/>
				<?php if(count($assetsObtenus) == 1){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
				<?php } ?>
				<?php if(count($assetsObtenus) == 2){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
					<input type="hidden" name="ressource3" value="<?php echo $assetsObtenus[1]->ReturnNo() ?>"/>
				<?php } ?>
				<input type="submit" value="Réessayer"/>
			</form>
			<form action = "../Transaction/EnvoiTransactionBD.php" method="post">
				<input type="hidden" name="noEtudiant" value="<?php echo $noLootboxEtudiant[1] ?>"/>
				<input type="hidden" name="fortuneObtenue" value="<?php echo $fortuneObtenue ?>"/>
				<input type="hidden" name="prix" value="<?php echo $lootboxChoisie->ReturnPrix() ?>"/>
				<input type="hidden" name="noRessourceLootbox" value="<?php echo $ressourceRandom->ReturnNo() ?>"/>
				<?php if(count($assetsObtenus) == 1){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
				<?php } ?>
				<?php if(count($assetsObtenus) == 2){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
					<input type="hidden" name="ressource3" value="<?php echo $assetsObtenus[1]->ReturnNo() ?>"/>
				<?php } ?>
				<input type="submit" value="Ne pas réessayer"/>
			</form>
		<?php }
		//Si l'étudiant n'a pas assez d'argent, il n'a pas le choix d'accepter le doublon
		else{ ?>
			<form action = "../Transaction/EnvoiTransactionBD.php" method="post">
				<input type="hidden" name="noEtudiant" value="<?php echo $noLootboxEtudiant[1] ?>"/>
				<input type="hidden" name="fortuneObtenue" value="<?php echo $fortuneObtenue ?>"/>
				<input type="hidden" name="prix" value="<?php echo $lootboxChoisie->ReturnPrix() ?>"/>
				<input type="hidden" name="noRessourceLootbox" value="<?php echo $ressourceRandom->ReturnNo() ?>"/>
				<?php if(count($assetsObtenus) == 1){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
				<?php } ?>
				<?php if(count($assetsObtenus) == 2){ ?>
					<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
					<input type="hidden" name="ressource3" value="<?php echo $assetsObtenus[1]->ReturnNo() ?>"/>
				<?php } ?>
				<input type="submit" value="Confirmer"/>
			</form>
		<?php }
	}
	//Si l'étudiant n'a pas obtenu un doublon, il doit accepter la ressource obtenue
	else{ ?>
		<form action = "../Transaction/EnvoiTransactionBD.php" method="post">
			<input type="hidden" name="noEtudiant" value="<?php echo $noLootboxEtudiant[1] ?>"/>
			<input type="hidden" name="fortuneObtenue" value="<?php echo $fortuneObtenue ?>"/>
			<input type="hidden" name="prix" value="<?php echo $lootboxChoisie->ReturnPrix() ?>"/>
			<input type="hidden" name="noRessourceLootbox" value="<?php echo $ressourceRandom->ReturnNo() ?>"/>
			<?php if(count($assetsObtenus) == 1){ ?>
				<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
			<?php } ?>
			<?php if(count($assetsObtenus) == 2){ ?>
				<input type="hidden" name="ressource2" value="<?php echo $assetsObtenus[0]->ReturnNo() ?>"/>
				<input type="hidden" name="ressource3" value="<?php echo $assetsObtenus[1]->ReturnNo() ?>"/>
			<?php } ?>
			<input type="submit" value="Confirmer"/>
		</form>
	<?php }
}
//Si le nombre de ressources uniques est égal au nombre de ressources disponibles de la lootbox
//L'étudiant ne peut acheter la lootbox, car il a déjà toutes les ressources disponibles qui sont des uniques déjà dans son inventaire
//On le renvoie à la page de Lootbox avec son numéro d'étudiant
else{ ?>
	<p> Les ressources de cette lootbox sont toutes des ressources uniques que vous avez déjà dans votre inventaire. Vous ne pouvez donc pas acheter cette lootbox.<p>
	<form action="PageLootbox.php" method="post">
		<input type="hidden" name="Etudiants" value="<?php echo $noLootboxEtudiant[1] ?>"/>
		<input type="submit" value="Retourner à la page des lootbox"/>
	</form>
<?php } ?>