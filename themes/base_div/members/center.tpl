<div class="container" style="width:{page:width}">
    <div class="headb">{lang:mod} - {lang:head_center} </div>
    <div class="leftb"><form method="post" name="members_center" action="{url:form}">
        {lang:team}:
        <select name="id" >
          <option value="0">----</option>
          
		{loop:squad}
          
          <option value="{squad:id}">{squad:name}</option>
          
		  {stop:squad}
        
        </select>
        <input type="submit" name="submit" value="{lang:show}" />
      </form></div>
</div>
<br />
<center>{lang:msg}</center>
<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
  <tr>
    <td class="headb">{sort:user} {lang:user}</td>
    <td class="headb">{sort:task} {lang:task}</td>
    <td class="headb" style="width:60px"> {lang:order}</td>
    <td class="headb" colspan="2"> {lang:options}</td>
  </tr>
  {loop:members}
  <tr>
    <td class="leftc">{members:user}</td>
    <td class="leftc">{members:task}</td>
    <td class="leftc"> {members:order}</td>
    <td class="leftc"> {members:edit}</td>
	<td class="leftc"> {members:remove}</td>
  </tr>
  {stop:members}
</table>
