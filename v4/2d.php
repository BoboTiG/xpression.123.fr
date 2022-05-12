<div class="galeries">
	<p class="p_titre">Galerie 2D</p>
	<?php
		(string)$chemin = 'images/creations/2d/';
		
		if ( isset($_GET['image']) && ! empty($_GET['image']) && is_numeric($_GET['image']) ) {
			if ( file_exists($chemin.$_GET['image'].'.png') && file_exists($chemin.$_GET['image'].'.nom') && file_exists($chemin.$_GET['image'].'.commentaire') ) {
				(string)$lien = $chemin.$_GET['image'].'.png';
				$nom = file_get_contents($chemin.$_GET['image'].'.nom');
				$commentaire = file($chemin.$_GET['image'].'.commentaire');
				
				echo 
				'<p>
					Description...
					<span class="commentaire">';
			
				foreach ( $commentaire as $ligne ) {
					echo $ligne.'<br />';
				}
				
				echo
					'</span>
				</p>
				<p>
					Aperçu...
					<br />
					<img src="'.$lien.'" alt="'.$nom.'" style="margin-left:5px; border:none; -moz-border-radius:0; padding:0;" />
				</p>
				<hr />
				<p style="text-align:center;""><a href="index.php?menu=2d">Retour</a></p>';
			} else {
				echo 
				'<p>
				Image inexistante...
				</p>
				<hr />
				<p style="text-align:center;"><a href="index.php?menu=2d">Retour</a></p>';
			}
		} else {
			echo 
			'<p>
				2008
				<br />
				<a href="index.php?menu=2d&image=15" class="image" title="La tour blanche"><img src="images/creations/2d/mini/15.png" alt="La tour blanche" /></a>
				<a href="index.php?menu=2d&image=16" class="image" title="Carte de visite Raphaël"><img src="images/creations/2d/mini/16.png" alt="Carte de visite Raphaël" /></a>
				<a href="images/creations/2d/17.pdf" class="image" title="PLaquette Pass\'Oval"><img src="images/creations/2d/mini/17.png" alt="PLaquette Pass\'Oval" /></a>
				<a href="index.php?menu=2d&image=18" class="image" title="Ma carte de visite"><img src="images/creations/2d/mini/18.png" alt="Ma carte de visite" /></a>
				
				<br />
				<a href="index.php?menu=2d&image=19" class="image" title="Bar à l\'Ancienne Gare"><img src="images/creations/2d/mini/19.png" alt="Bar à l\'Ancienne Gare" /></a>
				<a href="index.php?menu=2d&image=12" class="image" title="Nouveau logo RCMM"><img src="images/creations/2d/mini/12.png" alt="Nouveau logo RCMM" /></a>
			</p> 
			
			<hr />
			
			<p>
				2007
				<br />
				<a href="index.php?menu=2d&image=1" class="image" title="Songe d\'un soir"><img src="images/creations/2d/mini/1.png" alt="Songe d\'un soir" /></a>
				<a href="index.php?menu=2d&image=2" class="image" title="Rosa"><img src="images/creations/2d/mini/2.png" alt="Rosa" /></a>
				<a href="index.php?menu=2d&image=9" class="image" title="Une Mort Illuminée"><img src="images/creations/2d/mini/9.png" alt="Une Mort Illuminée" /></a>
				<a href="index.php?menu=2d&image=10" class="image" title="Rôdeur"><img src="images/creations/2d/mini/10.png" alt="Rôdeur" /></a>
				
				<br />
				<a href="index.php?menu=2d&image=11" class="image" title="Samus"><img src="images/creations/2d/mini/11.png" alt="Samus" /></a>
				<a href="index.php?menu=2d&image=14" class="image" title="Icône BeFlight"><img src="images/creations/2d/mini/14.png" alt="Icône BeFlight" /></a>
			</p> 
			
			<hr />
			
			<p>
				2006
				<br />
				<a href="index.php?menu=2d&image=7" class="image" title="Fresque"><img src="images/creations/2d/mini/7.png" alt="Fresque" /></a>
				<a href="images/creations/2d/3.gif" onclick="window.open(this.href);return(false);" class="image" title="Fumer tue"><img src="images/creations/2d/mini/3.png" alt="Fumer tue" /></a>
				<a href="index.php?menu=2d&image=5" class="image" title="Décision"><img src="images/creations/2d/mini/5.png" alt="Décision" /></a>
				<a href="index.php?menu=2d&image=4" class="image" title="Just married"><img src="images/creations/2d/mini/4.png" alt="Just married" /></a>
				
				<br />
				<a href="index.php?menu=2d&image=13" class="image" title="Pluie de Cendres"><img src="images/creations/2d/mini/13.png" alt="Pluie de Cendres" /></a>
			</p> 
			
			<hr />
			
			<p>
				2005
				<br />
				<a href="index.php?menu=2d&image=8" class="image" title="Derniers Instants"><img src="images/creations/2d/mini/8.png" alt="Derniers Instants" /></a>
				<a href="index.php?menu=2d&image=6" class="image" title="Le manoir"><img src="images/creations/2d/mini/6.png" alt="Le manoir" /></a>
			</p> ';
		}
	?>
</div>
