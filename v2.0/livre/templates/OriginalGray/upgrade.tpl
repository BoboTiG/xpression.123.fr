<form method="post" action="[!action!]" enctype="multipart/form-data">
	
<div class="centre">
	<div class="title">[!titleupgrade!]</div>
	<div class="subtitle">[!upgrade!]</div>
	<div class="body">
		[!goupgrade!]
		<input type="hidden" name="POST" value="step_go">
	</div>
	<div class="bottom"><input type="button" id="back1" OnClick="return false;" value="[!back!]">&nbsp;&nbsp;<input type="submit" class="backnext" value="[!next!]"></div>
</div>
<script type="text/javascript">
	document.getElementById("back1").disabled = true;
</script>
</form>