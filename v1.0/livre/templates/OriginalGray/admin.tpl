<form name="CONFIG" action="index.php" method="post" enctype="multipart/form-data">

<div class="blocknew" style="height:19px;padding-top:4px;"><img src="../templates/OriginalGray/images/list.gif"> <a href="../index.php" class="titre">[!msglist!]</a> > [!pannel!]</div>
<div class="titleadd"> [!newmsg!]:</div>
<div class="bodyadd">
<center>[!nbmsg!] [!newmsgprint!]</center>
</div>

<div class="titleadd"> [!config!]:</div>
<div class="bodyadd">
	<label for="Titre">[!titlepage!] </label> <input type="text" name="Titrepage" id="Titre" value="[!currenttitle!]"><br>
	<label for="Msg">[!msgperpage!] </label> <select name="msg_par_page" id="Msg">[!options!]</select><br>
	<label for="LangageLabel">[!lang!] </label> <select name="langage" id="LangageLabel">[!optionslang!]</select> &nbsp;&nbsp;
	<a href="#" class="help" onmouseover="return overlib('[!langinfos!]', FGCOLOR, 'white', BGCOLOR, 'black', BORDER, 1, TEXTFONT, 'Arial', TEXTSIZE, 1);" onmouseout="return nd();">
	<img src="../images/smilies/nosmile.gif" style="vertical-align:top;padding-top:1px"></a><br>
	<label for="ThemeLabel">[!theme!] </label> <select name="Theme" id="ThemeLabel">[!optionstheme!]</select> &nbsp;&nbsp;
	<a href="#" class="help" onmouseover="return overlib('[!themeinfos!]', FGCOLOR, 'white', BGCOLOR, 'black', BORDER, 1, TEXTFONT, 'Arial', TEXTSIZE, 1);" onmouseout="return nd();">
	<img src="../images/smilies/nosmile.gif" style="vertical-align:top;padding-top:1px"></a>
</div>

<div class="titleadd"> [!identification!]:</div>
[!errorinfos!]
<div class="bodyadd">
	<label for="Pseudo">[!pseudo!] </label> <input type="text" name="Pseudo" id="Pseudo" maxlength="10" value="[!currentpseudo!]"><br>
	<label for="Mdp1">[!mdp!] </label> <input type="password" name="Password" id="Mdp1"><br>
	<label for="Mdp2">[!confirm!] </label> <input type="password" name="Password2" id="Mdp2">
</div>

<div class="bottomadd">
	<input type="hidden" name="CONFIG" value="yes">
	<input type="reset" value="< [!default!]">
	&nbsp;&nbsp;&nbsp;<input type="submit" value="[!save!] >" name="Submit">
</div>

<div style="height:10px"></form></div>

<div class="titleadd" style="border-top:1px solid #989898"> [!list!]:</div>
<div class="bodyadd">
<center>[!contentbann!]</center>
<form name="IP" action="bann.php" method="post" enctype="multipart/form-data">
[!addip!]: 
	<input type="text" OnKeyPress="return checkentry(this.form.ip1)" id="ip1" size="3" maxlength="3" name="ip1">.
	<input type="text" OnKeyPress="return checkentry(this.form.ip2)" id="ip2" size="3" maxlength="3" name="ip2">.
	<input type="text" OnKeyPress="return checkentry(this.form.ip3)" id="ip3" size="3" maxlength="3" name="ip3">.
	<input type="text" OnKeyPress="return checkentry(this.form.ip4)" id="ip4" size="3" maxlength="3" name="ip4">
</div>
						
<div class="bottomadd">
	<input type="hidden" name="START_BANN" value="Add">
	<input type="submit" value="[!add!] >">
</div>

<div style="height:10px"></form></div>