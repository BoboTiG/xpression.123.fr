<div class="galeries">
	<p class="p_titre">Galerie Web Design</p>
	<?php
		(string)$chemin = 'images/creations/web_design/';
		
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
				<p style="text-align:center;""><a href="index.php?menu=web_design">Retour</a></p>';
			} else {
				echo 
				'<p>
				Image inexistante...
				</p>
				<hr />
				<p style="text-align:center;"><a href="index.php?menu=web_design">Retour</a></p>';
			}
		} else {
			echo 
			'<p>
				2009
				<br />
				<a href="index.php?menu=web_design&image=8" class="image" title="Site officiel du programme pdf-cli"><img src="images/creations/web_design/mini/8.png" alt="pdf-cli" /></a>
			</p> 
			
			<hr />
			 
			<p>
				2008
				<br />
				<a href="index.php?menu=web_design&image=6" class="image" title="XPression 4.0"><img src="images/creations/web_design/mini/6.png" alt="XPression 4.0" /></a>
				<a href="index.php?menu=web_design&image=5" class="image" title="Site officiel de Raphlaël Klein - Magicien"><img src="images/creations/web_design/mini/5.png" alt="Site officiel de Raphlaël Klein - Magicien" /></a>
				<a href="index.php?menu=web_design&image=4" class="image" title="Interface SIP"><img src="images/creations/web_design/mini/4.png" alt="Interface SIP" /></a>
				<a href="index.php?menu=web_design&image=3" class="image" title="GED Orditech"><img src="images/creations/web_design/mini/3.png" alt="GED Orditech" /></a>
			</p> 
			
			<hr />
			
			<p>
				2007
				<br />
				<a href="index.php?menu=web_design&image=2" class="image" title="Centralisation des mémos"><img src="images/creations/web_design/mini/2.png" alt="Centralisation des mémos" /></a>
				<a href="index.php?menu=web_design&image=1" class="image" title="Thème Framakey"><img src="images/creations/web_design/mini/1.png" alt="Thème Framakey" /></a>
			</p> 
			
			<hr />
			
			<p>
				2006
				<br />
				<a href="index.php?menu=web_design&image=7" class="image" title="XPression 3.0"><img src="images/creations/web_design/mini/7.png" alt="XPression 3.0" /></a>
			</p>';
		}
	?>
</div>
