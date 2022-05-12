<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Tiger-222 - Portfolio et ressources</title>
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="index, follow" />
		<meta name="description" content="Portfolio en ligne de Tiger-222. Entre graphisme et programmation..." />
		<meta name="keywords" lang="fr" content="graphisme, gimp, inkscape, javascript, php, css, xhtml, html, ajax, tiger-222, Tiger-222, blender, scribus, geany, scite, 2d, 3d, développement, programmation, art, visuel, motif, script" />
		<meta name="category" content="Internet" />
		<meta name="distribution" content="global" />
		<meta name="author" lang="fr" content="Tiger-222" />
		<meta name="copyright" content="Tiger-222" />
		<meta name="generator" content="Scite, Geany, Gimp, InkScape" />
		<meta name="identifier-url" content="http://xpression.123.fr" />
		<meta name="expires" content="never" />
		<meta name="Date-Creation-yyyymmdd" content="20060824" />
		<meta name="Date-Revision-yyyymmdd" content="20100709" />
		<meta name="revisit-after" content="7 days" />
		<meta http-equiv="imagetoolbar" content="no" />
		
		<link rel="shortcut icon" href="images/creations/favicon.ico" />
		<link rel="icon" href="images/creations/favicon.png" type="image/png" />
		<link rel="stylesheet" media="screen" type="text/css" title="Graphisme Écran" href="scripts/ecran.css" />
		<link rel="contents" href="index.php" />
		<link title="Dépôt" href="depot/" />
		
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/comparer.js"></script>
		<script type="text/javascript" src="scripts/affCache.js"></script>
	</head>

	<body>
		<div id="haut"></div>
		
		<div id="menu">
			<a href="index.php?menu=galeries">
				<img src="images/v4/png/Menu - Galeries.png" alt="Menu - Galeries" onMouseOver="this.src='images/v4/png/Menu - Galeries - Hover.png';" onMouseOut="this.src='images/v4/png/Menu - Galeries.png';" />
			</a>

			<a href="index.php?menu=ressources">
				<img src="images/v4/png/Menu - Ressources.png" alt="Menu - Ressources" onMouseOver="this.src='images/v4/png/Menu - Ressources - Hover.png';" onMouseOut="this.src='images/v4/png/Menu - Ressources.png';" />
			</a>

			<img src="images/v4/png/Menu - CV.png" alt="Menu - CV" onMouseOver="this.src='images/v4/png/Menu - CV - Hover.png';" onMouseOut="this.src='images/v4/png/Menu - CV.png';" />

			<a href="index.php?menu=liens">
				<img src="images/v4/png/Menu - Liens.png" alt="Menu - Liens" onMouseOver="this.src='images/v4/png/Menu - Liens - Hover.png';" onMouseOut="this.src='images/v4/png/Menu - Liens.png';" />
			</a>
		</div>
		
		<div id="milieu">
			<div class="contenu">
				<?php
					if ( ! defined('base') ) {
						define('base', getcwd().'/');
					}

					if ( isset($_GET['menu']) ) {
						if ( $_GET['menu'] == 'galeries' ) {
							echo '<img src="images/v4/png/Titre - Galeries.png" alt="Titre - Galeries" id="titre" />';
							include base.'galeries.html';
						} elseif ( $_GET['menu'] == '2d' ) {
							echo '<img src="images/v4/png/Titre - Galeries.png" alt="Titre - Galeries" id="titre" />';
							include base.'2d.php';
						} elseif ( $_GET['menu'] == '3d' )  {
							echo '<img src="images/v4/png/Titre - Galeries.png" alt="Titre - Galeries" id="titre" />';
							include base.'3d.php';
						} elseif ( $_GET['menu'] == 'web_design' )  {
							echo '<img src="images/v4/png/Titre - Galeries.png" alt="Titre - Galeries" id="titre" />';
							include base.'web_design.php';
						} elseif ( $_GET['menu'] == 'ressources' )  {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'ressources.html';
						} elseif ( $_GET['menu'] === 'liens' )  {
							echo '<img src="images/v4/png/Titre - Liens.png" alt="Titre - Liens" id="titre" />';
							include base.'liens.html';
						} elseif ( $_GET['menu'] == 'sitemap' )  {
							echo '<img src="images/v4/png/Titre - Sitemap.png" alt="Titre - Sitemap" id="titre" />';
							include base.'sitemap.html';
						} elseif ( $_GET['menu'] == 'script_xaralx' )  {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'script_xaralx.php';
						} elseif ( $_GET['menu'] == 'tons_manga' ) {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'tons_manga.php';
						} elseif ( $_GET['menu'] == 'plugins_smf' ) {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'plugins_smf.php';
						} elseif ( $_GET['menu'] == 'infos_modules_smf' ) {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'infos_modules_smf.php';
						} elseif ( $_GET['menu'] == 'maintenance' ) {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'maintenance.php';
						} elseif ( $_GET['menu'] == 'scite' )  {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'scite.php';
						} elseif ( $_GET['menu'] == 'utc' )  {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'depot/utc.php';
						} elseif ( $_GET['menu'] == 'md5sum_web' )  {
							echo '<img src="images/v4/png/Titre - Ressources.png" alt="Titre - Ressources" id="titre" />';
							include base.'depot/md5sum-web.html';
						} elseif ( $_GET['menu'] == 'a_propos' )  {
							echo '<img src="images/v4/png/Titre - A propos.png" alt="Titre - Accueil" id="titre" />';
							include base.'a_propos.html';
						} else {
							echo '<img src="images/v4/png/Titre - Accueil.png" alt="Titre - Accueil" id="titre" />';
							include base.'accueil.html';
						}
					} else {
						echo '<img src="images/v4/png/Titre - Accueil.png" alt="Titre - Accueil" id="titre" />';
						include base.'accueil.html';
					}

				?>
			</div>
		</div>
		
		<div id="bas">
			<span class="flux">
				<a href="index.php?menu=sitemap" title="Sitemap">Sitemap</a>
			</span>
		</div>
		
		<p><a href="index.php"><img src="images/v4/png/Bienvenue.png" alt="Accueil" id="accueil" /></a></p>
		
		<p><img src="images/v4/png/pointe.png" alt="Pointe" id="pointe" /></p>
		
		<p><a href="index.php?menu=a_propos" id="a_propos">...::: @propos</a></p>
	</body>
</html>
