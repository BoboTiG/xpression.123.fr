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

$connect =& new connect();

if (isset($_GET['id']) && $_SESSION['admin'] == "OK_IS_TRUE" && is_numeric($_GET['id'])) {
	$connect->query("DELETE FROM ".$db['prefix']."_msg WHERE id='".$_GET['id']."'");
}

$connect->close();
header('Location: ../index.php');
?>