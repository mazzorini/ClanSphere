<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
	<tr>
		<td class="headb">{lang:mod} - {lang:remove}</td>
	</tr>
	<tr>
		<td class="centerb">{maps:message}</td>
	</tr>
	<tr>
		<td class="centerb">
			<form method="post" name="maps_remove" action="{maps:action}">
				<input type="hidden" name="maps_id" value="{maps:maps_id}"  />
				<input type="submit" name="agree" value="{lang:confirm}"  />
				<input type="submit" name="cancel" value="{lang:cancel}"  />
			</form>
		</td>
	</tr>
</table>