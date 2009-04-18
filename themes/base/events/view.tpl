<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb">{lang:mod_name} - {lang:head_view}</td>
	</tr>
	<tr>
		<td class="leftc">{lang:body_view}</td>
	</tr>
{if:topinfo}
	<tr>
		<td class="centerb">{head:status}</td>
	</tr>
{stop:topinfo}
</table>
<br />
{head:getmsg}
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="leftc" style="width:130px">{icon:cal} {lang:name}</td>
		<td class="leftb" colspan="2">{data:events_name}</td>
	</tr>
	<tr>
		<td class="leftc">{icon:folder_yellow} {lang:category}</td>
		<td class="leftb" colspan="2">
			{data:categorie}
		</td>
	</tr>
	<tr>
		<td class="leftc">{icon:1day} {lang:date}</td>
		<td class="leftb" colspan="2">
			{data:time}
		</td>
	</tr>
	<tr>
		<td class="leftc">{icon:starthere} {lang:venue}</td>
		<td class="leftb" colspan="2">{data:events_venue}</td>
	</tr>
	<tr>
		<td class="leftc" rowspan="4">{icon:kdmconfig} {lang:guests}</td>
		<td class="leftb" style="width:140px">
          <a href="{url:events_guests:id={data:events_id}}">{lang:signed}</a>
        </td>
        <td class="leftc">{data:signed}</td>
	</tr>
	<tr>
		<td class="leftb">{lang:min}</td>
		<td class="leftc">{data:events_guestsmin}</td>
	</tr>
	<tr>
		<td class="leftb">{lang:max}</td>
		<td class="leftc">{data:events_guestsmax}</td>
	</tr>
	<tr>
		<td class="leftb">{lang:needage}</td>
		<td class="leftc">{data:events_needage}</td>
	</tr>
	<tr>
		<td class="leftc">{icon:gohome} {lang:url}</td>
		<td class="leftb" colspan="2">{data:events_url}</td>
	</tr>
	<tr>
		<td class="leftc">{icon:images} {lang:pictures}</td>
		<td class="leftb" colspan="2">{data:pictures}</td>
	</tr>
	<tr>
		<td class="leftc">{icon:kate} {lang:more}</td>
		<td class="leftb" colspan="2">
			{data:events_more}
		</td>
	</tr>
</table>