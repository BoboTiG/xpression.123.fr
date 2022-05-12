#!/bin/bash
#
# -------------------------------------------------------------
# Script par Tiger-222.
# Commencé le 15 Septembre 2007.
# Modifié le 16 Septembre 2007.
# -------------------------------------------------------------
# 
# Script d'installation de Xara Xtreme,
# pour Debian Etch utilisant Gnome.
#  
# Etre en root !! 
# Il faut le paquet libstdc++5 et imagemagick.
#  
# Il suffit de placer ce script dans le dossier d'extraction de RecomXaraLX0.7_rev1692.tar.bz2.
#  
# Il faut:
#   - modifier une ligne dans le fichier Xara Xtreme
#   - modifier une ligne dans le fichier xaralx.xml
#   - déplacer xaralx.png vers /share/xaralx/
#   - copier share/xaralx dans /usr/share/
#   - copier Xara Xtreme dans /usr/share/applications/
#   - copier xaralx.xml dans /usr/share/mime/application/
#   - copier /bin/* dans /usr/bin/
#   - copier /mime-storage/gnome/xaralx.keys dans /usr/share/mime-info/
#   - copier /mime-storage/gnome/xaralx.mime dans /usr/share/mime-info/
#   - copier /mime-storage/gnome/xaralx.applications dans /usr/share/application-registry/
#
#############################################################

clear

# regarde si le script est lancé par root, sinon il s'achève ici.
# le fait d'ajouter l'option -e pour echo signifie qu'il va y avoir une couleur.
# en ajoutant "\033[1m" dant la phrase et "\033[0m" derrière, on choisi la couleur.
if [ "$UID" -ne "0" ]; then 
	echo ''
	echo -e '\033[1m Vous devez lancer ce script en tant que ROOT. \033[0m'
	echo ''
	exit
fi

# menu
echo ''	
echo -e "    Script d'installation pour \033[1mXara Xtreme\033[0m v0.7"
echo -e "        \033[1mTiger-222\033[0m - http://xpression.123.fr"
echo '                          ---'
echo  '                           15-16 Septembre 2007'
echo ''
echo '---------------------------------------------------'
echo '---------------------------------------------------'
echo ''
echo -e ' [T]\303\251l\303\251charger et installer Xara Xtreme'
echo ' [S]upprimer Xara Xtreme'
echo ' [Q]uitter'
echo ''

# lecture de ce que l'utilisateur entrera
read choix 
# on récupère la touche entrée par l'utilisateur dans la variable choix
case "$choix" in 


# si la touche t ou T est activée, alors le téléchargement puis l'installation se lancent.
"T" | "t" ) 
clear
echo "###############################################"
echo -e "#   \033[1m[T]\303\251l\303\251charger et installer Xara Xtreme\033[0m    #"
echo "###############################################"
echo ''
# 1. récupération de l'archive:
# wget http://downloads.xara.com/opensource/RecomXaraLX0.7_rev1692.tar.bz2
wget http://xpression.123.fr/v3.1/depot/recomXaraLX0.7_rev1692.tar.bz2
# 2. on renomme l'archive:
mv -fv RecomXaraLX0.7_rev1692.tar.bz2 /opt/xaralx.tar.bz2
# 3. décompression de l'archive:
tar jvxf /opt/xaralx.tar.bz2 -C /opt/
# 4. on commence les ajouts, copies et déplacements:
cp -fv /opt/xaralx/xaralx.desktop /usr/share/applications/xaralx.desktop
cp -fv /opt/xaralx/bin/xaralx /usr/bin/xaralx
cp -fv /opt/xaralx/bin/xarasvgfilter /usr/bin/xarasvgfilt
cp -fv /opt/xaralx/bin/xarasvgfilterui /usr/bin/xarasvgfilterui
cp -fv /opt/xaralx/mime-storage/gnome/xaralx.keys /usr/share/mime-info/xaralx.keys
cp -fv /opt/xaralx/mime-storage/gnome/xaralx.mime /usr/share/mime-info/xaralx.mime
cp -fv /opt/xaralx/mime-storage/gnome/xaralx.applications /usr/share/application-registry/xaralx.applications
cp -fv /opt/xaralx/xaralx.xml /usr/share/mime/application/xaralx.xml
mkdir /usr/share/xaralx
cp -rfv /opt/xaralx/share/xaralx/* /usr/share/xaralx/
# 5. suppression des fichiers téléchargés:
rm -vrf /opt/xaralx
rm -vf /opt/xaralx.tar.bz2
# 6. installation des paquets d'imagemagick et libstdc++5:
yes | apt-get install libstdc++5
yes | apt-get install imagemagick
# on ferme le choix par un double point-virgule:
;;


# si la touche s ou S est activée, on supprime tout!
"S" | "s" ) 
clear
echo "###############################################"
echo -e "#         \033[1m[S]upprimer Xara Xtreme\033[0m             #"
echo "###############################################"
echo ''
# suppression des dossiers et fichiers:
rm -fv /usr/bin/xaralx
rm -fv /usr/bin/xarasvgfilter
rm -fv /usr/bin/xarasvgfilterui
rm -rfv /usr/share/xaralx
rm -fv /usr/share/applications/xaralx.desktop
rm -fv /usr/share/mime-info/xaralx.keys
rm -fv /usr/share/mime-info/xaralx.mime
rm -fv /usr/share/application-registry/xaralx.applications
rm -fv /usr/share/mime/application/xaralx.xml
echo ''
echo ''
echo -e ' Suppression de Xara Xtreme v0.7 confirm\303\251e.'
echo ''
echo ''
;;


# si la touche q ou Q est activée, direction la sortie.
"Q" | "q" ) 
clear
;;

esac # pour fermer les choix

echo " #####################################"
echo -e "             Op\303\251ration termin\303\251e"
echo " #####################################"
echo ''

exit 0
