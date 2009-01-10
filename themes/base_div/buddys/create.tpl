<div class="container" style="width:{page:width}">
	<div class="headb">
{lang:mod} - {lang:head_create}
	</div>
	<div class="leftb">
{lang:head}
    </div>
</div>
<br />

{if:form}
<form method="post" name="buddys_create" action="{url:buddys_create}">
<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
<tr><td class="leftc">
{icon:personal} {lang:user} *</td><td class="leftb">
{create:buddys_nick}
</td></tr>
<tr><td class="leftc">
{icon:kate} {lang:notice}
<br /><br />
{create:abcode_smilies}
</td><td class="leftb">
{create:abcode_features}
<textarea name="buddys_notice" cols="50" rows="15" id="buddys_notice" >{create:buddys_notice}</textarea>
</td></tr><tr><td class="leftc">
{icon:ksysguard} {lang:options}</td>
<td class="leftb">
<input type="submit" name="submit" value="{lang:create}" />
<input type="reset" name="reset" value="{lang:reset}" />
</td></tr>
</table>
</form>
{stop:form}

{if:done}
<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
<tr><td class="centerb">
<a href="{url:buddys_center}">{lang:continue}</a>
</td></tr>
</table>
{stop:done}