<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CETTE PARTIE SERT AU CALCUL DES STATISTIQUES, SI VOUS LA SUPPRIMEZ LES STATISTIQUES NE FONCTIONNERONT PLUS
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");            // Date du passé 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toujours modifié 
header("Cache-Control: no-cache, must-revalidate");          // HTTP/1.1 
header("Pragma: no-cache");                                  // HTTP/1.0 
$dt_a =date ("Y");
$dt_m =date ("m");
$dt_j =date ("d");
$dt_h =date ("H");
$dt_mn =date ("i");
$dt_s =date ("s");
$st_sess=0;
$st_sess=$_GET['ac_sess'];
$st_reference=$_GET['ac_reference'];
$st_type=$_GET['ac_type'];
$st_languec=$_GET['ac_languec'];
$gallerie=$_GET['gallerie'];
$hidemenu=$_GET['hidemenu'];
if ($st_sess > 0) {
} else {
$hasard=rand (0, 9000);
$st_sess= $dt_s.$hasard.$dt_j.$dt_h.$dt_mn;
$st_reference=getenv("HTTP_REFERER");
$st_reference2=getenv("SERVER_NAME").getenv("REQUEST_URI");
$empla=strpos($st_reference2,'?');
if($empla){$st_reference2=substr($st_reference2,0,$empla);}
}
$ip=getenv("REMOTE_ADDR");
$navigateur=getenv("HTTP_USER_AGENT");
$nbpages=$st_nbpages;
$nbclic=$st_nbclics;
$exploitation=$st_os;
$langue=$st_langue;
$resolution=$st_resolution;
$sess=$st_sess;
$reference=$st_reference;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tiger-222 - Galerie Personnelle</title>
<META NAME="Author" CONTENT="Tiger-222">
<META NAME="Description" CONTENT="Mes créations numériques assez diverses en 2D tout comme en 3D.">
<META NAME="Keywords" CONTENT="Galeries 2D/3D, Photos, Tutoriaux, Textures, Matières 3D, Objets 3D, LogonXP, kits graphiques, download, Photoshop, Terragen, Vue d&#8217;Esprit, Bryce, Poser, Cinema4D, Forum, E-boutique, E-Cards">
<META NAME="Identifier-URL" CONTENT=" http://xpression.123.fr/">
<META NAME="Reply-to" CONTENT="tiger-222@wanadoo.fr">
<META NAME="revisit-after" CONTENT="4">
<META NAME="Copyright" CONTENT="© Tiger-222">
<META NAME="generator" CONTENT="Photoshop, ImageReady, Poser, Dreamweaver">
<META NAME="robots" CONTENT="all">
<style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
}
body {
	background-color: #ffffff;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
-->
</script>

</head>
<body>

<div align="center">
<!-- DEBUT CODE MONCOMPTEUR.COM -->
<script type="text/javascript"><!--
member = 27787;
numCounter = 1;
border = 0;
//-->
</script>
<script type="text/javascript" src="http://www.moncompteur.com/javascripts/moncompteur.js">
</script>
<!-- FIN CODE MONCOMPTEUR.COM -->
<div align="center">

<div align="center"><table width="90%" height="90%"  border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><div align="center">
<!--//////////////////////////////////////////////
// CETTE PARTIE CONTIENT L'APPEL DE LA GALERIE 
//////////////////////////////////////////////-->
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="750" height="600" align="middle">
	<?php $phrase1='<PARAM NAME=movie VALUE="09.swf?hidemenu='.$hidemenu.'&gallerie='.$gallerie.'&ac_annee='.$dt_a.'&ac_mois='.$dt_m.'&ac_jour='.$dt_j.'&ac_sess='.$sess.'&ac_reference='.$st_reference.'&ac_reference2='.$st_reference2.'">';
print $phrase1;?>
        <param name="quality" value="best" >
	<param name="wmode" value="transparent" >
        <param name="bgcolor" value="#ffffff" >
        <embed <?php $phrase2='src="09.swf?hidemenu='.$hidemenu.'&gallerie='.$gallerie.'&ac_annee='.$dt_a.'&ac_mois='.$dt_m.'&ac_jour='.$dt_j.'&ac_sess='.$sess.'&ac_reference='.$st_reference.'&ac_reference2='.$st_reference2.'"';print $phrase2;?> quality="best" wmode="transparent" bgcolor="#ffffff" width="750" height="600" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />      
</object>
<!--//////////////////////////////////////////////-->
</div></td></tr></table></div>
<CENTER>

<p><a target="_blank" href="http://xpression.123.fr/liens.htm">
<img border="0" src="http://xpression.123.fr/pic/lien.jpg" width="130" height="60"></a></p>

<p><a target="_blank" href="http://xpression.123.fr/livre">
<img border="0" src="http://xpression.123.fr/pic/Livre%20d'or.jpg" width="230" height="80"></a></p>

<p><a href="mailto:tiger-222@wanadoo.fr">
<img border="0" src="http://xpression.123.fr/pic/copyright.jpg" width="330" height="60"></a></p>

</CENTER>
</body>
</html>
