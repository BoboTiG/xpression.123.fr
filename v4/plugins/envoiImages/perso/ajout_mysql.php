<?php
	// If SSI.php is in the same place as this file, and SMF isn't defined, this is being run standalone.
	if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
		require_once(dirname(__FILE__) . '/SSI.php');
	// Hmm... no SSI.php and no SMF?
	elseif (!defined('SMF'))
		die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

global $db_prefix;

$requete = db_query("
	CREATE TABLE IF NOT EXISTS {$db_prefix}t2_images (
  `id` int(11) NOT NULL auto_increment ,
  `pseudo` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `nom` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `miniature` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `date` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `type` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `poids` int(11) NOT NULL ,
  `largeur` int(11) NOT NULL ,
  `hauteur` int(11) NOT NULL ,
  PRIMARY KEY (id)
) TYPE = MYISAM
");

if ($requete === FALSE)
	echo 'Problème rencontré lors de la création de la table !';


?>
