<form name="ADD" action="index.php?mode=post" method="post" enctype="multipart/form-data">

<div class="blocknew" style="height:19px;padding-top:4px;"><img src="templates/OriginalGray/images/list.gif"> <a href="index.php" class="titre">[!msglist!]</a> > [!addnote!]</div>
<div class="titleadd"> [!headmsg!]:</div>
[!errorinfos!]
<div class="bodyadd">
	<label for="Pseudo">[!pseudo!] *</label> <input type="text" name="Pseudo" id="Pseudo" value="[!PSEUDO!]"><br>
	<label for="Note">[!note!] </label> 
	<select id="Note" name="Note" OnChange="changeimg(document.ADD.Note.value, 'vertical-align:top;padding-top:1px')">
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
	</select>
	&nbsp;&nbsp;&nbsp;<span id="smile"><img src="images/smilies/hey.gif" style="vertical-align:top;padding-top:1px"></span>
	<br>
	<label for="Url">[!site!]</label> <input type="text" name="Url" id="Url" value="[!URL!]"><br>
	<label for="Email">[!email!]</label> <input type="text" name="Email" id="Email" value="[!EMAIL!]"><br>
</div>
<div class="titleadd"> [!body!]: *</div>
[!errormsg!]
<div class="bodyadd">
	<div class="align">
	<select OnChange="if(document.forms['ADD'].elements['color'].value != 0) Insert(document.forms['ADD'].elements['color'].value, '[/color]')" name="color" style="width:80px">
	<option value="0">[!colors!]</option>
	<option value="[color=blue]" style="color: blue;">[!blue!]</option>
	<option value="[color=red]" style="color: red;">[!red!]</option>
	<option value="[color=orange]" style="color: orange;">[!orange!]</option>
	<option value="[color=purple]" style="color: purple;">[!purple!]</option>
	<option value="[color=yellow]" style="color: yellow;">[!yellow!]</option>
	<option value="[color=gray]" style="color: gray;">[!gray!]</option>
	<option value="[color=green]" style="color: green;">[!green!]</option>
	</select>
	
	<select OnChange="if(document.forms['ADD'].elements['size'].value != 0) Insert(document.forms['ADD'].elements['size'].value, '[/size]')" name="size" style="width:80px">
	<option value="0">[!size!]</option>
	<option value="[size=8]">[!vsmall!]</option>
	<option value="[size=10]">[!small!]</option>
	<option value="[size=14]">[!big!]</option>
	<option value="[size=18]">[!vbig!]</option>
	</select>
	
	<input type="button" class="button" OnClick="Insert('[url=http://]', '[/url]');return(false);" value="Url">
	<input type="button" class="button" OnClick="Insert('[B]', '[/B]');return(false);" value="B">
	<input type="button" class="button" OnClick="Insert('[I]', '[/I]');return(false);" value="I">
	<input type="button" class="button" OnClick="Insert('[U]', '[/U]');return(false);" value="U">
		
	<textarea name="Texte">[!TEXTE!]</textarea>
	
	<br>
	<a href="#" class="smilie" OnClick="Insert(' :D ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/veryhappy.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :) ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/happy.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :( ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/sad.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :!!: ', '' )"><img style="vertical-align:middle" border="0" src="images/smilies/nervos.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :p: ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/lol.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :?? ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hein.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' ;) ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hey.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :hi: ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/hi.gif"></a>
	<a href="#" class="smilie" OnClick="Insert(' :o: ', '')"><img style="vertical-align:middle" border="0" src="images/smilies/haha.gif"></a>
	
	<input type="hidden" name="POST" value="yes">	
	</div>
</div>
<div class="bottomadd">
	&nbsp;&nbsp;&nbsp;<input type="reset" value="< [!restart!]">
	<input type="submit" value="[!addmynote!] >" name="Submit" OnClick="this.form.Submit.disabled = 'true';this.form.submit();">
</div>

