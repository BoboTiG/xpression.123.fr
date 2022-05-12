<form name="CONFIG" action="index.php" method="post" enctype="multipart/form-data">

<table align="center" border="0" width="50%" cellspacing="0" cellpadding="0">

	<tr><td class="Titre1" valign="middle" colspan="3"><a href="../index.php" class="titre">[!msglist!]</a> > [!pannel!]</td></tr>
	
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;border-top: none;padding:5px"><b>[!newmsg!]:</b></td>
	</tr>
	
	<tr>
	<td colspan="3" align="center" style="border:1px solid gray;border-top:none;;padding:5px" height="10">
		[!nbmsg!] [!newmsgprint!]
	</td>
	</tr>
	
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;border-top: none;padding:5px"><b>[!config!]:</b></td>
	</tr>
	
	<tr>
		<td colspan="3">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px" height="10">&nbsp;</td>
					<td height="10" width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>		
					<td height="10" style="border-right:1px solid gray;" bgcolor="EDF0FC">&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!titlepage!]:</td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>		
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="text" name="Titrepage" value="[!currenttitle!]"></td>
				</tr>	
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!msgperpage!]:</td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>		
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><select name="msg_par_page" style="width:50px">[!options!]</select></td>
				</tr>
	
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!lang!] :</td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><select name="langage">[!optionslang!]</select>&nbsp;&nbsp;
					<a href="#" onmouseover="return overlib('[!langinfos!]', FGCOLOR, 'white', BGCOLOR, 'black', BORDER, 1, TEXTFONT, 'Arial', TEXTSIZE, 1);" onmouseout="return nd();"><img src="../images/smilies/nosmile.gif" style="vertical-align:top;padding-top:1px"></a></td>
				</tr>
	
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!theme!]: </td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><select name="Theme">[!optionstheme!]</select>&nbsp;&nbsp;
					<a href="#" onmouseover="return overlib('[!themeinfos!]', FGCOLOR, 'white', BGCOLOR, 'black', BORDER, 1, TEXTFONT, 'Arial', TEXTSIZE, 1);" onmouseout="return nd();"><img src="../images/smilies/nosmile.gif" style="vertical-align:top;padding-top:1px"></a></td>
				</tr>
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;border-top:none;border-bottom:none;padding:5px"><b>[!identification!]:</b></td>
	</tr>
				[!errorinfos!]								
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!pseudo!]: </td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="text" name="Pseudo" maxlength="10" value="[!currentpseudo!]">
				</tr>
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!mdp!]: </td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="password" name="Password">
				</tr>
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!confirm!]: </td>
					<td width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="password" name="Password2">
				</tr>
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px" height="10">&nbsp;</td>
					<td height="10" width="50" style="background:url('../templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="../templates/OriginalBlue/images/back.gif"></td>		
					<td height="10" style="border-right:1px solid gray;" bgcolor="EDF0FC">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td style="border:1px solid gray;border-bottom:none;padding:5px;" colspan="3">
			<input type="hidden" name="CONFIG" value="yes">
			<center><input type="submit" style="height:20px;font-size:10px" value="[!save!]" name="Submit">&nbsp;&nbsp;&nbsp;<input type="reset" style="height:20px;font-size:10px" value="[!default!]"></center>
		</td>
		</form>
	</tr>
	
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;border-bottom:none;padding:5px"><b>[!list!]:</b></td>
	</tr>
	
	<tr>
	<td colspan="3" align="center" style="border:1px solid gray;border-bottom:none;padding:5px" height="10">[!contentbann!]</td>
	</tr>
	<tr>
		<form name="IP" action="bann.php" method="post" enctype="multipart/form-data">
		<td colspan="3" style="border:1px solid gray;border-top:none;padding:5px" height="10">
			<table>
				<tr>
					<td>
						[!addip!]: 
						<input type="text" OnKeyPress="return checkentry(this.form.ip1)" id="ip1" size="3" style="height: 17px;font-size:11px;text-align:center" maxlength="3" name="ip1">.
						<input type="text" OnKeyPress="return checkentry(this.form.ip2)" id="ip2" size="3" style="height: 17px;font-size:11px;text-align:center" maxlength="3" name="ip2">.
						<input type="text" OnKeyPress="return checkentry(this.form.ip3)" id="ip3" size="3" style="height: 17px;font-size:11px;text-align:center" maxlength="3" name="ip3">.
						<input type="text" OnKeyPress="return checkentry(this.form.ip4)" id="ip4" size="3" style="height: 17px;font-size:11px;text-align:center" maxlength="3" name="ip4">
					</td>
					<td style="padding-left:3px">
						<input type="hidden" name="START_BANN" value="Add">
						<input type="submit" value="[!add!]" style="height:19px;font-size:10px;">
					</td>
				</tr>
			</table>
		</td>
		</form>
	</tr>
	
</table>