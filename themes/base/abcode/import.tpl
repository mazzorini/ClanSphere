<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod} - {lang:import}</td>
  </tr>
  <tr>
    <td class="leftb">{head:msg}</td>
  </tr>
</table>
<br />
<form action="#" method="post">
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:name}</td>
    <td class="headb">{lang:preview}</td>
    <td class="headb">{lang:pattern}</td>
  </tr>
  {loop:file}
  <tr>
    <td class="leftb"><input type="hidden" name="file[]" value="{file:name}" />{file:name}</td>
    <td class="leftb">{file:preview}</td>
    <td class="leftb"><input type="text" name="pattern[]" value="{file:run}" /></td>
  </tr>
  {stop:file}
  <tr>
    <td class="centerb" colspan="3"><input type="submit" name="submit" value="{lang:submit}" /></td>
  </tr>
</table>