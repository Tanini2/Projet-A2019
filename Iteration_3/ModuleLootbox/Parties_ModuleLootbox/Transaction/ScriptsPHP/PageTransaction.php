<?php
require '../Etudiant/CreateEtudiant.php';
require 'CreateTransactionLootboxRessource.php';
require 'ImportTransactionTestBD.php';
require 'ImportTransactionLootboxBD.php';
require 'ImportTransactionLootboxRessourceBD.php';
require '../Ressource/ImportRessourceBD.php';
require '../Ressource/CreateRessource.php';

//On va chercher le noEtudiant qu'on a reçu du POST
$noEtudiant = $_POST['Etudiants'];
$TransactionsTest = array();
$TransactionsLootbox = array();
$fortunePositive = 0;
$prixNegatif = 0;
?>

<h1>Page Transaction</h1>
<form action="PageTransaction.php" method="post">
	<select name="Etudiants" id="Etudiants">
	<?php //On crée un select avec les étudiants. Si on a un numéro d'étudiant passé en POST, on met l'option selected
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
<?php
//Si on a un numéro d'étudiant, on affiche le profil
if($noEtudiant != NULL){?>
	<!-- On affiche le profil de l'étudiant -->
	<h2>Profil Étudiant</h2>
	<ul>
		<li> Numéro de l'étudiant : <?php echo $etudiantActuel->ReturnNo() ?></li>
		<li> Nom de l'étudiant : <?php echo $etudiantActuel->ReturnNom() ?></li>
		<li> Prénom de l'étudiant : <?php echo $etudiantActuel->ReturnPrenom() ?></li>
		<?php 
		//On va chercher toutes les transactionsTest, toutes les transactionLootbox, et toutes les ressources de l'étudiant selon le noEtudiant
		$TransactionsTest = GetTransactionTestBD($noEtudiant);
		$TransactionsLootbox = GetTransactionLootboxBD($noEtudiant);
		$InfosRessources = GetRessourcesWithEtudiantBD($noEtudiant);
		$listeRessources = CreateRessources($InfosRessources);
		
		require 'CreateTransactionTest.php';
		require 'CreateTransactionLootbox.php';
		
		//Pour toutes les transactionsTest, on additionne le nombre de fortune obtenue
		foreach($listeTransactionsTest as $transactionTest){
			$fortunePositive += $transactionTest->ReturnNbFortune();
		}
		//Pour toutes les transactionsLootbox, on additionne le prix des lootbox achetées. On additionne aussi le nombre de fortune obtenue
		foreach($listeTransactionsLootbox as $transactionLootbox){
			$prixNegatif += $transactionLootbox->ReturnPrix();
			$fortunePositive += $transactionLootbox->ReturnNbFortune();
		}
		//La fortune est la soustraction de la fortune totale obtenue moins le prix des lootbox achetées 
		//Les XP sont la fortune totale obtenue
		$fortune = $fortunePositive - $prixNegatif;?>
		<li> Fortune : <?php echo $fortune ?> $</li>
		<li> XP : <?php echo $fortunePositive ?></li>
	</ul>
	<!-- On affiche toutes les transactionsTest -->
	<h2>Transactions Test</h2>
	<ul>
		<?php foreach($listeTransactionsTest as $transactionTest){?>
		<li>Numéro de transaction test : <?php echo $transactionTest->ReturnNo() ?></li>
		<li>Source : <?php echo $transactionTest->ReturnSource() ?></li>
		<li>Fortune attribuée : <?php echo $transactionTest->ReturnNbFortune() ?> $</li>
		<li>Description : <?php echo $transactionTest->ReturnDescription() ?></li>
		<br />
		<br />
		<?php } ?>
	</ul>
	<!-- On affiche toutes les transactionLootbox ainsi que les ressources obtenues pour chaque transaction-->
	<h2>Transactions Lootbox</h2>
	<ul>
		<?php if(count((array)$listeTransactionsLootbox) != 0){
			foreach($listeTransactionsLootbox as $transactionLootbox){?>
				<li>Numéro de transaction lootbox : <?php echo $transactionLootbox->ReturnNo() ?></li>
				<li>Destination : <?php echo $transactionLootbox->ReturnDestination() ?></li>
				<li>Fortune attribuée : <?php echo $transactionLootbox->ReturnNbFortune() ?> $</li>
				<li>Prix : <?php echo $transactionLootbox->ReturnPrix() ?> $</li>
				<li>Description : <?php echo $transactionLootbox->ReturnDescription() ?></li>
				<?php $TransactionsLootboxRessource = GetTransactionLootboxeRessourceBD($transactionLootbox->ReturnNo());
				$listeTransactionsLootboxRessource = CreateTransactionsLootboxRessource($TransactionsLootboxRessource);
				if(count($listeTransactionsLootboxRessource) > 0){ ?>
					<li>Ressources obtenues</li>
					<ul> <?php
					foreach($listeTransactionsLootboxRessource as $ressourceLootbox){ 
						$InfosRessourcesLootbox = GetRessourcesWithNoBD($ressourceLootbox->ReturnNoRessource());
						$listeRessourcesLootbox = CreateRessources($InfosRessourcesLootbox);
						foreach($listeRessourcesLootbox as $ressourceLootbox){?>
							<li><?php echo $ressourceLootbox->ReturnNom() ?></li>
							<li><?php echo $ressourceLootbox->ReturnRarete() ?></li>
							<li><?php echo $ressourceLootbox->ReturnCategorie() ?></li>
							<li><?php echo $ressourceLootbox->ReturnDescription() ?></li>
							<li><?php echo $ressourceLootbox->ReturnLienImage() ?></li>
							<?php if($ressourceLootbox->ReturnRessourceUnique()){ ?>
								<li>Ressource Unique</li>
							<?php } ?>
							<br />
						<?php }
					} ?>
					</ul>
				<?php } ?>
			<br />
			<?php }
		}
		else{ ?>
			<p>Aucune transaction lootbox n'a été effectuée.</p>
		<?php } ?>
	</ul>
	<!-- On affiche les ressources qui sont dans l'inventaire de l'étudiant -->
	<h2>Ressources</h2>
	<table>
		<tr>
			<th>Nom</th>
			<th>Rareté</th>
			<th>Catégorie</th>
			<th>Description</th>
			<th>LienImage</th>
			<th>Ressource Unique</th>
		</tr> <?php
		$InfosRessources = GetRessourcesWithEtudiantBD($noEtudiant);
		$listeRessources = CreateRessources($InfosRessources);
		foreach($listeRessources as $ressource){ ?>
			<tr>
				<td><?php echo $ressource->ReturnNom() ?></td>
				<td><?php echo $ressource->ReturnRarete() ?></td>
				<td><?php echo $ressource->ReturnCategorie() ?></td>
				<td><?php echo $ressource->ReturnDescription() ?></td>
				<td><?php echo $ressource->ReturnLienImage() ?></td>
				<td><?php echo $ressource->ReturnRessourceUnique() == 0 ? 'Non' : 'Oui' ?></td>
			</tr>
		<?php }
}
//Si on n'a pas de noEtudiant, on oblige l'utilisateur à choisir un compte pour afficher les informations
else{ ?>
	<p> Veuillez choisir un étudiant. </p><?php
}	
