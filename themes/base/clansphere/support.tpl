<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb"> ClanSphere - {lang:support} </td>
  </tr>
  <tr>
    <td class="leftb"> {lang:body_support} </td>
  </tr>
</table>
{loop:support} <br />
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="leftc"><a href="http://{support:url}" target="_blank">{support:name}</a>
      <hr noshade="noshade" style="width:100%" />
      {support:text} </td>
  </tr>
</table>
{stop:support}