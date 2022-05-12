<form method="post" action="[!action!]" enctype="multipart/form-data">
	
<table align="center" border="0" width="50%" cellspacing="0" cellpadding="0">

	<tr><td class="Titre1" valign="middle" colspan="3">[!titleupgrade!]</td></tr>
	<tr><td style="padding:2px"><b>[!upgrade!]</b></td></tr>
	<tr><td style="padding:5px">
		[!goupgrade!]
		<input type="hidden" name="POST" value="step_go">
	</td></tr>
	<tr><td align="right"><input type="button" id="back1" OnClick="return false;" value="[!back!]">&nbsp;&nbsp;<input type="submit" class="backnext" value="[!next!]">
</table>

<script type="text/javascript">
	document.getElementById("back1").disabled = true;
</script>
</form>