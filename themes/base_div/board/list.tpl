<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="5">{lang:mod} - {lang:head_list}</td>
 </tr>
 <tr>
  <td class="centerb" style="width:25%"><a href="{url:board_new}">{lang:new}</a></td>
  <td class="centerb" style="width:25%"><a href="{url:board_active}">{lang:active}</a></td>
  <td class="centerb" style="width:25%"><a href="{url:board_toplist}">{lang:toplist}</a></td>
  <td class="centerb" style="width:25%"><a href="{url:board_search}">{lang:search}</a></td>
 </tr>
 <tr>
  <td class="leftc" colspan="2"><a href="{url:board_list}">{lang:board}</a>
    {if:category} -> {category:name}{stop:category}</td>
  <td class="rightc" colspan="2"><a href="{url:board_mark}">{lang:mark_all}</a></td>
 </tr>
</table>
<br />

{head:message}

<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="2">{lang:board}</td>
  <td class="headb">{lang:topics}</td>
  <td class="headb">{lang:replies}</td>
  <td class="headb">{lang:lastpost}</td>
 </tr>
 {loop:categories}
 <tr>
  <td class="leftc" colspan="5">
    <a href="{categories:list_url}">{categories:categories_name}</a>
  </td>
 </tr>
   {loop:board}
   <tr>
    <td class="leftb" style="width:36px">{board:icon}</td>
    <td class="leftb"><strong><a href="{board:listcat_url}">{board:board_name}</a></strong>
      <br />{board:board_text}</td>
    <td class="rightb" style="width:60px">{board:board_topics}</td>
    <td class="rightb" style="width:60px">{board:board_comments}</td>
    <td class="leftb" style="width:180px">
      <a href="{board:last_url}">{board:last_name}</a>
      <br />{board:last_time}
      <br />{board:of} <a href="{board:user_url}">{board:last_usernick}</a></td>
   </tr>
   {stop:board}
 {stop:categories}
 <tr>
  <td class="rightc" colspan="5"><a href="{url:board_mark}">{lang:mark_all}</a></td>
 </tr>
</table>
<br />

<table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
 <tr>
  <td class="headb">{lang:board_stats}</td>
 </tr>
 <tr>
  <td class="leftb">
   <strong>{stats:topics}</strong> {lang:threads_and} <strong>{stats:replies}</strong> {lang:replies}</td>
 </tr>
</table>