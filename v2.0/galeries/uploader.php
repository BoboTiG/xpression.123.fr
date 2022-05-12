<?php
    $max_v=1024;
    $max_h=1024;
    $qual=70;
?>
<html>
<head>
<title>GFD v.2 - Ajouter une image</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="stylesheet.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Style4 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Style5 {font-size: 12px}
.Style6 {font-size: 14pt}
body {
	background-color: #ffffff;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Style9 {font-weight: bold; font-size: 18px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Style10 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0" height="100%"><tr><td><div align="center"><br><span class="Style9">Module de mise en ligne des images
        </span><br><br><table width="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
          <tr><td><table width="100%" cellpadding="5" cellspacing="5" bgcolor="#aaaaaa">
                <tr><td bgcolor="#dddddd">
<?php

if ($bilde_fil){
if ($folder2 != ""){
$folder=$folder2;
if (is_dir($folder))
	{
	}
	else
	{
	$folder = eregi_replace("[^A-Z0-9]", "_", $folder);
	if($_GET["dir"] == "" || !is_dir($_GET["dir"])) $dir = getcwd();
	else $dir = $_GET["dir"];
	$dir = str_replace("\\", "/", $dir);
	$i=-1;
	$maxDepth=0;
	$i++;
  	if($checkDir = opendir($dir)){
       	$cDir = 0;
       	$cFile = 0;
       	while($file = readdir($checkDir)){
           if($file != "." && $file != ".."){
               if(is_dir($dir . "/" . $file)){
                   $listDir[$cDir] = $file;
                   $cDir++;
               }
           }
      	}
       	if(count($listDir) > 0){
           sort($listDir);
           for($j = 0; $j < count($listDir); $j++){
		$derdir=$listDir[$j];
           }
       	}
       	closedir($checkDir);
   	}
		$derdir2 = substr($derdir, 0, 2); 
		$derdir2 = (int) $derdir2;
		$derdir2++;
		if ($derdir2<9){
		$derdir2="0".$derdir2;
		}
		else
		{
		$derdir2="".$derdir2;
		}
		$folder=$derdir2.$folder;
		mkdir ($folder);
        	chmod ($folder, 0755); 
	}
}
$nyttnavn=$nomfic;                       
$nyttnavn = eregi_replace("[^A-Z0-9]", "_", $nyttnavn);

if ($nyttnavn==""){
$nyttnavn =date ("dmYHis",time());
}
$ending=".jpg";
$path=$folder."/"; 

   $ok = 1;

   if (is_file($path.$nyttnavn.$ending)){
      print "<span class=\"Style3\"><b>Erreur</b>, ce nom existe déjà<br></span>";
      $ok = 0;
   }
   if (preg_match("/^[\/\\\.]/", $nyttnavn)){
      print "<b>Erreur</b>, nom incorrect";
      $ok = 0;
   }
   print "";
}
if ($ok){
    chmod ($folder, 0777); 
    $ti_fichier_image=$bilde_fil."a"; 
    $im = ImageCreateFromjpeg("$bilde_fil"); 
    $v=ImageSY($im); // $v prend la hauteur
    $h=ImageSX($im); // $h prend la largeur
    $rapportmoi=$v/$h;
    if ($v > $max_v) 
    {
        $taux_hauteur=$v/$max_v;    
        $ti_v=(int)floor($max_v); 
        $ti_h=(int)floor($h/$taux_hauteur); 
    }
    else $ti_v=$v; 
    if ($ti_h!="") $h_comp = $ti_h; else $h_comp = $h;
    if ($ti_v!="") $v_comp = $ti_v; else $v_comp = $v;
    if ($h_comp > $max_h)
    {
        $taux_largeur=$h_comp/$max_h; 
        $ti_h=(int)floor($max_h);
        $ti_v=(int)floor($v_comp/$taux_largeur); 
    }
    else $ti_h=$h_comp;
    $ti_im = imagecreatetruecolor($ti_h,$ti_v); 
    imagecopyresized($ti_im,$im,0,0,0,0,$ti_h,$ti_v,$h,$v); 
    imagejpeg($ti_im,"$ti_fichier_image",$qual); 
    $nomfichier = $ti_fichier_image;
   $res = copy($nomfichier, $path.$nyttnavn.$ending);
   chmod ($folder, 0755); 
   $vgv=150;
   $vgh=150*$rapportmoi;
   print ($res)?"<div align=\"center\"><span class=\"Style3\">Fichier <b>".$nyttnavn.$ending."</b> mis en ligne,<br>vous pouvez entrer le fichier suivant </span><br></div><br><div align=\"center\"><img src=".$path.$nyttnavn.$ending." width=".$vgv." height=".$vgh."></div>":"<b>Erreur</b>, Impossible d'ouvrir le fichier.<br>";
$ttg=urldecode($ttgz2);
$trans2 = array("é" => "Ã©");
$ttg = strtr($ttg , $trans2);
}
$ttg2=urlencode($ttg);
$gname="formen";
$sep = "/";
$urldd = $_SERVER['PHP_SELF'];
$chainedd = basename($urldd,$extdd);
$tableaudd=explode($sep,$chainedd);
$monurl=$tableaudd[0];
$gaction=$monurl;
$gmethod="post";
$genc="multipart/form-data";
print "<form name=$gname action=$gaction method=$gmethod enctype=$genc>";
print "<div align=\"center\" class=\"Style4\"><span class=\"Style6\">Charger une image</span><br><span class=\"Style5\">Votre fichier doit &ecirc;tre un jpeg<br>Sa taille Maximum : 8000ko</span></div><table width=\"100%\" cellpadding=2 cellspacing=2 bgcolor=#FFFFFF><tr bgcolor=#FFFFFF><td width=180 class=\"Style3\">R&eacute;pertoire existant :</td><td><select name=\"folder\" style=\"width:240\">";
if($_GET["dir"] == "" || !is_dir($_GET["dir"])) $dir = getcwd();
else $dir = $_GET["dir"];
$dir = str_replace("\\", "/", $dir);
$i=-1;
$maxDepth=0;
$i++;
   if($checkDir = opendir($dir)){
       $cDir = 0;
       $cFile = 0;
       while($file = readdir($checkDir)){
           if($file != "." && $file != ".."){
               if(is_dir($dir . "/" . $file)){
                   $listDir[$cDir] = $file;
                   $cDir++;
               }
           }
       }
       if(count($listDir) > 0){
           sort($listDir);
           for($j = 0; $j < count($listDir); $j++){
                   $spacer = "";
                   for($l = 0; $l < $i; $l++) $spacer .= "&emsp;";
     		   $jb=$j+1;
                   print("<option value=\"".$listDir[$j]."\">".$listDir[$j]);
           }
	   $derdir=$listDir[$j];
       }
       closedir($checkDir);
   }
print "</select></td></tr><tr bgcolor=#FFFFFF><td width=180 class=Style3>ou nouveau r&eacute;pertoire :</td><td><INPUT type=text name=folder2 style=\"width:240\"></td></tr><tr bgcolor=#FFFFFF><td width=180 class=Style3>Image &agrave; mettre en ligne :</td><td width=228><input name=\"bilde_fil\" type=\"file\"><br></td></tr><tr><td width=180 class=Style3>Nom de l'image en ligne :</td><td><INPUT type=text name=nomfic style=\"width:240\"></td></tr>";
print "</tr><tr bgcolor=#FFFFFF></tr></table><span class=Style3><br></span><div align=\"center\" class=Style3><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"8000000\">";
$ttg2=urlencode($ttg);
print "<input type=\"hidden\" name=\"ttgz2\" value=$ttg2>";
print "<input type=\"submit\" value=\"Mettre en ligne\" name=\"submit\">";
print "<br>";
?> 
<br>
Powered by <a href="http://www.creation3d.org" target="_blank" class="Style10">creation3d.org</a></div>
</form></td></tr></table></td></tr></table></div></td></tr></table><br><br></body></html>