<form name="IDENTIFY" action="identify.php" method="post" enctype="multipart/form-data">

<div class="blocknew" style="height:19px;padding-top:4px;"><img src="../templates/OriginalGray/images/list.gif"> <a href="../index.php" class="titre">[!msglist!]</a> > [!adminzone!]</div>
<div class="bodyadd">
	<label for="Pseudo">[!pseudo!] </label> <input type="text" name="Pseudo" id="Pseudo"><br>
	<label for="Password">[!mdp!] </label> <input type="password" name="Password" id="Password"><br>
</div>
<div class="bottomadd">
	<input type="submit" value="[!next!]" name="Submit" OnClick="this.form.Submit.disabled = 'true';this.form.submit();">
</div>

<input type="hidden" name="IDENTIFY" value="IDENTIFY">
</form>		


