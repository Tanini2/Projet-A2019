<?php
require 'ImportRessourceBD.php';
require 'CreateCategorie.php';
require 'CreateRessource.php';
?>

<div>
	<h1>Page Ressources</h1>
<?php
//On va chercher toutes les ressources de la base de données
$InfosRessources = GetRessourcesBD();
$listeRessources = CreateRessources($InfosRessources);

//On va chercher le nombre de catégories et le nombres d'assets/ressources des listes
$totalCategorie = count((array)$listeCategories);
$totalAsset = count((array)$listeRessources);
//On boucle dans les catégories en affichant le nom de la catégorie et les ressources appartenant à cette catégorie avec toutes les informations
for($i2 = 0; $i2 < $totalCategorie; $i2++){
	?><h2><?php echo $listeCategories[$i2]->ReturnNom() ?></h2>
	<table>
		<tr>
			<th>Nom</th>
			<th>Rareté</th>
			<th>Catégorie</th>
			<th>Description</th>
			<th>LienImage</th>
			<th>Ressource Unique</th>
			<th>Statut</th>
			<th>Prix</th><?php
	for($i3 = 0; $i3 < $totalAsset; $i3++){
		if($listeRessources[$i3]->ReturnCategorie() == $listeCategories[$i2]->ReturnNom()){
			?><tr>
			<td><?php echo $listeRessources[$i3]->ReturnNom() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnRarete() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnCategorie() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnDescription() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnLienImage() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnRessourceUnique() == 0 ? 'Non' : 'Oui' ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnStatut() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnPrix().' $' ?></td>
			</tr><?php
		}
		
	}
	?> </table> <?php
}
?>