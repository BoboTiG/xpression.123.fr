<?
session_start();
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.0						 
/*											 
/***********************************************************************/

if (isset($_SESSION['admin']) && isset($_SESSION['racine'])) {
		header('Location: index.php');
		exit;
}

require ('../clsS.php');
require ('../functions.php');
$connect = New connect();
require "../langages/".$connect->check("Langage");
set_magic_quotes_runtime(0);

$Langage = $connect->check("Langage");
$Msg = $connect->check("Msg");
$Theme = $connect->check("Theme");
$TitreSite = $connect->check("Titresite");

$CssJs = New Templates();
$CssJs->SetFile('../templates/head.tpl');
$CssJs->Read();
$CssJs->SetEntry = array('js' => '../', 'css' => '../templates', 'titresite' => $TitreSite, 'theme' => $Theme);
$CssJs->SetEntry();
$CssJs->Write();

if (isset($_POST['IDENTIFY']) && $_POST['IDENTIFY'] == "IDENTIFY") {
	if ($connect->linesw('vars', 'Pseudo='.quote_smart($_POST['Pseudo']).' AND Pass="'.md5($_POST['Password']).'"') != 0) {
		$_SESSION['admin'] = "OK_IS_TRUE";
		$_SESSION['racine'] = realpath('../index.php');
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
		exit;
	}
}

$_Tmcopyright =& new Templates();
$_Tmcopyright->SetFile(array('../templates/'.$Theme.'/identify.tpl', '../templates/'.$Theme.'/copyright.tpl'));
$_Tmcopyright->Read();
$_Tmcopyright->SetVars = array('msglist', 'adminzone', 'pseudo', 'mdp', 'next');
$_Tmcopyright->SetVars();
$_Tmcopyright->Write();

?>