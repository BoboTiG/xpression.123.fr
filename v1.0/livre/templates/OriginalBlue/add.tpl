<form name="ADD" action="index.php?mode=post" method="post" enctype="multipart/form-data">

<table align="center" border="0" width="50%" cellspacing="0" cellpadding="0">

	<tr><td class="Titre1" valign="middle" colspan="3"><a href="index.php" class="titre">[!msglist!]</a> > [!addnote!]</td></tr>
		
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;border-top: none;padding:5px"><b>[!headmsg!]:</b></td>
	</tr>
	
	<tr>
		<td colspan="3">
			<table width="100%" cellpadding="0" cellspacing="0">
				
				[!errorinfos!]
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px" height="10">&nbsp;</td>
					<td height="10" width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>		
					<td height="10" style="border-right:1px solid gray;" bgcolor="EDF0FC">&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!pseudo!] <font color="red">*</font>:</td>
					<td width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>		
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="text" value="[!PSEUDO!]" name="Pseudo" maxlength="20"></td>
				</tr>
	
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!note!]:</td>
					<td width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><select id="Note" name="Note" OnChange="changeimg(document.ADD.Note.value, 'vertical-align:top;padding-top:1px')">
					<option value="10">10/10</option>
					<option value="9">9/10</option>
					<option value="8">8/10</option>
					<option value="7">7/10</option>
					<option value="6">6/10</option>
					<option value="5" selected="selected">5/10</option>
					<option value="4">4/10</option>
					<option value="3">3/10</option>
					<option value="2">2/10</option>
					<option value="1">1/10</option>
					<option value="0">0/10</option>
					<option value="-">Pas d'opinion</option>
					</select>&nbsp;&nbsp;&nbsp;<span id="smile"><img src="images/smilies/hey.gif" style="vertical-align:top;padding-top:1px"></span></td>
				</tr>
	
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!site!]: <font style="font-size:11px">([!with!] http://)</font></td>
					<td width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input type="text" value="[!URL!]" name="Url" maxlength="50"></td>
				</tr>
	
				<tr>
					<td style="border-left:1px solid gray;padding-left:5px">[!email!]:</td>
					<td width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>
					<td bgcolor="EDF0FC" style="border-right:1px solid gray;"><input value="[!EMAIL!]" type="text" name="Email" maxlength="40"></td>
				</tr>

				<tr>
					<td style="border-left:1px solid gray;padding-left:5px" height="10">&nbsp;</td>
					<td height="10" width="50" style="background:url('templates/OriginalBlue/images/back.gif');background-repeat:repeat-y"><img src="templates/OriginalBlue/images/back.gif"></td>		
					<td height="10" style="border-right:1px solid gray;" bgcolor="EDF0FC">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
		
	<tr>
		<td colspan="3" bgcolor="EDF0FC" style="border:1px solid gray;padding:5px"><b>[!body!]:</b></td>
	</tr>	
	
	[!errormsg!]
	
	<tr>
		<td style="border-left:1px solid gray;border-right:1px solid gray;padding-left:5px;padding-right:5px" colspan="3">

			<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td valign="middle" height="29">
						<select OnChange="Insert(document.forms['ADD'].elements['color'].value, '[/color]')" name="color" style="width:80px">
						<option value="">[!colors!]</option>
						<option value="[color=blue]" style="color: blue;">[!blue!]</option>
						<option value="[color=red]" style="color: red;">[!red!]</option>
						<option value="[color=purple]" style="color: purple;">[!purple!]</option>
						<option value="[color=orange]" style="color: orange;">[!orange!]</option>
						<option value="[color=yellow]" style="color: yellow;">[!yellow!]</option>
						<option value="[color=gray]" style="color: gray;">[!gray!]</option>
						<option value="[color=green]" style="color: green;">[!green!]</option>
						</select>
					</td><td> 
						<select OnChange="Insert(document.forms['ADD'].elements['size'].value, '[/size]')" name="size" style="width:80px">
						<option value="">[!size!]</option>
						<option value="[size=8]">[!vsmall!]</option>
						<option value="[size=10]">[!small!]</option>
						<option value="[size=14]">[!big!]</option>
						<option value="[size=18]">[!vbig!]</option>
						</select>
					</td>
					<td valign="middle" height="29">
						<a href="#" class="options" OnClick="Insert('[url=http://]', '[/url]')">Url</a>
						<a href="#" class="options" OnClick="Insert('[B]', '[/B]')"><b>B</b></a>
						<a href="#" class="options" OnClick="Insert('[I]', '[/I]')"><i>I</i></a>
						<a href="#" class="options" OnClick="Insert('[U]', '[/U]')"><u>U</u></a>
					</td>
					</tr>
					<tr>
					<td colspan="3" >
						<a href="#" class="smilie" OnClick="Insert(' :D ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/veryhappy.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :) ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/happy.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :( ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/sad.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :!!: ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/nervos.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :p ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/lol.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :?? ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hein.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' ;) ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hey.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :hi: ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hi.gif"></a>
						<a href="#" class="smilie" OnClick="Insert(' :o ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/haha.gif"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td style="border-left:1px solid gray;border-right:1px solid gray;padding-left:5px;padding-right:5px" colspan="3">
			<br>[!msg!]: <font color="red">*</font><br>
			<center><textarea name="Texte">[!TEXTE!]</textarea></center>
		</td>
	</tr>
	
	<tr>
		<td style="border:1px solid gray;border-top:none;padding:5px;padding-top:0px;" colspan="3">
			<br>
			<input type="hidden" name="POST" value="yes">
			<center><input type="submit" style="height:20px;font-size:10px" value="[!addmynote!]" name="Submit" OnClick="this.form.Submit.disabled = 'true';this.form.submit();">&nbsp;&nbsp;&nbsp;<input type="reset" style="height:20px;font-size:10px" value="[!restart!]"></center>
		</td>
		</form>
	</tr>
		
</table>

