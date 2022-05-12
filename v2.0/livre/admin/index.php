<?
session_start();
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.0						 
/*											 
/***********************************************************************/

if (!isset($_SESSION['admin']) or !isset($_SESSION['racine'])) {
		header('Location: identify.php');
		exit;
}
elseif (isset($_SESSION['racine']) && $_SESSION['racine'] != realpath('../index.php')) {
		header('Location: identify.php');
		exit;	
}

include ('../clsS.php');
include ('../functions.php');
set_magic_quotes_runtime(0);

$connect =& new connect();
$Langage = $connect->check("Langage");
$Theme = $connect->check("Theme");
$TitreSite = $connect->check("Titresite");
$Msg = $connect->check("Msg");

$CssJs = New Templates();
$CssJs->SetFile('../templates/head.tpl');
$CssJs->Read();
$CssJs->SetEntry = array('js' => '../', 'css' => '../templates', 'titresite' => $TitreSite, 'theme' => $Theme);
$CssJs->SetEntry();
$CssJs->Write();

require "../langages/".$connect->check("Langage");

echo '<noscript><meta http-equiv="Refresh" content="0;url=noscript.html"></noscript>';

#
# Config
#

$Error = '';

if (isset($_POST['CONFIG']) && $_POST['CONFIG'] == "yes") {
	if ($_SERVER["SERVER_NAME"] == $connect->check("Self")) {
	   $pseudo = trim($_POST['Pseudo']);
	   $titre = trim($_POST['Titrepage']);
	   $titre = (empty($titre)) ? 'Php-Book v.3 par KraK' : $titre;
	   $pass = trim($_POST['Password']);
	   $pass2 = trim($_POST['Password2']);
	   if (!strstr($pseudo, ' ') && $pass == $pass2) {
	      $Pseudo = (empty($pseudo)) ? quote_smart($connect->check("Pseudo")) : quote_smart($pseudo);
	      $Pass = (empty($pass)) ? $connect->check("Pass") : md5($pass);
	      $connect->query("UPDATE ".$db['prefix']."_vars SET Titresite=".quote_smart($titre).", Langage=".quote_smart($_POST['langage']).", Msg='".$_POST['msg_par_page']."', Theme=".quote_smart($_POST['Theme']).", Pseudo=".$Pseudo.", Pass='".$Pass."'");
	      echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=index.php">';
	      exit;
	   }
	   else {
	      $_TmError =& new Templates;
	      if ($pass != $pass2) {
		   $_TmError->SetFile('../templates/'.$Theme.'/error1.tpl');
	        $_TmError->Read();
	        $_TmError->SetVars = array('invalidpass' => 'mdpnotequal');
	        $_TmError->SetVars();
	      }
	      else {
		   $_TmError->SetFile('../templates/'.$Theme.'/error3.tpl');
	        $_TmError->Read();
	        $_TmError->SetVars = 'nospace';
	        $_TmError->SetVars();
	      }
	      $Error = $_TmError->read[0];
	   }
	}
}

#
# Langages
#

$langages = '';
$global_error = false;
$string_error = $lang['nokey'].':';
if ($handle = opendir('../langages')) {
   while (false !== ($file = readdir($handle))) {
	 $error = false;
      if ($file != "." && $file != "..") {
         if (substr($file, -4) == '.php') {
            ob_start();
            $before = get_defined_vars(); 
            include('../langages/'.$file);
            $after = get_defined_vars(); 
		  $diff = array_diff($after, $before);
		  foreach($diff As $var => $extra) {
		     if ($var != 'name_lang') {
			   $error = true; 
		     }
		     if ($error == true) {
				if (!strstr($string_error, $file)) $string_error .= '<br><u>'.$file.'</u><br>';
				$string_error .= '[!!!]<br>';
				$global_error = true;  		        
		     }
		  } 
               if (ob_get_length() == 0) { 
			   if (!isset($lang) OR !isset($name_lang)) {
				if (!strstr($string_error, $file)) $string_error .= '<br><u>'.$file.'</u><br>';
				$string_error .= '$name_lang<br>';
				$error = true; 
				$global_error = true;  
			   }
			   reset($base_lang);
			   while(list(,$value) = each($base_lang)) { 
			      if (!isset($lang[$value])) { 
					if (!strstr($string_error, $file)) $string_error .= '<br><u>'.$file.'</u><br>';
					$string_error .= $value.'<br>';
					$error = true; 
					$global_error = true;  
			      } 
			   } 
			   if (!$error) { 
			      $selected = ($file == $Langage) ? 'selected="selected"' : ''; 
			      $langages .= '<option value="'.$file.'" '.$selected.'>'.$name_lang.'</option>'; 
			   } 
			   unset($lang); 
			   unset($name_lang); 
               }
            ob_end_clean();
	    }
	 }
   }
   closedir($handle);
}
require "../langages/".$connect->check("Langage");
$string_errorlang = ($global_error == true) ? addslashes($string_error) : '<center>'.$lang['noadlang'].'</center>';

#
# Messages par page
#

$msg_per_page = '';
for ($i = 1; $i <= 100; $i++) {
   if ($i == $Msg) $checked = "selected"; else $checked = "";
   $msg_per_page .= "<option ".$checked." value='".$i."'>".$i."</option>";
}

#
# Theme
#

$themes = '';
$global_error = false;
$string_error = $lang['nofile'].':';
$needed_files = array("add.tpl", "admin.tpl", "body.tpl", 'error3.tpl', "error2.tpl", "nomsg.tpl", "style.css", "restore.tpl", "pages.tpl", 'close.tpl', 'admin_edit.tpl', 'edit.tpl',
						  'identify.tpl', 'nobdd.tpl', 'copyright.tpl', 'newadmin.tpl', 'error4.tpl', 'error5.tpl', 'bann.tpl', 'error1.tpl', 'admin_msg.tpl', 'admin_msgblock.tpl'); 
if ($dh = opendir('../templates')) {
	while ($dir = readdir($dh)) {
		$list_of_files = array();
		if ($dir != ".." && $dir != ".") {
			if (is_dir('../templates/'.$dir)) {
				$list = opendir('../templates/'.$dir);
				while ($files = readdir($list)) {
					if ($files != ".." && $files != ".") $list_of_files[] = $files;
				}
				$error = false;
				closedir($list);
				reset($needed_files);
				while(list(,$needed) = each($needed_files)) { 
					if(!in_array($needed, $list_of_files)) {
						if (!strstr($string_error, $dir)) $string_error .= '<br><u>'.$dir.'</u><br>';
					     $string_error .= $needed.'<br>';
						$error = true; 
						$global_error = true; 
					}
				} 
				if (!$error) {
					$checked = ($dir == $Theme) ? "selected='seleted'" : "";
					$themes .= "<option ".$checked." value='".$dir."'>".$dir."</option>";
				}
			}
		}
	}
	closedir($dh);
}
$string_error = ($global_error == true) ? addslashes($string_error) : '<center>'.$lang['noadvertissment'].'</center>';

#
# Bann
#

if ($connect->lines("bann") != 0) {
	$bann = "<form method='post' name='DO_BANN' action='bann.php'".
			   "enctype='multipart/form-data'><select size='3' ".
			   "style='height:100px' mutiple name='bannlist'>";
			
	$connect->query("SELECT ip FROM ".$db['prefix']."_bann");
	while (list($ip) = mysql_fetch_array($connect->query)) {
		$bann .= "<option value='".$ip."'>".$ip."</option>";
     }
	$bann .= "</select><input type='hidden' name='START_BANN' value='yes'>";
	$_TmRestore =& new Templates();
	$_TmRestore->SetFile('../templates/'.$Theme.'/restore.tpl');
	$_TmRestore->Read();
	$_TmRestore->SetVars = 'restore';
	$_TmRestore->SetVars();
	$bann .= $_TmRestore->read[0];
}
else {
     global $lang;
	$bann = $lang["nobann"];
}

#
#  End
#

$_TmAdmin =& new Templates;
$_TmAdmin->SetFile('../templates/'.$Theme.'/admin.tpl');
$_TmAdmin->Read();
$_TmAdmin->SetVars = array('msglist', 'pannel', 'newmsg', 'newmsgprint', 'config', 'msgperpage', 'lang', 'theme',
								    'pseudo', 'mdp', 'identification', 'save', 'default', 'list', 'addip', 'add', 'confirm', 'titlepage', 'deletethefiles', 'adminmsg');

$_TmAdmin->SetEntry = array('nbmsg' => $connect->linesw('msg', 'id>'.$connect->check('last_id').''), 'currentpseudo' => htmlspecialchars($connect->check('Pseudo'), ENT_QUOTES), 
									'options' => $msg_per_page, 'optionslang' => $langages, 'optionstheme' => $themes, 'contentbann' => $bann, 'errorinfos' => $Error,
									'themeinfos' => $string_error, 'langinfos' => $string_errorlang, 'currenttitle' => htmlspecialchars($TitreSite, ENT_QUOTES));
$_TmAdmin->SetEntry();
$_TmAdmin->SetVars();
$_TmAdmin->Write();

#
# Messages 
#

$content_msg = '';
if ($connect->lines('msg') > 0) {
   $connect->query("SELECT Id, Pseudo, Text from `".$db['prefix']."_msg` ORDER BY Id DESC");
   while (list($id, $auteur, $text) = mysql_fetch_array($connect->query)) {
     $text = (strlen($text) > 40) ? '<a href="javascript:openmsg('.$id.')" class="a_admin" title="'.$lang['entiremsg'].'">'.bbcode(substr($text, 0, 40), 'no_img').'...</a>' : bbcode($text, 'no_img');
	 $_Tmmsg =& new Templates();
	 $_Tmmsg->SetFile("../templates/".$Theme."/admin_msg.tpl");
	 $_Tmmsg->Read();
	 $_Tmmsg->SetEntry = array('auteur' => htmlspecialchars($auteur), 'msg' => $text, 'id' => $id);
	 $_Tmmsg->SetEntry();
      $content_msg .= $_Tmmsg->read[0];
   }
   $_TmMsgAdmin =& new Templates();
   $_TmMsgAdmin->SetFile("../templates/".$Theme."/admin_msgblock.tpl");
   $_TmMsgAdmin->Read();
   $_TmMsgAdmin->SetVars = array('body', 'author', 'edit', 'justdelete', 'adminmsg', 'deletethefiles');
   $_TmMsgAdmin->SetVars();
   $_TmMsgAdmin->SetEntry = array('msg' => $content_msg);
   $_TmMsgAdmin->SetEntry();
   $_TmMsgAdmin->Write();
}
else {
   $content_msg = '<tr><td colspan="3" align="center">Aucun message</td></tr>';
}

#
# Copyright
#

$_Tmcopyright = new Templates();
$_Tmcopyright->SetFile('../templates/'.$Theme.'/copyright.tpl');
$_Tmcopyright->Read();
$_Tmcopyright->Write();

$connect->query("SELECT id FROM ".$db['prefix']."_msg ORDER BY id DESC");
list($id) = mysql_fetch_array($connect->query);
$connect->query("UPDATE ".$db['prefix']."_vars SET Last_Id='".$id."'");
	
?>