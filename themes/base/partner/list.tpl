<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width};">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:list}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:our_partner}</td>
  </tr>
</table>
<br />

<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width};" cellpadding="0" cellspacing="0">
{loop:categories}
	<tr>
		<td class="leftb" colspan="2">
     <strong>{categories:categories_name}:</strong>
     <hr style="width: 100%;" size="1" />
    </td>
	</tr>
	{loop:partner}
	<tr>
		<td class="leftb" style="width: {partner:list_width}px">{partner:partner_limg}</td>
		<td class="leftb"><strong>{partner:partner_name}</strong><br /><br />{partner:partner_text}</td>
	</tr>
	<tr>
	  <td class="leftb" colspan="2"><hr style="width: 100%;" size="1" /></td>
	</tr>
	{stop:partner}
{stop:categories}	
</table>