<?php
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.1						 
/*											 
/***********************************************************************/

include("clsS.php");
include("functions.php");

function findlang($thelang) {
   return $thelang = ($thelang == "English.lg") ? 'en.php' : 'fr.php';
}

if ((isset($_POST['POST']) && $_POST['POST'] != 'is_upgraded') || !isset($_POST['POST'])) $db['prefix'] = 'seebook';

$connect = New connect();
$language = findlang($connect->check("Langage"));
require "langages/".$language;
$Theme = $connect->check("Theme");

$CssJs = New Templates();
$CssJs->SetFile('templates/head.tpl');
$CssJs->Read();
$CssJs->SetEntry = array('js' => '', 'css' => 'templates', 'titresite' => 'Mise à jour de Php-Book v2.1 vers 3.2', 'theme' => $Theme);
$CssJs->SetEntry();
$CssJs->Write();

if (isset($_POST['POST'])) {
   if ($_POST['POST'] == 'is_upgraded') {
      $_TmUpgrade =& new Templates;
      $_TmUpgrade->SetFile("templates/".$Theme."/upgrade.tpl");
      $_TmUpgrade->Read();
      $_TmUpgrade->SetVars = array("titleupgrade" => "upgradesuccess", "goupgrade" => "see", "back", "next", "upgrade");
      $_TmUpgrade->SetVars();
      $_TmUpgrade->SetEntry = array("action" => "index.php");
      $_TmUpgrade->SetEntry();
      $_TmUpgrade->Write();
      exit;
   }
   set_magic_quotes_runtime(0);
   $connect->query("SELECT Dir FROM `seebook_vars`");
   list($dir) = mysql_fetch_array($connect->query);
   
   if ($dh = opendir($dir)) {
      while ($file = readdir($dh)) {
	   if ($file != ".." && $file != ".") {
	      if (is_file($dir.'/'.$file) &&
		    ($file == "identify.php" ||
		    $file == "delete.php" ||
		    $file == "bann.php" ||
		    $file == "clsS.php" ||
		    $file == "index.php")) {
		       unlink($dir.'/'.$file);
	      }
	   }
	}
   }
   
   $connect->query("ALTER TABLE `seebook_msg` CHANGE `Titre` `Note` ENUM( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) NOT NULL");
   $connect->query("ALTER TABLE `seebook_vars` CHANGE `Dir` `Titresite` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL");
   $connect->query("SHOW TABLES FROM `".$db['db']."`");
   $tables = array();
   while ($row = mysql_fetch_row($connect->query)) {
      if (!in_array(substr($row[0], 0, 7), $tables)) {
	   $tables[] = substr($row[0], 0, 7);
      }
   }
   $prefix = 'phpbook';
   while (in_array($prefix, $tables)) {
      $id = rand(0, 99);
      $prefix = 'phpbook'.$id;
   }

   $connect->query("ALTER TABLE `seebook_msg` RENAME `".$prefix."_msg`");
   $connect->query("ALTER TABLE `seebook_vars` RENAME `".$prefix."_vars`");
   $connect->query("ALTER TABLE `seebook_bann` RENAME `".$prefix."_bann`");
   $connect->query("UPDATE `".$prefix."_vars` SET `Langage` = '".$language."', `Titresite` = 'Php-Book v3.1 par KraK'");
   
   $open = fopen('config.inc.php', 'r+');
   $content = fread($open, filesize('config.inc.php'));
   $content = str_replace('?>', '', $content);
   $content .= "\r\n".'$db[\'prefix\']'." = \"".$prefix."\";\r\n".'?>';
   
   fwrite($open, $content);
   fclose($open);
   echo '<noscript><META HTTP-EQUIV="refresh" CONTENT="0;URL=index.php"></noscript>';
   echo '<form method="post" name="endinstall" enctype="multipart/form-data"><input type="hidden" name="POST" value="is_upgraded"></form>';
   echo '<script type="text/javascript">'
          .'document.endinstall.submit();'
          .'</script>';
   exit;
}
else {
   $_TmUpgrade =& new Templates;
   $_TmUpgrade->SetFile("templates/".$Theme."/upgrade.tpl");
   $_TmUpgrade->Read();
   $_TmUpgrade->SetVars = array("titleupgrade", "goupgrade", "back", "next", "upgrade");
   $_TmUpgrade->SetVars();
   $_TmUpgrade->SetEntry = array("action" => "");
   $_TmUpgrade->SetEntry();
   $_TmUpgrade->Write();
}
?>