<?php

require 'CreateRessource.php';
require 'CreateCategorie.php';
?>

<div>
	<h1>Page Ressources</h1>
<?php
$totalCategorie = count((array)$listeCategories);
$totalAsset = count((array)$listeRessources);
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
			<td><?php echo $listeRessources[$i3]->ReturnRessourceUnique() == 0 ? 'Faux' : 'Vrai' ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnStatut() ?></td>
			<td><?php echo $listeRessources[$i3]->ReturnPrix().' $' ?></td>
			</tr><?php
		}
		
	}
	?> </table> <?php
}
?>