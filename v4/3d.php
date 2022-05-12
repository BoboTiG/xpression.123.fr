<div class="galeries">
	<p class="p_titre">Galerie 3D</p>
	<?php
		(string)$chemin = 'images/creations/3d/';
		
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
				<p style="text-align:center;""><a href="index.php?menu=3d">Retour</a></p>';
			} else {
				echo 
				'<p>
				Image inexistante...
				</p>
				<hr />
				<p style="text-align:center;"><a href="index.php?menu=3d">Retour</a></p>';
			}
		} else {
			echo 
			'<p>
				2007
				<br />
				<a href="index.php?menu=3d&image=5" class="image" title="Histoire de Science"><img src="images/creations/3d/mini/5.png" alt="Histoire de Science" /></a>
				<a href="images/creations/3d/6.avi" class="image" title="Découverte III"><img src="images/creations/3d/mini/6.png" alt="Découverte III" /></a>
			</p> 
			
			<hr />
			
			<p>
				2006
				<br />
				<a href="index.php?menu=3d&image=4" class="image" title="Le Grand Saharien"><img src="images/creations/3d/mini/4.png" alt="Le Grand Saharien" /></a>
				<a href="index.php?menu=3d&image=8" class="image" title="Deadly Yours"><img src="images/creations/3d/mini/8.png" alt="Deadly Yours" /></a>
				<a href="index.php?menu=3d&image=1" class="image" title="Alien Robot"><img src="images/creations/3d/mini/1.png" alt="Alien Robot" /></a>
				<a href="index.php?menu=3d&image=2" class="image" title="Terres Indomptables"><img src="images/creations/3d/mini/2.png" alt="Terres Indomptables" /></a>
				
				<br />
				<a href="index.php?menu=3d&image=7" class="image" title="Space Contact!"><img src="images/creations/3d/mini/7.png" alt="Space Contact!" /></a>
			</p> 
			
			<hr />
			
			<p>
				2005
				<br />
				<a href="index.php?menu=3d&image=3" class="image" title="Borealis"><img src="images/creations/3d/mini/3.png" alt="Borealis" /></a>
			</p> ';
		}
	?>
	
</div>
