<div class="ressources">
	<p class="p_titre">Modules pour Simple Machines Forum</p>
	
	<p>
		Il s'agit d'un <strong>générateur de modules</strong>, il vous est possible de personnaliser un des modules pour votre site en fournissant quelques informations.
		<br />
		<br />
		Ces archives contenant scripts et images sont sous license GPL. Vous pouvez utiliser, étudier, modifier et diffuser ces fichiers et ses versions dérivées sans soucis.
		<br />
		<br />
		<u>Note</u> : Laissez-moi l'adresse de votre site utilisant un de ces modules, je vous ajouterai à la liste située plus bas.
	</p>
	
	<hr />
	
	<p>
		Faîtes votre choix...
		<!--<form method="post" action="generer.php" enctype="multipart/form-data" id="envoiFormulaire" target="envoiFrame" onsubmit="envoiEnCours();" >-->
		<form method="post" action="generer.php" enctype="multipart/form-data" id="envoiFormulaire"  >
			<dl>
				<dt><strong>1</strong>. <u>Sélectionner un module</u> : </dt>
				<dd>
					<br />
					<select name="module">
						<optgroup label="...::: SMF 1.1.5 :::..." style="background-color:black; color:white;">
							<option value="modRecherche" style="background-color:white; color:black;"> modRecherche v1.0 </option>
							<option value="envoiImages" style="background-color:white; color:black;"> envoiImages v1.0</option>
							<option value="passerelleWP" style="background-color:white; color:black;"> passerelleWP v1.0</option>
					</select>
					<a href="index.php?menu=infos_modules_smf">Description des modules disponibles</a>
					<br />
					<br />
					<br />
				</dd>
				
				<dt><strong>2</strong>. <u>Renseigner</u> : </dt>
				<dd>
					<br />
					Nom de votre forum :
					<br />
					<input type="text" size="50" name="nom_forum" />
					<br />
					<br />
					
					URL de votre forum :
					<br />
					<input type="text" name="url_forum" size="50" value="http://" />
					<br />
					<br />
					
					Chemin du thème<sup style="color:maroon;">*</sup> :
					<br />
					<input type="text" name="url_theme" size="50" value="Themes/" />
					<br />
					<br />
					
					<acronym title="Image au format ico de 16x16 pixels">Icône</acronym> :
					<input type="file" name="icone" size="25" />
					<br />
					<br />
					
					<span style="color:maroon;">
						<sup>*</sup> à remplir seulement si vous utilisez un thème autre que <em>default</em>, sinon laissez tel quel.
					</span>
					<br />
					<br />
					<br />
				</dd>
				
				<dt><strong>3</strong>. <u>C'est parti</u> !  </dt>
				<dd>
					<br />
					<input type="submit" id="envoi" value="Générer !" />
					&nbsp;
					<img src="images/ressources/chargement.gif" id="envoiChargement" style="visibility:hidden; vertical-align:middle; margin-top:-5px;" />
					<br />
					<br />
					<br />
				</dd>
				
				<dt><strong>4</strong>. <u>Obtenir le module</u> :  </dt>
				<dd>
					<div id="envoiStatut" style="color:white;"></div>
					<iframe id="envoiFrame" name="envoiFrame" src="#" style="border:none; height:1px; text-align:center;"></iframe>
				</dd>
			</dl>
		</form>
	</p>
	
	<hr />
	
	<!--<p>
		Sites qui utilisent un de ces modules :
		<ul>
			<li><a href="http://www.subposerforum.com" onclick='window.open(this.href);return(false);'>SubPoserForum</a></li>
		</ul>
	</p>-->
	
	<p class="p_telechargement">
		Dernière mise à jour des modules le <span style="color:red;"><?php require('fonctions.php'); echo Config::DATEF; ?></span>.
	</p>
</div>
