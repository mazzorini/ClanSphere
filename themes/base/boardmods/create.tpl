<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb">{lang:mod_name} - {lang:head_create}</td>
	</tr>
	<tr>
		<td class="leftb">{head:body}</td>
	</tr>
</table>
<br />

<form method="post" id="boardmods_create" action="{url:boardmods_create}">
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="leftc">{icon:personal} {lang:user} *</td>
		<td class="leftb">
			{bm:users_dropdown}
		</td>
	</tr>
	<tr>
		<td class="leftc">{icon:kedit} {lang:rank} *</td>
		<td class="leftb">
			{bm:cat_dropdown}
		</td>
	</tr>
	<tr>
		<td class="leftc">{icon:access} Rechte</td><td class="leftb">
			<input type="checkbox" name="boardmods_modpanel" value="1" {bm:boardmods_modpanel} />{lang:modpanel}<br />
			<input type="checkbox" name="boardmods_edit" value="1" {bm:boardmods_edit} />{lang:edit}<br />
			<input type="checkbox" name="boardmods_del" value="1" {bm:boardmods_del} />{lang:remove}
		</td>
	</tr>
	<tr>
		<td class="leftc">{icon:ksysguard} {lang:options}</td>
		<td class="leftb">
			<input type="submit" name="submit" value="{lang:create}" />
			<input type="reset" name="reset" value="{lang:reset}" />
		</td>
	</tr>
</table>
</form>
