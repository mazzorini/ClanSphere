<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
<tr>
<td class="headb" colspan="3">
{head:mod} - {head:action}
</td>
</tr>
<tr>
<td class="leftb">
{icon:editpaste} {head:gbook_entry}
</td>
<td class="leftb">
{icon:contents} {lang:all} {head:gbook_count}
</td>
<td class="rightb">
{head:pages}
</td>
</tr>
</table>
<br />
{lang:getmsg}
{loop:gbook}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="bottom" style="width:160px"># {gbook:entry_count} <br />
		{icon:personal} {gbook:users_nick} <br />
		{gbook:icon_town} {gbook:town} <br />
		{gbook:icon_mail} {gbook:icon_icq} {gbook:icon_msn} {gbook:icon_skype} {gbook:icon_url}<br />
	</td>
    <td class="leftb">{gbook:text}</td>
  </tr>
  <tr>
    <td class="bottom">{gbook:time}</td>
    <td class="leftb">
      <div style="float:right">{gbook:icon_edit}
        {gbook:icon_remove}
        {gbook:icon_ip}
       </div></td>
  </tr>
</table>
<br />
{stop:gbook}